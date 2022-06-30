<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <title>Panmo | {{ $title }}</title>
    {{-- My Style --}}
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link href="{{ asset('css/carousel.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}" />
    <style>
      body {
        background-image: url('../img/bg.png');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: 100% 100%;
      }
      </style>
  </head>
  <body>
    
    @include('partials.navbar')


    <div class="container mt-4">
        @yield('container')
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('javascript')
    <script src="assets/timepicker.js"></script> 
  
  </body>
</html>