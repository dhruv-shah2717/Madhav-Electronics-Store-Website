<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasOne;
use MongoDB\Laravel\Relations\BelongsTo;

class RegisterUser extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'registerusers';
    protected $table = "registerusers";
    protected $primaryKey = "_id";
    protected $attributes = [
        'user_name' => 'Hello !',
        'user_role' => 'User',
    ];
}
