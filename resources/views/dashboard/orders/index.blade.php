@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Orders</h1>
    </div>    

    @if(session()->has('success'))
      <div class="alert alert-success col-lg-8" role="alert">
        {{ session('success') }}
      </div>
    @endif
    <div>
    <button class="btn btn-dark mb-3">Pending Orders</button>
      @foreach ($pending_orders as $pending_order)
          <div class="card" style="width: 40rem; margin-bottom: 10px;">
            <div class="card-body">
              <h5 class="card-title">{{ $pending_order->name }}</h5> <hr>
              <h6 class="card-subtitle">{{ $pending_order->job->job_title}}</h6>
              <a type="button" class="btn btn-outline-dark" href="/viewOrder/id={{$pending_order->id}}" style="float: right; margin-left: 10px;">Details</a> 
            </div>
          </div>
      @endforeach
    </div>
    <div>
    <button class="btn btn-dark mb-3"style="margin-top: 15px;">Accepted Orders</button> 
    <div class="table-responsive col-lg-8">
            @foreach ($accepted_orders as $accepted_order)
              <div class="card" style="width: 40rem; margin-bottom: 10px;">
                <div class="card-body">
                  <h5 class="card-title">{{ $accepted_order->name }}</h5> <hr>
                  <h6 class="card-subtitle">{{ $accepted_order->job->job_title}}</h6>
                  <a type="button" class="btn btn-outline-dark" href="/viewOrder/id={{$accepted_order->id}}" style="float: right; margin-left: 10px;">Details</a> 
                </div>
              </div>
            @endforeach
      <div>
      </div>
      <div>
    <button class="btn btn-dark mb-3" style="margin-top: 15px;">Done / Declined</button>
    <div>
            @foreach ($done_orders as $done_order)
                <div class="card" style="width: 40rem; margin-bottom: 10px;">
                <div class="card-body">
                  <h5 class="card-title">{{ $done_order->name }}</h5> <hr>
                  <h6 class="card-subtitle">{{ $done_order->job->job_title}}</h6>
                  @if(Auth::user()->id == $done_order->user_id)
                  <a type="button" class="btn btn-outline-dark" href="/review/id={{$done_order->model_id}}" style="float: right; margin-left: 10px;">Review</a> 
                  @else
                  <a type="button" class="btn btn-outline-dark" href="/viewOrder/id={{$done_order->id}}" style="float: right; margin-left: 10px;">Details</a> 
                  @endif
                </div>
              </div>
            @endforeach
      </div>
      
@endsection
