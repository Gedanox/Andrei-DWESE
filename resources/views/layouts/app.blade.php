<!DOCTYPE html>
<html class="has-sidemenu has-fancynav-top" lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{ url('/') }}/">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>RottenPotatoes</title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ url('assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ url('assets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="{{ url('assets/vendors/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/vendors/loaders.css/loaders.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=PT+Mono%7cPT+Serif:400,400i%7cLato:100,300,400,700,800,900" rel="stylesheet">
    <link href="{{ url('assets/css/theme.min.css') }}" rel="stylesheet" />
  </head>

  <body class="overflow-hidden-x">
    <nav class="navbar bg-dark navbar-expand-lg navbar-dark fixed-top navbar-sparrow">
      <div class="container"><h3 class="text-white"><a class="text-white" href="{{ url('/') }}">Rotten Potatoes</a></h3>
            @if (Route::has('login'))
                <div style="display: inline-block;" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                      <a class="btn-light btn" href="{{ url('/home') }}">{{ auth()->user()->name }}</a>
                      <a class="btn-light btn" href="javascript:;" onclick="document.getElementById('formLogout').submit();">Logout</a>
                        <form id="formLogout" action="{{ url('logout') }}" method="post">
                            @csrf
                        </form>
                    @else
                      <a class="btn-light btn" href="{{ route('login') }}">Log In</a>
                      <a class="btn-light btn" href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif
      </div>
    </nav>
    
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main min-vh-100" id="top">

      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-lg-7 py-xl-8 mt-5 bg-light" id="ecommerceHeader">
        <div class="container-fluid">
          <div class="row">
            <div class="offset-xl-3 col px-4" style="max-width: 45.81rem">
              <h1 class="display-4 fs-3 fs-sm-4 fs-md-5"><a class="text-black" href="{{ url('/') }}">Rotten Potatoes</h1><h3>Reviews</h3></a>
            </div>
          </div>
        </div><!-- end of .container-->
      </section><!-- <section> close ============================-->
      <!-- ============================================-->
      
      
      <!--<div class="container">
          @yield('content')
      </div> end of .container-->
               

      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section style="text-align: center;" class=" container py-0" id="ecommerceProducts">
          @yield('content')
      </section><!-- <section> close ============================-->
      <!-- ============================================-->



      


      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="text-center" id="ecommerceFooter">
        <div class="container">
          <div class="row flex-center">
            <div class="col-lg-6"><a href="#!"><span class="fab fa-facebook-f text-black fs-1 mx-2"></span></a><a href="#!"><span class="fab fa-twitter text-black fs-1 mx-2"></span></a><a href="#!"><span class="fab fa-pinterest-p text-black fs-1 mx-1 mx-sm-2"></span></a>
              <div class="d-block mt-4 fs--1 fw-bold font-sans-serif"><a class="me-1 mx-sm-2 text-700" href="#!">Contact</a><a class="mx-1 mx-sm-2 text-700" href="#!">Shipping &amp; returns</a><a class="mx-1 mx-sm-2 text-700" href="#!">Terms of service</a><a class="mx-1 mx-sm-2 text-700" href="#!">Privacy policy</a></div>
            </div>
          </div>
        </div><!-- end of .container-->
      </section><!-- <section> close ============================-->
      <!-- ============================================-->

    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->



    <!--===============================================-->
    <!--    Footer-->
    <!--===============================================-->
    <footer class="footer bg-black text-600 py-4 font-sans-serif text-center overflow-hidden" data-zanim-timeline="{}" data-zanim-trigger="scroll">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-4 order-lg-2 position-relative"><a class="indicator indicator-up" href="#top"><span class="indicator-arrow indicator-arrow-one" data-zanim-xs='{"from":{"opacity":0,"y":15},"to":{"opacity":1,"y":-5,"scale":1},"ease":"Back.easeOut","duration":0.4,"delay":0.9}'></span><span class="indicator-arrow indicator-arrow-two" data-zanim-xs='{"from":{"opacity":0,"y":15},"to":{"opacity":1,"y":-5,"scale":1},"ease":"Back.easeOut","duration":0.4,"delay":1.05}'></span></a></div>
          <div class="col-lg-4 text-lg-start mt-4 mt-lg-0">
            <p class="fs--1 text-uppercase ls fw-bold mb-0">Copyright &copy; 2023 Sparrow&trade; inc.</p>
          </div>
          <div class="col-lg-4 text-lg-end order-lg-2 mt-2 mt-lg-0">
            <p class="fs--1 text-uppercase ls fw-bold mb-0">Made with<span class="text-danger fas fa-heart mx-1"></span>by <a class="text-600" href="https://themewagon.com/">Themewagon</a></p>
          </div>
        </div>
      </div>
    </footer>

    <!--===============================================-->
    <!--    Modal for language selection-->
    <!--===============================================-->
    <!-- Modal-->
    <div class="overflow-hidden">
      <div class="modal fade fade-in" id="languageModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xs mx-auto" role="document">
          <div class="modal-content bg-black">
            <div class="modal-body text-center p-0"><button class="btn-close text-white position-absolute top-0 end-0 times-icon mt-2 me-2 p-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
              <ul class="list-unstyled my-0 py-4 font-sans-serif">
                <li><a class="text-white fw-bold pt-1 d-block" href="../homes/default.html">English</a></li>
                <li><a class="pt-1 d-block text-500" href="#!">Français</a></li>
                <li><a class="text-500 pt-1 d-block" href="../pages/rtl.html">عربى</a></li>
                <li><a class="pt-1 d-block text-500" href="#!">Deutsche</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{ url('assets/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ url('assets/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ url('assets/vendors/is/is.min.js') }}"></script>
    <script src="{{ url('assets/vendors/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ url('assets/vendors/bigpicture/BigPicture.js') }}"> </script>
    <script src="{{ url('assets/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ url('assets/vendors/lodash/lodash.min.js') }}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ url('assets/vendors/imagesloaded/imagesloaded.pkgd.js') }}"></script>
    <script src="{{ url('assets/vendors/gsap/gsap.js') }}"></script>
    <script src="{{ url('assets/vendors/gsap/customEase.js') }}"></script>
    <script src="{{ url('assets/vendors/gsap/drawSVGPlugin.js') }}"></script>
    <script src="{{ url('assets/js/theme.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/ajax.js') }}"></script>
  </body>
</html>