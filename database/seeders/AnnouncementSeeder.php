<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Announcement::create(['label'=>'Maintenance','content'=>'Une maintenance du site est en cours']);
        Announcement::create(['label'=>'Problème','content'=>"Nous sommes conscient d'un problème sur le site, nous faisons au plus vite pour le régler.Excusez-nous pour la gêne occassionnée"]);
    }
}
