<?php
 
namespace App\Services\Midtrans;
 
use Midtrans\Snap;
 
class CreateSnapTokenService extends Midtrans
{
    protected $order;
 
    public function __construct($order)
    {
        parent::__construct();
 
        $this->order = $order;
    }
 
    public function getSnapToken()
    {
        $params = [
            'transaction_details' => [
                'order_id' => $this->order->id,
                'gross_amount' => $this->order->total_price,
            ],
            'item_details' => [
                [
                    'id' => 1,
                    'price' => $this->order->job->price,
                    'quantity' => 1,
                    'name' => $this->order->job->job_title,
                ],
            ],
            'customer_details' => [
                'first_name' => $this->order->user->name,
                'email' => $this->order->user->email,
            ]
        ];
 
        $snapToken = Snap::getSnapToken($params);
 
        return $snapToken;
    }
}