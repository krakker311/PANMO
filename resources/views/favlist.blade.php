@extends('layouts.main')

@section('container')
    <div class="container mt-5">
        <div class="row">
        @foreach($models as $model)
            <div class="col-md-4 mb-5 mr-2">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $model->name }}</h5>
                        <div style="max-height: 400px; overflow:hidden;">
                            @if($model->image)
                                <img src="{{ $model->image }}" class="img-fluid" style="width: 300px; height: 300px;">
                            @else
                                <img src="{{ asset('storage/profile/default.jpg') }}" class="img-fluid" style="width: 300px; height: 300px;">
                            @endif
                        </div>
                        <h6 style="margin-top:10px"> <span class="bi-geo-alt-fill"></span> {{ $model->province->name }} - {{ $model->city->name  }}</h6>
                        <h6> <span class="bi-briefcase"></span>&nbsp;Jobs done: {{ $model->jobs_done }} </h6>
                        <a href="/profile/{{ $model->id }}" class="btn btn-dark">Profile</a>
                    </div>
                  </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

