<?php

namespace App\Services;

use App\Models\User;
use App\Models\Project;
use App\Models\Quote;
use App\Models\Invoice;
use App\Models\SupportTicket;

class NotificationService
{
    /**
     * Notify client that a quote has been generated.
     */
    public function notifyQuoteGenerated(Quote $quote): void
    {
        $client = $quote->project->client;
        // Logic to send email, WhatsApp, SMS
        // $client->notify(new \App\Notifications\QuoteGenerated($quote));
    }

    /**
     * Notify client that project status has changed.
     */
    public function notifyStatusUpdate(Project $project): void
    {
        $client = $project->client;
        // $client->notify(new \App\Notifications\ProjectStatusUpdated($project));
    }

    /**
     * Notify admin of new support ticket.
     */
    public function notifyNewTicket(SupportTicket $ticket): void
    {
        $admins = User::role(['admin', 'super_admin'])->get();
        // Notification::send($admins, new \App\Notifications\NewSupportTicket($ticket));
    }

    /**
     * Notify client of payment confirmation.
     */
    public function notifyPaymentConfirmed(Invoice $invoice, float $amount): void
    {
        $client = $invoice->project->client;
        // $client->notify(new \App\Notifications\PaymentConfirmed($invoice, $amount));
    }
}
