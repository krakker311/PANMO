<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class ModelUser extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function favorited()
    {
        return (bool) Favorite::where('user_id', Auth::id())
                            ->where('model_id', $this->id)
                            ->first();
    }

    public function User(){
        return $this->belongsTo(User::class);
    }
    public function province(){
        return $this->belongsTo(Province::class,'province_id');
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function job(){
        return $this->hasMany(Job::class);
    }
}
