<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingOrderController extends Controller
{
    public function index(){
        return view('booking',[
            'title' => 'Booking',
            'active' => 'post'
        ]);
    }
}
