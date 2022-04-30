<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\ModelUser;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(){
        $title ='';
        if(request('category')){
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }

        if(request('author')){
            $author = ModelUser::firstWhere('username', request('author'));
            $title = ' by ' . $author->name;
        }
        return view ('posts', [
        "title" => "Our Models" . $title,
        "active" => 'posts',
        "posts" => ModelUser::latest()->paginate(7)->withQueryString()
        ]);
    }

    public function show($id){

        return view('post', [
            "title" => 'Profile',
            "active" => 'posts',
            "model" => ModelUser::where("id",$id)->first()
        ]);
    }
    
    public function favorite(ModelUser $model)
    {
        Auth::user()->favorites()->attach($model->id);
        return back();
    }

    public function unfavorite(ModelUser $model)
    {
        Auth::user()->favorites()->detach($model->id);
        return back();
    }
}
