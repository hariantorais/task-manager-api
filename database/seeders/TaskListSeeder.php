<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lists = ['To Do', 'In Progress', 'Done'];

        foreach ($lists as $list) {
            \App\Models\TaskList::create([
                'name' => $list,
                'board_id' => 1,
            ]);
        }
    }
}
