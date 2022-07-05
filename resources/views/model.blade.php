@extends('layouts.main')

@section('container')

<div id="app">
  <section class="h-100">
    <div class="container py-4 h-100" >
      <div class="row d-flex justify-content-center align-items-center h-100" >
        <div class="col col-xl-12 col-xl-7">
          <div class="card" style="background-color: whitesmoke">
            <div class="rounded-top text-white d-flex flex-row" style="background-color: black; height:200px;">
              <div class="ms-4 mt-1 d-flex flex-column" style="width: 150px; height:200px">
                @if($model->image)
                  <img src="{{ $model->image }}" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1; height: 150px;">
                @else
                  <img src="{{ asset('storage/profile/default.jpg') }}" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1; height: 150px;">
                @endif
              </div>
              <div class="ms-3" style="margin-top: 30px;">
                <h4 style="margin-bottom: 15px; font-weight: bold">{{ $model->name }}</h4>
                <h6><span class="bi-geo-alt-fill"></span> {{ $model->province->name }} - {{ $model->city->name }}</h6> 
                <h6> <span class="bi-briefcase"></span> Jobs Done : {{ $model->jobs_done }} </h6>
                <h6>Member since : {{isset($model->created_at) ? $model->created_at->format('m/d/Y') : $model->email}}</h6>
              </div>
            </div>
            <div class="container">
              @if(Auth::User())
                @if(!is_null($myModel))
                  @if($myModel->id != $model->id)             
                  <div class="card-body p-4 text-black">
                    <div class="col">
                        <div class="btn-toolbar" style="margin-left:375px">
                          <a href="/booking/{{ $model->id }}" class="btn btn-dark mb-3" style="width: 150px; margin-right: 10px"> Book now</a>
                          <a href="javascript:void(0);" class="btn-chat1" data-id="{{ $model->user_id }}" data-user="{{ $model->user->name }}"  style="z-index: 1; margin-right: 10px; text-decoration:none; width: 150px;" id="chat-toggle">
                          <div class="center">
                          Ask Availability
                          </div>
                          </a>
                          <favorite :model={{ $model->id }} :favorited={{ $model->favorited() ? 'true' : 'false' }}></favorite>
                          </div>
                    </div>
                    @endif
                  @else
                  <div class="card-body p-4 text-black">
                    <div class="col">
                        <div class="btn-toolbar" style="margin-left:375px">
                          <a href="/booking/{{ $model->id }}" class="btn btn-dark mb-3" style="width: 150px; margin-right: 10px"> Book now</a>
                          <a href="javascript:void(0);" class="btn-chat1" data-id="{{ $model->user_id }}" data-user="{{ $model->user->name }}"  style="z-index: 1; margin-right: 10px; text-decoration:none; width: 150px;" id="chat-toggle">
                          <div class="center">
                          Ask Availability
                          </div>
                          </a>
                          <favorite :model={{ $model->id }} :favorited={{ $model->favorited() ? 'true' : 'false' }}></favorite>
                          </div>
                    </div>
                    @endif 
                @endif
                <div class="col text-center mt-5">
                  <h4 style="font-weight: bold">About Me</h4>
                      <h5>Height: {{ $model->height }} cm -
                      Weight: {{ $model->weight }} kg -
                      Hips: {{ $model->hips }} cm -
                      Waist: {{ $model->waist }} cm -
                      Bust: {{ $model->bust }} cm -
                      Hair Color: {{ $model->hair_color }}</h5>
                      <hr>
                      <h5>{{ $model->description }}</h5>
                </div>
                <div class="text-center mt-5" >
                  <h4 style="font-weight: bold">Portofolio</h4>
                </div>
                  @forelse ($portfolios as $portfolio)
                      <!-- <img src="" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1"> -->
                      <img class="myImg" id="myImg"src="{{ asset('storage/' . $portfolio->image) }}" alt="{{$portfolio->title}} <br>{{$portfolio->desc}}" width="350" height="200" style="margin-right: 10px; margin-bottom: 10px">
                        <!-- The Modal -->
                        <div class="myModal" id="modal">
                          <span class="close">&times;</span>
                          <img class="modal-content">
                          <div class="caption" id=""></div>
                        </div>
                        @empty 
                        <h6 style="text-align: center">No portfolio yet</h6>
                  @endforelse
    
                  <div class="d-flex justify-content-center">
                      {{ $portfolios->links() }}
                  </div>
            
              <br>
              <div class="text-center mt-5" >
                <h4 style="font-weight: bold">Service</h4>
              </div>
                  @forelse ($jobs as $job)
                  <div class="card text-center" style="margin-bottom: 10px">
                      <div class="card-body">
                        <h4 class="card-title">{{ $job->job_title }}</h4> <hr>
                        <h5 class="card-subtitle" style="margin-bottom: 10px">Description : {{ $job->job_desc }}</h5>
                        
                        <h5 class="card-text"><span class="bi-cash-stack"></span> IDR {{ number_format($job->price,2,',','.') }}</h5>
                      </div>
                    </div>
                    @empty 
                    <h6 style="text-align: center">No service yet</h6>
                  @endforelse
                  <br>
                  <div class="text-center mt-5" >
                    <h4 style="font-weight: bold">Review</h4>
                  </div>
                  <div class="row" style="margin-left: 5px; margin-bottom: 30px">
                    @forelse ($reviews as $review)
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
      
                    @empty 
                      <h6 style="text-align: center">No review yet</h6>
                    @endforelse
                  </div>
                  <div class="d-flex justify-content-center">
                    {{ $reviews->links() }}
                </div>
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
