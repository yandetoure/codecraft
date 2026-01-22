<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Pack;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        // 1. SERVICES
        // ----------------------------------------------------------------
        $services = [
            [
                'name' => 'Développement Web',
                'description' => 'Création de sites vitrines, e-commerce et plateformes web sur-mesure.',
            ],
            [
                'name' => 'Applications Mobiles',
                'description' => 'Conception d\'applications natives iOS et Android performantes.',
            ],
            [
                'name' => 'Design & Branding',
                'description' => 'Identité visuelle, maquettage UI/UX et chartes graphiques.',
            ],
        ];

        foreach ($services as $data) {
            $data['slug'] = Str::slug($data['name']);
            Service::firstOrCreate(['name' => $data['name']], $data);
        }

        $serviceWeb = Service::where('name', 'Développement Web')->first();
        $serviceMobile = Service::where('name', 'Applications Mobiles')->first();
        // $serviceDesign = Service::where('name', 'Design & Branding')->first();

        // 2. FEATURES
        // ----------------------------------------------------------------
        $features = [
            // Tech Features
            ['name' => 'SEO Avancé', 'type' => 'technical', 'price' => 150000, 'icon' => '🚀'],
            ['name' => 'Multi-langue', 'type' => 'technical', 'price' => 100000, 'icon' => '🌍'],
            ['name' => 'Chatbot IA', 'type' => 'technical', 'price' => 300000, 'icon' => '🤖'],
            ['name' => 'Panel Admin Custom', 'type' => 'technical', 'price' => 250000, 'icon' => '🎛️'],
            ['name' => 'Payment Gateway', 'type' => 'technical', 'price' => 200000, 'icon' => '💳'],

            // Support Features
            ['name' => 'Maintenance 24/7', 'type' => 'support', 'price' => 100000, 'icon' => '🛡️'],
            ['name' => 'Formation Équipe', 'type' => 'support', 'price' => 150000, 'icon' => '👨‍🏫'],
            ['name' => 'Rédacteur Dédié', 'type' => 'support', 'price' => 80000, 'icon' => '✍️'],

            // Marketing Features
            ['name' => 'Google Analytics Setup', 'type' => 'marketing', 'price' => 50000, 'icon' => '📈'],
            ['name' => 'Campagne Publcitaire', 'type' => 'marketing', 'price' => 200000, 'icon' => '📣'],
        ];

        foreach ($features as $data) {
            $data['slug'] = Str::slug($data['name']);
            Feature::firstOrCreate(['name' => $data['name']], $data);
        }

        // 3. PACKS
        // ----------------------------------------------------------------

        // Packs Web
        $packSolo = Pack::firstOrCreate(['name' => 'Pack Solopreneur', 'service_id' => $serviceWeb->id], [
            'slug' => Str::slug('Pack Solopreneur'),
            'base_price' => 450000,
            'is_featured' => false,
            'description' => 'Idéal pour lancer votre activité en ligne avec professionnalisme.'
        ]);

        $packBusiness = Pack::firstOrCreate(['name' => 'Pack Business', 'service_id' => $serviceWeb->id], [
            'slug' => Str::slug('Pack Business'),
            'base_price' => 850000,
            'is_featured' => true,
            'description' => 'La solution complète pour les PME en croissance.'
        ]);

        $packEcommerce = Pack::firstOrCreate(['name' => 'Pack E-commerce', 'service_id' => $serviceWeb->id], [
            'slug' => Str::slug('Pack E-commerce'),
            'base_price' => 1200000,
            'is_featured' => false,
            'description' => 'Vendez vos produits en ligne avec une boutique performante.'
        ]);

        // Packs Mobile
        $packMvp = Pack::firstOrCreate(['name' => 'Pack MVP Mobile', 'service_id' => $serviceMobile->id], [
            'slug' => Str::slug('Pack MVP Mobile'),
            'base_price' => 1500000,
            'is_featured' => false,
            'description' => 'Lancez votre concept d\'application rapidement sur les stores.'
        ]);

        $packScale = Pack::firstOrCreate(['name' => 'Pack Scale-Up', 'service_id' => $serviceMobile->id], [
            'slug' => Str::slug('Pack Scale-Up'),
            'base_price' => 2500000,
            'is_featured' => true,
            'description' => 'Application mobile native complète iOS & Android.'
        ]);

        // Attach Features to Packs
        // Clear existings to prevent duplication if running multiple times (though migrate:fresh avoids this)
        $packSolo->features()->detach();
        $packBusiness->features()->detach();
        $packEcommerce->features()->detach();
        $packMvp->features()->detach();
        $packScale->features()->detach();

        $allFeatures = Feature::all();

        $packSolo->features()->sync($allFeatures->whereIn('name', ['SEO Avancé', 'Google Analytics Setup'])->pluck('id'));
        $packBusiness->features()->sync($allFeatures->whereIn('name', ['SEO Avancé', 'Multi-langue', 'Panel Admin Custom', 'Google Analytics Setup'])->pluck('id'));
        $packEcommerce->features()->sync($allFeatures->whereIn('name', ['SEO Avancé', 'Payment Gateway', 'Panel Admin Custom', 'Chatbot IA'])->pluck('id'));

        $packMvp->features()->sync($allFeatures->whereIn('name', ['Panel Admin Custom', 'Google Analytics Setup'])->pluck('id'));
        $packScale->features()->sync($allFeatures->whereIn('name', ['Multi-langue', 'Chatbot IA', 'Maintenance 24/7', 'Payment Gateway'])->pluck('id'));
    }
}
