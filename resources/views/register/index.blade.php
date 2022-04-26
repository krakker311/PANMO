@extends('layouts.main')

@section('container')
<div class="row justify-content-center">
  <div class="col-lg-4">
    
    <main class="form-registration">
      <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>
        <form action="/register" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-floating">
                <input type="name" name="name" class="form-control rounded-top @error('name')is-invalid @enderror" id="name" placeholder="Name" required value="{{ old('name') }}">
                <label for="name">Name</label>
                  @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
            </div>

            <div class="form-floating">
                <input type="username" name="username" class="form-control  @error('username')is-invalid @enderror" id="username" placeholder="Username" required value="{{ old('username') }}">
                <label for="username">Username</label>
                  @error('username')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
            </div>

          <div class="form-floating">
            <input type="email" name="email" class="form-control  @error('email')is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
            <label for="email">Email address</label>
              @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
          </div>

          <div class="form-floating">
            <input type="password" name="password" class="form-control rounded-bottom  @error('password')is-invalid @enderror" id="password" placeholder="Password">
            <label for="password">Password</label>
              @error('password')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
          </div>
          
          <div class="mb-3">
              <label for="image" class="form-label">Profile Picture</label>
              <img class="img-preview img-fluid mb-3 col-sm-5">
              <input class="form-control  @error('image') is-invalid @enderror" type="file" name="image" id="image" onchange="previewImage()" enctype="multipart/form-data">
              @error('image')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
              @enderror
          </div>
      
          <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Register</button>

        </form>
        <small class="d-block text-center mt-3">Already registered? <a href="/login">Login now</a></small>
      </main>
  </div>
</div>

  <script>
        function previewImage(){
            const image = document.querySelector('#imageProfile');
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