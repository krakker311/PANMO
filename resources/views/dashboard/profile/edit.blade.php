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
					</div>
					<div class="text-center text-sm-right">
						<span class="badge badge-secondary">administrator</span>
						<div class="text-muted"><small>Joined {{isset(Auth::user()->created_at) ? Auth::user()->created_at->format('m/d/Y') : Auth::user()->email}}</small></div>
					</div>
					</div>
				</div>

				<div class="tab-content pt-3">
					<div class="tab-pane active">
					@if(Auth::user()->role_id == 1)
					<form class="form" method="POST" action="{{ route('dashboard.updateUser')}}"  enctype="multipart/form-data">
					@else
					<form class="form" method="POST" action="{{ route('dashboard.update')}}"  enctype="multipart/form-data">
					@endif
						@csrf
                        @method('patch')
						<div class="row">
						<div class="col">
								<div class="col">
									<div class="form-group">
									<label>Change Profile Picture</label>
									<img class="img-preview img-fluid mb-3 col-sm-5">
									<input class="form-control   @error('image') is-invalid @enderror" type="file" name="image" id="image" onchange="previewImage()">
									@error('image')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
										@enderror
									</div>
								</div>
							<div class="row">
								<div class="col">
									<div class="form-group">
									<label>Full Name</label>
									<input class="form-control   @error('name') is-invalid @enderror" type="text" name="name" value="{{ auth()->user()->name }}">
									@error('name')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
										@enderror
									</div>
								</div>
								<div class="col">
									<div class="form-group">
									<label>Username</label>
									<input class="form-control   @error('username') is-invalid @enderror" type="text" name="username" value="{{ auth()->user()->username }}">
									@error('username')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
										@enderror
									</div>
								</div>
								<div class="col">
									<div class="form-group">
									<label>Email</label>
									<input  id="email" type="email   @error('email') is-invalid @enderror" class="form-control" name="email" value="{{ auth()->user()->email  }}">
									@error('email')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
										@enderror
									</div>
								</div>
							</div>
							</div>
						</div>
						</div>
						@if(Auth::user()->role_id == 2)

							<div class="col mb-3">
								<div class="form-group">
								<label>About</label>
								<textarea class="form-control @error('description') is-invalid @enderror" rows="5" placeholder="My Bio" name="description">{{ auth()->user()->model->description }}</textarea>
								@error('description')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
								@enderror
								</div>
							</div>
							<div class="row">
								<div class="col">
									<label class="order-form-label">Province</label>
									<select class="form-select  @error('province_id') is-invalid @enderror" name="province_id" placeholder="Province" id="province"> 
									  <option value="">Select Province</option>
									  @foreach ($provinces as $province)
										  @if(old('province_id') == $province->id)
											  <option value="{{ $province->id }}" selected>{{ $province->name }}</option>
										  @else
											  <option value="{{ $province->id }}" >{{ $province->name }}</option>
										  @endif
									  @endforeach 
									  @error('province_id')
									  <div class="invalid-feedback">
										  {{ $message }}
									  </div>
									  @enderror
									</select>
								</div>
								<div class="col">
								  <label class="order-form-label">City</label>
									<select class="form-select  @error('city_id') is-invalid @enderror" id="city" name="city_id" value="{{ auth()->user()->model->city_id }}">
									</select>
									@error('city_id')
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
									<input style = "width : 150px" class="form-control @error('height') is-invalid @enderror" type="text" name="height" value="{{ auth()->user()->model->height }}">
									@error('height')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
									@enderror
								</div>
							</div>
							<div class="col-lg-2 col-md-10 col-sm-10 col-xs-10">
								<div class="form-group">
									<label>Weight (kg)</label>
									<input style = "width : 150px" class="form-control @error('weight') is-invalid @enderror" type="text" name="weight" value="{{ auth()->user()->model->weight }}">
									@error('weight')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
									@enderror
								</div>
							</div>
							<div class="col-lg-2 col-md-10 col-sm-10 col-xs-10">
								<div class="form-group">
									<label>Hair Color</label>
									<input style = "width : 150px" class="form-control @error('hair_color') is-invalid @enderror" type="text" name="hair_color" value="{{ auth()->user()->model->hair_color }}">
									@error('hair_color')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
									@enderror
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-md-10 col-sm-10 col-xs-10">
								<div class="form-group">
									<label>Waist (cm)</label>
									<input style = "width : 150px" class="form-control @error('waist') is-invalid @enderror" type="text" name="waist" value="{{ auth()->user()->model->waist }}">
									@error('waist')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
									@enderror
								</div>
							</div>
							<div class="col-lg-2 col-md-10 col-sm-10 col-xs-10">
								<div class="form-group">
									<label>Bust (cm)</label>
									<input style = "width : 150px" class="form-control @error('bust') is-invalid @enderror" type="text" name="bust" value="{{ auth()->user()->model->bust }}">
									@error('bust')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
									@enderror
								</div>
							</div>
							<div class="col-lg-2 col-md-10 col-sm-10 col-xs-10">
								<div class="form-group">
									<label>Hips (cm)</label>
									<input style = "width : 150px" class="form-control @error('hips') is-invalid @enderror" type="text" name="hips" value="{{ auth()->user()->model->hips }}">
									@error('hips')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
									@enderror
								</div>
							</div>
						</div>
					</div>
					@endif
					<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
						<div class="row">
						<div class="col d-flex justify-content-end">
							<button class="btn btn-dark" type="submit">Save Changes</button>
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
	<script>
		$(document).ready(function() {
    $('#province').on('change', function() {
      var province_id = this.value;
      $("#city").html('');
      $.ajax({
        url:"{{url('get_cities')}}",
        type: "POST",
        data: {
          province_id: province_id,
          _token: '{{csrf_token()}}'
        },
        dataType : 'json',
        success: function(result){
          console.log(result)
          $('#city').html('<option value="">Select City</option>'); 
          $.each(result,function(key,value){
            $("#city").append('<option value="'+value.id+'">'+value.name+'</option>');
          });
        }
      });
    });
  });

    
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