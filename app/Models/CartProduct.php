<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasOne;
use MongoDB\Laravel\Relations\BelongsTo;

class CartProduct extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'cartproducts';
    protected $table = "cartproducts";
    protected $primaryKey = "_id";
    protected $attributes = [
        'product_qty' => 1,
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
