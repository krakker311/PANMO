<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    //
    public function index() {
        return view('dashboard.orders.index',[
            'pending_orders' => Order::where('model_id',auth()->user()->id)
                                ->where('isOrderAccepted','0')->get(),
            'accepted_orders' => Order::where('model_id',auth()->user()->id)
                                ->where('isOrderAccepted','1')->get()                   
        ]);
    }

    public function detail($id) {
        return view('dashboard.orders.detail',[
            'order' => Order::where('id',$id)->first()           
        ]);
    }

    public function acceptOrder($id) {
        Order::where('id',$id)
            ->update(['isOrderAccepted' => '1']);
        return redirect()->route('viewAllOrders');
    }
}
