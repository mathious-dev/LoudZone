<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listUser=User::all();
        $listArticleCategory=ArticleCategory::all();
        for ($i = 0; $i < 50; $i++) {
            $title = fake()->sentence(4); 
            Article::create([
                'title'=> $title,
                'description'=> fake()->paragraphs(3, true),
                'price_ht'=> fake()->randomFloat(2, 5, 500),
                'slug'=> Str::slug($title),// Transforme "Mon Super Titre" en "mon-super-titre"
                'stock'=> fake()->numberBetween(0, 100),
                'is_published' => fake()->boolean(80), 
                'tva'=> fake()->randomElement([6, 12, 21]), 
                'user_id'=> $listUser->random()->id,
                'article_category_id' => $listArticleCategory->random()->id,
            ]);
        }
    }
}
