<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Affiliates extends Model
{
    /** @use HasFactory<\Database\Factories\AffiliatesFactory> */
    use HasFactory;

    protected $fillable = [
        'name', 'date_birth', 'email', 'phone', 'address', 'city', 'state', 'user_id'
    ];

    protected $casts = [
        'date_birth' => 'datetime:Y-m-d',
    ];
}
