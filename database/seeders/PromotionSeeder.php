<?php

namespace Database\Seeders;

use App\Models\Promotion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Promotion::create([
            'label'      => "Promotion d'hiver",
            'amount'     => 20.00,
            'start_date' => now(),                  
            'end_date'   => now()->addMonths(1)   
        ]);
        Promotion::create([
            'amount'     => 10.00,
            'start_date' => now()->subDays(5),      
            'end_date'   => null                    
        ]);
    }
}
