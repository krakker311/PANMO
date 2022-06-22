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

    <div class="table-responsive col-lg-8">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">User</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
          @php
          $i = 1
          @endphp
            @foreach ($messages as $message)
                <tr>
                    @if($i != $message->fromUser->id) 
                    @php
                    $i = $message->fromUser->id
                    @endphp
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $message->fromUser->name }}</td>
                    <td>
                        <a href="javascript:void(0);" data-id="{{ $message->fromUser->id }}" data-user="{{ $message->fromUser->name }}" class="btn-chat1"><span data-feather="message-circle"></span></a>
                    </td>
                    @elseif($i == $message->fromUser->id)
                    @endif
                </tr>
            @endforeach
           
          </tbody>
        </table>
      </div>
    @if(Auth::user())
    <input type="hidden" id="current_user" value="{{ \Auth::user()->id }}" />
    @endif
    @include('chat-box')
    <div id="chat-overlay" class="row"></div>
</div>

@endsection
