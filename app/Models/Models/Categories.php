<?php

namespace App\Models\Models;

use App\Models\User;
use App\Models\Models\Cases;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id'
    ];
    public function user_id()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function cases()
    {
        return $this->hasMany(Cases::class, 'category_id');
    }
}
