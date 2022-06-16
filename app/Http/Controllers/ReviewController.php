<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelUser;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index(){
        $model = ModelUser::where('user_id',auth()->user()->id)->first();
        return view('dashboard.reviews.index',[
            'reviews' => Review::where('model_id',$model->id)->get(),            
        ]);
    }

    public function create($id){
        return view('dashboard.reviews.create',[
            'model' => ModelUser::where('id',$id)->first(),           
        ]);
    }

    public function addReview(Request $request) {

        $validatedData = $request->validate([
            'comment' => 'required|max:255',
            'rating' => 'required',
            'model_id' => 'required',
            'user_id' => 'required',
        ]);

        Review::create($validatedData);
        return redirect()->route('dashboard')->with('success','Review has been added');
    }
}
