<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasOne;
use MongoDB\Laravel\Relations\BelongsTo;

class ProductImage extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'productimages';
    protected $table = "productimages";
    protected $primaryKey = "_id";
    protected $attributes = [
        'image_primary' => false,
    ];
}
