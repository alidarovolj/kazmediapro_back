<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'images',
        'category_id',
        'description'
    ];

    protected $casts = [
        'images' => 'array',
    ];
}
