<?php

namespace Database\Seeders;

use App\Models\visite;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class visiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        visite::factory()->times(50)->create();
    }
}
