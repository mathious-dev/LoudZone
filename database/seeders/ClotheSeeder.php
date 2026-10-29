<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

class ClotheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryVetement = ArticleCategory::firstOrCreate(['label' => 'Vêtement']);
        $articles = Article::inRandomOrder()->take(10)->get();
        $tailles = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        $colors = ['Rouge', 'Gris', 'Vert'];
        
        $cpt = 0; 

        foreach ($articles as $article) 
        {
            $article->update([
                'article_category_id' => $categoryVetement->id 
            ]);
            $nombreDeVariantes = rand(1, 3);

            for ($i = 0; $i < $nombreDeVariantes; $i++) 
            {
                $chosenColor = ($cpt === 0) ? null : $colors[array_rand($colors)];
                $article->clothes()->create([
                    'size' => $tailles[array_rand($tailles)],
                    'color' => $chosenColor
                ]);
            }
            $cpt++;
        }
    } 
}
