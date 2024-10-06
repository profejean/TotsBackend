<?php

namespace Database\Factories;
use App\Models\Service;
use App\Models\Space;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'space_id' => Space::factory(),
        ];
    }
}