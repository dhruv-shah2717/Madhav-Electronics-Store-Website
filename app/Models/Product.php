<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasOne;
use MongoDB\Laravel\Relations\BelongsTo;

class Product extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'products';
    protected $table = "products";
    protected $primaryKey = "_id";
    protected $attributes = [
        'product_qty' => 1,
    ];

    public function productAttributes(): HasMany
    {
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }

    public function cartProducts(): HasMany
    {
        return $this->hasMany(CartProduct::class, 'product_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }
}
