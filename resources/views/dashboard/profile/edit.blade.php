@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Welcome Back, {{ auth()->user()->name }}</h1>
    </div>    
	@if(Session::has('message'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
	@endif
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
	<div class="container">
	<div class="col">
		<div class="row">
		<div class="col mb-3">
			<div class="card">
			<div class="card-body">
				<div class="e-profile">
				<div class="row">
					<div class="col-12 col-sm-auto mb-3">
					<div class="mx-auto" style="width: 140px;">
						<div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
							@if(Auth::user()->image)
								<img src="{{asset('/storage/post-images/'. Auth::user()->image)}}" alt="img-fluid" width="140px">
							@else
								<img src="{{asset('/storage/profile/default.jpg')}}" alt="img-fluid" width="140px" >
							@endif
						</div>
					</div>
					</div>
					<div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
					<div class="text-center text-sm-left mb-2 mb-sm-0">
						<h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{ auth()->user()->name }}</h4>
						<p class="mb-0">{{ auth()->user()->username }}</p>
						<div class="mt-2">
							<button class="btn btn-primary" type="button" >
								Change Profile Picture
							</button>
						</div>
					</div>
					<div class="text-center text-sm-right">
						<span class="badge badge-secondary">administrator</span>
						<div class="text-muted"><small>Joined {{isset(Auth::user()->created_at) ? Auth::user()->created_at->format('m/d/Y') : Auth::user()->email}}</small></div>
					</div>
					</div>
				</div>
				<ul class="nav nav-tabs">
					<li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
				</ul>
				<div class="tab-content pt-3">
					<div class="tab-pane active">
					<form class="form" method="POST" action="{{ route('dashboard.update')}}">
						@csrf
                        @method('patch')
						<div class="row">
						<div class="col">
							<div class="row">
							<div class="col">
								<div class="form-group">
								<label>Full Name</label>
								<input class="form-control" type="text" name="name" value="{{ auth()->user()->name }}">
								</div>
							</div>
							<div class="col">
								<div class="form-group">
								<label>Username</label>
								<input class="form-control" type="text" name="username" value="{{ auth()->user()->username }}">
								</div>
							</div>
							</div>
							<div class="row">
							<div class="col">
								<div class="form-group">
								<label>Email</label>
								<input id="email" type="email" class="form-control" name="email" value="{{ auth()->user()->email  }}">
								</div>
							</div>
							</div>
						</div>
						</div>
						<div class="row">
						<div class="col d-flex justify-content-end">
							<button class="btn btn-primary" type="submit">Save Changes</button>
						</div>
						</div>
					</form>

					</div>
				</div>
				</div>
			</div>
			</div>
		</div>



	</div>
	</div>
	</div>
@endsection