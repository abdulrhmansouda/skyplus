@extends('admin.dashboard')


@section('title', 'نقاط البيع')

@section('content')
    <div class="py-4 container-fluid">
        <!-- start add  -->
        <button type="button" class="btn bg-gradient-dark btn-sm" data-bs-toggle="modal" data-bs-target="#add">
            إضافة
        </button>
        <!-- add Modal -->
        <form action="{{ route('admin.points.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">إضافة نقطة بيع</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="img">الصورة</label>
                                <input type="file" class="form-control" id="img" name="image">
                            </div>
                            <div class="form-group">
                                <label for="name">الاسم</label>
                                <input type="text" class="form-control" id="name" placeholder="ادخل الاسم" name="name">
                            </div>
                            <div class="form-group">
                                <label for="username">اسم المستخدم</label>
                                <input type="text" class="form-control" id="username" placeholder="ادخل الاسم المستخدم"
                                    name="username">
                            </div>
                            <div class="form-group">
                                <label for="password">كلمة السر</label>
                                <input type="password" class="form-control" id="password" placeholder="ادخل كلمة السر"
                                    name="password">
                            </div>
                            <div class="form-group">
                                <label for="price">الرصيد</label>
                                <input type="number" class="form-control" id="account" placeholder="ادخل الرصيد"
                                    name="account">
                            </div>
                            <div class="form-group">
                                <label for="info">الشرح</label>
                                <textarea class="form-control" id="info" rows="3" name="description"></textarea>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <span class="btn btn-secondary" data-bs-dismiss="modal">الغاء</span>
                            <button type="submit" class="btn btn-info">حفظ</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- end add  -->
        <div class="row">
            <div class="col-12">
                <div class="mb-4 card">
                    <div class="px-0 pt-0 pb-2 card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="p-0 table-responsive">
                            <table class="table mb-0 align-items-center">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">
                                            الاسم</th>
                                        <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            الرصيد</th>
                                        <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Price</th>
                                        <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Quantity</th>
                                        <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            status</th>
                                        <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            action</th>
                                    </tr>
                                </thead>
                                @foreach ($points as $point)
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="px-2 py-1 d-flex">
                                                    <div>
                                                        <img src="{{ $point->imageUrl }}" class="avatar avatar-sm ms-3"
                                                            alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $point->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold">{{ $point->account }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold">100 </p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold">10</p>
                                            </td>
                                            <td class="text-sm align-middle">
                                                <span class="badge badge-sm bg-gradient-success">on</span>
                                            </td>
                                            <td class="align-middle ">
                                                <!-- start view1 -->
                                                <div class="d-inline-block">
                                                    <a href="javascript:;"
                                                        class="px-1 text-xs text-secondary font-weight-bold "
                                                        data-toggle="tooltip" data-original-title="view user"
                                                        data-bs-toggle="modal" data-bs-target="#view{{ $point->id }}">
                                                        <i class="fas fa-eye fs-6"></i>
                                                    </a>
                                                    <!-- satrt view1 Modal -->
                                                    <form action="">
                                                        <div class="modal fade" id="view{{ $point->id }}"
                                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            عرض</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="img">الصورة</label>
                                                                            <div class="position-relative">
                                                                                <img src="{{ $point->image ? $point->imageUrl : asset('images/no_image.webp') }}"
                                                                                    alt="img1" class="rounded w-100">
                                                                                {{-- <div
                                                                                    class="top-0 right-0 gap-1 p-1 position-absolute d-flex">
                                                                                    <a href="javascript:;"
                                                                                        class="text-xs text-secondary font-weight-bold"
                                                                                        data-toggle="tooltip"
                                                                                        data-original-title="Edit user">
                                                                                        <i class="p-1 text-white rounded fas fa-edit fs-6 bg-primary"
                                                                                            aria-hidden="true"></i>
                                                                                    </a>
                                                                                    <a href="javascript:;"
                                                                                        class="text-xs text-secondary font-weight-bold "
                                                                                        data-toggle="tooltip"
                                                                                        data-original-title="Edit user">
                                                                                        <i class="p-1 text-white rounded fas fa-trash fs-6 bg-primary"
                                                                                            aria-hidden="true"></i>
                                                                                    </a>
                                                                                </div> --}}
                                                                            </div>
                                                                            <input type="file" class="form-control"
                                                                                id="img" name="image">
                                                                        </div>

                                                                        {{-- <div class="form-group">
                                                                            <label for="imgs">الصور</label>
                                                                            <!-- start slider  -->
                                                                            <div class="row">
                                                                                <div class="mx-auto col-md-12">
                                                                                    <div id="caeousel1"
                                                                                        class="carousel slide"
                                                                                        data-bs-ride="carousel">
                                                                                        <div class="carousel-indicators">
                                                                                            <button type="button"
                                                                                                data-bs-target="#caeousel1"
                                                                                                data-bs-slide-to="0"
                                                                                                class="active"
                                                                                                aria-current="true"
                                                                                                aria-label="Slide 1"></button>
                                                                                            <button type="button"
                                                                                                data-bs-target="#caeousel1"
                                                                                                data-bs-slide-to="1"
                                                                                                aria-label="Slide 2"></button>
                                                                                            <button type="button"
                                                                                                data-bs-target="#caeousel1"
                                                                                                data-bs-slide-to="2"
                                                                                                aria-label="Slide 3"></button>
                                                                                        </div>
                                                                                        <div class="carousel-inner">
                                                                                            <div
                                                                                                class="carousel-item active">
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <img src="{{ asset('/assets/img/home-decor-1.jpg') }}"
                                                                                                        alt="img1"
                                                                                                        class="rounded w-100">
                                                                                                    <div
                                                                                                        class="top-0 right-0 gap-1 p-1 position-absolute d-flex">
                                                                                                        <a href="javascript:;"
                                                                                                            class="text-xs text-secondary font-weight-bold"
                                                                                                            data-toggle="tooltip"
                                                                                                            data-original-title="Edit user">
                                                                                                            <i class="p-1 text-white rounded fas fa-edit fs-6 bg-primary"
                                                                                                                aria-hidden="true"></i>
                                                                                                        </a>
                                                                                                        <a href="javascript:;"
                                                                                                            class="text-xs text-secondary font-weight-bold "
                                                                                                            data-toggle="tooltip"
                                                                                                            data-original-title="Edit user">
                                                                                                            <i class="p-1 text-white rounded fas fa-trash fs-6 bg-primary"
                                                                                                                aria-hidden="true"></i>
                                                                                                        </a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="carousel-item">
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <img src="{{ asset('/assets/img/home-decor-2.jpg') }}"
                                                                                                        alt="img1"
                                                                                                        class="rounded w-100">
                                                                                                    <div
                                                                                                        class="top-0 right-0 gap-1 p-1 position-absolute d-flex">
                                                                                                        <a href="javascript:;"
                                                                                                            class="text-xs text-secondary font-weight-bold"
                                                                                                            data-toggle="tooltip"
                                                                                                            data-original-title="Edit user">
                                                                                                            <i class="p-1 text-white rounded fas fa-edit fs-6 bg-primary"
                                                                                                                aria-hidden="true"></i>
                                                                                                        </a>
                                                                                                        <a href="javascript:;"
                                                                                                            class="text-xs text-secondary font-weight-bold "
                                                                                                            data-toggle="tooltip"
                                                                                                            data-original-title="Edit user">
                                                                                                            <i class="p-1 text-white rounded fas fa-trash fs-6 bg-primary"
                                                                                                                aria-hidden="true"></i>
                                                                                                        </a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="carousel-item">
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <img src="{{ asset('/assets/img/home-decor-3.jpg') }}"
                                                                                                        alt="img1"
                                                                                                        class="rounded w-100">
                                                                                                    <div
                                                                                                        class="top-0 right-0 gap-1 p-1 position-absolute d-flex">
                                                                                                        <a href="javascript:;"
                                                                                                            class="text-xs text-secondary font-weight-bold"
                                                                                                            data-toggle="tooltip"
                                                                                                            data-original-title="Edit user">
                                                                                                            <i class="p-1 text-white rounded fas fa-edit fs-6 bg-primary"
                                                                                                                aria-hidden="true"></i>
                                                                                                        </a>
                                                                                                        <a href="javascript:;"
                                                                                                            class="text-xs text-secondary font-weight-bold "
                                                                                                            data-toggle="tooltip"
                                                                                                            data-original-title="Edit user">
                                                                                                            <i class="p-1 text-white rounded fas fa-trash fs-6 bg-primary"
                                                                                                                aria-hidden="true"></i>
                                                                                                        </a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <button
                                                                                            class="carousel-control-prev"
                                                                                            type="button"
                                                                                            data-bs-target="#caeousel1"
                                                                                            data-bs-slide="prev">
                                                                                            <span
                                                                                                class="carousel-control-prev-icon"
                                                                                                aria-hidden="true"></span>
                                                                                            <span
                                                                                                class="visually-hidden">Previous</span>
                                                                                        </button>
                                                                                        <button
                                                                                            class="carousel-control-next"
                                                                                            type="button"
                                                                                            data-bs-target="#caeousel1"
                                                                                            data-bs-slide="next">
                                                                                            <span
                                                                                                class="carousel-control-next-icon"
                                                                                                aria-hidden="true"></span>
                                                                                            <span
                                                                                                class="visually-hidden">Next</span>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <input type="file" class="form-control"
                                                                                multiple="multiple" id="imgs">
                                                                            <!-- end slider  -->
                                                                        </div> --}}
                                                                        <div class="form-group">
                                                                            <label for="name">الاسم</label>
                                                                            <input type="text" class="form-control"
                                                                                id="name" placeholder="ادخل الاسم"
                                                                                name="name" value="{{ $point->name }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="username">اسم المستخدم</label>
                                                                            <input type="text" class="form-control"
                                                                                id="username"
                                                                                placeholder="ادخل الاسم المستخدم"
                                                                                name="username"
                                                                                value="{{ $point->user->username }}">
                                                                        </div>
                                                                        {{-- <div class="form-group">
                                                                            <label for="password">كلمة السر</label>
                                                                            <input type="password" class="form-control"
                                                                                id="password"
                                                                                placeholder="ادخل كلمة السر الجديدة"
                                                                                name="password">
                                                                        </div> --}}
                                                                        <div class="form-group">
                                                                            <label for="price">الرصيد</label>
                                                                            <input type="number" class="form-control"
                                                                                id="account" placeholder="ادخل الرصيد"
                                                                                name="account"
                                                                                value="{{ $point->account }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="info">الشرح</label>
                                                                            <textarea class="form-control" id="info" rows="3" name="description">{{ $point->description }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <span class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</span>
                                                                        {{-- <button type="submit" class="btn btn-primary">Save
                                                                            changes</button> --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- end Modal view1  -->
                                                </div>
                                                <!-- end view1 -->
                                                <!-- start edit 1 -->
                                                <div class="d-inline-block">
                                                    <a href="javascript:;"
                                                        class="px-1 text-xs text-secondary font-weight-bold "
                                                        data-toggle="tooltip" data-original-title="Edit user"
                                                        data-bs-toggle="modal" data-bs-target="#edit{{ $point->id }}">
                                                        <i class="fas fa-edit fs-6"></i>
                                                    </a>
                                                    <!-- satrt edit Modal -->
                                                    <form
                                                    action="{{ route('admin.points.update', $point->id) }}"
                                                    method="POST" 
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                        <div class="modal fade" id="edit{{ $point->id }}"
                                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            تعديل </h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="img">الصورة</label>
                                                                            <div class="position-relative">
                                                                                <img src="{{ $point->image ? $point->imageUrl : asset('images/no_image.webp') }}"
                                                                                    alt="img1" class="rounded w-100">
                                                                                {{-- <div
                                                                                    class="top-0 right-0 gap-1 p-1 position-absolute d-flex">
                                                                                    <a href="javascript:;"
                                                                                        class="text-xs text-secondary font-weight-bold"
                                                                                        data-toggle="tooltip"
                                                                                        data-original-title="Edit user">
                                                                                        <i class="p-1 text-white rounded fas fa-edit fs-6 bg-primary"
                                                                                            aria-hidden="true"></i>
                                                                                    </a>
                                                                                    <a href="javascript:;"
                                                                                        class="text-xs text-secondary font-weight-bold "
                                                                                        data-toggle="tooltip"
                                                                                        data-original-title="Edit user">
                                                                                        <i class="p-1 text-white rounded fas fa-trash fs-6 bg-primary"
                                                                                            aria-hidden="true"></i>
                                                                                    </a>
                                                                                </div> --}}
                                                                            </div>
                                                                            <input type="file" class="form-control"
                                                                                id="img" name="image">
                                                                        </div>

                                                                        {{-- <div class="form-group">
                                                                            <label for="imgs">الصور</label>
                                                                            <!-- start slider  -->
                                                                            <div class="row">
                                                                                <div class="mx-auto col-md-12">
                                                                                    <div id="caeousel1"
                                                                                        class="carousel slide"
                                                                                        data-bs-ride="carousel">
                                                                                        <div class="carousel-indicators">
                                                                                            <button type="button"
                                                                                                data-bs-target="#caeousel1"
                                                                                                data-bs-slide-to="0"
                                                                                                class="active"
                                                                                                aria-current="true"
                                                                                                aria-label="Slide 1"></button>
                                                                                            <button type="button"
                                                                                                data-bs-target="#caeousel1"
                                                                                                data-bs-slide-to="1"
                                                                                                aria-label="Slide 2"></button>
                                                                                            <button type="button"
                                                                                                data-bs-target="#caeousel1"
                                                                                                data-bs-slide-to="2"
                                                                                                aria-label="Slide 3"></button>
                                                                                        </div>
                                                                                        <div class="carousel-inner">
                                                                                            <div
                                                                                                class="carousel-item active">
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <img src="{{ asset('/assets/img/home-decor-1.jpg') }}"
                                                                                                        alt="img1"
                                                                                                        class="rounded w-100">
                                                                                                    <div
                                                                                                        class="top-0 right-0 gap-1 p-1 position-absolute d-flex">
                                                                                                        <a href="javascript:;"
                                                                                                            class="text-xs text-secondary font-weight-bold"
                                                                                                            data-toggle="tooltip"
                                                                                                            data-original-title="Edit user">
                                                                                                            <i class="p-1 text-white rounded fas fa-edit fs-6 bg-primary"
                                                                                                                aria-hidden="true"></i>
                                                                                                        </a>
                                                                                                        <a href="javascript:;"
                                                                                                            class="text-xs text-secondary font-weight-bold "
                                                                                                            data-toggle="tooltip"
                                                                                                            data-original-title="Edit user">
                                                                                                            <i class="p-1 text-white rounded fas fa-trash fs-6 bg-primary"
                                                                                                                aria-hidden="true"></i>
                                                                                                        </a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="carousel-item">
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <img src="{{ asset('/assets/img/home-decor-2.jpg') }}"
                                                                                                        alt="img1"
                                                                                                        class="rounded w-100">
                                                                                                    <div
                                                                                                        class="top-0 right-0 gap-1 p-1 position-absolute d-flex">
                                                                                                        <a href="javascript:;"
                                                                                                            class="text-xs text-secondary font-weight-bold"
                                                                                                            data-toggle="tooltip"
                                                                                                            data-original-title="Edit user">
                                                                                                            <i class="p-1 text-white rounded fas fa-edit fs-6 bg-primary"
                                                                                                                aria-hidden="true"></i>
                                                                                                        </a>
                                                                                                        <a href="javascript:;"
                                                                                                            class="text-xs text-secondary font-weight-bold "
                                                                                                            data-toggle="tooltip"
                                                                                                            data-original-title="Edit user">
                                                                                                            <i class="p-1 text-white rounded fas fa-trash fs-6 bg-primary"
                                                                                                                aria-hidden="true"></i>
                                                                                                        </a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="carousel-item">
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <img src="{{ asset('/assets/img/home-decor-3.jpg') }}"
                                                                                                        alt="img1"
                                                                                                        class="rounded w-100">
                                                                                                    <div
                                                                                                        class="top-0 right-0 gap-1 p-1 position-absolute d-flex">
                                                                                                        <a href="javascript:;"
                                                                                                            class="text-xs text-secondary font-weight-bold"
                                                                                                            data-toggle="tooltip"
                                                                                                            data-original-title="Edit user">
                                                                                                            <i class="p-1 text-white rounded fas fa-edit fs-6 bg-primary"
                                                                                                                aria-hidden="true"></i>
                                                                                                        </a>
                                                                                                        <a href="javascript:;"
                                                                                                            class="text-xs text-secondary font-weight-bold "
                                                                                                            data-toggle="tooltip"
                                                                                                            data-original-title="Edit user">
                                                                                                            <i class="p-1 text-white rounded fas fa-trash fs-6 bg-primary"
                                                                                                                aria-hidden="true"></i>
                                                                                                        </a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <button
                                                                                            class="carousel-control-prev"
                                                                                            type="button"
                                                                                            data-bs-target="#caeousel1"
                                                                                            data-bs-slide="prev">
                                                                                            <span
                                                                                                class="carousel-control-prev-icon"
                                                                                                aria-hidden="true"></span>
                                                                                            <span
                                                                                                class="visually-hidden">Previous</span>
                                                                                        </button>
                                                                                        <button
                                                                                            class="carousel-control-next"
                                                                                            type="button"
                                                                                            data-bs-target="#caeousel1"
                                                                                            data-bs-slide="next">
                                                                                            <span
                                                                                                class="carousel-control-next-icon"
                                                                                                aria-hidden="true"></span>
                                                                                            <span
                                                                                                class="visually-hidden">Next</span>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <input type="file" class="form-control"
                                                                                multiple="multiple" id="imgs">
                                                                            <!-- end slider  -->
                                                                        </div> --}}
                                                                        <div class="form-group">
                                                                            <label for="name">الاسم</label>
                                                                            <input type="text" class="form-control"
                                                                                id="name" placeholder="ادخل الاسم"
                                                                                name="name" value="{{ $point->name }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="username">اسم المستخدم</label>
                                                                            <input type="text" class="form-control"
                                                                                id="username"
                                                                                placeholder="ادخل الاسم المستخدم"
                                                                                name="username"
                                                                                value="{{ $point->user->username }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="password">كلمة السر</label>
                                                                            <input type="password" class="form-control"
                                                                                id="password"
                                                                                placeholder="ادخل كلمة السر الجديدة"
                                                                                name="password">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="price">الرصيد</label>
                                                                            <input type="number" class="form-control"
                                                                                id="account" placeholder="ادخل الرصيد"
                                                                                name="account"
                                                                                value="{{ $point->account }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="info">الشرح</label>
                                                                            <textarea class="form-control" id="info" rows="3" name="description">{{ $point->description }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <span class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">الغاء</span>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">تعديل</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- end Modal edit  -->

                                                <!-- start delete 1 -->
                                                <div class="d-inline-block">
                                                    <a href="javascript:;"
                                                        class="px-1 text-xs text-secondary font-weight-bold "
                                                        data-toggle="tooltip" data-original-title="Edit user"
                                                        data-bs-toggle="modal" data-bs-target="#delete{{ $point->id }}">
                                                        <i class="fas fa-trash fs-6"></i>
                                                    </a>
                                                    <!--start delete Modal -->
                                                    <div class="modal fade" id="delete{{ $point->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="deleteLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="pb-0 text-center border-0 modal-header">
                                                                    <h5 class="modal-title" id="deleteLabel ">
                                                                        هل انت متأكد من أنك تريد حذف
                                                                        <strong>النقطة {{ $point->user->name }}
                                                                            ؟</strong>
                                                                    </h5>
                                                                </div>
                                                                <div class="border-0 modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">الغاء</button>
                                                                    <form
                                                                        action="{{ route('admin.points.destroy', $point->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-info">حذف</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end delete Modal -->
                                                </div>
                                                <!-- end delete -->
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                            <td>
                                                <div class="px-2 py-1 d-flex">
                                                    <div>
                                                        <img src="{{ asset('/assets/img/team-2.jpg') }}"
                                                            class="avatar avatar-sm ms-3" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">John Michael</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold">clothing</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold">100 </p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold">10</p>
                                            </td>
                                            <td class="text-sm align-middle">
                                                <span class="badge badge-sm bg-gradient-danger">off</span>
                                            </td>
                                            <td class="align-middle ">
                                                <!-- start view2 -->
                                                <div class="d-inline-block">
                                                    <a href="javascript:;"
                                                        class="px-1 text-xs text-secondary font-weight-bold "
                                                        data-toggle="tooltip" data-original-title="view user"
                                                        data-bs-toggle="modal" data-bs-target="#view2">
                                                        <i class="fas fa-eye fs-6"></i>
                                                    </a>
                                                    <!-- satrt view1 Modal -->
                                                    <form action="">
                                                        <div class="modal fade" id="view2" tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            عرض</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <h6>الصورة</h6>
                                                                            <img src="{{ asset('/assets/img/home-decor-2.jpg') }}"
                                                                                alt="img1" class="rounded w-100">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <h6>الصور</h6>
                                                                            <!-- start slider  -->
                                                                            <div class="row">
                                                                                <div class="mx-auto col-md-12">
                                                                                    <div id="caeouselView1"
                                                                                        class="carousel slide"
                                                                                        data-bs-ride="carousel">
                                                                                        <div class="carousel-indicators">
                                                                                            <button type="button"
                                                                                                data-bs-target="#caeouselView1"
                                                                                                data-bs-slide-to="0"
                                                                                                class="active"
                                                                                                aria-current="true"
                                                                                                aria-label="Slide 1"></button>
                                                                                            <button type="button"
                                                                                                data-bs-target="#caeouselView1"
                                                                                                data-bs-slide-to="1"
                                                                                                aria-label="Slide 2"></button>
                                                                                            <button type="button"
                                                                                                data-bs-target="#caeouselView1"
                                                                                                data-bs-slide-to="2"
                                                                                                aria-label="Slide 3"></button>
                                                                                        </div>
                                                                                        <div class="carousel-inner">
                                                                                            <div
                                                                                                class="carousel-item active">
                                                                                                <img src="{{ asset('/assets/img/home-decor-1.jpg') }}"
                                                                                                    class="d-block w-100"
                                                                                                    alt="...">
                                                                                            </div>
                                                                                            <div class="carousel-item">
                                                                                                <img src="{{ asset('/assets/img/home-decor-2.jpg') }}"
                                                                                                    class="d-block w-100"
                                                                                                    alt="...">
                                                                                            </div>
                                                                                            <div class="carousel-item">
                                                                                                <img src="{{ asset('/assets/img/home-decor-3.jpg') }}"
                                                                                                    class="d-block w-100"
                                                                                                    alt="...">
                                                                                            </div>
                                                                                        </div>
                                                                                        <button
                                                                                            class="carousel-control-prev"
                                                                                            type="button"
                                                                                            data-bs-target="#caeouselView1"
                                                                                            data-bs-slide="prev">
                                                                                            <span
                                                                                                class="carousel-control-prev-icon"
                                                                                                aria-hidden="true"></span>
                                                                                            <span
                                                                                                class="visually-hidden">Previous</span>
                                                                                        </button>
                                                                                        <button
                                                                                            class="carousel-control-next"
                                                                                            type="button"
                                                                                            data-bs-target="#caeouselView1"
                                                                                            data-bs-slide="next">
                                                                                            <span
                                                                                                class="carousel-control-next-icon"
                                                                                                aria-hidden="true"></span>
                                                                                            <span
                                                                                                class="visually-hidden">Next</span>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- end slider  -->
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <h6>الاسم</h6>
                                                                            <span>الاسم هنا</span>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <h6>السعر</h6>
                                                                            <span>السعر هنا</span>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <h6>الشرح</j>
                                                                                <p>الشرح هنا</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="border-0 modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">الغاء</button>
                                                                        <button type="button"
                                                                            class="btn btn-info">حفظ</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- end Modal view1  -->
                                                </div>
                                                <!-- end view2 -->
                                                <!-- start edit 2 -->
                                                <div class="d-inline-block">
                                                    <a href="javascript:;"
                                                        class="px-1 text-xs text-secondary font-weight-bold "
                                                        data-toggle="tooltip" data-original-title="Edit user"
                                                        data-bs-toggle="modal" data-bs-target="#edit2">
                                                        <i class="fas fa-edit fs-6"></i>
                                                    </a>
                                                    <!-- satrt edit Modal -->
                                                    <form action="">
                                                        <div class="modal fade" id="edit2" tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            تعديل </h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="img">الصورة</label>
                                                                            <div class="position-relative">
                                                                                <img src="{{ asset('/assets/img/home-decor-2.jpg') }}"
                                                                                    alt="img1" class="rounded w-100">
                                                                                <div
                                                                                    class="top-0 right-0 gap-1 p-1 position-absolute d-flex">
                                                                                    <a href="javascript:;"
                                                                                        class="text-xs text-secondary font-weight-bold"
                                                                                        data-toggle="tooltip"
                                                                                        data-original-title="Edit user">
                                                                                        <i class="p-1 text-white rounded fas fa-edit fs-6 bg-primary"
                                                                                            aria-hidden="true"></i>
                                                                                    </a>
                                                                                    <a href="javascript:;"
                                                                                        class="text-xs text-secondary font-weight-bold "
                                                                                        data-toggle="tooltip"
                                                                                        data-original-title="Edit user">
                                                                                        <i class="p-1 text-white rounded fas fa-trash fs-6 bg-primary"
                                                                                            aria-hidden="true"></i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                            <input type="file" class="form-control"
                                                                                id="img">
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="imgs">الصور</label>
                                                                            <!-- start slider  -->
                                                                            <div class="row">
                                                                                <div class="mx-auto col-md-12">
                                                                                    <div id="caeousel1"
                                                                                        class="carousel slide"
                                                                                        data-bs-ride="carousel">
                                                                                        <div class="carousel-indicators">
                                                                                            <button type="button"
                                                                                                data-bs-target="#caeousel1"
                                                                                                data-bs-slide-to="0"
                                                                                                class="active"
                                                                                                aria-current="true"
                                                                                                aria-label="Slide 1"></button>
                                                                                            <button type="button"
                                                                                                data-bs-target="#caeousel1"
                                                                                                data-bs-slide-to="1"
                                                                                                aria-label="Slide 2"></button>
                                                                                            <button type="button"
                                                                                                data-bs-target="#caeousel1"
                                                                                                data-bs-slide-to="2"
                                                                                                aria-label="Slide 3"></button>
                                                                                        </div>
                                                                                        <div class="carousel-inner">
                                                                                            <div
                                                                                                class="carousel-item active">
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <img src="{{ asset('/assets/img/home-decor-1.jpg') }}"
                                                                                                        alt="img1"
                                                                                                        class="rounded w-100">
                                                                                                    <div
                                                                                                        class="top-0 right-0 gap-1 p-1 position-absolute d-flex">
                                                                                                        <a href="javascript:;"
                                                                                                            class="text-xs text-secondary font-weight-bold"
                                                                                                            data-toggle="tooltip"
                                                                                                            data-original-title="Edit user">
                                                                                                            <i class="p-1 text-white rounded fas fa-edit fs-6 bg-primary"
                                                                                                                aria-hidden="true"></i>
                                                                                                        </a>
                                                                                                        <a href="javascript:;"
                                                                                                            class="text-xs text-secondary font-weight-bold "
                                                                                                            data-toggle="tooltip"
                                                                                                            data-original-title="Edit user">
                                                                                                            <i class="p-1 text-white rounded fas fa-trash fs-6 bg-primary"
                                                                                                                aria-hidden="true"></i>
                                                                                                        </a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="carousel-item">
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <img src="{{ asset('/assets/img/home-decor-2.jpg') }}"
                                                                                                        alt="img1"
                                                                                                        class="rounded w-100">
                                                                                                    <div
                                                                                                        class="top-0 right-0 gap-1 p-1 position-absolute d-flex">
                                                                                                        <a href="javascript:;"
                                                                                                            class="text-xs text-secondary font-weight-bold"
                                                                                                            data-toggle="tooltip"
                                                                                                            data-original-title="Edit user">
                                                                                                            <i class="p-1 text-white rounded fas fa-edit fs-6 bg-primary"
                                                                                                                aria-hidden="true"></i>
                                                                                                        </a>
                                                                                                        <a href="javascript:;"
                                                                                                            class="text-xs text-secondary font-weight-bold "
                                                                                                            data-toggle="tooltip"
                                                                                                            data-original-title="Edit user">
                                                                                                            <i class="p-1 text-white rounded fas fa-trash fs-6 bg-primary"
                                                                                                                aria-hidden="true"></i>
                                                                                                        </a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="carousel-item">
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <img src="{{ asset('/assets/img/home-decor-3.jpg') }}"
                                                                                                        alt="img1"
                                                                                                        class="rounded w-100">
                                                                                                    <div
                                                                                                        class="top-0 right-0 gap-1 p-1 position-absolute d-flex">
                                                                                                        <a href="javascript:;"
                                                                                                            class="text-xs text-secondary font-weight-bold"
                                                                                                            data-toggle="tooltip"
                                                                                                            data-original-title="Edit user">
                                                                                                            <i class="p-1 text-white rounded fas fa-edit fs-6 bg-primary"
                                                                                                                aria-hidden="true"></i>
                                                                                                        </a>
                                                                                                        <a href="javascript:;"
                                                                                                            class="text-xs text-secondary font-weight-bold "
                                                                                                            data-toggle="tooltip"
                                                                                                            data-original-title="Edit user">
                                                                                                            <i class="p-1 text-white rounded fas fa-trash fs-6 bg-primary"
                                                                                                                aria-hidden="true"></i>
                                                                                                        </a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <button
                                                                                            class="carousel-control-prev"
                                                                                            type="button"
                                                                                            data-bs-target="#caeousel1"
                                                                                            data-bs-slide="prev">
                                                                                            <span
                                                                                                class="carousel-control-prev-icon"
                                                                                                aria-hidden="true"></span>
                                                                                            <span
                                                                                                class="visually-hidden">Previous</span>
                                                                                        </button>
                                                                                        <button
                                                                                            class="carousel-control-next"
                                                                                            type="button"
                                                                                            data-bs-target="#caeousel1"
                                                                                            data-bs-slide="next">
                                                                                            <span
                                                                                                class="carousel-control-next-icon"
                                                                                                aria-hidden="true"></span>
                                                                                            <span
                                                                                                class="visually-hidden">Next</span>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <input type="file" class="form-control"
                                                                                multiple="multiple" id="imgs">
                                                                            <!-- end slider  -->
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="name">الاسم</label>
                                                                            <input type="text" class="form-control"
                                                                                id="name" placeholder="ادخل الاسم">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="price">السعر</label>
                                                                            <input type="number" class="form-control"
                                                                                id="price" placeholder="ادخل السعر">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="info">الشرح</label>
                                                                            <textarea class="form-control" id="info" rows="3"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="border-0 modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">الغاء</button>
                                                                        <button type="button"
                                                                            class="btn btn-info">حفظ</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- end Modal edit  -->
                                                </div>
                                                <!-- end edit 2-->
                                                <!-- start delete 2-->
                                                <div class="d-inline-block">
                                                    <a href="javascript:;"
                                                        class="px-1 text-xs text-secondary font-weight-bold "
                                                        data-toggle="tooltip" data-original-title="Edit user"
                                                        data-bs-toggle="modal" data-bs-target="#delete2">
                                                        <i class="fas fa-trash fs-6"></i>
                                                    </a>
                                                    <!--start delete Modal -->
                                                    <div class="modal fade" id="delete2" tabindex="-1" role="dialog"
                                                        aria-labelledby="deleteLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="pb-0 text-center border-0 modal-header">
                                                                    <h5 class="modal-title" id="deleteLabel ">هل تريد
                                                                        تأكيد حذف العنصر</h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">الغاء</button>
                                                                    <form action="">
                                                                        <button type="submit"
                                                                            class="btn btn-info">نعم</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end delete Modal -->
                                                </div>
                                                <!-- end delete -->
                                            </td>
                                        </tr> --}}

                                    </tbody>
                                @endforeach
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- start pagination -->
            {{-- <ul class="pagination pagination-info">
                    <li class="page-item">
                        <a class="page-link" href="#link" aria-label="Previous">
                            <span aria-hidden="true"> <i class="fas fa-angle-right" aria-hidden="true"></i>
                            </span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#link">1</a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#link">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#link">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#link">4</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#link">5</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#link" aria-label="Next">
                            <span aria-hidden="true">
                                <i class="fas fa-angle-left" aria-hidden="true"></i>
                            </span>
                        </a>
                    </li>
                </ul> --}}

            {{ $points->links() }}
            <!-- end pagination -->
        </div>
    </div>
    </div>
@endsection

@section('js')
    <!--   Core JS Files   -->
    <script src="{{ asset('/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/choices.min.js') }}"></script>

    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('/assets/js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
@endsection
