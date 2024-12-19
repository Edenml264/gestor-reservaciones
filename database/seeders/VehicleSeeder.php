<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            [
                'name' => 'Tesla Model X',
                'type' => 'tesla',
                'capacity' => 4,
                'price_normal' => 150.00,
                'price_paypal' => 165.00,
                'description' => 'Luxury Tesla Model X for premium transportation',
                'image_url' => 'https://images.unsplash.com/photo-1560958089-b8a1929cea89?w=800',
                'active' => true,
            ],
            [
                'name' => 'Luxury SUV',
                'type' => 'suv',
                'capacity' => 6,
                'price_normal' => 120.00,
                'price_paypal' => 132.00,
                'description' => 'Comfortable SUV for small groups',
                'image_url' => 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?w=800',
                'active' => true,
            ],
            [
                'name' => 'Premium Minivan',
                'type' => 'minivan',
                'capacity' => 8,
                'price_normal' => 140.00,
                'price_paypal' => 154.00,
                'description' => 'Spacious minivan for medium groups',
                'image_url' => 'https://images.unsplash.com/photo-1559416523-140ddc3d238c?w=800',
                'active' => true,
            ],
            [
                'name' => 'Executive Van',
                'type' => 'van',
                'capacity' => 12,
                'price_normal' => 160.00,
                'price_paypal' => 176.00,
                'description' => 'Comfortable van for larger groups',
                'image_url' => 'https://images.unsplash.com/photo-1464219789935-c2d9d9eb4d19?w=800',
                'active' => true,
            ],
            [
                'name' => 'Large Van',
                'type' => 'largevan',
                'capacity' => 15,
                'price_normal' => 180.00,
                'price_paypal' => 198.00,
                'description' => 'Spacious van for large groups',
                'image_url' => 'https://images.unsplash.com/photo-1464219789935-c2d9d9eb4d19?w=800',
                'active' => true,
            ],
            [
                'name' => 'Airport Shuttle',
                'type' => 'shuttle',
                'capacity' => 20,
                'price_normal' => 200.00,
                'price_paypal' => 220.00,
                'description' => 'Economic shuttle service for large groups',
                'image_url' => 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=800',
                'active' => true,
            ],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }
    }
}
