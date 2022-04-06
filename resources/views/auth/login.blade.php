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
    <title>تسجيل الدخول</title>
    <link id="pagestyle" href={{ asset('/assets/css/soft-ui-dashboard.css?v=1.0.3') }} rel="stylesheet" />
</head>

<body class="rtl">
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-5">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <img src={{ asset('/assets/img/skyplus.jpg') }} alt="skyplus"
                                        class="mx-auto my-2 d-block" width="150">
                                    <h2 class="font-weight-bolder text-info text-gradient text-center">تسجيل الدخول</h2>
                                </div>
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="tab-content">
                                        {{-- @if(old('user'))
                                        @dd(old('user'))
                                        @endif --}}
                                        <div class="" >
                                            <form action="{{ route('login') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="user" value="point">
                                                <label> الاسم <span class="text-danger"> * </span> </label>
                                                <div class="mb-3">
                                                    <input type="name" class="form-control" aria-label="name"
                                                        name="username" aria-describedby="name-addon" required>
                                                </div>
                                                <label> كلمة المرور<span class="text-danger"> * </span> </label>
                                                <div class="mb-3">
                                                    <input type="Password" class="form-control" aria-label="Password"
                                                        name="password" aria-describedby="password-addon" required>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="rememberMe2"
                                                        name="remeber" checked="">
                                                    <label class="form-check-label font-bold"
                                                        for="rememberMe2">تذكرني</label>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit"
                                                        class="btn bg-gradient-info w-100 mt-4 mb-0 h5">دخول</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none ms-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                    style="background-image:url('../assets/img/curved-images/background.jpg')"></div>
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



{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="login" :value="__('Email/Username')" />

                <x-input id="login" class="block mt-1 w-full" type="text" name="login" :value="old('login')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
