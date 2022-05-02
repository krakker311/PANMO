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

          <div class="row mx-4">
            <div class="col-12 ">
              <label class="order-form-label">Name</label>
            </div>
            <div class="col-12 col-sm-6">
              <input class="order-form-input">
            </div>
          </div>

          <div class="row mt-3 mx-4">
            <div class="col-12">
              <label class="order-form-label">Phone Number</label>
            </div>
            <div class="col-12">
              <input class="order-form-input">
            </div>
          </div>

          <div class="row mt-3 mx-4">
            <div class="col-12">
              <label class="order-form-label" for="date-picker-example">Date</label>
            </div>
            <div class="col-12">
              <input class="order-form-input datepicker" placeholder="Selected date" type="text"
                id="date-picker-example">
            </div>
          </div>

          <div class="row mt-3 mx-4">
            <div class="col-12">
              <label class="order-form-label">Adress</label>
            </div>
            <div class="col-12">
              <input class="order-form-input" placeholder="Street Address">
            </div>
            <div class="col-12 mt-2">
              <input class="order-form-input" placeholder="City">
            </div>
            <div class="col-12 mt-2">
              <input class="order-form-input" placeholder="Province">
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-12">
              <button type="button" id="btnSubmit" class="btn btn-dark d-block mx-auto btn-submit">Next</button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
@endsection

<script>
  // Data Picker Initialization
  $('.datepicker').pickadate();
</script>