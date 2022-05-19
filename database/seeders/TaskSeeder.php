<?php

namespace Database\Seeders;

use App\Models\DailyList;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::factory()->times(1000)->create();
    }
}
