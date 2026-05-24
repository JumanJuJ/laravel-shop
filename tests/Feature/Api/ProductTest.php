<?php

namespace Tests\Feature\Api;

use App\Models\products;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_get_all_products(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token', ['products:read'])->plainTextToken;

        products::create([
            'name' => 'T-shirt',
            'description' => 'Cotone',
            'price' => 19.99,
            'stock' => 5,
        ]);

        products::create([
            'name' => 'Felpa',
            'description' => 'Invernale',
            'price' => 49.99,
            'stock' => 3,
        ]);

        $this->getJson('/api/products', [
            'Authorization' => "Bearer {$token}",
        ])
            ->assertOk()
            ->assertJsonCount(2, 'products')
            ->assertJsonPath('products.0.name', 'T-shirt')
            ->assertJsonPath('products.1.name', 'Felpa');
    }
}
