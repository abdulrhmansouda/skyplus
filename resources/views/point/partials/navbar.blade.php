<nav class="px-0 mx-4 shadow-none navbar navbar-main navbar-expand-lg border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="px-3 py-1 container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="px-0 pt-1 pb-0 mb-0 bg-transparent breadcrumb ">
                <li class="text-sm breadcrumb-item ps-2"><a class="opacity-5 text-dark" href="javascript:;">لوحات
                        التحكم</a></li>
                <li class="text-sm breadcrumb-item text-dark active" aria-current="page">
                    @switch(Route::currentRouteName())
                        @case('point.subscribers')
                            تسديد الفواتير
                        @break

                        @case('point.setting.change-password.index')
                            الاعدادات / تغيير كلمة المرور
                        @break

                        @default
@dd(Route::currentRouteName())
                    @endswitch
                </li>
            </ol>
        </nav>
        @switch(Route::currentRouteName())
        @case('point.subscribers')
            <div class="px-0 mt-2 collapse navbar-collapse mt-sm-0" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <form action="" method="GET">
                        <div class="input-group">
                            <span class="input-group-text text-body"><button class="submit search-button"><i
                                        class="fas fa-search" aria-hidden="true"></i></button></span>
                            <input type="text" class="form-control" placeholder="أكتب هنا..." name="s"
                                value="@if (isset($search)) {{ $search ? $search : '' }} @endif">
                        </div>
                    </form>
                </div>
            @break
        @endswitch
        {{-- <div class="px-0 mt-2 collapse navbar-collapse mt-sm-0" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="أكتب هنا...">
                </div>
            </div>
            <ul class="navbar-nav me-auto ms-0 justify-content-end">
                <li class="nav-item d-xl-none pe-3 d-flex align-items-center">
                    <a href="javascript:;" class="p-0 nav-link text-body" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown ps-2 d-flex align-items-center">
                    <a href="javascript:;" class="p-0 nav-link text-body" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="cursor-pointer fa fa-bell"></i>
                    </a>
                    <ul class="px-2 py-3 dropdown-menu me-sm-n4" aria-labelledby="dropdownMenuButton">
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="py-1 d-flex">
                                    <div class="my-auto">
                                        <img src={{ asset('/assets/img/team-2.jpg') }} class="avatar avatar-sm ms-3 ">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-1 text-sm font-weight-normal">
                                            <span class="font-weight-bold">New message</span> from Laur
                                        </h6>
                                        <p class="mb-0 text-xs text-secondary">
                                            <i class="fa fa-clock me-1"></i>
                                            13 minutes ago
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="py-1 d-flex">
                                    <div class="my-auto">
                                        <img src={{ asset('/assets/img/small-logos/logo-spotify.svg') }}
                                            class="avatar avatar-sm bg-gradient-dark ms-3 ">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-1 text-sm font-weight-normal">
                                            <span class="font-weight-bold">New album</span> by Travis Scott
                                        </h6>
                                        <p class="mb-0 text-xs text-secondary">
                                            <i class="fa fa-clock me-1"></i>
                                            1 day
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="py-1 d-flex">
                                    <div class="my-auto avatar avatar-sm bg-gradient-secondary ms-3">
                                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>credit-card</title>
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF"
                                                    fill-rule="nonzero">
                                                    <g transform="translate(1716.000000, 291.000000)">
                                                        <g transform="translate(453.000000, 454.000000)">
                                                            <path class="color-background"
                                                                d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                                                opacity="0.593633743"></path>
                                                            <path class="color-background"
                                                                d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-1 text-sm font-weight-normal">
                                            Payment successfully completed
                                        </h6>
                                        <p class="mb-0 text-xs text-secondary">
                                            <i class="fa fa-clock me-1"></i>
                                            2 days
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div> --}}
    </div>
</nav>
