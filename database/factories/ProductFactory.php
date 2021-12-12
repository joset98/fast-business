<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randImage = $this->faker->randomNumber(100); 
        return [
            'name' => $this->faker->word(),
            'cost' => $this->faker->randomFloat(2, 1, 200),
            'tax' => $this->faker->randomFloat(2, 1, 30),
            'stock' => $this->faker->numberBetween(50,200),
            'picture_file' => 'https://picsum.photos/200/200?random=' . $randImage,
            // 'picture_file' => $this->faker->imageUrl(200, 200),
        ];
    }
}
