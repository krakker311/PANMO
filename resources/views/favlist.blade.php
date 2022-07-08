@extends('layouts.main')

@section('container')
    <div class="container mt-5">
        <div class="row">
            @foreach($posts as $post)
            <div class="col-md-4 mb-3">
                <div class="card">

                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $post->name }}</h5>
                        <div style="max-height: 400px; overflow:hidden;">
                            @if($post->image)
                                <img src="{{ $post->image }}" class="img-fluid">
                            @else
                                <img src="{{ asset('storage/profile/default.jpg') }}" class="img-fluid">
                            @endif
                        </div>
                        <h6> <span class="bi-geo-alt-fill"></span> {{ $post->province->name }} - {{ $post->city->name  }}</h6>
                        <h6> <span class="bi-briefcase"></span>&nbsp;Jobs done: {{ $post->jobs_done }} </h6>
                        <a href="/profile/{{ $post->id }}" class="btn btn-dark">Profile</a>
                    </div>
                  </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

