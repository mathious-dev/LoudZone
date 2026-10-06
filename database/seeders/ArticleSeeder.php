<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0;$i++;$i<50)
        {
            Article::create(['title'=>'',
            'description'=>'',
            'price_ht'=>'',
            'slug'=>'',
            'stock'=>'',
            'is_published'=>'',
            'tva'=>'',
            'user_id'=>'',
            'article_category_id'=>'',
            ]);
        }
    }
}
