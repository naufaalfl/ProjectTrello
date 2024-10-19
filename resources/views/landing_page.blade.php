@extends('templates.app', ['title' => 'Landing'])

@section('content-dinamis')
{{-- section : mengisi html ke yield yg ada di file extends --}}
    <h1 class="mt-3 text-center">Selamat Datang, {{ Auth::user()->name}}</h1>

   <!DOCTYPE html>
   <html lang="en">
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
   </head>
   <body>
    <div id="carouselExampleDark" class="carousel carousel-dark slide">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="10000">
            <img src="{{asset('assets/images/bg5.png')}}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>LOGOUT</h5>
              <p>ini halaman ketika user logout</p>
            </div>
          </div>
          <div class="carousel-item" data-bs-interval="2000">
            <img src="{{asset('assets/images/bg6.png')}}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>LOGIN</h5>
              <p>halaman ketika user melakukan login.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="{{asset('assets/images/bg7.png')}}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Menambah Data Laptop</h5>
              <p>menambah data laptop dengan fitur-fitur crud.</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

    @push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
    @endpush

    @endsection
   </body>
   </html>
