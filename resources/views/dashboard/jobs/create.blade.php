@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create New Job</h1>
    </div>
    <div class="col-lg-8">
            <form method="post" action="/dashboard/jobs" class="mb-5" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="title" class="form-label">Job Title</label>
                  <input type="text" class="form-control @error('title') is-invalid @enderror"  id="job_title" name="job_title" required autofocus value="{{ old('job_title') }}">
                  @error('title')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select" name="category_id">
                        @foreach ($categories as $category)
                            @if(old('category_id') == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}" >{{ $category->name }}</option>
                            @endif
                        @endforeach 
                      </select>
                </div>
                <div class="mb-3">
                    <label for="job_desc" class="form-label">Job Desc</label>
                    <input type="text" class="form-control @error('job_desc') is-invalid @enderror"  id="job_desc" name="job_desc" required autofocus value="{{ old('job_desc') }}">
                    @error('job_desc')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <label for="title" class="form-label-inline">Price</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text">Rp</span>
                    <input type="text" class="form-control @error('price') is-invalid @enderror"  id="price" name="price" required autofocus value="{{ old('price') }}">
                    @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                  </div>
                 
                </div>

                <button type="submit" class="btn btn-primary">Create New Job</button>
                
              </form>
    </div>
@endsection
