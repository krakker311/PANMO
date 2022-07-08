@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Portofolio</h1>
    </div>
    <div class="col-lg-8">
            <form method="post" action="/dashboard/portfolio/{{ $portfolio->id }}" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                  <label for="title" class="form-label">Title</label>
                  <input type="text" class="form-control @error('title') is-invalid @enderror"  id="title" name="title" required autofocus value="{{ old('title', $portfolio->title) }}" readonly>
                  @error('title')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" class="form-control @error('category') is-invalid @enderror"  id="category" name="category" required autofocus value="{{ old('category', $portfolio->category->name) }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Descripstion</label>
                    <input type="text" class="form-control @error('desc') is-invalid @enderror"  id="desc" name="desc" required autofocus value="{{ old('desc', $portfolio->desc) }}" readonly>
                    @error('desc')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror 
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="hidden" name="oldImage" value="{{ $portfolio->image }}">
                    @if($portfolio->image)
                    <img src="{{ $portfolio->image }}" class="img-preview img-fluid mb-3 col-sm-5 d-block" >
                    @else
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                    @endif
                    @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>              
              </form>
    </div>

@endsection