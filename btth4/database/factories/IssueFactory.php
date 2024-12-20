<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Computer;

class IssueFactory extends Factory
{
    public function definition(): array
    {
        return [
            'computer_id' => Computer::factory(), 
            'reported_by' => $this->faker->name(),
            'reported_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'description' => $this->faker->paragraph(),
            'urgency' => $this->faker->randomElement(['Low','Medium','High']),
            'status' => $this->faker->randomElement(['Open','In Progress','Resolved'])
        ];
    }
}
