<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ModelUser;
use App\Models\Province;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index(){
        return view('dashboard.profile.index', [
            'title' => 'Dashboard',
            'provinces' => Province::all()
        ]);
    }


    public function editProfile(Request $request)
    {
        return view('dashboard.profile.edit', [
            'user' => $request->user(),
            'provinces' => Province::all()
        ]);
    }
    
    public function updateProfile(Request $request, User $user)
    {   
        $rules = [
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
            'images' => 'image|file|max:1024',
            'description' => 'required'
        ];

        $validatedData = $request->validate($rules);

        
        if($request->file('image')){

            if($request->oldImage){
                Storage::delete($request->oldImage);
            }

            $validatedData['image'] = $request->file('image')->store('profile');
            
        }
        $validatedDataUser = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255', Rule::unique('users')->ignore($request->user_id),
            'email' => 'required|email:dns', Rule::unique('users')->ignore($request->user_id)
        ]);
        $validatedDataUser['image'] = $request->file('image')->store('profile');
        ModelUser::where('id', $request->user_id)->update($validatedData);
        User::where('id', $request->user_id)->update($validatedDataUser);

        return redirect('/dashboard')->with('message', 'Profile Successfully Updated!');
    }


    public function updateProfileUser(Request $request, User $user)
    {   
       
        $validatedDataUser = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255',
            'email' => 'required|email:dns'
        ]);
      
        User::where('id', $request->user_id)->update($validatedDataUser);

        return redirect('/dashboard')->with('message', 'Profile Successfully Updated!');
    }
}
