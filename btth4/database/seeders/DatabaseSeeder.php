<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Computer;
use App\Models\Issue;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $computers = Computer::factory(10)->create();

        foreach ($computers as $computer) {
            Issue::factory(5)->create([
                'computer_id' => $computer->id
            ]);
        }
    }
}
