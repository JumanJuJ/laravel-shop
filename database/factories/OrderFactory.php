<?php

namespace Database\Factories;

use App\Models\order;
use App\Models\products;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = products::query()->inRandomOrder()->first() ?? products::factory()->create();
        $quantity = fake()->numberBetween(1, 5);

        return [
            'user_id' => User::query()->inRandomOrder()->value('id') ?? User::factory(),
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_price' => $product->price * $quantity,
        ];
    }
}
