<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser=User::firstOrCreate(['name'=>'Colle',
        'first_name'=>'Mathieu',
        'email'=>'mathieu.colle1@gmail.com',
        'password'=>Hash::make('Mathieu123'),
        'news_letter'=>true])->assignRole('admin');
        for($i=0;$i<99;$i++)
        {
            User::create(
                ['name'=>fake()->lastName(),
                'first_name' => fake()->firstName(),
                'email' => fake()->unique()->safeEmail(), 
                'password' => Hash::make('password123'),
                'news_letter' => fake()->boolean()]
            )->assignRole('user');
        }
    }
}
