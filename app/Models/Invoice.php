<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'quote_id',
        'invoice_number',
        'total_amount',
        'paid_amount',
        'remaining_amount',
        'notes',
        'status',
        'due_date',
        'issued_at',
        'paid_at',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'remaining_amount' => 'decimal:2',
        'due_date' => 'date',
        'issued_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            if (empty($invoice->invoice_number)) {
                $prefix = config('codecraft.invoice.prefix', 'FACT');
                $invoice->invoice_number = $prefix . '-' . date('Y') . '-' . str_pad(static::whereYear('created_at', date('Y'))->count() + 1, 4, '0', STR_PAD_LEFT);
            }

            if (empty($invoice->issued_at)) {
                $invoice->issued_at = now();
            }

            $invoice->remaining_amount = $invoice->total_amount - $invoice->paid_amount;
        });

        static::updating(function ($invoice) {
            $invoice->remaining_amount = $invoice->total_amount - $invoice->paid_amount;

            if ($invoice->remaining_amount <= 0 && $invoice->status !== 'paid') {
                $invoice->status = 'paid';
                $invoice->paid_at = now();
            } elseif ($invoice->remaining_amount > 0 && $invoice->remaining_amount < $invoice->total_amount) {
                $invoice->status = 'partial';
            }
        });
    }

    // Relationships
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeOverdue($query)
    {
        return $query->where('status', 'pending')
            ->where('due_date', '<', now());
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    // Helper Methods
    public function recordPayment(float $amount, array $paymentData = []): Payment
    {
        $payment = $this->payments()->create(array_merge([
            'amount' => $amount,
            'status' => 'completed',
            'paid_at' => now(),
        ], $paymentData));

        $this->paid_amount += $amount;
        $this->save();

        return $payment;
    }

    public function markAsPaid(): void
    {
        $this->update([
            'status' => 'paid',
            'paid_at' => now(),
            'paid_amount' => $this->total_amount,
            'remaining_amount' => 0,
        ]);
    }

    public function isOverdue(): bool
    {
        return $this->status === 'pending' && $this->due_date < now();
    }

    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }

    public function isPartiallyPaid(): bool
    {
        return $this->status === 'partial';
    }
}
