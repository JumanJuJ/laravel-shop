<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    public function mine(Request $request): JsonResponse
    {
        return $this->productsForUser($request->user());
    }

    public function index(User $user): JsonResponse
    {
        return $this->productsForUser($user);
    }

    private function productsForUser(User $user): JsonResponse
    {
        $orders = $user->userOrders()
            ->with('product')
            ->latest()
            ->get()
            ->map(fn ($order) => [
                'order_id' => $order->id,
                'quantity' => $order->quantity,
                'total_price' => $order->total_price,
                'ordered_at' => $order->created_at,
                'product' => $order->product,
            ]);

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
            'products' => $orders,
        ]);
    }
}
