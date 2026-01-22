<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_number',
        'project_id',
        'client_id',
        'assigned_to_id',
        'type',
        'status',
        'subject',
        'description',
        'scheduled_at',
        'duration_minutes',
        'location',
        'notes',
        'completion_notes',
        'completed_at',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($appointment) {
            if (empty($appointment->appointment_number)) {
                $appointment->appointment_number = 'APT-' . date('Y') . '-' . str_pad(static::whereYear('created_at', date('Y'))->count() + 1, 5, '0', STR_PAD_LEFT);
            }
        });
    }

    // Relationships
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeUpcoming($query)
    {
        return $query->whereIn('status', ['pending', 'confirmed'])
            ->where('scheduled_at', '>', now())
            ->orderBy('scheduled_at');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('scheduled_at', today());
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    // Helper Methods
    public function confirm(): void
    {
        $this->update(['status' => 'confirmed']);
    }

    public function start(): void
    {
        $this->update(['status' => 'in_progress']);
    }

    public function complete(string $completionNotes = null): void
    {
        $this->update([
            'status' => 'completed',
            'completed_at' => now(),
            'completion_notes' => $completionNotes ?? $this->completion_notes,
        ]);
    }

    public function cancel(): void
    {
        $this->update(['status' => 'cancelled']);
    }

    public function reschedule(\DateTime $newDateTime): void
    {
        $this->update([
            'scheduled_at' => $newDateTime,
            'status' => 'pending',
        ]);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isConfirmed(): bool
    {
        return $this->status === 'confirmed';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    public function isUpcoming(): bool
    {
        return in_array($this->status, ['pending', 'confirmed']) && $this->scheduled_at > now();
    }

    public function isPast(): bool
    {
        return $this->scheduled_at < now();
    }

    // Accessors
    public function getTypeLabelAttribute(): string
    {
        return config('codecraft.appointment_types')[$this->type] ?? $this->type;
    }

    public function getEndTimeAttribute(): \DateTime
    {
        return $this->scheduled_at->copy()->addMinutes($this->duration_minutes);
    }
}
