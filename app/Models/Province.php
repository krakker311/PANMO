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
}