@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Job Details</h1>
    </div>
    <div class="col-lg-8">
            <form method="post" action="/dashboard/jobs/{{ $job->id }}" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                  <label for="title" class="form-label">Job Title</label>
                  <input type="text" class="form-control @error('title') is-invalid @enderror"  id="job_title" name="job_title" required autofocus value="{{ old('job_title', $job->job_title) }}" readonly>
                  @error('title')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" class="form-control @error('job_category') is-invalid @enderror"  id="job_category" name="job_category" required autofocus value="{{ old('job_category', $job->category->name) }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="job_desc" class="form-label">Job Desc</label>
                    <input type="text" class="form-control @error('job_desc') is-invalid @enderror"  id="job_desc" name="job_desc" required autofocus value="{{ old('job_desc', $job->job_desc) }}" readonly>
                    @error('job_desc')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <label for="price" class="form-label-inline">Price</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text">Rp</span>
                    <input type="text" class="form-control @error('price') is-invalid @enderror"  id="price" name="price" required autofocus value="{{ old('price', $job->price) }}" readonly>
                    @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                  </div>
              </form>
    </div>
@endsection
