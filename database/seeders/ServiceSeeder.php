<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
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
            [
                'name' => 'Marketing Digital',
                'description' => 'Stratégie SEO/SEA et gestion des réseaux sociaux.',
            ],
            [
                'name' => 'Consulting Tech',
                'description' => 'Audit technique et accompagnement à la transformation digitale.',
            ],
        ];

        foreach ($services as $data) {
            $data['slug'] = Str::slug($data['name']);
            Service::firstOrCreate(['name' => $data['name']], $data);
        }
    }
}
