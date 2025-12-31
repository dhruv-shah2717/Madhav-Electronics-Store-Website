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
        Schema::create('products', function (Blueprint $collection) {
            $collection->text('product_name');
            $collection->text('product_brand');
            $collection->integer('product_price');
            $collection->integer('product_xprice');
            $collection->text('category_id');
            $collection->text('subcategory_id');
            $collection->integer('product_qty');
            $collection->text('product_description');
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
