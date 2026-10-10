<?php

namespace Database\Seeders;

use App\Models\AddInfo;
use App\Models\SupportMessageCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. On récupère les catégories (Adapte 'label' avec le vrai nom de ta colonne)
        $catInfo = SupportMessageCategory::where('label', 'Information')->first();
        $catSignalement = SupportMessageCategory::where('label', 'Signalement')->first();

        // 2. AddInfo pour la catégorie 'Information'
        $site = AddInfo::create(['label' => 'Site']);
        $commande = AddInfo::create(['label' => 'Commande']);
        $rgpd = AddInfo::create(['label' => 'RGPD']);
        
        // 3. AddInfo pour la catégorie 'Signalement'
        $bug = AddInfo::create(['label' => 'Bug']);
        $article = AddInfo::create(['label' => 'Article']);

        // 4. Pour toutes les catégories
        $autre = AddInfo::create(['label' => 'Autre']);

        // 5. LA LIAISON MAGIQUE (sans modèle pivot)
        if ($catInfo) {
            // On attache les IDs à la catégorie "Information"
            $catInfo->addInfos()->attach([
                $site->id, 
                $commande->id, 
                $rgpd->id, 
                $autre->id // "Autre" est partout
            ]);
        }

        if ($catSignalement) {
            // On attache les IDs à la catégorie "Signalement"
            $catSignalement->addInfos()->attach([
                $bug->id, 
                $article->id, 
                $autre->id // "Autre" est partout
            ]);
        }
    }
}
