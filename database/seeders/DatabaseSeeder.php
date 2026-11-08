<?php

namespace Database\Seeders;
use Database\Seeders\AnnouncementSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\PriceFilterSeeder;
use Database\Seeders\PromotionSeeder;
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
            CategorySeeder::class,
            ArticleSeeder::class,
            ClotheSeeder::class,
            CartSeeder::class,
            AddInfoSeeder::class,
            SupportMessageSeeder::class,
            OrderSeeder::class,
            ArticleOrderSeeder::class,
            PaymentSeeder::class,
            AddressSeeder::class,
            EventSeeder::class,
            AnnouncementSeeder::class,
            PriceFilterSeeder::class
        ]);
        
    }
}
