@extends('admin.dashboard')


@section('title', 'المشتركين')

@section('content')
    <div class="py-4 container-fluid">
        <div class="flex-wrap gap-3 d-flex">
            <button type="button" class="mx-md-2 btn bg-gradient-dark btn-sm" data-bs-toggle="modal" data-bs-target="#add">
                إضافة
            </button>
            <!-- start import  -->
            <form action="{{ route('admin.subscribers.import') }}" method="POST" enctype="multipart/form-data"
                class="me-md-auto">
                @csrf
                <label class="mx-md-3 btn btn-light btn-sm ps-3 pe-3">
                    <i class="mx-1 fas fa-file-import"></i>
                    استيراد
                    <input type="file" class="d-none" accept=".xlsx" name="subscribers" onchange="form.submit()">
                </label>
            </form>
            <!-- end import  -->
            <!-- start export  -->
            <form action="{{ route('admin.subscribers.export') }}" method="GET">
                <input type="hidden" name="pagination_number" value="{{ $pagination_number }}">
                <input type="hidden" name="page" value="{{ $page }}">
                <input type="hidden" name="sort_by" value="{{ $sort_by }}">
                <input type="hidden" name="s" value="{{ $search }}">

                <button class="btn btn-white btn-sm ps-3 pe-3">
                    تصدير
                    <i class="mx-1 fas fa-file-export"></i>
                </button>
            </form>
            <!-- end export  -->
        </div>
        <!-- start add  -->
        <!-- add Modal -->
        <form action="{{ route('admin.subscribers.store') }}" method="POST">
            @csrf
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="font-bold modal-title">إضافة مشترك</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            الاسم
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input name="name" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            اسم المستخدم
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input type="text" class="form-control" required name="sub_username"
                                            placeholder="username@icenet">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            T.C
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input type="text" class="form-control" required name="t_c">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            ID
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input type="number" class="form-control" required name="sub_id">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            رقم المشترك
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input type="number" class="form-control" required name="subscriber_number">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            اسم الأم
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input type="text" class="form-control" required name="mother">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            رقم الهاتف
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input type="tel" class="form-control" required name="phone">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            تاريخ بدء الباقة
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input type="date" class="form-control date-now" required name="package_start">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            اسم الباقة
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <select class="form-select" required name="package_id">
                                            <option value="">اختر باقة</option>
                                            @foreach ($packages as $package)
                                                <option value="{{ $package->id }}">{{ $package->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            حالة المستخدم
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <select class="form-select" required name="status">
                                            <option value="{{ App\Enums\UserStatusEnum::ACTIVE->value }}" selected> مفعل
                                            </option>
                                            <option value="{{ App\Enums\UserStatusEnum::INACTIVE->value }}"> غير مفعل
                                            </option>
                                            <option value="{{ App\Enums\UserStatusEnum::CLOSED->value }}">مغلق</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            منفذ المهمة
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input type="text" class="form-control" required name="mission_executor">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            العنوان
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <textarea cols="30" rows="3" required class="form-control" name="address"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            مكان التركيب
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <textarea cols="30" rows="3" required class="form-control" name="installation_address"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            الملاحظات
                                        </label>
                                        <textarea name="note" cols="30" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info">حفظ</button>
                            <span type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- end add  -->
        <div class="row">

            <!-- start filter -->
            <div class="col-md-6">
                <form action="" method="GET">
                    <input type="hidden" name="pagination_number" value="{{ $pagination_number }}">
                    <input type="hidden" name="page" value="{{ $page }}">
                    <input type="hidden" name="s" value="{{ $search }}">
                    <div class="flex-wrap form-group form-row">
                        <span>ترتيب حسب حقل</span>
                        <select required class="form-select input-200" name="sort_by" onchange="form.submit()">
                            <option value="">اختر احد الحقول</option>
                            <option @if ($sort_by == 'name') selected @endif value="name">الاسم </option>
                            <option @if ($sort_by == 't_c') selected @endif value="t_c">T.C</option>
                            <option @if ($sort_by == 'package_start') selected @endif value="package_start">تاريخ البدء
                            </option>
                            <option @if ($sort_by == 'status') selected @endif value="status">حالة المستخدم</option>
                        </select>
                    </div>
                </form>
            </div>
            <!-- end filter -->

            <!-- start pagination show  -->
            <div class="col-md-6">
                <form action="" method="GET">
                    <div class="flex-row-reverse justify-xs-start form-group form-row">
                        <button class="m-0 btn btn-secondary btn-sm">تغير</button>
                        <input type="hidden" name="s" value="{{ $search }}">
                        <input type="hidden" name="page" value="1">
                        <input type="hidden" name="sort_by" value="{{ $sort_by }}">
                        <input type="number" class="py-1 form-control input-75" name="pagination_number"
                            value="{{ $pagination_number }}">
                        عرض في كل صفحة
                    </div>
                </form>
            </div>
            <!-- end pagination show  -->
        </div>
        <div class="row">
            <div class="col-12">
                <div class="mb-4 card">
                    <div class="px-0 pt-0 pb-2 card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
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
                                        اسم المستخدم </th>
                                        <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            T.C </th>
                                        <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ID</th>
                                        <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            رقم المشترك</th>
                                        <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            تاريخ البدء </th>
                                        <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            تاريخ الانتهاء </th>
                                        <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            اسم الباقة </th>
                                        <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            حالة المستخدم </th>
                                        <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subs as $sub)
                                        <tr>
                                            <td>
                                                <h6 class="mb-0 text-sm">{{ $sub->name }}</h6>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold">{{ $sub->sub_username }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold">{{ $sub->t_c }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold">{{ $sub->sub_id }} </p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold">{{ $sub->subscriber_number }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold">
                                                    {{ $sub->start_package }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold">
                                                    {{ $sub->end_package }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold">
                                                    {{ $sub->package ? $sub->package->name : 'الباقة محذوفة' }}
                                                </p>
                                            </td>
                                            <td class="text-sm align-middle">
                                                {!! $sub->status() !!}
                                            </td>
                                            <td class="align-middle ">
                                                <!-- start view1 -->
                                                <div class="d-inline-block">
                                                    <a href="javascript:;"
                                                        class="px-1 text-xs text-secondary font-weight-bold "
                                                        data-toggle="tooltip" data-original-title="view user"
                                                        data-bs-toggle="modal" data-bs-target="#view{{ $sub->id }}">
                                                        <i class="fas fa-eye fs-6"></i>
                                                    </a>
                                                    <!-- satrt view1 Modal -->

                                                    <!-- end Modal view1  -->
                                                    <div class="modal fade" id="view{{ $sub->id }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="view1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-xl"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="font-bold modal-title">عرض المشترك</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    الاسم
                                                                                </h6>
                                                                                {{ $sub->name }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    اسم المستخدم
                                                                                </h6>
                                                                                {{ $sub->sub_username }}
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    T.C

                                                                                </h6>
                                                                                {{ $sub->t_c }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    ID
                                                                                </h6>
                                                                                {{ $sub->sub_id }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    رقم المشترك
                                                                                </h6>
                                                                                {{ $sub->subscriber_number }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    اسم الأم
                                                                                </h6>
                                                                                {{ $sub->mother }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    رقم الهاتف
                                                                                </h6>
                                                                                <bdi>{{ $sub->phone }}</bdi>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    التاريخ
                                                                                </h6>
                                                                                {{ $sub->start_package }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    اسم الباقة
                                                                                </h6>
                                                                                {{ $sub->package ? $sub->package->name : 'الباقة محذوفة' }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    حالة المستخدم
                                                                                </h6>
                                                                                {!! $sub->status() !!}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    منفذ المهمة
                                                                                </h6>
                                                                                {{ $sub->mission_executor }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    العنوان
                                                                                </h6>
                                                                                <p>
                                                                                    {{ $sub->address }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    مكان التركيب
                                                                                </h6>
                                                                                <p>
                                                                                    {{ $sub->installation_address }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    الملاحظات
                                                                                </h6>
                                                                                <p>
                                                                                    {{ $sub->note }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <span type="button" class="btn btn-info"
                                                                        data-bs-dismiss="modal">اغلاق</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end view1 -->

                                                <!-- start edit 1 -->
                                                <div class="d-inline-block">
                                                    <a href="javascript:;"
                                                        class="px-1 text-xs text-secondary font-weight-bold "
                                                        data-toggle="tooltip" data-original-title="Edit user"
                                                        data-bs-toggle="modal" data-bs-target="#edit{{ $sub->id }}">
                                                        <i class="fas fa-edit fs-6"></i>
                                                    </a>
                                                    <!-- satrt edit Modal -->
                                                    <form action="{{ route('admin.subscribers.update', $sub->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="_id"
                                                            value="{{ $sub->id }}">
                                                        <div class="modal fade" id="edit{{ $sub->id }}"
                                                            tabindex="-1" role="dialog" aria-labelledby="add"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-xl"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="font-bold modal-title">تعديل الشترك
                                                                        </h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        الاسم
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <input name="name" type="text"
                                                                                        class="form-control" required
                                                                                        value="{{ $sub->name }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        اسم المستخدم
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <input name="sub_username"
                                                                                        type="text"
                                                                                        class="form-control"
                                                                                        placeholder="username@icenet"
                                                                                        value="{{ $sub->sub_username }}"
                                                                                        required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        T_C
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <input name="t_c" type="number"
                                                                                        class="form-control" required
                                                                                        value="{{ $sub->t_c }}"
                                                                                        pattern="\d{11}" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        ID
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <input name="sub_id" type="number"
                                                                                        class="form-control" required
                                                                                        value="{{ $sub->sub_id }}">
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-lg-4 col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        رقم المشترك
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <input name="subscriber_number"
                                                                                        type="number"
                                                                                        class="form-control" required
                                                                                        value="{{ $sub->subscriber_number }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        اسم الأم
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <input name="mother" type="text"
                                                                                        class="form-control" required
                                                                                        value="{{ $sub->mother }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        رقم الهاتف
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <input name="phone" type="tel"
                                                                                        class="form-control" required
                                                                                        value="{{ $sub->phone }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        تاريخ بدء الباقة
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <input name="package_start"
                                                                                        type="date"
                                                                                        class="form-control"
                                                                                        value="{{ $sub->start_package }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        اسم الباقة
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <select required class="form-select"
                                                                                        name="package_id">
                                                                                        <option value="">اختر باقة
                                                                                        </option>
                                                                                        @foreach ($packages as $package)
                                                                                            <option
                                                                                                value="{{ $package->id }}"
                                                                                                @if ($sub->package_id == $package->id) selected @endif>
                                                                                                {{ $package->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        حالة المستخدم
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <select required class="form-select"
                                                                                        name="status">
                                                                                        <option
                                                                                            value="{{ App\Enums\UserStatusEnum::ACTIVE->value }}"
                                                                                            @if ($sub->status == App\Enums\UserStatusEnum::ACTIVE->value) selected @endif>
                                                                                            مفعل
                                                                                        </option>
                                                                                        <option
                                                                                            value="{{ App\Enums\UserStatusEnum::INACTIVE->value }}"
                                                                                            @if ($sub->status == App\Enums\UserStatusEnum::INACTIVE->value) selected @endif>
                                                                                            غير مفعل
                                                                                        </option>
                                                                                        <option
                                                                                            value="{{ App\Enums\UserStatusEnum::CLOSED->value }}"
                                                                                            @if ($sub->status == App\Enums\UserStatusEnum::CLOSED->value) selected @endif>
                                                                                            مغلق</option>

                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        منفذ المهمة
                                                                                    </label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="mission_executor"
                                                                                        value="{{ $sub->mission_executor }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        العنوان
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <textarea name="address" cols="30" rows="3" required class="form-control"> {{ $sub->address }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        مكان التركيب
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <textarea name="installation_address" cols="30" rows="3" required class="form-control"> {{ $sub->installation_address }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        الملاحظات
                                                                                    </label>
                                                                                    <textarea name="note" cols="30" rows="3" class="form-control">{{ $sub->note }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit"
                                                                            class="btn btn-info">حفظ</button>
                                                                        <span type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">الغاء</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- end edit Modal -->
                                                </div>
                                                <!-- end edit 1 -->
                                                <!-- start delete 1 -->
                                                <div class="d-inline-block">
                                                    <a href="javascript:;"
                                                        class="px-1 text-xs text-secondary font-weight-bold "
                                                        data-toggle="tooltip" data-original-title="delete user"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $sub->id }}">
                                                        <i class="fas fa-ban fs-6" aria-hidden="true"></i>
                                                    </a>
                                                    <!--start delete Modal -->
                                                    <div class="modal fade" id="delete{{ $sub->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="deleteLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="pb-0 text-center border-0 modal-header">
                                                                    <h5 class="modal-title" id="deleteLabel ">
                                                                        انت متأكد من أنك تريد ايقاف
                                                                        <strong>المشترك {{ $sub->name }}
                                                                        </strong>
                                                                    </h5>
                                                                </div>
                                                                <div class="border-0 modal-footer">
                                                                    <form
                                                                        action="{{ route('admin.subscribers.destroy', $sub->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-info">ايقاف</button>
                                                                    </form>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">الغاء</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end delete Modal -->
                                                </div>
                                                <!-- end delete 1 -->

                                                @if (Auth::user()->isSuperAdmin())
                                                    <!-- start charge1 -->
                                                    <div class="d-inline-block">
                                                        <a href="javascript:;"
                                                            class="px-1 text-xs text-secondary font-weight-bold "
                                                            data-toggle="tooltip"
                                                            data-original-title="charge{{ $sub->id }} user"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#charge{{ $sub->id }}">
                                                            <i class="fas fa-money-bill-wave-alt"></i>
                                                        </a>
                                                        <!-- satrt charge1 Modal -->
                                                        <form action="{{ route('admin.subscribers.charge', $sub->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal fade" id="charge{{ $sub->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        @if ($sub->status != 'closed')
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLabel">
                                                                                    تمديد أيام
                                                                                    فاتورة لمشترك </h5>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class=" col-6">
                                                                                        <div class="form-group">
                                                                                            <h6>
                                                                                                الاسم
                                                                                            </h6>
                                                                                            {{ $sub->name }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class=" col-6">
                                                                                        <div class="form-group">
                                                                                            <h6>
                                                                                                الأيام المتبقية
                                                                                            </h6>
                                                                                            {{ $sub->days_to_end }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class=" col-6">
                                                                                        <div class="form-group">
                                                                                            <h6>
                                                                                                اسم الباقة </h6>
                                                                                            {{ $sub->package->name }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class=" col-6">
                                                                                        <div class="form-group">
                                                                                            <h6>
                                                                                                سعر الباقة </h6>
                                                                                            {{ $sub->package->price }}
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class=" col-6">
                                                                                        <div class="form-group">
                                                                                            <h6>
                                                                                                حالة المشترك </h6>
                                                                                            {!! $sub->status() !!}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class=" col-6">
                                                                                        <div class="form-group">
                                                                                            <h6>عدد الأيام </h6>
                                                                                            <input name="days"
                                                                                                type="number"
                                                                                                class="form-control"
                                                                                                required>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit"
                                                                                    class="btn btn-info">حفظ</button>
                                                                                <span type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">الغاء</span>
                                                                            </div>
                                                                        @else
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">
                                                                                    عذرا المشترك مغلق
                                                                                </h5>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                هذا المشترك مغلق الرجاء تفعيل النقطة ومن ثم
                                                                                اضافة ايام
                                                                            </div>
                                                                            <div class="modal-footer">

                                                                                <span type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">الغاء</span>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!-- end Modal charge1  -->
                                                        <!-- end charge1 -->
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- start pagination -->
            {{ $subs->links() }}
            <!-- end pagination -->
        </div>
    </div>
@endsection
