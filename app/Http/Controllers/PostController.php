<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index(){
        $title ='';
        if(request('category')){
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }

        if(request('author')){
            $author = User::firstWhere('username', request('author'));
            $title = ' by ' . $author->name;
        }
        return view ('posts', [
        "title" => "Our Models" . $title,
        "active" => 'posts',
        "posts" => User::latest()->paginate(7)->withQueryString()
        ]);
    }

    public function show($id){

        return view('post', [
            "title" => 'Profile',
            "active" => 'posts',
            "post" => User::findOrFail($id)
        ]);
    }

}
