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

    <div class="table-responsive col-lg-8">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Model Name</th>
              <th scope="col">Orderer Name</th>
              <th scope="col">Orderer Phone</th>
              <th scope="col">Orderer address</th>
              <th scope="col">Order Date</th>
              <th scope="col">Order Time</th>
              <th scope="col">Order Job</th>
              <th scope="col">Order Price</th>
              @if($order->isOrderAccepted == 1)
              <th scope="col">Payment Status</th>
              @endif
            </tr>
          </thead>
          <tbody>
           
                <tr>
                    <td>{{ $order->model->name }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->date }}</td>
                    <td>{{ $order->time }}</td>
                    <td>{{ $order->job->job_title }}</td>
                    <td>{{ $order->job->price }}</td>
                    @if($order->isOrderAccepted == 1)
                      @if($order->payment_status == 1)
                      <td>not yet paid</td>
                      @elseif($order->payment_status == 1)
                      <td>already paid</td>
                      @endif
                    @endif
                </tr>

           
          </tbody>
        </table>
      </div>
      <div class="mt-2">
      @if($order->isOrderAccepted == 0 && Auth::user()->role_id == 2)
      <a href="/acceptOrder/id={{$order->id}}">
        <button class="btn btn-primary" type="button" >
          Accept Order
            </button>
      </a>
      <a href="/declineOrder/id={{$order->id}}">
        <button class="btn btn-primary" type="button" >
          Decline Order
            </button>
      </a>
      
      @elseif($order->isOrderAccepted == 1 && $order->user_id == Auth::user()->id && $order->payment_status == 1)
      <button class="btn btn-primary" id="pay-button">Bayar Sekarang</button>
      @elseif($order->isOrderAccepted == 1 && $order->model->user_id == Auth::user()->id && $order->payment_status == 2 && $order->date <= \Carbon\Carbon::now()->toDateString() && $order->time <= \Carbon\Carbon::now()->toTimeString())
      <a href="/orderDone/id={{$order->id}}">
        <button class="btn btn-primary" type="button" >
          Order Done
            </button>
      </a>
      @elseif($order->isOrderAccepted == 1 && $order->user_id == Auth::user()->id && $order->payment_status == 4)
      <a href="/review/id={{$order->model_id}}">
        <button class="btn btn-primary" type="button" >
          Add Review
            </button>
      </a>
      @endif
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
