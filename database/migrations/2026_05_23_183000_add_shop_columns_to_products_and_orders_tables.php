<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->text('description')->nullable()->after('name');
            $table->decimal('price', 10, 2)->after('description');
            $table->unsignedInteger('stock')->default(0)->after('price');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->after('user_id')->constrained('products')->cascadeOnDelete();
            $table->unsignedInteger('quantity')->default(1)->after('product_id');
            $table->decimal('total_price', 10, 2)->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['product_id']);
            $table->dropColumn(['user_id', 'product_id', 'quantity', 'total_price']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['name', 'description', 'price', 'stock']);
        });
    }
};
