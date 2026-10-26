<?php

namespace Database\Seeders;
use Database\Seeders\AnnouncementSeeder;
use Database\Seeders\ArticleCategorySeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\PromotionSeeder;
use Database\Seeders\SupportMessageCategorySeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            PromotionSeeder::class,
            ArticleCategorySeeder::class,
            ArticleSeeder::class,
            ClotheSeeder::class,
            CartSeeder::class,
            SupportMessageCategorySeeder::class,
            AddInfoSeeder::class,
            SupportMessageSeeder::class,
            OrderSeeder::class,
            ArticleOrderSeeder::class,
            PaymentSeeder::class,
            AddressSeeder::class,
            EventSeeder::class,
            AnnouncementSeeder::class
        ]);
        
    }
}
