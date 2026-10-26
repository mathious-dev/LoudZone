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
        foreach ($articles as $article) {
            
            $article->update([
                'article_category_id' => $categoryVetement->id 
            ]);
            $article->clothe()->create([
                'size' => $tailles[array_rand($tailles)]
            ]);
        }
    }
}
