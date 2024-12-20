<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ComputerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'computer_name' => $this->faker->unique()->lexify('Lab?-PC??'),
            'model' => $this->faker->randomElement(['Dell Optiplex 7090','HP EliteDesk 800','Lenovo ThinkCentre M720']),
            'operating_system' => $this->faker->randomElement(['Windows 10 Pro','Windows 11','Ubuntu 20.04']),
            'processor' => $this->faker->randomElement(['Intel Core i5-11400','Intel Core i7-10700','AMD Ryzen 5 5600G']),
            'memory' => $this->faker->randomElement([8,16,32]),
            'available' => $this->faker->boolean(80) 
        ];
    }
}
