<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasOne;
use MongoDB\Laravel\Relations\BelongsTo;

class ProductAttribute extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'productattributes';
    protected $table = "productattributes";
    protected $primaryKey = "_id";

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
