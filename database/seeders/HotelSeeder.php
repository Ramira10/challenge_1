<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hotels = [
            [
                'name' => 'Hotel Paraíso',
                'description' => 'Un hotel de lujo con vista al mar.',
                'address' => 'Calle 123, Playa Bonita',
                'rating' => 5,
                'price_per_night' => 300.00,
            ],
            [
                'name' => 'Montaña Lodge',
                'description' => 'Alojamiento acogedor en la montaña.',
                'address' => 'Ruta 45, Valle Verde',
                'rating' => 4,
                'price_per_night' => 120.00,
            ],
        ];

        foreach ($hotels as $hotel) {
            Hotel::firstOrCreate(['name' => $hotel['name']], $hotel);
        }
    }
}
