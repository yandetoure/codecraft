<?php

namespace App\Services;

use App\Models\Project;
use App\Models\Pack;
use App\Models\Quote;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProjectService
{
    /**
     * Create a new project from a pack selection.
     */
    public function createFromPack(User $client, Pack $pack, Collection $optionalFeatures, array $data = []): Project
    {
        return DB::transaction(function () use ($client, $pack, $optionalFeatures, $data) {
            $project = Project::create([
                'client_id' => $client->id,
                'pack_id' => $pack->id,
                'name' => $data['name'] ?? ($pack->name . ' - ' . $client->name),
                'domain_name' => $data['domain_name'] ?? null,
                'description' => $data['description'] ?? null,
                'client_notes' => $data['client_notes'] ?? null,
                'payment_type' => $data['payment_type'] ?? 'total',
                'base_price' => $pack->base_price,
                'status' => 'demande',
            ]);

            // Add all included features from pack
            $includedFeatures = $pack->features()->wherePivot('is_included', true)->get();
            foreach ($includedFeatures as $feature) {
                $project->features()->attach($feature->id, ['price' => 0]); // Included in base price
            }

            // Add optional features
            foreach ($optionalFeatures as $feature) {
                $project->features()->attach($feature->id, ['price' => $feature->price]);
            }

            $project->calculateTotalPrice();

            // Create default empty configuration
            $project->configuration()->create([
                'company_name' => $data['company_name'] ?? $client->name,
            ]);

            return $project;
        });
    }

    /**
     * Update project status and handle related business logic.
     */
    public function updateStatus(Project $project, string $newStatus, string $notes = null): bool
    {
        return DB::transaction(function () use ($project, $newStatus, $notes) {
            $oldStatus = $project->status;

            if ($oldStatus === $newStatus) {
                return true;
            }

            $project->status = $newStatus;

            if ($newStatus === 'en_cours' && empty($project->started_at)) {
                $project->started_at = now();
            }

            if ($newStatus === 'termine' && empty($project->completed_at)) {
                $project->completed_at = now();
            }

            $project->save();

            // Status history is created via model boot updating hook

            return true;
        });
    }

    /**
     * Generate a quote for a project.
     */
    public function generateQuote(Project $project, array $data = []): Quote
    {
        return Quote::create([
            'project_id' => $project->id,
            'total_amount' => $project->total_price,
            'notes' => $data['notes'] ?? null,
            'status' => 'draft',
            'valid_until' => isset($data['valid_until']) ? Carbon::parse($data['valid_until']) : now()->addDays(30),
        ]);
    }

    /**
     * Convert an accepted quote to an invoice.
     */
    public function convertToInvoice(Quote $quote): Invoice
    {
        if ($quote->status !== 'accepted') {
            throw new \Exception('Only accepted quotes can be converted to invoices.');
        }

        return DB::transaction(function () use ($quote) {
            $invoice = Invoice::create([
                'project_id' => $quote->project_id,
                'quote_id' => $quote->id,
                'total_amount' => $quote->total_amount,
                'status' => 'pending',
                'due_date' => now()->addDays(7),
            ]);

            $quote->project->update(['status' => 'en_attente_paiement']);

            return $invoice;
        });
    }
}
