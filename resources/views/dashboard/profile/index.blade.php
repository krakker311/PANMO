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
								<img src="{{asset('/storage/'. Auth::user()->image)}}" alt="img-fluid" width="140px" height="140px">
							@else
								<img src="{{asset('/storage/profile/default.jpg')}}" alt="img-fluid" width="140px" height="140px">
							@endif
						</div>
					</div>
					</div>
					<div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
					<div class="text-center text-sm-left mb-2 mb-sm-0">
						<h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{ auth()->user()->name }}</h4>
						<p class="mb-0">{{ auth()->user()->username }}</p>
						<div class="mt-2">
						@if(Auth::user()->role_id == 1)
						<a href="/dashboard/editUser">
							<button class="btn btn-dark" type="button" >
								Edit Profile
							</button>
						</a>
						</div>
						<div class="mt-2">
						<a href="/dashboard/regismodel">
							<button class="btn btn-dark" type="button" >
								Register as Model
							</button>
						</a>
						</div>
						@else
						<a href="/dashboard/edit">
							<button class="btn btn-dark" type="button" >
								Edit Profile
							</button>
						</a>
						</div>
						@endif
					</div>
					<div class="text-center text-sm-right">
						<span class="badge badge-secondary">administrator</span>
						<div class="text-muted"><small>Joined {{isset(Auth::user()->created_at) ? Auth::user()->created_at->format('m/d/Y') : Auth::user()->email}}</small></div>
					</div>
					</div>
				</div>

				<div class="tab-content pt-3">
					<div class="tab-pane active">
					<form class="form" novalidate="">
						<div class="row">
						<div class="col">
							<div class="row">
								<div class="col">
									<div class="form-group">
									<label>Full Name</label>
									<input class="form-control" type="text" name="name" value="{{ auth()->user()->name }}" readonly>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
									<label>Username</label>
									<input class="form-control" type="text" name="username" value="{{ auth()->user()->username }}" readonly>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
									<label>Email</label>
									<input class="form-control" type="text" value="{{ auth()->user()->email }}" readonly>
									</div>
								</div>
							</div>
							@if(Auth::user()->role_id == 2)
							<div class="row">
								<div class="col mb-3">
									<div class="form-group">
									<label>About</label>
									<textarea class="form-control" rows="5" placeholder="My Bio" readonly>{{ auth()->user()->model->description }}</textarea >
									</div>
								</div>
							</div>
			
						</div>
						</div>
						<div class="mb-2"><b>About Me</div>

							<div class="row">

								<div class="col">
									<label class="order-form-label">Province</label>
									<input class="form-control @error('province') is-invalid @enderror" type="text" name="province" value="{{ auth()->user()->model->province->name }}" readonly>
									  @error('province')
									  <div class="invalid-feedback">
										  {{ $message }}
									  </div>
									  @enderror
								</div>
								  
								<div class="col">
									<label class="order-form-label">City</label>
									<input class="form-control @error('city') is-invalid @enderror" type="text" name="city" value="{{ auth()->user()->model->city->name }}" readonly>
									  @error('city')
									  <div class="invalid-feedback">
										  {{ $message }}
									  </div>
									  @enderror
								  </div>
							</div>
							
							<div class="row">
                  <div class="col-lg-2 col-md-10 col-sm-10 col-xs-10">
                    <div class="form-group">
                      <label>Height (cm)</label>
                        <input style = "width : 150px" class="form-control" type="text" name="height" value="{{ auth()->user()->model->height }}" readonly>
                    </div>
                </div>
                  <div class="col-lg-2 col-md-10 col-sm-10 col-xs-10">
                    <div class="form-group">
                      <label>Weight (kg)</label>
                      <input style = "width : 150px" class="form-control" type="text" name="weight" value="{{ auth()->user()->model->weight }}" readonly>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-10 col-sm-10 col-xs-10">
                    <div class="form-group">
                      <label>Hair Color</label>
                      <input style = "width : 150px" class="form-control" type="text" name="hair_color" value="{{ auth()->user()->model->hair_color }}" readonly>
                    </div>
                  </div>
                </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-10 col-sm-10 col-xs-10">
                      <div class="form-group">
                        <label>Waist (cm)</label>
                        <input style = "width : 150px" class="form-control" type="text" name="waist" value="{{ auth()->user()->model->waist }}" readonly>
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-10 col-sm-10 col-xs-10">
                      <div class="form-group">
                        <label>Bust (cm)</label>
                        <input style = "width : 150px" class="form-control" type="text" name="bust" value="{{ auth()->user()->model->bust }}" readonly>
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-10 col-sm-10 col-xs-10">
                      <div class="form-group">
                        <label>Hips (cm)</label>
                        <input style = "width : 150px" class="form-control" type="text" name="hip" value="{{ auth()->user()->model->hips }}" readonly>
                      </div>
                    </div>
                  </div>

						</div>
						@endif
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