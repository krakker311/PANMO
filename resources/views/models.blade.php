@extends('layouts.main')

@section('container')
<div class="container">

    <h1 class="mb-5 text-center mt-5">{{ $title }}</h1>
    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="/posts">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if($searchCategory == '0')
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search by name" name="search" value="{{ request('search') }}">
                        @if(!is_null($myModel))
                        <input type="hidden" name="model-id" value = "{{ $myModel->id }}">
                        @endif
                        <button class="btn btn-dark" type="submit" >Search</button>
                    </div>
                @endif
            </form> 
        </div>
    </div>
    <br>
    @if($searchCategory == '0')
    <div class="containner">
        <div class="row">
            @foreach($models as $model)
            <div class="col-md-4 mb-3">
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
    <div class="d-flex justify-content-end">
        {{ $models->links() }}
    </div>

    @else
        @php
            $model_id = 1
        @endphp
    <div class="containner">
        <div class="row">
            @foreach($jobs as $job)
            @if($job->model_id != $model_id)
            <div class="col-md-4 mb-3">
                <div class="card" style="border-radius: 10%">
                    <div class="card-body">
                        <h5 class="card-title">{{ $job->model->name }}</h5>
                        <div style="max-height: 400px; overflow:hidden;">
                            @if($job->model->image)
                                <img src="{{ $job->model->image }}" class="img-fluid">
                            @else
                                <img src="{{ asset('storage/profile/default.jpg') }}" class="img-fluid">
                            @endif
                        </div>
                        <h6 style="margin-top:10px"> <span class="bi-geo-alt-fill"></span> {{ $job->model->province->name }} - {{ $job->model->city->name  }}</h6>
                        <h6> <span class="bi-briefcase"></span>&nbsp;Jobs done: {{ $job->model->jobs_done }} </h6>
                        <a href="/profile/{{ $job->model->id }}" class="btn btn-dark">Profile</a>
                    </div>
                  </div>
            </div>
                @php
                    $model_id = $job->model_id
                @endphp
            @endif
            @endforeach
        </div>
    </div>
    <div class="d-flex justify-content-end">
        {{ $jobs->links() }}
    </div>

    @endif
</div>

@endsection