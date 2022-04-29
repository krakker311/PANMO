<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function favorites(){
        return $this->belongsTo(User::class, 'model_id','user_id');
    }
}
