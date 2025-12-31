<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasOne;
use MongoDB\Laravel\Relations\BelongsTo;

class Slider extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'sliders';
    protected $table = "sliders";
    protected $primaryKey = "_id";
    protected $attributes = [
        'slider_image' => false,
    ];
}
