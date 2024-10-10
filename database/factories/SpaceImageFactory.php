<?php

namespace Database\Factories;
use App\Models\SpaceImage;
use App\Models\Space;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpaceImageFactory extends Factory
{
    protected $model = SpaceImage::class;

    public function definition()
    {
        return [
            'space_id' => Space::factory(),
            'url' => $this->faker->imageUrl(),
        ];
    }
}
