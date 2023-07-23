<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Models\Categories;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cases extends Model
{
    use SoftDeletes;
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

    public function user_id()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function category_id()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
