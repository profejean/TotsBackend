<?php
namespace Database\Factories;

use App\Models\Space;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpaceFactory extends Factory
{
    protected $model = Space::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'location' => $this->faker->address(),
            'capacity' => $this->faker->numberBetween(10, 500),
            'description' => $this->faker->paragraph(),
            'type' => $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 100, 1000)
        ];
    }
}
