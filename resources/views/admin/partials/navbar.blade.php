<nav class="px-0 mx-4 shadow-none navbar navbar-main navbar-expand-lg border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="px-3 py-1 container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="px-0 pt-1 pb-0 mb-0 bg-transparent breadcrumb ">
                <li class="text-sm breadcrumb-item ps-2"><a class="opacity-5 text-dark" href="{{ route('admin.home') }}">
                        لوحات
                        التحكم</a></li>
                <li class="text-sm breadcrumb-item text-dark active" aria-current="page">
                    @switch(Route::currentRouteName())
                        @case('admin.home')
                            الرئيسية
                        @break

                        @case('admin.box-cash.index')
                            صندوق / نقد
                        @break
                        
                        @case('admin.box-bank.index')
                            صندوق / البنك
                        @break


                        @case('admin.points.index')
                            نقاط البيع
                        @break

                        @case('admin.subscribers.index')
                            المشتركين
                        @break

                        @case('admin.packages.index')
                            الباقات
                        @break

                        @case('admin.recharge.index')
                            شحن رصيد
                        @break

                        @case('admin.reports.index')
                            التقارير
                        @break

                        @case('admin.admins.index')
                            المشرفين
                        @break

                        @case('admin.setting.binding-telegram.index')
                            الاعدادات / الربط مع تيليجرام
                        @break

                        @case('admin.support.index')
                            الدعم الفني للمشتركين الاساسين
                        @break

                        @case('admin.supportNewSubscriber.index')
                            الدعم الفني للمشتركين الجدد
                        @break

                        @case('admin.setting.binding-app.index')
                            الاعدادات / الربط
                        @break

                        @case('admin.setting.change-password.index')
                            الاعدادات / تغيير كلمة المرور
                        @break

                        @case('admin.setting.social.index')
                            الاعدادات / التواصل
                        @break

                        @case('admin.setting.other.index')
                            الاعدادات / اعدادات أخرى
                        @break

                        @default
                            need works from navbar
                    @endswitch
                </li>
            </ol>
        </nav>
        <a href="javascript:;" class="p-0 nav-link text-body toggle-nav d-md-none" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
                <i class="bg-black sidenav-toggler-line"></i>
                <i class="bg-black sidenav-toggler-line"></i>
                <i class="bg-black sidenav-toggler-line"></i>
            </div>
        </a>
        <div class="px-0 mt-2 collapse navbar-collapse mt-sm-0" id="navbar">
            <div class="px-0 mt-2 collapse navbar-collapse mt-sm-0" id="navbar">
                @switch(Route::currentRouteName())
                    @case('admin.points.index')
                    @case('admin.subscribers.index')

                    @case('admin.packages.index')
                    @case('admin.recharge.index')

                    @case('admin.admins.index')
                        <div class="px-0 mt-2 collapse navbar-collapse mt-sm-0" id="navbar">
                            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                                <form action="" method="GET">
                                    <div class="input-group">
                                        <span class="input-group-text text-body"><button class="submit search-button"><i
                                                    class="fas fa-search" aria-hidden="true"></i></button></span>
                                        <input type="text" class="form-control" placeholder="أكتب هنا..." name="s"
                                            value="@if (isset($search)) {{ $search ? $search : '' }} @endif">
                                        @if (Route::currentRouteName() == 'admin.subscribers.index')
                                            <input type="hidden" name="pagination_number"
                                                value="@if (isset($pagination_number)) {{ $pagination_number }} @endif">
                                            <input type="hidden" name="page"
                                                value="@if (isset($page)) {{ $page }} @endif">
                                            <input type="hidden" name="sort_by"
                                                value="@if (isset($sort_by)) {{ $sort_by }} @endif">
                                        @endif

                                    </div>
                                </form>
                            </div>
                        </div>
                    @break

                @endswitch


            </div>
        </div>
    </div>
</nav>
