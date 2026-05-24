<?php

namespace Database\Seeders;

use App\Models\products;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        products::factory()
            ->count(10)
            ->create();
    }
}
