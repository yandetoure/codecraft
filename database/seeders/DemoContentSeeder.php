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
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Demo Clients
        $client1 = User::create([
            'name' => 'Moussa Diop',
            'email' => 'moussa@client.com',
            'password' => Hash::make('password'),
        ]);
        $client1->assignRole('client');

        $client2 = User::create([
            'name' => 'Fatou Ndiaye',
            'email' => 'fatou@client.com',
            'password' => Hash::make('password'),
        ]);
        $client2->assignRole('client');

        $admin = User::role('admin')->first() ?? User::where('email', 'admin@codecraft.com')->first();

        // 2. Client 1 Project: "La Teranga Restaurant" (Web, In Progress)
        // ----------------------------------------------------------------
        $packBusiness = Pack::where('name', 'Pack Business')->first();
        $seoFeature = Feature::where('name', 'SEO Avancé')->first();

        $project1 = Project::create([
            'project_number' => 'PRJ-2024-001',
            'name' => 'La Teranga Restaurant',
            'description' => 'Site vitrine moderne pour un restaurant gastronomique avec module de réservation.',
            'client_id' => $client1->id,
            'pack_id' => $packBusiness->id,
            'status' => 'en_cours',
            'started_at' => now()->subDays(15),
            'total_price' => $packBusiness->base_price + $seoFeature->price,
        ]);
        $project1->features()->attach($seoFeature->id, ['price' => $seoFeature->price]);

        // History
        $project1->statusHistories()->create([
            'old_status' => 'demande',
            'new_status' => 'demande',
            'notes' => 'Création du projet',
            'changed_by_id' => $client1->id,
            'created_at' => now()->subDays(15)
        ]);
        $project1->statusHistories()->create([
            'old_status' => 'demande',
            'new_status' => 'devis_envoye',
            'notes' => 'Devis généré',
            'changed_by_id' => $admin->id,
            'created_at' => now()->subDays(14)
        ]);
        $project1->statusHistories()->create([
            'old_status' => 'devis_envoye',
            'new_status' => 'en_cours',
            'notes' => 'Démarrage du projet',
            'changed_by_id' => $admin->id,
            'created_at' => now()->subDays(10)
        ]);

        // Quote
        $quote1 = Quote::create([
            'quote_number' => 'DEV-2024-001',
            'project_id' => $project1->id,
            'total_amount' => $project1->total_price,
            'valid_until' => now()->addDays(15),
            'status' => 'accepted'
        ]);

        // Invoice (Deposit)
        Invoice::create([
            'invoice_number' => 'FAC-2024-001',
            'project_id' => $project1->id,
            'quote_id' => $quote1->id,
            'total_amount' => $project1->total_price * 0.4, // Deposit amount
            'paid_amount' => $project1->total_price * 0.4, // Paid
            'remaining_amount' => 0,
            'due_date' => now()->subDays(10),
            'status' => 'paid',
            'paid_at' => now()->subDays(9),
        ]);

        // Appointment
        Appointment::create([
            'appointment_number' => 'APT-2024-012',
            'project_id' => $project1->id,
            'client_id' => $client1->id,
            'assigned_to_id' => $admin->id,
            'type' => 'consultation',
            'status' => 'completed',
            'subject' => 'Kick-off Meeting',
            'description' => 'Réunion de lancement pour définir la charte graphique.',
            'scheduled_at' => now()->subDays(10),
            'duration_minutes' => 60,
            'location' => 'Google Meet'
        ]);

        // Support Ticket
        $ticket1 = SupportTicket::create([
            'ticket_number' => 'TKT-2024-056',
            'client_id' => $client1->id,
            'project_id' => $project1->id,
            'assigned_to_id' => $admin->id,
            'type' => 'technical',
            'priority' => 'medium',
            'status' => 'open',
            'subject' => 'Question sur le menu',
            'description' => 'Est-il possible d\'ajouter des photos pour chaque plat du menu ?',
        ]);
        $ticket1->messages()->create([
            'user_id' => $client1->id,
            'message' => 'Bonjour, je voulais savoir si le module menu supporte les images HD ?',
        ]);
        $ticket1->messages()->create([
            'user_id' => $admin->id,
            'message' => 'Bonjour Moussa, oui tout à fait ! Je vous envoie les specs techniques.',
        ]);


        // 3. Client 2 Project: "Dakar Delivers" (Mobile App, Planning)
        // -------------------------------------------------------------
        $packMvp = Pack::where('name', 'Pack MVP Mobile')->first();

        $project2 = Project::create([
            'project_number' => 'PRJ-2024-002',
            'name' => 'Dakar Delivers',
            'description' => 'App de livraison locale MVP.',
            'client_id' => $client2->id,
            'pack_id' => $packMvp->id,
            'status' => 'devis_envoye', // En devis
            'total_price' => $packMvp->base_price,
            'started_at' => null,
        ]);

        Quote::create([
            'quote_number' => 'DEV-2024-002',
            'project_id' => $project2->id,
            'total_amount' => $project2->total_price,
            'valid_until' => now()->addDays(7),
            'status' => 'pending'
        ]);

        Appointment::create([
            'appointment_number' => 'APT-2024-089',
            'project_id' => $project2->id,
            'client_id' => $client2->id,
            'assigned_to_id' => $admin->id,
            'type' => 'consultation',
            'status' => 'scheduled',
            'subject' => 'Validation Specs MVP',
            'description' => 'Revue finale des fonctionnalités pour le MVP.',
            'scheduled_at' => now()->addDays(2),
            'duration_minutes' => 45,
            'location' => 'Zoom'
        ]);
    }
}
