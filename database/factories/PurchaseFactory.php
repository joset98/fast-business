<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $quantity = $this->faker->numberBetween(5, 50);
        $product = Product::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();
        $total = ($product->cost + ($product->cost * ( $product->tax / 100) )) * $quantity;

        return [
            'product_id' => $product,
            'user_id' => $user,
            'quantity' => $quantity,
            'total' => $total,
        ];
    }
}
