<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use MongoDB\Laravel\Schema\Blueprint;

return new class extends Migration
{
    protected $connection = 'mongodb';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cartproducts', function (Blueprint $collection) {
            $collection->text('user_id');
            $collection->text('product_id');
            $collection->text('attribute_id');
            $collection->integer('product_price');
            $collection->integer('product_qty');
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartproducts');
    }
};
