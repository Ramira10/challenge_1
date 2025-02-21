<?php

namespace Database\Seeders;

use App\Models\Tour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tours = [
            [
                'name' => 'Tour por la ciudad',
                'description' => 'Un recorrido por los principales puntos turísticos.',
                'price' => 150.00,
                'start_date' => '2025-06-10',
                'end_date' => '2025-06-15',
            ],
            [
                'name' => 'Aventura en la montaña',
                'description' => 'Excursión de senderismo con guías expertos.',
                'price' => 200.00,
                'start_date' => '2025-07-01',
                'end_date' => '2025-07-05',
            ],
        ];

        foreach ($tours as $tour) {
            Tour::firstOrCreate(['name' => $tour['name']], $tour);
        }
    }
}
