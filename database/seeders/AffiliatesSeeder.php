<?php

namespace Database\Seeders;

use App\Models\Affiliates;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AffiliatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Affiliates::factory(10)->create();
    }
}
