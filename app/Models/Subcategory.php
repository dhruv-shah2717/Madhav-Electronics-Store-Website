<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasOne;
use MongoDB\Laravel\Relations\BelongsTo;

class Subcategory extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'subcategories';
    protected $table = "subcategories";
    protected $primaryKey = "_id";

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
