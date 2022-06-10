<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\ModelUser;
use App\Services\Midtrans\CreateSnapTokenService;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    //
    public function index() {
        return view('dashboard.orders.index',[
            'pending_orders' => Order::where('model_id',auth()->user()->id)
                                ->where('isOrderAccepted','0')->get(),
            'accepted_orders' => Order::where('model_id',auth()->user()->id)
                                ->where('isOrderAccepted','1')
                                ->where('payment_status','!=','4')->get(),    
            'done_orders' => Order::where('model_id',auth()->user()->id)
                                ->where('payment_status','4')->get()               
        ]);
    }

    public function indexUser() {
        return view('dashboard.orders.index',[
            'pending_orders' => Order::where('user_id',auth()->user()->id)
                                ->where('isOrderAccepted','0')->get(),
            'accepted_orders' => Order::where('user_id',auth()->user()->id)
                                ->where('isOrderAccepted','1')
                                ->where('payment_status','!=','4')->get(),
            'done_orders' => Order::where('model_id',auth()->user()->id)
                                ->where('payment_status','1')->get()                   
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
        $user = User::where('id',$order->user_id)->first();
        $model = ModelUser::where('id',$order->model_id)->first();
        $email = [
            'greeting' => 'Hi '.$user->name.',',
            'body' => 'Your Booking has been accepted, Please proceed to payment in 1x24hr ',
            'actionText' => 'Pay Now',
            'actionURL' => url('/viewOrder/id='.$order->id)
        ];
      
        Notification::send($user, new EmailNotification($email));
        
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

    public function declineOrder($id) {
        
        $orderid = Order::where('id',$id)->first();
        $user = User::where('id',$orderid->user_id)->first();
        $model = ModelUser::where('id',$orderid->model_id)->first();
        $order = [
            'greeting' => 'Hi '.$user->name.',',
            'body' => 'Sorry your order have been declined by '.$model->name.'',
            'actionText' => 'Look for Other Model',
            'actionURL' => url('/posts')
        ];
      
        Notification::send($user, new EmailNotification($order));
        Order::where('id',$id)
        ->delete();
            
        return redirect()->route('viewAllOrders');
    }

    public function orderDone($id) {
        $orderid = Order::where('id',$id)->first();
        $user = User::where('id',$orderid->user_id)->first();
        $model = ModelUser::where('id',$orderid->model_id)->first();
        $order = [
            'greeting' => 'Hi '.$user->name.',',
            'body' => 'Thank for using '.$model->name.' service, if you dont mind you can give your review by click button beloew',
            'actionText' => 'Review Model',
            'actionURL' => url('/review/id='.$orderid->model_id)
        ];
        
        Notification::send($user, new EmailNotification($order));
        $orderupdate = Order::where('id',$id)->update([
            'payment_status' => 4,
        ]);
        
            
        return redirect()->route('viewAllOrders');
    }
}
