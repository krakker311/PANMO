@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create New Portfolio</h1>
    </div>
    <div class="col-lg-8">
            <form method="post" action="/dashboard/portfolio/{{ $portfolio->id }}" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                  <label for="title" class="form-label">Title</label>
                  <input type="text" class="form-control @error('title') is-invalid @enderror"  id="title" name="title" required autofocus value="{{ old('title', $portfolio->title) }}">
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
                    <label for="desc" class="form-label">Descripstion</label>
                    <input type="text" class="form-control @error('desc') is-invalid @enderror"  id="desc" name="desc" required autofocus value="{{ old('desc', $portfolio->desc) }}">
                    @error('desc')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                  </div>
                 
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Post Image</label>
                    <input type="hidden" name="oldImage" value="{{ $portfolio->image }}">
                    @if($portfolio->image)
                    <img src="{{ asset('storage/' . $portfolio->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                    @else
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                    @endif
                    <input class="form-control  @error('image') is-invalid @enderror" type="file" name="image" id="image" onchange="previewImage()">
                    @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Create New Portfolio</button>
                
              </form>
    </div>

    <script>
    
        function previewImage(){
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');
            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection