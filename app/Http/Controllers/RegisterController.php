<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function index(){
        return view('auth.register', [
            'title' => 'Register',
            'active' => 'register'
        ]);
    }

    public function store(Request $request){
        
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', ' min:3', 'max:255', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255',
            'image' => 'image|file|max:2048'
        ]);

        
        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        // $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        return redirect('/login')->with('success', 'Registration successfull! Please login');
    }
}
