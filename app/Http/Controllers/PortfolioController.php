<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use JD\Cloudder\Facades\Cloudder;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.portfolio.index', [
            'title' =>'My Portfolio',
            'portfolios' => Portfolio::where('model_id', auth()->user()->model->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.portfolio.create', [
            'title' =>'My Portfolio',
            'categories' => Category::all()
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
            'title' => 'required|max:100',
            'desc' => 'required|max:500',
            'category_id' => 'required',
            'image' => "required|image|file|max:1024"
        ]);

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
        $validatedData['public_id'] = $public_id;
        $validatedData['image'] = $image_url;
        $validatedData['model_id'] = auth()->user()->model->id;

        Portfolio::create($validatedData);

        return redirect('dashboard/portfolio')->with('success', 'New portfolio has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('dashboard.portfolio.detail', [
            'title' =>'My Portfolio',
            'portfolio' => Portfolio::where('id',$id)->first(),
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        return view('dashboard.portfolio.edit', [
            'title' =>'My Portfolio',
            'portfolio' => $portfolio,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $rules = [
            'title' => 'required|max:100',
            'desc' => 'required|max:500',
            'category_id' => 'required',
            'image' => 'required|image|file|max:1024'
        ];
        $currentPortfolio = Portfolio::where('id', $portfolio->id)->first();

        if ($currentPortfolio->public_id != null) {
            Cloudder::delete($currentPortfolio->public_id);
        }

        $validatedData = $request->validate($rules);

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
        $validatedData['public_id'] = $public_id;
        $validatedData['image'] = $image_url;

        $validatedData['model_id'] = auth()->user()->model->id;

        Portfolio::where('id', $portfolio->id)->update($validatedData);

        return redirect('dashboard/portfolio')->with('success', 'Portfolio has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        Portfolio::destroy($portfolio->id);
        return redirect('dashboard/portfolio')->with('success', 'Portfolio has been deleted!');
    }
}
