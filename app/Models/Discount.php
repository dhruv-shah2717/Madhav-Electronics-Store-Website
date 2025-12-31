<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasOne;
use MongoDB\Laravel\Relations\BelongsTo;

class Discount extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'discounts';
    protected $table = "discounts";
    protected $primaryKey = "_id";
}
