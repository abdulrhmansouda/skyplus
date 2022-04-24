<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href={{ asset('/assets/img/apple-icon.png') }}>
  <link rel="icon" type="image/png" href={{ asset('/assets/img/favicon.png') }}>
  <title>@yield('title')</title>
  <!--     Fonts and icons     -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500;600;700&display=swap" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <script src="{{ asset('/assets/js/fontawsome.js') }}" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">
  <link id="pagestyle" href={{ asset('/assets/css/soft-ui-dashboard.css?v=1.0.3') }} rel="stylesheet" />
  @yield('css')
</head>

<body class="bg-gray-100 g-sidenav-show rtl">
@include('point.partials.aside')
  <main class="mt-1 main-content position-relative h-100 border-radius-lg">
    <!-- Navbar -->
@include('point.partials.navbar')
    <!-- End Navbar -->
    @if (session()->has('success'))
    <div class="alert alert-success">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    
        {{ session()->get('success') }}
    </div>
@endif

@if (session()->has('error'))
    <div class="alert alert-danger">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session()->get('error') }}
    </div>
@endif
@yield('content')
  </main>
    <!-- start logout modal -->
    <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">هل أنت متأكد من تسجيل الخروج</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-info">نعم</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end logout modal -->
  <!--   Core JS Files   -->
  <script src={{ asset('/assets/js/core/popper.min.js') }}></script>
  <script src={{ asset('/assets/js/core/bootstrap.min.js') }}></script>
  <script src={{ asset('/assets/js/plugins/perfect-scrollbar.min.js') }}></script>
  <script src={{ asset('/assets/js/plugins/smooth-scrollbar.min.js') }}></script>
  <script src={{ asset('/assets/js/plugins/fullcalendar.min.js') }}></script>
  <script src={{ asset('/assets/js/plugins/chartjs.min.js') }}></script>
  <script src={{ asset('/assets/js/plugins/choices.min.js') }}></script>

  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src={{ asset('/assets/js/soft-ui-dashboard.js') }}></script>

  @yield('js')

</body>

</html>