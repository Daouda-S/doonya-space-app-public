<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('Reservation', 'Reservation') }} - @yield('title')</title>

        <!-- Favicons -->
        <link href={{ asset('images/logo.jpg') }} rel="icon">
        <link href={{ asset('assets/img/apple-touch-icon.png') }} rel="apple-touch-icon">

        <!-- Fonts -->
        {{-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}
        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        
        <!-- Vendor CSS Files -->
        <link href={{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
        <link href={{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }} rel="stylesheet">
        <link href={{ asset('assets/vendor/aos/aos.css') }} rel="stylesheet">
        <link href={{ asset('assets/vendor/fontawesome-free/css/all.min.css') }} rel="stylesheet">
        <link href={{ asset('assets/vendor/swiper/swiper-bundle.min.css') }} rel="stylesheet">

        <!-- Main CSS File -->
        <link href={{ asset('assets/css/main.css') }}  rel="stylesheet">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Flatpickr CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        <!-- Flatpickr JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    </head>
    <body class="index-page">
            @include('layouts.navigation')

            <!-- Page Heading -->
            {{-- @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset --}}
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <footer id="footer" class="footer light-background p-5" >

                <div class="container">
                  <div class="row gy-3">
                    <div class="col-lg-3 col-md-6 d-flex">
                      <i class="bi bi-geo-alt icon"></i>
                      <div class="address">
                        <h4>Address</h4>
                        <p>Bd Tensoba Zoobdo, rue 17.69 porte 333, Secteur 06,</p>
                        <p>17 BP Ouagadougou, Burkina Faso</p>
                       
                      </div>
            
                    </div>
            
                    <div class="col-lg-3 col-md-6 d-flex">
                      <i class="bi bi-telephone icon"></i>
                      <div>
                        <h4>Contact</h4>
                        <p>
                          <strong>Phone:</strong> <span>+226 67400675</span><br>
                          <strong>Email:</strong> <span>doonyalabs@gmail.com</span><br>
                        </p>
                      </div>
                    </div>
            
                    <div class="col-lg-3 col-md-6 d-flex">
                      <i class="bi bi-clock icon"></i>
                      <div>
                        <h4>Heures d'ouvertures</h4>
                        <p>
                          <strong>Lun-Sam</strong> <span>7h-18h</span><br>
                          <strong>Dimanche</strong>: <span>Fermé</span>
                        </p>
                      </div>
                    </div>
            
                    <div class="col-lg-3 col-md-6 ">
                      <h4>Suivez Nous</h4>
                      <div class="social-links d-flex">
                        <a href="https://www.facebook.com/doonyalabs" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.linkedin.com/company/doonyalabs/" class="linkedin"><i class="bi bi-linkedin"></i></a>
                      </div>
                    </div>
            
                  </div>
                </div>
            
            </footer>

              <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Preloader -->
        <div id="preloader"></div>

        <!-- Vendor JS Files -->
        <script src={{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>
        <script src={{ asset('assets/vendor/php-email-form/validate.js') }} ></script>
        <script src={{ asset('assets/vendor/aos/aos.js') }} src=""></script>
        <script src={{ asset('assets/vendor/swiper/swiper-bundle.min.js') }} ></script>
        <script src={{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }} ></script>

        <!-- Main JS File -->
        <script src={{ asset('assets/js/main.js') }} ></script>
    </body>
</html>
