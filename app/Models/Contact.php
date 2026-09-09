<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'phone',
    'message',
    'product',
    'page',
])]
class Contact extends Model {}
