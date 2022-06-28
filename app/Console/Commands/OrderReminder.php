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
        $orders = Order::where('call_start_time', '<=', Carbon::now()->add(15, 'minute')->toDateTimeString())
                            ->where('call_start_time', '>', Carbon::now()->toDateTimeString())
                            ->where('notified', 0)
                            ->get();

        foreach ($orders as $order){
            $order->user->notify(new BookingOrderNotification());
            $order->notified = 1;
            $order->save();
        }
    }
}
