<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Province;
use Illuminate\Http\Request;

class BookingOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('booking',[
            'title' => 'Booking',
            'active' => 'post',
            'categories' => Category::all(),
            'provinces' => Province::all()
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('booking',[
            'title' => 'Booking',
            'active' => 'post',
            'categories' => Category::all(),
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
            'name' => 'required|max:100',
            'phone' => 'required', 
            'date' => 'required|date',
            'time' => 'required',
            'city' => 'required',
            'address' => 'required|max:200', 
            'category_id' => 'required',
            'province_id' => 'required',
        ]);

        $validatedData['model_id'] = auth()->user()->id;

        Order::create($validatedData);

        return redirect('/')->with('success', 'Your Order Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(BookingOrderController $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(BookingOrderController $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookingOrderController $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookingOrderController $order)
    {
        //
    }
}
