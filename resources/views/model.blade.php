@extends('layouts.main')

@section('container')

<div id="app">
  <section class="h-100">
    <div class="container py-4 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-12 col-xl-7">
          <div class="card">
            <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:250px;">
              <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                @if($model->image)
                  <img src="{{ asset('storage/' . $model->image) }}" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1">
                @else
                  <img src="{{ asset('storage/profile/default.jpg') }}" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1">
                @endif
                  <a href="/booking/{{ $model->id }}" class="btn btn-primary mb-3" style="z-index: 1;"> Book now</a>
                  @if(Auth::user())
                  <a href="javascript:void(0);" data-id="{{ $model->user_id }}" data-user="{{ $model->user->name }}" class="btn-chat1" style="z-index: 1;" id="chat-toggle">Ask Availability</a>
                  @endif
              </div>
              <div class="ms-3" style="margin-top: 90px;">
                <h5>{{ $model->name }}</h5>
                <p>{{ $model->province->name }}</p> 
                <p>{{ $model->city->name }}</p> 
              </div>
            </div>
            <div class="p-4 text-black" style="background-color: #f8f9fa;">
              <div class="d-flex justify-content-end text-center py-1">
                {{-- <div>
                  <p class="mb-1 h5">253</p>
                  <p class="small text-muted mb-0">Photos</p>
                </div>
                <div class="px-3">
                  <p class="mb-1 h5">1026</p>
                  <p class="small text-muted mb-0">Followers</p>
                </div>
                <div>
                  <p class="mb-1 h5">478</p>
                  <p class="small text-muted mb-0">Following</p>
                </div> --}}
              </div>
            </div>
            <div class="card-body p-4 text-black">
            @if (Auth::check())
            <div class="card-footer text-muted">
              <div id="app">
            <favorite :model={{ $model->id }} :favorited={{ $model->favorited() ? 'true' : 'false' }}></favorite></div>
            </div>
            @endif
              <div class="mb-5">
                <p class="lead fw-normal mb-1 mt-4">About Me</p>
                <div class="p-4" style="background-color: #f8f9fa;">
                  <p class="font-italic mb-1"></p>
                </div>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="lead fw-normal mb-0">Service</p>
              </div>
              <table class="table table-striped table-sm">
                <tbody>
                  @foreach ($jobs as $job)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $job->job_title }}</td>
                          <td>{{ $job->job_desc }}</td>
                          <td>{{ $job->price }}</td>
                      </tr>
                  @endforeach
                
                </tbody>
                </table>
              
              
              <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="lead fw-normal mb-0">Portofolio</p>
              </div>


  <!-- Carousel wrapper -->
                <div
                  id="carouselMultiItemExample"
                  class="carousel slide carousel-dark text-center"
                  data-mdb-ride="carousel"
                >
                  <!-- Controls -->
                  <div class="d-flex justify-content-center mb-4">
                    <button
                      class="carousel-control-prev position-relative"
                      type="button"
                      data-mdb-target="#carouselMultiItemExample"
                      data-mdb-slide="prev"
                    >
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button
                      class="carousel-control-next position-relative"
                      type="button"
                      data-mdb-target="#carouselMultiItemExample"
                      data-mdb-slide="next"
                    >
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
                  <!-- Inner -->
                  <div class="carousel-inner py-4">
                    <!-- Single item -->
                    <div class="carousel-item active">
                      <div class="container">
                        <div class="row">
                          <div class="col-lg-4">
                            @foreach ($portfolios as $portfolio)
                              <div class="card">
                                <img
                                  src="https://mdbcdn.b-cdn.net/img/new/standard/nature/181.webp"
                                  class="card-img-top"
                                  alt="Waterfall"
                                />
                                {{-- <img src="{{ asset('storage/' . $portfolio->image) }}" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1"> --}}
                                <div class="card-body">
                                  <h5 class="card-title">{{ $portfolio->title }}</h5>
                                  <p class="card-text">
                                    {{ $portfolio->desc }}
                                  </p>
                                  <a href="#!" class="btn btn-primary">Button</a>
                                </div>
                              </div>
                            @endforeach
                          </div>


                        </div>
                      </div>
                    </div>

                  </div>
                  <!-- Inner -->
                </div>
                <!-- Carousel wrapper -->


                <div class="row g-2">
                    <div style="max-height: 350px; overflow:hidden;">
                      <img src=""  class="img-fluid"> 
                    </div>
                </div>

              <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="lead fw-normal mb-0">Review</p>
              </div>
              <!-- Carousel wrapper -->
                <div
                  id="carouselMultiItemExample"
                  class="carousel slide carousel-dark text-center"
                  data-mdb-ride="carousel"
                >
                  <!-- Controls -->
                  <div class="d-flex justify-content-center mb-4">
                    <button
                      class="carousel-control-prev position-relative"
                      type="button"
                      data-mdb-target="#carouselMultiItemExample"
                      data-mdb-slide="prev"
                    >
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button
                      class="carousel-control-next position-relative"
                      type="button"
                      data-mdb-target="#carouselMultiItemExample"
                      data-mdb-slide="next"
                    >
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
                  <!-- Inner -->
                  <div class="carousel-inner" >
                    <!-- Single item -->
                    <div class="carousel-item active">
                      <div class="container">
                            @foreach ($reviews as $review)
                            <div class="card text-start">
                              <div class="card-body">
                                <h5 class="card-title">{{$review->user->name}}</h5>
                                <p class="card-text"> 
                                  @while($review->rating>0)
                                    @if($review->rating >0.5)
                                        <i class="fa fa-star"></i>
                                    @else
                                        <i class="fa fa-star-half"></i>
                                    @endif
                                    @php $review->rating--; @endphp
                                  @endwhile</p>
                                <p class="card-text">{{$review->comment}}</p> 
                              </div>
                            </div>
                            @endforeach
                          </div>
                    </div>

                  </div>
                  <!-- Inner -->
                </div>
                <!-- Carousel wrapper -->
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </section>
  @if(Auth::user())
  <input type="hidden" id="current_user" value="{{ \Auth::user()->id }}" />
  @endif
  @include('chat-box')
  <div id="chat-overlay" class="row"></div>
</div>

@endsection