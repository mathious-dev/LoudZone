<?php

namespace Database\Seeders;

use App\CategoryEnum;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['label'=>'Porte-clé','type'=>CategoryEnum::ARTICLE]);
        Category::create(['label'=>'Vêtement','type'=>CategoryEnum::ARTICLE]);
        Category::create(['label'=>'Logo','type'=>CategoryEnum::ARTICLE]);

        Category::create(['label'=>'Information','type'=>CategoryEnum::SUPPORT]);
        Category::create(['label'=>'Signalement','type'=>CategoryEnum::SUPPORT]);

        Category::create(['label'=>'Système','type'=>CategoryEnum::ANNOUNCE]);
        Category::create(['label'=>'Utilisateur','type'=>CategoryEnum::ANNOUNCE]);
    }
}
