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
        Schema::create('orders', function (Blueprint $collection) {
            $collection->text('user_id');
            $collection->text('product_id');
            $collection->text('order_qty');
            $collection->text('order_price');
            $collection->integer('order_total');
            $collection->integer('order_coupon')->nullable();
            $collection->date('order_date');
            $collection->text('order_status');
            $collection->date('payment_date')->nullable();
            $collection->text('payment_status');
            $collection->text('payment_id');
            $collection->text('shipped_name');
            $collection->text('shipped_email');
            $collection->text('shipped_phone');
            $collection->text('shipped_address');
            $collection->integer('shipped_pincode');
            $collection->text('shipped_state');
            $collection->text('shipped_cdt');
            $collection->date('shipped_date')->nullable();
            $collection->date('delivered_date')->nullable();
            $collection->date('cancle_date')->nullable();
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
