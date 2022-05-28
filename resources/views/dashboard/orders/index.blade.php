@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pending Orders</h1>
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
              <th scope="col">#</th>
              <th scope="col">Orderer Name</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pending_orders as $pending_order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pending_order->name }}</td>
                    <td>
                        <a href="/viewOrder/id={{$pending_order->id}}" class="badge bg-info"><span data-feather="eye"></span></a>
                    </td>
                </tr>
            @endforeach
           
          </tbody>
        </table>
      </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Accepted Orders</h1>
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
              <th scope="col">#</th>
              <th scope="col">Orderer Name</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($accepted_orders as $accepted_order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $accepted_order->name }}</td>
                    <td>
                    <a href="/viewOrder/id={{$accepted_order->id}}" class="badge bg-info"><span data-feather="eye"></span></a>
                    </td>
                </tr>
            @endforeach
           
          </tbody>
        </table>
      </div>
@endsection
