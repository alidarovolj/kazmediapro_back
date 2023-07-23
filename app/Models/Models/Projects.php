<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Models\Clients;
use App\Models\Models\Cases;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projects extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'images',
        'client_id',
        'case_id',
        'description'
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function user_id()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function client_id()
    {
        return $this->belongsTo(Clients::class, 'client_id');
    }
    public function case_id()
    {
        return $this->belongsTo(Cases::class, 'client_id');
    }
}
