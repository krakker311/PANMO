<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Services\Midtrans\CreateSnapTokenService;

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
        $order =  Order::where('id',$id)->first();
        $snapToken = $order->snap_token;
         
        return view('dashboard.orders.detail',[
            'order' => Order::where('id',$id)->first(), 
            'snapToken' => $snapToken
        ]);
    }

    public function acceptOrder($id) {
        Order::where('id',$id)
            ->update(['isOrderAccepted' => '1']);
        $order =  Order::where('id',$id)->first();
        $snapToken = $order->snap_token;
        if (empty($snapToken)) {
        // Jika snap token masih NULL, buat token snap dan simpan ke database

            $midtrans = new CreateSnapTokenService($order);
            $snapToken = $midtrans->getSnapToken();

            $order->snap_token = $snapToken;
            $order->save();
        }    
        return redirect()->route('viewAllOrders');
    }
}
