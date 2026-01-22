<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FeatureSeeder extends Seeder
{
    public function run(): void
    {
        $features = [
            // Technical features (8)
            ['name' => 'SEO Avancé', 'type' => 'technical', 'price' => 150000, 'icon' => '🚀'],
            ['name' => 'Multi-langue', 'type' => 'technical', 'price' => 100000, 'icon' => '🌍'],
            ['name' => 'Chatbot IA', 'type' => 'technical', 'price' => 300000, 'icon' => '🤖'],
            ['name' => 'Panel Admin Custom', 'type' => 'technical', 'price' => 250000, 'icon' => '🎛️'],
            ['name' => 'Payment Gateway', 'type' => 'technical', 'price' => 200000, 'icon' => '💳'],
            ['name' => 'Module Newsletter', 'type' => 'technical', 'price' => 75000, 'icon' => '📧'],
            ['name' => 'Blog Intégré', 'type' => 'technical', 'price' => 120000, 'icon' => '📰'],
            ['name' => 'Migration de Données', 'type' => 'technical', 'price' => 180000, 'icon' => '💾'],

            // Support features (6)
            ['name' => 'Maintenance 24/7', 'type' => 'support', 'price' => 100000, 'icon' => '🛡️'],
            ['name' => 'Formation Équipe', 'type' => 'support', 'price' => 150000, 'icon' => '👨‍🏫'],
            ['name' => 'Rédacteur Dédié', 'type' => 'support', 'price' => 80000, 'icon' => '✍️'],
            ['name' => 'Support Prioritaire', 'type' => 'support', 'price' => 50000, 'icon' => '⚡'],
            ['name' => 'Audit Sécurité', 'type' => 'support', 'price' => 200000, 'icon' => '🔒'],
            ['name' => 'Sauvegarde Quotidienne', 'type' => 'support', 'price' => 45000, 'icon' => '☁️'],

            // Marketing features (6)
            ['name' => 'Google Analytics Setup', 'type' => 'marketing', 'price' => 50000, 'icon' => '📈'],
            ['name' => 'Campagne Publicitaire', 'type' => 'marketing', 'price' => 200000, 'icon' => '📣'],
            ['name' => 'Copywriting Landing Page', 'type' => 'marketing', 'price' => 150000, 'icon' => '📝'],
            ['name' => 'Community Management (1 mois)', 'type' => 'marketing', 'price' => 300000, 'icon' => '📱'],
            ['name' => 'Emailing Automatisé', 'type' => 'marketing', 'price' => 120000, 'icon' => '📨'],
            ['name' => 'Branding Kit Basic', 'type' => 'marketing', 'price' => 250000, 'icon' => '🎨'],
        ];

        foreach ($features as $data) {
            $data['slug'] = Str::slug($data['name']);
            Feature::firstOrCreate(['name' => $data['name']], $data);
        }
    }
}
