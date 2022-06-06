<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function jobs(){
        return $this->hasMany(Job::class);
    }

    public function portfolios(){
        return $this->hasMany(Portfolio::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
