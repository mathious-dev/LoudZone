<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use App\Enum\StateEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // On récupère tous les IDs des utilisateurs existants
        $userIds = User::pluck('id')->toArray();
        if (empty($userIds)) {
            $userIds = [1]; // Sécurité au cas où la table est vide
        }

        // On récupère tous les cas possibles de ton Enum
        $states = StateEnum::cases();

        // On génère 25 commandes aléatoires
        for ($i = 0; $i < 25; $i++) {
            Order::create([
                // Génère une référence du type "CMD-A1B2C3D4"
                'reference' => 'CMD-' . strtoupper(Str::random(8)), 
                
                // Sélectionne un état au hasard (WAITING, REFUSED, ou FINISHED)
                'state' => $states[array_rand($states)], 
                
                // J'ai mis un prix aléatoire provisoire pour que ton affichage soit joli en attendant les articles
                'total_price' => rand(20, 150) + (rand(0, 99) / 100), 
                
                'user_id' => $userIds[array_rand($userIds)]
            ]);
        }
    }
}