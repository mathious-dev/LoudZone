<?php

namespace Database\Seeders;
use Database\Seeders\ArticleCategorySeeder;
use Database\Seeders\SupportMessageCategorySeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ArticleCategorySeeder::class,
            ArticleSeeder::class,
            SupportMessageCategorySeeder::class,
            AddInfoSeeder::class,
            SupportMessageSeeder::class
        ]);
        
    }
}
