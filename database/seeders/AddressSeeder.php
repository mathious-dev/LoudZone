<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        $addresses = [
            ['city' => 'Mons', 'postal_code' => '7000', 'street' => 'Grand Place, 1'],
            ['city' => 'Bruxelles', 'postal_code' => '1000', 'street' => 'Rue Neuve, 45'],
            ['city' => 'Paris', 'postal_code' => '75001', 'street' => 'Rue de Rivoli, 10'],
            ['city' => 'Lyon', 'postal_code' => '69002', 'street' => 'Place Bellecour, 5'],
            ['city' => 'Bordeaux', 'postal_code' => '33000', 'street' => 'Rue Sainte-Catherine, 120'],
        ];

        foreach ($addresses as $address) {
            Address::create($address);
        }
    }
}