<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Feature;
use App\Models\Invoice;
use App\Models\Pack;
use App\Models\Project;
use App\Models\Quote;
use App\Models\SupportTicket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $clients = User::role('client')->get();
        if ($clients->isEmpty()) {
            return;
        }

        $webPack = Pack::where('slug', 'pack-business-web')->first();
        $mobilePack = Pack::where('slug', 'pack-startup-mobile')->first();

        $webProjects = [
            'Site E-commerce Bio',
            'Portail Immobilier',
            'Blog Voyage',
            'Site Vitrine Avocat',
            'Dashboard Analytique',
            'Marketplace Artisanat',
            'Site Restaurant Luxe',
            'Plateforme E-learning',
            'Site Cabinet Medical',
            'Agence Voyage Booking'
        ];

        $mobileProjects = [
            'App Fitness Tracker',
            'App Livraison Repas',
            'App Gestion Budget',
            'App Meditation',
            'App Streaming Audio',
            'App Reseau Social',
            'App Scan Documents',
            'App Messagerie',
            'App Meteo Locale',
            'App VTC Service'
        ];

        // Seed Web Projects
        foreach ($webProjects as $index => $name) {
            $this->createProject($name, 'web', $webPack, $clients->random(), $index);
        }

        // Seed Mobile Projects
        foreach ($mobileProjects as $index => $name) {
            $this->createProject($name, 'mobile', $mobilePack, $clients->random(), $index + 10);
        }
    }

    private function createProject($name, $type, $pack, $client, $index)
    {
        if (!$pack)
            return;

        $statuses = ['demande', 'devis_envoye', 'en_attente_paiement', 'en_cours', 'termine', 'en_maintenance'];
        $status = $statuses[$index % count($statuses)];

        $date = Carbon::now()->subDays(rand(1, 100));

        $project = Project::create([
            'project_number' => 'PRJ-' . Carbon::now()->format('Y') . '-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
            'client_id' => $client->id,
            'pack_id' => $pack->id,
            'name' => $name,
            'domain_name' => Str::slug($name) . ($type == 'web' ? '.com' : '.app'),
            'description' => "Projet de développement $type complet pour $name.",
            'client_notes' => 'Client souhaite une intégration rapide.',
            'admin_notes' => 'Projet standard, vérifier les specs.',
            'status' => $status,
            'base_price' => $pack->base_price,
            'payment_type' => 'one_time',
            'created_by_id' => 1, // Super Admin
            'started_at' => in_array($status, ['en_cours', 'termine', 'en_maintenance']) ? $date : null,
            'completed_at' => $status === 'termine' ? $date->copy()->addDays(30) : null,
        ]);

        // Add Features
        $features = Feature::inRandomOrder()->take(rand(3, 6))->get();
        foreach ($features as $feature) {
            $project->features()->attach($feature->id, ['price' => $feature->price]);
        }
        $project->calculateTotalPrice();

        // Generate Related Data based on status
        if ($status !== 'demande') {
            $this->createQuote($project);
        }

        if (in_array($status, ['en_cours', 'termine', 'en_maintenance'])) {
            $this->createInvoice($project);
        }

        // Random Appointment
        if (rand(0, 1)) {
            Appointment::create([
                'appointment_number' => 'APT-' . uniqid(),
                'client_id' => $client->id,
                'project_id' => $project->id,
                'subject' => 'Point d\'avancement ' . $name,
                'scheduled_at' => Carbon::now()->addDays(rand(1, 14)),
                'duration_minutes' => 30,
                'status' => 'confirmed',
                'notes' => 'Réunion de suivi.',
                'location' => 'En ligne: https://meet.google.com/abc-defg-hij',
            ]);
        }

        // Random Support Ticket
        if (in_array($status, ['en_cours', 'en_maintenance']) && rand(0, 1)) {
            SupportTicket::create([
                'ticket_number' => 'TKT-' . strtoupper(Str::random(8)),
                'client_id' => $client->id,
                'project_id' => $project->id,
                'subject' => 'Question sur une fonctionnalité',
                'description' => 'Comment mettre à jour le contenu de la page d\'accueil ?',
                'status' => 'open',
                'priority' => 'medium',
            ]);
        }
    }

    private function createQuote($project)
    {
        Quote::create([
            'quote_number' => 'DEV-' . strtoupper(Str::random(8)),
            'project_id' => $project->id,
            'total_amount' => $project->total_price,
            'valid_until' => Carbon::now()->addDays(30),
            'status' => 'accepted', // Assume accepted for advanced stages
        ]);
    }

    private function createInvoice($project)
    {
        Invoice::create([
            'invoice_number' => 'FAC-' . strtoupper(Str::random(8)),
            'project_id' => $project->id,
            'quote_id' => $project->quotes->first()->id ?? null,
            'total_amount' => $project->total_price,
            'paid_amount' => $project->total_price * 0.3, // 30% deposit
            'due_date' => Carbon::now()->addDays(30),
            'status' => 'partial',
            'issued_at' => Carbon::now(),
        ]);
    }
}
