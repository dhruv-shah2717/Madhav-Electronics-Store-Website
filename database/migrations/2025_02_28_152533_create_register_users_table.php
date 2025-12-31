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
        Schema::create('registerusers', function (Blueprint $collection) {
            $collection->text('user_name');
            $collection->text('user_email');
            $collection->text('user_otp');
            $collection->text('user_role');
            $collection->text('user_address')->nullable();
            $collection->integer('user_pincode')->nullable();
            $collection->text('user_state')->nullable();
            $collection->text('user_cdt')->nullable();
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registerusers');
    }
};
