@extends('layouts.main')

@section('container')

<div id="app">
  <section class="h-100">
    <div class="container py-4 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-12 col-xl-7">
          <div class="card">
            <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:250px;">
              <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px; height:350px">
                @if($model->image)
                  <img src="{{ asset('storage/' . $model->image) }}" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1;margin-bottom: 10px;">
                @else
                  <img src="{{ asset('storage/profile/default.jpg') }}" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1;margin-bottom: 10px;">
                @endif
                  <a href="/booking/{{ $model->id }}" class="btn btn-primary mb-3" style="z-index: 1; margin-bottom: 10px;"> Book now</a>
                  @if(Auth::user())
                  <a href="javascript:void(0);" class="btn-chat1" data-id="{{ $model->user_id }}" data-user="{{ $model->user->name }}"  style="z-index: 1; margin-bottom: 10px; text-decoration:none;" id="chat-toggle">
                  <div class="center">
                  Ask Availability
                  </div>
                </a>
                  @endif
              </div>
              <div class="ms-3" style="margin-top: 90px;">
                <h5>{{ $model->name }}</h5>
                <p>{{ $model->province->name }}</p> 
                <p>{{ $model->city->name }}</p> 
              </div>
            </div>
            <div class="card-body p-4 text-black">
            @if (Auth::check())
            <div class="card-footer text-muted" style="margin-top: 100px">
              <div id="app">
            <favorite :model={{ $model->id }} :favorited={{ $model->favorited() ? 'true' : 'false' }}></favorite></div>
            </div>
            @endif
              <div class="mb-5">
                <p class="lead fw-normal mb-1 mt-4">About Me</p>
								<textarea class="form-control" rows="5" placeholder="My Bio" readonly>{{ $model->description }}</textarea >
              </div>
              <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="lead fw-normal mb-0">Service</p>
              </div>
      
                  @foreach ($jobs as $job)
                  <div class="card" style="width: 50rem; margin-bottom: 10px">
                      <div class="card-body">
                        <h5 class="card-title">Title: {{ $job->job_title }}</h5>
                        <h6 class="card-subtitle">Description : {{ $job->job_desc }}</h6>
                        <h6 class="card-text ">Price: {{ $job->price }}</p>
                      </div>
                    </div>
                  @endforeach
              
              
              <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="lead fw-normal mb-0">Portofolio</p>
              </div>
              <div class="review-box">
                @foreach ($portfolios as $portfolio)
                    <!-- <img src="" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1"> -->
                    <img class="myImg" id="myImg"src="{{ asset('storage/' . $portfolio->image) }}" alt="{{$portfolio->title}} <br>{{$portfolio->desc}}" width="350" height="200" style="margin-right: 10px; margin-bottom: 10px">
                      <!-- The Modal -->
                      <div class="myModal" id="modal">
                        <span class="close">&times;</span>
                        <img class="modal-content">
                        <div class="caption" id=""></div>
                      </div>
                @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {{ $portfolios->links() }}
                </div>
              <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="lead fw-normal mb-0">Review</p>
              </div>
                  @foreach ($reviews as $review)
                  <div class="card text-start" style="width: 400px;">
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
                  <div class="d-flex justify-content-center">
                    {{ $reviews->links() }}
                </div>
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

@section('javascript')
<script>

  var modals = document.getElementsByClassName('myModal');

  // Get the image and insert it inside the modal - use its "alt" text as a caption
  var imgs = document.getElementsByClassName('myImg');
  var modalImgs = document.getElementsByClassName('modal-content');
  var captionTexts = document.getElementsByClassName('caption');
  for (let i = 0; i <= imgs.length; i++) {
    imgs[i].onclick = function(){
    
      modals[i].style.display = "block";
      modalImgs[i].src = this.src;
      captionTexts[i].innerHTML = this.alt;    
    }
    var spans = document.getElementsByClassName('close')[i];
    console.log(spans)
  // When the user clicks on <span> (x), close the modal
      spans.onclick = function() { 
      modals[i].style.display = "none";
    }
  }


// Get the <span> element that closes the modal
 
  </script>
  @endsection