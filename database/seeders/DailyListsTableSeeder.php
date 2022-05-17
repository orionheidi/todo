<?php

namespace Database\Seeders;

use App\Models\DailyList;
use Illuminate\Database\Seeder;

class DailyListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DailyList::factory()->times(500)->create();
    }
}
