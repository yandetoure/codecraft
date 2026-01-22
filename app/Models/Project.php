<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_number',
        'client_id',
        'pack_id',
        'name',
        'domain_name',
        'description',
        'client_notes',
        'admin_notes',
        'status',
        'base_price',
        'features_price',
        'total_price',
        'payment_type',
        'created_by_id',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'features_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    // Boot
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->project_number)) {
                $project->project_number = 'PRJ-' . strtoupper(uniqid());
            }
        });

        static::updating(function ($project) {
            if ($project->isDirty('status')) {
                $project->statusHistories()->create([
                    'old_status' => $project->getOriginal('status'),
                    'new_status' => $project->status,
                    'changed_by_id' => auth()->id(),
                ]);
            }
        });
    }

    // Relationships
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function pack(): BelongsTo
    {
        return $this->belongsTo(Pack::class);
    }

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class, 'feature_project')
            ->withPivot('price')
            ->withTimestamps();
    }

    public function configuration(): HasOne
    {
        return $this->hasOne(ProjectConfiguration::class);
    }

    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function paymentSchedules(): HasMany
    {
        return $this->hasMany(PaymentSchedule::class);
    }

    public function supportTickets(): HasMany
    {
        return $this->hasMany(SupportTicket::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function statusHistories(): HasMany
    {
        return $this->hasMany(ProjectStatusHistory::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    // Scopes
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByClient($query, int $clientId)
    {
        return $query->where('client_id', $clientId);
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['en_cours', 'en_maintenance']);
    }

    public function scopePending($query)
    {
        return $query->whereIn('status', ['demande', 'devis_envoye', 'en_attente_paiement']);
    }

    // Accessors & Mutators
    public function getStatusLabelAttribute(): string
    {
        return config('codecraft.project_statuses')[$this->status] ?? $this->status;
    }

    public function getPaymentTypeLabelAttribute(): string
    {
        return config('codecraft.payment_types')[$this->payment_type] ?? $this->payment_type;
    }

    // Helper Methods
    public function calculateTotalPrice(): void
    {
        $this->base_price = $this->pack ? $this->pack->base_price : 0;
        $this->features_price = $this->features->sum('pivot.price');
        $this->total_price = $this->base_price + $this->features_price;
        $this->save();
    }

    public function isCompleted(): bool
    {
        return $this->status === 'termine';
    }

    public function isPending(): bool
    {
        return in_array($this->status, ['demande', 'devis_envoye', 'en_attente_paiement']);
    }

    public function isActive(): bool
    {
        return in_array($this->status, ['en_cours', 'en_maintenance']);
    }
}
