@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Orders</h1>
    </div>    

    @if(session()->has('success'))
      <div class="alert alert-success col-lg-8" role="alert">
        {{ session('success') }}
      </div>
    @endif
    <div class="card" style="width: 50rem;">
      <div class="card-body">
        <h5 class="card-title"style="margin-bottom:40px; text-align: center;">Service: {{ $order->job->job_title}}</h5>
        <h6 class="card-subtitle"style="margin-bottom:10px;">Order id: {{ $order->id }}</h6>
        <h6 class="card-subtitle"style="margin-bottom:10px;">Model Name: {{ $order->model->name }}</h6>
        <h6 class="card-subtitle"style="margin-bottom:10px;">Name : {{ $order->name}}</h6>
        <h6 class="card-subtitle"style="margin-bottom:10px;">Phone : {{ $order->phone}}</h6>
        <h6 class="card-subtitle"style="margin-bottom:10px;">Address : {{ $order->address}}</h6>
        <h6 class="card-subtitle"style="margin-bottom:10px;">Order Date : {{ $order->date}}</h6>
        <h6 class="card-subtitle"style="margin-bottom:10px;">Order Time : {{ $order->time}}</h6>
        <hr>
        <h6>Order Status : 
        @if($order->isOrderAccepted == 1)
          @if($order->payment_status == 1)
          <button type="button" class="btn btn-warning">Not Paid Yet</button>
          @elseif($order->payment_status == 2)
          <button type="button" class="btn btn-success">Already Paid</button>
          @elseif($order->payment_status == 4)
          <button type="button" class="btn btn-success">Done</button>
          @endif
        @elseif($order->isOrderAccepted == 0)
          <button type="button" class="btn btn-secondary">Not Accepted yet</button>
        @endif

        <div style="text-align: right">
          @if($order->isOrderAccepted == 0 && Auth::user()->role_id == 2)
          <a href="/acceptOrder/id={{$order->id}}">
            <button class="btn btn-dark" type="button" >
              Accept Order
            </button>
          </a>
          <a href="/declineOrder/id={{$order->id}}">
            <button class="btn btn-dark" type="button" >
              Decline Order
            </button>
          </a>
          
          @elseif($order->isOrderAccepted == 1 && $order->user_id == Auth::user()->id && $order->payment_status == 1)
          <button class="btn btn-dark" id="pay-button">Bayar Sekarang</button>
          @elseif($order->isOrderAccepted == 1 && $order->model->user_id == Auth::user()->id && $order->payment_status == 2 && $order->date <= \Carbon\Carbon::now()->toDateString() && $order->time <= \Carbon\Carbon::now()->toTimeString())
          <a href="/orderDone/id={{$order->id}}">
            <button class="btn btn-dark" type="button" >
              Order Done
                </button>
          </a>
          @elseif($order->isOrderAccepted == 1 && $order->user_id == Auth::user()->id && $order->payment_status == 4)
          <a href="/review/id={{$order->model_id}}">
            <button class="btn btn-dark" type="button" >
              Add Review
                </button>
          </a>
          @endif
        </div>
      </h6>

      </div>
    </div>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        const payButton = document.querySelector('#pay-button');
        payButton.addEventListener('click', function(e) {
            e.preventDefault();
 
            snap.pay('{{ $snapToken }}', {
                // Optional
                onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    alert("Please Refresh Page to Check Payment Result")
                    console.log(result)
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                }
            });
        });
    </script>
@endsection
