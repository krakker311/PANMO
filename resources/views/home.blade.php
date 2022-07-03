@extends('layouts.main')

@section('container')
  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->
  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="img/4.png">
        <div class="container">
          <div class="carousel-caption text-start">
            <h1>Discover Our Models</h1>
            <p>More than 1000 Beauty Services accross Indonesia</p>
            <p><a class="btn btn-lg btn-dark" href="/posts">Browse Our Model</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/model2.png">
        <div class="container">
          <div class="carousel-caption text-start">
            <h1>How to Book</h1>
            <p><a class="btn btn-lg btn-dark " href="/about">Learn more</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/home3.jpg">
        <div class="container">
          <div class="carousel-caption text-start">
            <h1>Join Us</h1>
            <div class="row">
                <div class="col-sm-6">
                  <p>We will helps you as a Model to enhance your online exposure, grow and manage your beauty business professionally, while helping clients to find & book preferred beauty services easily.</p>
                </div>
            </div>
            <p><a class="btn btn-lg btn-dark" href="/register">Sign up Today</a></p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <div style="margin-top: 7%" class="modelofthemonth text-center">

<div class="title mb-4">
    <h1>Model of the month</h1>
</div>
<!-- Three columns of text below the carousel -->
<div class="container">

  <div class="row">
  @foreach($modelMonths as $model)
    <div class="col-md-4">
  
      <a style="text-decoration: none; color: black" href="/profile/{{ $model->id }}">
        <div style="border-radius: 10%" class="card">
          <div class="card-body">
            <img style="border-radius: 10%" src="{{ asset('storage/' . $model->image) }}" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 250px; z-index: 1; height:250px;">
          </div>
          <div class="card-footer">
            <h4>{{ $model->name }} </h4>
          </div>
        </div>
      </a>
    </div>
    @endforeach
  
  </div>
</div>

<div style="margin-top: 7%" class="service text-center">

<div class="title mb-4 mt-4">
    <h1>Our Service</h1>
</div>
<!-- Three columns of text below the carousel -->
<div class="container">
  <div class="row">
          <div class="col-md-4 mb-5">
              <a href="/posts?category=1">
              <div style="border-radius: 10%" class="card bg-dark text-white">
                  <img style="border-radius: 10%" src="img/model-makeup.jpg" class="card-img" >
                  <div class="card-img-overlay d-flex align-items-center p-0">
                  <h5 class="card-title text-center flex-fill p-4 fs-3" style="background-color: rgba(0, 0, 0, 0.7)">Make-up Model</h5>
                  </div>
              </div>
              </a> 
          </div>
          <div class="col-md-4 mb-5">
            <a href="/posts?category=2">
            <div style="border-radius: 10%" class="card bg-dark text-white">
                <img style="border-radius: 10%" src="img/commercial.jpg" class="card-img" >
                <div class="card-img-overlay d-flex align-items-center p-0">
                <h5 class="card-title text-center flex-fill p-4 fs-3" style="background-color: rgba(0, 0, 0, 0.7)">Commercial Model</h5>
                </div>
            </div>
            </a> 
        </div>
        <div class="col-md-4 mb-5">
          <a href="/posts?category=3">
          <div style="border-radius: 10%" class="card bg-dark text-white">
              <img style="border-radius: 10%" src="img/mature.jpg" class="card-img" >
              <div class="card-img-overlay d-flex align-items-center p-0">
              <h5 class="card-title text-center flex-fill p-4 fs-3" style="background-color: rgba(0, 0, 0, 0.7)">Mature Model</h5>
              </div>
          </div>
          </a> 
      </div>
  </div>
</div>
    <!-- START THE FEATURETTES -->
    <div style="margin-top: 7%" class="title mb-4">
    <h1>Testimonials</h1>
    </div>
    <div id="testiCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="container">
          <img src="{{ asset('img/testi1.png') }}" alt="">
        </div>
      </div>
      <div class="carousel-item">
        <div class="container">
          <img src="{{ asset('img/testi2.png') }}" alt="">
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#testiCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#testiCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>


  <!-- FOOTER -->
  <footer class="container">
    <p style="text-align: center">&copy; 2022 Panmo, Inc.</p>
  </footer>
</main>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
@endsection

