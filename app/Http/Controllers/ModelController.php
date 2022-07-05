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
            'title' => 'Register',
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
            'hips' => 'required',
            'description' => 'required',
            'jobs_done'=>'required'
        ]);

        $new_role_id = 2;
        User::where('id',$request->user_id)->update(array('role_id'=> $new_role_id));
        ModelUser::create($validatedData);
        return redirect('dashboard')->with('message', 'Profile Successfully Updated!');
    }

    public function browse(){
        $title ='';
        $models = ModelUser::latest();
        $jobs = Job::orderBy('model_id');
        $searchCategory = 0;
        $myModel = ModelUser::all();
        if (Auth::user()) {
            $myModel = $myModel->where('user_id',Auth::user()->id)->first();
            if(!is_null($myModel)) {
                $models = $models->where('name', '!=', $myModel->name);
                $jobs = $jobs->where('model_id', '!=', $myModel->id);
            }  
        } else {
            $myModel = NULL;
        }

        if(request('search')){
            $models->where('name', 'like', '%' . request('search') . '%');
        }

        if(request('category')){
            $jobs->where('category_id', 'like', '%' . request('category') . '%');
            $searchCategory = 1;
        }

        return view ('models', [
        "title" => "Our Models" . $title,
        "active" => 'posts',
        "models" => $models->latest()->paginate(6)->withQueryString(),
        "jobs" => $jobs->latest()->paginate(6)->withQueryString(),
        "myModel" => $myModel,
        "searchCategory" => $searchCategory
        ]);
    }

    public function show($id){
        $model = ModelUser::where('id',$id)->first();
        $myModel = $myModel = ModelUser::all(); 
        if (Auth::user()) {
            $myModel = $myModel->where('user_id',Auth::user()->id)->first();
        } 
        return view('model', [
            "title" => $model->name,
            "active" => 'posts',
            "model" => ModelUser::where('id',$id)->first(),
            'jobs' => Job::where('model_id', $id)->get(),
            'portfolios' => Portfolio::where('model_id', $id)->paginate(6)->withQueryString(),
            'reviews' => Review::where('model_id',$id)->paginate(3)->withQueryString(),
            'myModel' => $myModel
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
            "title" => 'Favorite',
            "active" => 'favorite',
            "posts" => Auth::user()->favorites
        ]);
    }
}
