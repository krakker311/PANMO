<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ModelUser;
use App\Models\Province;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use JD\Cloudder\Facades\Cloudder;


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
            'title' => 'Profile',
            'user' => $request->user(),
            'provinces' => Province::all()
        ]);
    }
    
    public function updateProfile(Request $request, User $user)
    {   
        $image_name = "";
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

        $currentUser = User::where('id', $request->user_id)->first();

        $validatedData = $request->validate($rules);
        $validatedDataUser = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255', Rule::unique('users')->ignore($request->user_id),
            'email' => 'required|email:dns', Rule::unique('users')->ignore($request->user_id)
        ]);
        if($request->file('image')){
            if ($currentUser->public_id != null) {
                Cloudder::delete($currentUser->public_id);
            }
            $image_name = $request->file('image')->getRealPath();   
            //Also note you could set a default height for all the images and Cloudinary does a good job of handling and rendering the image.
            Cloudder::upload($image_name, null, array(
                "folder" => "panmo-images",  "overwrite" => FALSE,
                "resource_type" => "image", "responsive" => TRUE, "transformation" => array("quality" => "100", "width" => "500", "height" => "500", "crop" => "scale")
            ));

            //Cloudinary returns the publicId of the media uploaded which we'll store in our database for ease of access when displaying it.

            $public_id = Cloudder::getPublicId();
            $width = 500;
            $height = 500;

            //The show method returns the URL of the media file on Cloudinary
            $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height" => $height, "crop" => "scale", "quality" => 100, "secure" => "true"]);
            
            // In a situation where the user has already uploaded a file we could use the delete method to remove the media and upload a new one.
            $validatedData['image'] = $image_url;
            $validatedDataUser['public_id'] = $public_id;
            $validatedDataUser['image'] = $image_url; 
        }
             
        ModelUser::where('id', $request->user_id)->update($validatedData);
        User::where('id', $request->user_id)->update($validatedDataUser);

        return redirect('/dashboard')->with('message', 'Profile Successfully Updated!');
    }


    public function updateProfileUser(Request $request, User $user)
    {   
       
        $validatedDataUser = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255',
            'email' => 'required|email:dns',
            'images' => 'image|file|max:1024',
        ]);

        $currentUser = User::where('id', $request->user_id)->first();

        if($request->file('image')){
            if ($currentUser->public_id != null) {
                Cloudder::delete($currentUser->public_id);
            }
            $image_name = $request->file('image')->getRealPath();    
            Cloudder::upload($image_name, null, array(
                "folder" => "panmo-images",  "overwrite" => FALSE,
                "resource_type" => "image", "responsive" => TRUE, "transformation" => array("quality" => "100", "width" => "500", "height" => "500", "crop" => "scale")
            ));
    
            //Cloudinary returns the publicId of the media uploaded which we'll store in our database for ease of access when displaying it.
    
            $public_id = Cloudder::getPublicId();
            $width = 500;
            $height = 500;
    
            //The show method returns the URL of the media file on Cloudinary
            $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height" => $height, "crop" => "scale", "quality" => 100, "secure" => "true"]);
            
            // In a situation where the user has already uploaded a file we could use the delete method to remove the media and upload a new one.
            $validatedDataUser['public_id'] = $public_id;
            $validatedDataUser['image'] = $image_url;
        }
        
        //Also note you could set a default height for all the images and Cloudinary does a good job of handling and rendering the image.
       
      
        User::where('id', $request->user_id)->update($validatedDataUser);

        return redirect('/dashboard')->with('message', 'Profile Successfully Updated!');
    }
}
