<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Division;
class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Division::truncate();

        Division::factory()->count(7)->create();
    }
}
