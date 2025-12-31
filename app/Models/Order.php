<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasOne;
use MongoDB\Laravel\Relations\BelongsTo;

class Order extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'orders';
    protected $table = "orders";
    protected $primaryKey = "_id";
    protected $attributes = [
        'order_status' => 'Pending',
        'payment_status' => 'Pending',
    ];
}
