<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jobs(){
        return $this->hasMany(Job::class);
    }

    public function orders(){
        return $this->hasMany(Orders::class);
    }
    public function cities(){
        return $this->hasMany(City::class);
    }
    public function model(){
        return $this->hasMany(Model::class);
    }
}
