<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Station;
class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Station::truncate();
        Station::factory()->count(300)->create();
    }
}
