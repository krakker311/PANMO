@extends('dashboard.layouts.main')

@section('container')
<div id="app">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Messages</h1>
    </div>    

    @if(session()->has('success'))
      <div class="alert alert-success col-lg-8" role="alert">
        {{ session('success') }}
      </div>
    @endif

          @php
          $i = 1
          @endphp
            @foreach ($messages as $message)
              @if($i != $message->fromUser->id) 
              @php
              $i = $message->fromUser->id
              @endphp
              <div class="card mb-3" style="width: 30rem;">
                <div class="row no-gutters">
                  <div class="col-md-3" style="margin-left: 20px">
                        @if($message->fromUser->image)
                        <img src="{{ asset('storage/' . $message->fromUser->image) }}" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1;margin-bottom: 10px;">
                        @else
                        <img src="{{ asset('storage/profile/default.jpg') }}" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1;margin-bottom: 10px;">
                        @endif
                  </div>
                  <div class="col-md-8 ">
                    <div class="card-body" style="margin-top: 30px;">
                      <h5 class="card-title">{{ $message->fromUser->name }}</h5>
                      <a href="javascript:void(0);" data-id="{{ $message->fromUser->id }}" data-user="{{ $message->fromUser->name }}" class="btn-chat1" style="text-decoration:none;width: 200px;">Reply Messages</span></a>
                    </div>
                  </div>
                </div>
              </div>
              @elseif($i == $message->fromUser->id)
              @endif
            @endforeach
    @if(Auth::user())
    <input type="hidden" id="current_user" value="{{ \Auth::user()->id }}" />
    @endif
    @include('chat-box')
    <div id="chat-overlay" class="row"></div>
</div>

@endsection
