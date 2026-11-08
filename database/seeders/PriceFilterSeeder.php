<?php

namespace Database\Seeders;

use App\Models\PriceFilter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceFilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PriceFilter::create([
            'label'     => 'Moins de 25 €',
            'min_price' => null,
            'max_price' => 25.00,
        ]);

        PriceFilter::create([
            'label'     => 'De 25 € à 50 €',
            'min_price' => 25.00,
            'max_price' => 50.00,
        ]);

        PriceFilter::create([
            'label'     => 'De 50 € à 100 €',
            'min_price' => 50.00,
            'max_price' => 100.00,
        ]);

        PriceFilter::create([
            'label'     => 'Plus de 100 €',
            'min_price' => 100.00,
            'max_price' => null,
        ]);
    }
}
