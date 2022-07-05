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
        <h5>1. Pilih model yang anda inginkan pada halaman browse, Kemudian klik read more untuk melihat info harga, foto hasil, rating & review dari client lain.</h5>
        <br>
        <h5>2. Klik "Book Now" pada layanan yang kamu inginkan atau bisa klik "Ask for Availability" untuk menanyakan ketersediaan jadwal dari Beauty Artist yang bersangkutan.</h5>
        <br>
        <h5>3. Masukan detail pesanan anda dan selesaikan proses pemesanan.</h5>
        <br>
        <h5>4. Tunggu konfirmasi dari model.</h5>
        <br>
        <h5>5. Model akan segera menghubungi kamu dan siap untuk melayani.</h5>
    </div>
</div>
    
@endsection

