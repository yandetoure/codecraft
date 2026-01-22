<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\PaymentSchedule;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    /**
     * Set up an installment plan for a project.
     */
    public function setupInstallmentPlan(Project $project, array $installments): void
    {
        DB::transaction(function () use ($project, $installments) {
            // Remove existing schedules if any and not paid
            $project->paymentSchedules()->where('status', 'pending')->delete();

            foreach ($installments as $index => $installment) {
                $project->paymentSchedules()->create([
                    'installment_number' => $index + 1,
                    'amount' => $installment['amount'],
                    'due_date' => $installment['due_date'],
                    'status' => 'pending',
                ]);
            }

            $project->update(['payment_type' => 'installment']);
        });
    }

    /**
     * Record a payment (e.g. from Wave callback).
     */
    public function recordPayment(Invoice $invoice, float $amount, array $gatewayResponse = []): Payment
    {
        return DB::transaction(function () use ($invoice, $amount, $gatewayResponse) {
            $payment = $invoice->recordPayment($amount, [
                'payment_method' => 'wave',
                'transaction_id' => $gatewayResponse['id'] ?? null,
                'gateway_response' => $gatewayResponse,
                'status' => 'completed',
            ]);

            // If it's an installment, find the oldest pending schedule and mark it
            $project = $invoice->project;
            if ($project->payment_type === 'installment') {
                $schedule = $project->paymentSchedules()
                    ->where('status', 'pending')
                    ->orderBy('installment_number')
                    ->first();

                if ($schedule && abs($schedule->amount - $amount) < 0.01) {
                    $schedule->markAsPaid();
                }
            }

            // Check if project should move to 'en_cours' after first payment
            if ($invoice->paid_amount > 0 && $project->status === 'en_attente_paiement') {
                $project->update(['status' => 'en_cours']);
            }

            return $payment;
        });
    }

    /**
     * Initiate a Wave payment (mock for now).
     */
    public function initiateWavePayment(Invoice $invoice, float $amount): array
    {
        // This would call Wave API
        // For now returning mock redirect URL
        return [
            'status' => 'success',
            'checkout_url' => 'https://checkout.wave.com/pay/' . uniqid(),
            'transaction_id' => 'WAVE_' . uniqid(),
        ];
    }
}
