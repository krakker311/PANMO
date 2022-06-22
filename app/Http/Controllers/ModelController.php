<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ModelUser;
use App\Models\Province;
use App\Models\Category;
use App\Models\Job;
use App\Models\Portfolio;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.model.register', [
            'provinces' => Province::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'user_id' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'hair_color' => 'required',
            'waist' => 'required',
            'bust' => 'required',
            'hips' => 'required'
        ]);

        $new_role_id = 2;
        User::where('id',$request->user_id)->update(array('role_id'=> $new_role_id));
        ModelUser::create($validatedData);
        return redirect('dashboard')->with('message', 'Profile Successfully Updated!');
    }

    public function browse(){
        $title ='';
        if(request('category')){
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }

        if(request('author')){
            $author = ModelUser::firstWhere('username', request('author'));
            $title = ' by ' . $author->name;
        }
        return view ('models', [
        "title" => "Our Models" . $title,
        "active" => 'posts',
        "posts" => ModelUser::latest()->paginate(6)->withQueryString()
        ]);
    }

    public function show($id){
        return view('model', [
            "title" => 'Profile',
            "active" => 'posts',
            "model" => ModelUser::where('id',$id)->first(),
            'jobs' => Job::where('model_id', $id)->get(),
            'portfolios' => Portfolio::where('model_id', $id)->get(),
            'reviews' => Review::where('model_id',$id)->get()
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
