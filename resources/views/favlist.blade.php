@extends('layouts.main')

@section('container')
    <div class="containner">
        <div class="row">
            @foreach($posts as $post)
            <div class="col-md-4 mb-3">
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">{{ $post->name }}</h5>
                        <div style="max-height: 400px; overflow:hidden;">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid">
                            @else
                                <img src="{{ asset('storage/profile/default.jpg') }}" class="img-fluid">
                            @endif
                        </div>
                      <a href="/profile/{{ $post->id }}" class="btn btn-primary">Read more</a>
                    </div>
                  </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

