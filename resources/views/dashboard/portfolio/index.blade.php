@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Portfolio</h1>
    </div>    

    @if(session()->has('success'))
      <div class="alert alert-success col-lg-8" role="alert">
        {{ session('success') }}
      </div>
    @endif
    <a href="/dashboard/portfolio/create" class="btn btn-dark mb-3"><i class="bi bi-plus-circle" style="margin-right: 10px;"></i>New Portofolio</a>
    
            @foreach ($portfolios as $portfolio)
            <div class="card" style="width: 40rem; margin-bottom: 10px;">
              <div class="card-body">
                <h5 class="card-title">{{ $portfolio->title }}</h5> <hr>
                <h6 class="card-subtitle mb-5">Description : {{ $portfolio->desc }}</h6>
                <a type="button" class="btn btn-dark" href="/dashboard/portfolio/{{ $portfolio->id }}" style="float: right; margin-left: 10px;">Details</a>  
                <form action="/dashboard/portfolio/{{ $portfolio->id }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button  class="btn btn-dark" onclick="return confirm('Are you sure?')" style="float: right; margin-left: 10px;">Delete</button>
                </form>
                <a type="button" class="btn btn-dark" href="/dashboard/portfolio/{{ $portfolio->id }}/edit" style="float: right; margin-left: 10px;">Update</a>
              </div>
            </div>
            @endforeach
@endsection
