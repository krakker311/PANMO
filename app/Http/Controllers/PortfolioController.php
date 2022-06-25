<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'portfolios' => Portfolio::where('model_id', auth()->user()->id)->get()
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
            'image' => "image|file|max:1024"
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['model_id'] = auth()->user()->id;

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
        //
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
            'image' => 'image|file|max:1024'
        ];

        $validatedData = $request->validate($rules);

        if($request->file('image')){

            if($request->oldImage){
                Storage::delete($request->oldImage);
            }

            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['model_id'] = auth()->user()->id;

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
