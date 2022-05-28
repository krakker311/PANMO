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
              <th scope="col">Orderer Name</th>
              <th scope="col">Orderer adress</th>
            </tr>
          </thead>
          <tbody>
           
                <tr>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->address }}</td>
                </tr>

           
          </tbody>
        </table>
      </div>
      <div class="mt-2">
			<a href="/acceptOrder/id= {{$order->id}}">
				<button class="btn btn-primary" type="button" >
					accept Order
		        </button>
			</a>
		</div>
@endsection
