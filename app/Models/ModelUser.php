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
}
