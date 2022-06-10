<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        return view('dashboard.profile.index', [
            'provinces' => Province::all()
        ]);
    }
}
