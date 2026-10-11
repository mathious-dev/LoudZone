<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // On récupère tous les IDs des utilisateurs existants
        $userIds = User::pluck('id')->toArray();
        if (empty($userIds)) {
            $userIds = [1]; // Sécurité au cas où la table est vide
        }

        // On génère 25 commandes aléatoires
        for ($i = 0; $i < 25; $i++) {
            Order::create([
                'state' => (bool)rand(0, 1), // 50% de chance d'être validée (true) ou en attente (false)
                'total_price' => 0, // Temporaire : on va calculer le vrai prix dans le prochain seeder !
                'user_id' => $userIds[array_rand($userIds)]
            ]);
        }
    }
}