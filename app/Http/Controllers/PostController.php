<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Job;
use App\Models\User;
use App\Models\ModelUser;
use App\Models\Portfolio;
use App\Models\Review;
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
        "posts" => ModelUser::latest()->paginate(6)->withQueryString()
        ]);
    }

    public function show(Request $request){
        $data = $request->all();
        return view('post', [
            "title" => 'Profile',
            "active" => 'posts',
            "model" => ModelUser::where('id',$data['id'])->first(),
            'jobs' => Job::where('model_id', $data['id'])->get(),
            'portfolios' => Portfolio::where('model_id', $data['id'])->get(),
            'reviews' => Review::where('model_id',$data['id'])->get()
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

    public function favorites()
    {
        return view('favlist', [
            "title" => 'Profile',
            "active" => 'favorite',
            "posts" => Auth::user()->favorites
        ]);
    }
}
