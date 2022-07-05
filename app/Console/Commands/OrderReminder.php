<?php

namespace App\Console\Commands;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Notifications\EmailNotification as BookingOrderNotification;


class OrderReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'command:name';
    protected $signature = 'users:order-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reminder Booking Order';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = Order::where('time', '>=', Carbon::now()->add(60, 'minute')->toDateTimeString())
                            ->where('time', '<', Carbon::now()->toDateTimeString())
                            ->where('notified', 0)
                            ->get();

        foreach ($orders as $order){
            $email = [
                'greeting' => 'Hi ',
                'body' => 'There are order for you .',
                'actionText' => 'View Order',
                'actionURL' => ''
            ];
            $user = User::find($request->input($order->model->user_id));
            Notification::send($user, new EmailNotification($email));
            $order->notified = 1;
            $order->save();
        }
    }
}
