<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ArticleCategory::create(['label'=>'Porte-clé']);
        ArticleCategory::create(['label'=>'Vêtement']);
        ArticleCategory::create(['label'=>'Logo']);
    }
}
