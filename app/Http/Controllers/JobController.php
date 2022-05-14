<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use App\Models\Province;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    /* Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.jobs.index', [
            'jobs' => Job::where('model_id', auth()->user()->id)->get()
        ]);
    }

    /* Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.jobs.create', [
            'categories' => Category::all(),
            'provinces' => Province::all()
        ]);
    }

    /* Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'job_title' => 'required|max:100',
            'job_desc' => 'required|max:500',
            'category_id' => 'required',
            'province_id' => 'required',
            'price' => 'required',
        ]);

        $validatedData['model_id'] = auth()->user()->id;

        Job::create($validatedData);

        return redirect('dashboard/jobs')->with('success', 'New job has been added!');
    }

    
    /* Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    
    /* Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(job $job)
    {
        return view('dashboard.jobs.edit', [
            'job' => $job,
            'categories' => Category::all(),
            'provinces' => Province::all()
        ]);
    }

    
    /* Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        $rules = [
            'job_title' => 'required|max:100',
            'job_desc' => 'required|max:500',
            'category_id' => 'required',
            'province_id' => 'required',
            'price' => 'required|integer',
        ];

        $validatedData = $request->validate($rules);
        $validatedData['model_id'] = auth()->user()->id;

        Job::where('id', $job->id)->update($validatedData);

        return redirect('dashboard/jobs')->with('success', 'job has been updated!');
    }

    
    /* Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
    
        Job::destroy($job->id);
        return redirect('dashboard/jobs')->with('success', 'jobs has been deleted!');
    }
}
