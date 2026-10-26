<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClotheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryVetement = ArticleCategory::firstOrCreate(['label'=>'Vêtement']);
        $articles = Article::doesntHave('clothe')->inRandomOrder()->take(10)->get();
        $tailles = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        $colors=['Rouge','Gris','Vert'];
        $cpt = 0; // 1. On crée un compteur

        foreach ($articles as $article) 
        {
            $article->update([
                'article_category_id' => $categoryVetement->id 
            ]);

            // 2. Si le compteur est à 0, pas de couleur. Sinon, au hasard.
            $chosenColor = ($cpt === 0) ? null : $colors[array_rand($colors)];

            $article->clothe()->create([
                'size' => $tailles[array_rand($tailles)],
                'color' => $chosenColor
            ]);
            
            $cpt++; // 3. On augmente le compteur pour les articles suivants
        }
    } 
}
