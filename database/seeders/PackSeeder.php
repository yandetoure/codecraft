<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Pack;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PackSeeder extends Seeder
{
    public function run(): void
    {
        $serviceWeb = Service::where('slug', 'developpement-web')->first();
        $serviceMobile = Service::where('slug', 'applications-mobiles')->first();
        $serviceDesign = Service::where('slug', 'design-branding')->first();

        // Web Packs
        $this->createPack('Pack Starter Web', $serviceWeb, 450000, 
            'Idéal pour lancer votre présence en ligne.', 
            ['SEO Avancé', 'Google Analytics Setup', 'Module Newsletter']
        );
        
        $this->createPack('Pack Business Web', $serviceWeb, 850000, 
            'Site vitrine complet pour PME exigeante.', 
            ['SEO Avancé', 'Multi-langue', 'Panel Admin Custom', 'Google Analytics Setup', 'Blog Intégré'],
            true
        );

        $this->createPack('Pack E-commerce Pro', $serviceWeb, 1500000, 
            'Boutique en ligne performante et sécurisée.', 
            ['SEO Avancé', 'Payment Gateway', 'Panel Admin Custom', 'Chatbot IA', 'Sauvegarde Quotidienne']
        );

        // Mobile Packs
        $this->createPack('Pack MVP Mobile', $serviceMobile, 1500000, 
            'Prototype fonctionnel pour tester votre marché.', 
            ['Panel Admin Custom', 'Google Analytics Setup']
        );

        $this->createPack('Pack Startup Mobile', $serviceMobile, 2500000, 
            'Application native iOS & Android complète.', 
            ['Multi-langue', 'Notifications Push', 'Maintenance 24/7', 'Payment Gateway'],
            true
        );

        // Design Packs
        $this->createPack('Pack Identité Visuelle', $serviceDesign, 350000, 
            'Logo, charte graphique et cartes de visite.', 
            ['Branding Kit Basic']
        );
        
        $this->createPack('Pack UI/UX Design', $serviceDesign, 650000, 
            'Maquettes haute fidélité pour votre app ou site.', 
            ['Branding Kit Basic', 'Prototypage Interactif'] // Assuming Prototypage not seeded, will handle graceful lookup
        );
    }

    private function createPack($name, $service, $price, $description, $featureNames, $isFeatured = false)
    {
        if (!$service) return;

        $pack = Pack::firstOrCreate(
            ['name' => $name],
            [
                'service_id' => $service->id,
                'slug' => Str::slug($name),
                'base_price' => $price,
                'is_featured' => $isFeatured,
                'description' => $description,
            ]
        );

        $features = Feature::whereIn('name', $featureNames)->get();
        $pack->features()->sync($features->pluck('id'));
    }
}
