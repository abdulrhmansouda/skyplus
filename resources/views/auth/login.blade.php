<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href={{ asset('/assets/img/apple-icon.png') }}>
    <link rel="icon" type="image/png" href={{ asset('/assets/img/favicon.png') }}>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">
    <title>تسجيل الدخول</title>
    <link id="pagestyle" href={{ asset('/assets/css/soft-ui-dashboard.css?v=1.0.3') }} rel="stylesheet" />
</head>

<body class="rtl">
    <main class="mt-0 main-content">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="mx-auto col-xl-4 col-lg-5 col-md-6 d-flex flex-column">
                            <div class="mt-5 card card-plain">
                                <div class="pb-0 text-left bg-transparent card-header">
                                    <img src={{ asset('/assets/img/skyplus.png') }} alt="skyplus" class="mx-auto my-2 d-block" width="150">
                                    <h2 class="text-center font-weight-bolder text-info text-gradient">تسجيل الدخول</h2>
                                </div>
                                <div class="card-body">

                                    <div class="tab-content">
                                        <div class="">
                                            <form action="{{ route('login') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="user" value="point">
                                                <label> الاسم المستخدم <span class="text-danger"> * </span> </label>
                                                <div class="mb-3">
                                                    <input type="name" class="form-control" aria-label="name" name="username" aria-describedby="name-addon" required>
                                                </div>
                                                <label> كلمة المرور<span class="text-danger"> * </span> </label>
                                                <div class="mb-3">
                                                    <input type="Password" class="form-control" aria-label="Password" name="password" aria-describedby="password-addon" required>
                                                </div>
                                                @if ($errors->any())
                                                <!-- <div class="alert alert-danger"> -->
                                                    <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
                                                    <ul class="text-danger">
                                                        @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                <!-- </div> -->
                                                @endif
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="rememberMe2" name="remeber" checked="">
                                                    <label class="font-bold form-check-label" for="rememberMe2">تذكرني</label>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="mt-4 mb-0 btn bg-gradient-info w-100 h5">دخول</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="top-0 oblique position-absolute h-100 d-md-block d-none ms-n8">
                                <div class="bg-cover oblique-image position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('../assets/img/curved-images/background.jpg')"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src={{ asset('/assets/js/core/popper.min.js') }}></script>
    <script src={{ asset('/assets/js/core/bootstrap.min.js') }}></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
</body>

</html>