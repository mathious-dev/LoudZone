<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Address;
use Illuminate\Database\Seeder;
use Carbon\Carbon; // Très important d'importer Carbon pour gérer les dates

class EventSeeder extends Seeder
{
    public function run(): void
    {
        // On récupère les IDs des adresses disponibles
        $addressIds = Address::pluck('id')->toArray();

        $events = [
            ['label' => 'Braderie de Printemps', 'desc' => 'Grande braderie annuelle avec réductions exceptionnelles dans toute la ville.'],
            ['label' => 'Foire du Livre', 'desc' => 'Rencontrez vos auteurs préférés et découvrez les nouveautés littéraires.'],
            ['label' => 'Festival de Musique', 'desc' => 'Trois jours de concerts en plein air avec des artistes internationaux.'],
            ['label' => 'Salon de l\'Automobile', 'desc' => 'Présentation exclusive des nouveaux véhicules électriques et hybrides.'],
            ['label' => 'Marché de Noël', 'desc' => 'Produits artisanaux, décorations féériques et vin chaud au programme.'],
            ['label' => 'Conférence Tech 2026', 'desc' => 'Les nouvelles tendances du développement web et de l\'intelligence artificielle.'],
            ['label' => 'Exposition d\'Art', 'desc' => 'Découvrez les œuvres magnifiques d\'artistes locaux contemporains.'],
            ['label' => 'Tournoi e-sport', 'desc' => 'Grande compétition sur les jeux vidéo les plus populaires du moment.'],
        ];

        foreach ($events as $eventData) {
            // 1. Date de début : Dans 1 à 60 jours, à une heure aléatoire entre 8h et 19h
            $startHour = rand(8, 19); 
            $startMinute = rand(0, 1) == 1 ? 30 : 0; // Soit pile (00), soit et demi (30)
            
            $startDate = Carbon::now()->addDays(rand(1, 60))->setTime($startHour, $startMinute);
            
            // 2. Date de fin : Même jour ou jusqu'à 3 jours plus tard, entre 18h et 23h
            $endHour = rand(18, 23);
            $endMinute = rand(0, 1) == 1 ? 30 : 0;
            
            $endDate = (clone $startDate)->addDays(rand(0, 3))->setTime($endHour, $endMinute); 

            Event::create([
                'label' => $eventData['label'],
                'description' => $eventData['desc'],
                'start_date' => $startDate, // Enverra par ex: "2026-11-05 09:30:00"
                'end_date' => $endDate,     // Enverra par ex: "2026-11-05 18:00:00"
                'address_id' => !empty($addressIds) ? $addressIds[array_rand($addressIds)] : null
            ]);
        }
    }
}