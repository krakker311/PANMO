@extends('layouts.main')

@section('container')


<section class="order-form my-4 mx-4">
    <div class="container pt-4">

      <div class="row">
        <div class="col-12">
          <h1>Booking to </h1>
          <hr class="mt-1">
        </div>
        <div class="col-12">

          <form method="post" action="/booking" class="mb-5" enctype="multipart/form-data">
          @csrf
          <div class="row mx-4">
            <div class="col-12">
              <label class="order-form-label">Name</label>
            </div>
            <div class="col-12 col-sm-6" >
              <input type="text" class="form-control @error('name') is-invalid @enderror"  id="name" name="name" required autofocus value="{{ old('name') }}">
            </div>
          </div>

          <div class="row mt-3 mx-4">
            <div class="col-12">
              <label class="order-form-label">Phone Number</label>
            </div>
            <div class="col-12">
              <input type="text" class="form-control @error('phone') is-invalid @enderror"  id="phone" name="phone" required autofocus value="{{ old('phone') }}">
            </div>
          </div>

          <div class="row mt-3 mx-4">
            <div class="col-12">
              <label class="order-form-label" for="date-picker-example">Date</label>
            </div>
            <div class="col-12">
              <input class="order-form-input datepicker" placeholder="Selected date" type="date"
                id="date" name="date" required autofocus value="{{ old('date') }}">
            </div>
          </div>

          <div class="row mt-3 mx-4">
            <div class="col-12">
              <label class="order-form-label" for="date-picker-example">Time</label>
            </div>
            <div class="col-12">
              <input class="order-form-input datepicker" placeholder="Selected date" type="time">
                <div class="input-group-addon" >
                  <span class="glyphicon glyphicon-time"></span>
           </div>
            </div>
          </div>

          <div class="row mt-3 mx-4">
            <div class="col-12">
              <label class="order-form-label">Address</label>
            </div>
            <div class="col-12">
              <input type="text" class="form-control @error('address') is-invalid @enderror"  id="address" name="address" required autofocus value="{{ old('address') }}">
            </div>
            <div class="col-sm-6 mt-2">
              <select class="form-select" name="province_id" placeholder="Province"> 
                @foreach ($provinces as $province)
                    @if(old('province_id') == $province->id)
                        <option value="{{ $province->id }}" selected>{{ $province->name }}</option>
                    @else
                        <option value="{{ $province->id }}" >{{ $province->name }}</option>
                    @endif
                @endforeach 
              </select>
            </div>
            <div class="col-12 mt-2">
              <input type="text" class="form-control @error('city') is-invalid @enderror"  id="city" name="city" required autofocus value="{{ old('city') }}">
            </div>
          </div>

          
        <div class="row mt-3 mx-4">
            <div class="col-12 col-sm-6">
              <label for="category" class="form-label">Category</label>
              <select class="form-select" name="category_id">
                  @foreach ($categories as $category)
                      @if(old('category_id') == $category->id)
                          <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                      @else
                          <option value="{{ $category->id }}" >{{ $category->name }}</option>
                      @endif
                  @endforeach 
                </select>
            </div>
        </div>

          <div class="row mt-3">
            <div class="col-12">
              <button type="button" id="btnSubmit" class="btn btn-dark d-block mx-auto btn-submit">Next</button>
            </div>
          </div>

          </form>

        </div>
      </div>
    </div>
  </section>
@endsection

<script>
  // Data Picker Initialization
  $('.datepicker').pickadate();
</script>


