<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Servicio de Chófer',
                'description' => 'Servicio de chófer profesional para traslados en Los Cabos. Incluye vehículo de lujo y conductor experimentado.',
                'price' => 1500.00,
                'category' => 'Transporte',
                'image_url' => 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?w=800',
                'active' => true,
            ],
            [
                'name' => 'Tour de Golf',
                'description' => 'Experiencia de golf en los mejores campos de Los Cabos. Incluye equipo y acceso a instalaciones premium.',
                'price' => 2500.00,
                'category' => 'Deportes',
                'image_url' => 'https://images.unsplash.com/photo-1587174486073-ae5e5cff23aa?w=800',
                'active' => true,
            ],
            [
                'name' => 'Excursión en Yate',
                'description' => 'Navegación de lujo por las aguas de Los Cabos. Incluye bebidas, snacks y equipo de snorkel.',
                'price' => 3500.00,
                'category' => 'Actividades Marítimas',
                'image_url' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800',
                'active' => true,
            ],
        ];

        foreach ($services as $service) {
            \App\Models\Service::create($service);
        }
    }
}
