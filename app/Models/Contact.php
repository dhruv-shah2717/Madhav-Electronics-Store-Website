<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasOne;
use MongoDB\Laravel\Relations\BelongsTo;

class Contact extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'contacts';
    protected $table = "contacts";
    protected $primaryKey = "_id";
    protected $attributes = [
        'contact_status' => 'Pending',
    ];
}
