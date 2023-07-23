<?php

namespace App\Models\Models;

use App\Models\User;
use App\Models\Models\Cases;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use SoftDeletes;
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
