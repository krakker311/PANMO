<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    protected $with = ['category', 'province'];

    public function province(){
        return $this->belongsTo(Province::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function User(){
        return $this->BelongsTo(User::Class);
    }

    public function Job(){
        return $this->BelongsTo(Job::Class);
    }
    
}
