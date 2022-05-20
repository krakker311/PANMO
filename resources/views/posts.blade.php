@extends('layouts.main')

@section('container')
    <h1 class="mb-5 text-center">{{ $title }}</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="/posts">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if(request('author'))
                <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
                    <button class="btn btn-dark" type="submit" >Search</button>
                </div>
            </form> 
        </div>
    </div>


    <div class="containner">
        <div class="row">
            @foreach($posts as $post)
            <div class="col-md-4 mb-3">
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">{{ $post->name }}</h5>
                        <div style="max-height: 400px; overflow:hidden;">
                            @if($post->image)
                                <img src="{{ asset('storage/post-images' . $post->image) }}" class="img-fluid">
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
    <div class="d-flex justify-content-end">
        {{ $posts->links() }}
    </div>
    

@endsection