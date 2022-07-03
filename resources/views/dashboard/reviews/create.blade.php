@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create New Review</h1>
    </div>
    <div class="col-lg-8">
            <form method="post" action="/review" class="mb-5" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="comment" class="form-label">Comment</label>
                  <input type="text" class="form-control @error('comment') is-invalid @enderror"  id="comment" name="comment" required autofocus value="{{ old('comment') }}">
                  @error('comment')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
                <input id="input-1" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="1">
                <input type="hidden" name="model_id" value="{{$model->id}}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <button type="submit" class="btn btn-dark">Add Review</button>
                
              </form>
    </div>
@endsection
