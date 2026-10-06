<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ArticleCategory::create(['label'=>'porte-clé']);
        ArticleCategory::create(['label'=>'vêtements']);
        ArticleCategory::create(['label'=>'logo']);
    }
}
