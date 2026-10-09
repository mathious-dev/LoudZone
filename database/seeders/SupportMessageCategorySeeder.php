<?php

namespace Database\Seeders;

use App\Models\SupportMessageCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupportMessageCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SupportMessageCategory::create(['label'=>'Information']);
        SupportMessageCategory::create(['label'=>'Signalement']);
    }
}
