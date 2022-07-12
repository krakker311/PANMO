@extends('layouts.main')

@section('container')
    <div style="background-image: url({{ asset('img/about.jpg') }}); background-size: 100%">
        <br>
        <div style="color: black; margin-left: 3%; margin-top: 5%"class="judul text-start" id="title">
            <h1><strong>About Us</strong></h1>
        </div>
        <div class="row">
            <div style="color: black; margin-left: 3%; margin-top: 5%" class="col-sm-5 text-left" id="about">
                <h4 style="  font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                ">Panmo is Indonesia’s No.1 beauty services marketplace for professionals models. Our models can manage their business, connect with new & existing clients, and showcase their services. Clients can discover model services, and book instantly anytime, anywhere.</h4>
            </div>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
<div class="container">

    <div class="text-center mb-5 mt-5">
        <h1><strong>How to Book</strong></h1>
    </div>
    <hr style="color: black" size="4px">
    <div class="mb-5 mt-5" id="about">
        <h5>1. Select the model you want on the browse page, then click read more to see price info, photo results, ratings & reviews from other clients.</h5>
        <br>
        <h5>2. Click "Book Now" on the service you want or you can click "Ask for Availability" to inquire about the availability of the schedule from the Beauty Artist concerned.</h5>
        <br>
        <h5>3. Enter your order details and complete the ordering process.</h5>
        <br>
        <h5>4. Wait for confirmation from the model.</h5>
        <br>
        <h5>5. The model will contact you soon and ready to service.</h5>
    </div>
</div>
    
@endsection

