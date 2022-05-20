<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    
    protected $guarded = ['id'];
    protected $with = ['category', 'province','modeluser'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function province(){
        return $this->belongsTo(Province::class);
    }

    public function modeluser(){
        return $this->belongsTo(ModelUser::class);
    }
}
