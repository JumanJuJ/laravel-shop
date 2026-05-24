<?php

namespace Tests\Feature\Api;

use App\Models\order;
use App\Models\products;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_products_ordered_by_them(): void
    {
        $user = User::factory()->create();
        $product = products::create([
            'name' => 'T-shirt',
            'description' => 'Cotone',
            'price' => 19.99,
            'stock' => 5,
        ]);

        order::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'total_price' => 39.98,
        ]);

        $token = $user->createToken('test-token', ['products:read'])->plainTextToken;

        $this->getJson("/api/users/{$user->id}/products", [
            'Authorization' => "Bearer {$token}",
        ])
            ->assertOk()
            ->assertJsonPath('user.email', $user->email)
            ->assertJsonPath('products.0.quantity', 2)
            ->assertJsonPath('products.0.product.name', 'T-shirt');
    }

    public function test_user_can_not_see_products_ordered_by_another_user(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $token = $user->createToken('test-token', ['products:read'])->plainTextToken;

        $this->getJson("/api/users/{$otherUser->id}/products", [
            'Authorization' => "Bearer {$token}",
        ])->assertForbidden();
    }
}
