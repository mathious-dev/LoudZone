<?php

namespace Database\Seeders;

use App\Models\SupportMessage;
use App\Models\SupportMessageCategory;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupportMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // On initialise Faker en français pour des données réalistes
        $faker = Faker::create('fr_FR');
        $categories = SupportMessageCategory::all();
        $users = User::all();
        for ($i = 0; $i < 15; $i++) {
            SupportMessage::create([
                'title' => $faker->sentence(nbWords: 5, variableNbWords: true), // Un titre de 5 mots
                'content' => $faker->paragraphs(3, true), // Un texte de 3 paragraphes
                'user_id' => $users->random()->id, 
                'state' => $faker->boolean(30), 
                

                'support_message_category_id' => $categories->random()->id,
            ]);
        }
    }
}
