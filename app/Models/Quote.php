<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'quote_number',
        'total_amount',
        'notes',
        'status',
        'valid_until',
        'sent_at',
        'accepted_at',
        'rejected_at',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'valid_until' => 'date',
        'sent_at' => 'datetime',
        'accepted_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($quote) {
            if (empty($quote->quote_number)) {
                $prefix = config('codecraft.quote.prefix', 'DEV');
                $quote->quote_number = $prefix . '-' . date('Y') . '-' . str_pad(static::whereYear('created_at', date('Y'))->count() + 1, 4, '0', STR_PAD_LEFT);
            }

            if (empty($quote->valid_until)) {
                $validityDays = config('codecraft.quote.validity_days', 30);
                $quote->valid_until = now()->addDays($validityDays);
            }
        });
    }

    // Relationships
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'sent');
    }

    public function scopeExpired($query)
    {
        return $query->where('status', 'sent')
            ->where('valid_until', '<', now());
    }

    // Helper Methods
    public function markAsSent(): void
    {
        $this->update([
            'status' => 'sent',
            'sent_at' => now(),
        ]);
    }

    public function accept(): void
    {
        $this->update([
            'status' => 'accepted',
            'accepted_at' => now(),
        ]);
    }

    public function reject(): void
    {
        $this->update([
            'status' => 'rejected',
            'rejected_at' => now(),
        ]);
    }

    public function isExpired(): bool
    {
        return $this->status === 'sent' && $this->valid_until < now();
    }
}
