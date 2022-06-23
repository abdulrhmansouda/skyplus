@extends('point.app')



@section('title', 'تسديد الفاتورة')

@section('content')
    <div class="py-4 container-fluid">
    @if ( Auth::user()->point->account <= 0)
    <div class="alert alert-danger alert-dismissible fade show position-relative" role="alert">
        <span class="alert-icon"><i class='fa fa-warning'></i></span>
        <span class="alert-text"><strong> عذرا! </strong>انت تقوم بتسديد الفواتير بحالة الدين</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
        <div class="mb-3 row">
            <div class="mb-4 col-lg-3 col-sm-6 mb-lg-0">
                <div class="card">
                    <div class="p-3 card-body">
                        <div class=" row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="mb-0 text-sm text-capitalize font-weight-bold">الرصيد الحالي</p>
                                    <h5 class="mb-0 font-weight-bolder">
                                        {{ Auth::user()->point->account }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-start">
                                <div class="text-center shadow icon icon-shape bg-gradient-info border-radius-md">
                                    <i class="text-lg fas fa-wallet opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="p-3 card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="mb-0 text-sm text-capitalize font-weight-bold">الربح</p>
                                    <h5 class="mb-0 font-weight-bolder">
                                        {{ Auth::user()->point->daily_profit }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-start">
                                <div class="text-center shadow icon icon-shape bg-gradient-info border-radius-md">
                                    <i class="fas fa-coins" text-lg="" opacity-10="" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="row">
            <!-- if search  -->
            @if ($search && $sub)

                <div class="col-12">
                    <div class="mb-4 card">
                        <div class="pb-0 card-header">
                            <div class="row">
                                <div class="col-12">
                                    <h6>المشتركين</h6>
                                </div>
                            </div>
                        </div>
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
                                                الاسم
                                            </th>
                                            <th
                                                class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                T.C </th>
                                            <th
                                                class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                رقم المشترك
                                            </th>
                                            <th
                                                class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                تاريخ البدء </th>
                                            <th
                                                class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                تاريخ الانتهاء </th>
                                            <th
                                                class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                اسم الباقة
                                            </th>
                                            <th
                                                class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                حالة
                                                المستخدم </th>
                                            <th
                                                class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($subs as $sub) --}}
                                        <tr>
                                            <td>
                                                <h6 class="mb-0 text-sm">{{ $sub->name }}</h6>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold">{{ $sub->t_c }}</p>
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
                                                <p class="mb-0 text-xs font-weight-bold">{{ $sub->package->name }}</p>
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
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <!-- satrt view1 Modal -->
                                                    <div class="modal fade" id="view{{ $sub->id }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-xl"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        عرض المشترك </h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    اسم المشترك
                                                                                    <h6>
                                                                                        {{ $sub->name }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    T.c
                                                                                </h6>
                                                                                {{ $sub->t_c }}
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
                                                                                    رقم الهاتف
                                                                                </h6>
                                                                                <bdi>{{ $sub->phone }}</bdi>
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
                                                                                    سعر الباقة
                                                                                </h6>
                                                                                {{ $sub->package->price }}
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    تاريخ البدء
                                                                                </h6>
                                                                                {{ $sub->start_package }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    تاريخ الانتهاء
                                                                                </h6>
                                                                                {{ $sub->end_package }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    الايام المتبقية
                                                                                </h6>
                                                                                {{ $sub->days_to_end }}
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    حالة المستخدم
                                                                                </h6>
                                                                                {{-- @if ($sub->status === 'active')
                                                                                    <span
                                                                                        class="badge badge-sm bg-gradient-success">مفعل</span>
                                                                                @elseif($sub->status === 'deactive')
                                                                                    <span
                                                                                        class="badge badge-sm bg-gradient-danger">غير
                                                                                        مفعل</span>
                                                                                @else
                                                                                    <span
                                                                                        class="badge badge-sm bg-gradient-danger">مغلق</span>
                                                                                @endif --}}
                                                                                {!! $sub->status() !!}
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
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-info"
                                                                        data-bs-dismiss="modal">اغلاق</button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end Modal view1  -->
                                                </div>
                                                <!-- end view1 -->

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
                                                    {{-- <!-- <form action="{{ route('point.subscribers.charge', $sub->id) }}" method="POST"> --}}
                                                    {{-- @csrf --}}
                                                    {{-- @method('PUT') --> --}}
                                                    {{-- <input type="text"> --}}
                                                    <div class="modal fade" id="charge{{ $sub->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                @if ($sub->status !== 'closed')
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            دفع
                                                                            فاتورة للمشترك </h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- tabs -->
                                                                        <ul class="mb-3 nav nav-tabs">
                                                                            <li class="nav-item">
                                                                                <button type="button"
                                                                                    class="nav-link active"
                                                                                    data-tab="tab1-{{ $sub->id }}"
                                                                                    onclick="openTab(event)">تسديد</button>
                                                                            </li>
                                                                            <li class="nav-item">
                                                                                <button type="button" class="nav-link"
                                                                                    data-tab="tab2-{{ $sub->id }}"
                                                                                    onclick="openTab(event)">الغاء
                                                                                    تسديد</button>
                                                                            </li>
                                                                            <li class="nav-item">
                                                                                <button type="button" class="nav-link"
                                                                                    data-tab="tab3-{{ $sub->id }}"
                                                                                    onclick="openTab(event)">ترقية</button>
                                                                            </li>
                                                                        </ul>
                                                                        <div class="tab-content">
                                                                            <div class="tab-pane active"
                                                                                id="tab1-{{ $sub->id }}">
                                                                                <!-- start tab 1 -->
                                                                                <form
                                                                                    action="{{ route('point.subscribers.charge', $sub->id) }}"
                                                                                    method="POST">
                                                                                    @csrf
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
                                                                                                <span class="price" >
                                                                                                    {{ $sub->package->price }}
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class=" col-6">
                                                                                            <div class="form-group">
                                                                                                <h6>
                                                                                                     السعر الكلي </h6>
                                                                                                <span class="final-price" >
                                                                                                    {{ $sub->package->price }}
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class=" col-6">
                                                                                            <div class="form-group">
                                                                                                <h6>
                                                                                                    حالة المشترك </h6>
                                                                                                {{-- @if ($sub->status === 'active')
                                                                                                    <span
                                                                                                        class="badge badge-sm bg-gradient-success">مفعل</span>
                                                                                                @elseif($sub->status === 'deactive')
                                                                                                    <span
                                                                                                        class="badge badge-sm bg-gradient-danger">غير
                                                                                                        مفعل</span>
                                                                                                @else
                                                                                                    <span
                                                                                                        class="badge badge-sm bg-gradient-danger">مغلق</span>
                                                                                                @endif --}}
                                                                                                {!! $sub->status() !!}
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class=" col-6">
                                                                                            <div class="form-group">
                                                                                                <h6>
                                                                                                    الأشهر </h6>
                                                                                                <select name="months"
                                                                                                onchange="changeMonth(event)"
                                                                                                    id=""
                                                                                                    class="form-select month">
                                                                                                    <option value="1">
                                                                                                        1
                                                                                                    </option>
                                                                                                    <option value="2">
                                                                                                        2
                                                                                                    </option>
                                                                                                    <option value="3">
                                                                                                        3
                                                                                                    </option>
                                                                                                    <option value="4">
                                                                                                        4
                                                                                                    </option>
                                                                                                    <option value="5">
                                                                                                        5
                                                                                                    </option>
                                                                                                    <option value="6">
                                                                                                        6
                                                                                                    </option>
                                                                                                    <option value="7">
                                                                                                        7
                                                                                                    </option>
                                                                                                    <option value="8">
                                                                                                        8
                                                                                                    </option>
                                                                                                    <option value="9">
                                                                                                        9
                                                                                                    </option>
                                                                                                    <option value="10">
                                                                                                        10
                                                                                                    </option>
                                                                                                    <option value="11">
                                                                                                        11
                                                                                                    </option>
                                                                                                    <option value="12">
                                                                                                        12
                                                                                                    </option>
                                                                                                </select>
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
                                                                                </form>
                                                                                <!-- end tab 1 -->
                                                                            </div>
                                                                            <div class="tab-pane "
                                                                                id="tab2-{{ $sub->id }}">
                                                                                <form
                                                                                    action="{{ route('point.subscribers.uncharge', $sub->id) }}"
                                                                                    method="POST">
                                                                                    @csrf
                                                                                    <!-- start tab 2 -->
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
                                                                                                <span class="price" >
                                                                                                    {{ $sub->package->price }}
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class=" col-6">
                                                                                            <div class="form-group">
                                                                                                <h6>
                                                                                                     السعر الكلي </h6>
                                                                                                <span class="final-price" >
                                                                                                    {{ $sub->package->price }}
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class=" col-6">
                                                                                            <div class="form-group">
                                                                                                <h6>
                                                                                                    حالة المشترك </h6>
                                                                                                {{-- @if ($sub->status === 'active')
                                                                                                    <span
                                                                                                        class="badge badge-sm bg-gradient-success">مفعل</span>
                                                                                                @elseif($sub->status === 'deactive')
                                                                                                    <span
                                                                                                        class="badge badge-sm bg-gradient-danger">غير
                                                                                                        مفعل</span>
                                                                                                @else
                                                                                                    <span
                                                                                                        class="badge badge-sm bg-gradient-danger">مغلق</span>
                                                                                                @endif --}}
                                                                                                {!! $sub->status() !!}
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class=" col-6">
                                                                                            <div class="form-group">
                                                                                                <h6>
                                                                                                    الأشهر </h6>
                                                                                                <select name="months"
                                                                                                 onchange="changeMonth(event)"
                                                                                                    id=""
                                                                                                    class="form-select month">
                                                                                                    <option value="1">
                                                                                                        1
                                                                                                    </option>
                                                                                                    <option value="2">
                                                                                                        2
                                                                                                    </option>
                                                                                                    <option value="3">
                                                                                                        3
                                                                                                    </option>
                                                                                                    <option value="4">
                                                                                                        4
                                                                                                    </option>
                                                                                                    <option value="5">
                                                                                                        5
                                                                                                    </option>
                                                                                                    <option value="6">
                                                                                                        6
                                                                                                    </option>
                                                                                                    <option value="7">
                                                                                                        7
                                                                                                    </option>
                                                                                                    <option value="8">
                                                                                                        8
                                                                                                    </option>
                                                                                                    <option value="9">
                                                                                                        9
                                                                                                    </option>
                                                                                                    <option value="10">
                                                                                                        10
                                                                                                    </option>
                                                                                                    <option value="11">
                                                                                                        11
                                                                                                    </option>
                                                                                                    <option value="12">
                                                                                                        12
                                                                                                    </option>
                                                                                                </select>
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
                                                                                    <!-- end tab 2 -->
                                                                                </form>
                                                                            </div>
                                                                            <div class="tab-pane "
                                                                                id="tab3-{{ $sub->id }}">
                                                                                <!-- start tab3 -->
                                                                                <form
                                                                                    action="{{ route('point.subscribers.switchPackageAndChargeRequest', $sub->id) }}"
                                                                                    method="POST">
                                                                                    @csrf <div class="row">
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
                                                                                                <span class="price" >
                                                                                                    {{ $sub->package->price }}
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class=" col-6">
                                                                                            <div class="form-group">
                                                                                                <h6>
                                                                                                     السعر الكلي </h6>
                                                                                                <span class="final-price" >
                                                                                                    {{ $sub->package->price }}
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class=" col-6">
                                                                                            <div class="form-group">
                                                                                                <h6>
                                                                                                    حالة المشترك </h6>
                                                                                                {{-- @if ($sub->status === 'active')
                                                                                                    <span
                                                                                                        class="badge badge-sm bg-gradient-success">مفعل</span>
                                                                                                @elseif($sub->status === 'deactive')
                                                                                                    <span
                                                                                                        class="badge badge-sm bg-gradient-danger">غير
                                                                                                        مفعل</span>
                                                                                                @else
                                                                                                    <span
                                                                                                        class="badge badge-sm bg-gradient-danger">مغلق</span>
                                                                                                @endif --}}
                                                                                                {!! $sub->status() !!}
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class=" col-6">
                                                                                            <div class="form-group">
                                                                                                <h6>
                                                                                                    الأشهر </h6>
                                                                                                <select name="months"
                                                                                                 onchange="changeMonth(event)"
                                                                                                    id=""
                                                                                                    
                                                                                                    class="form-select month">
                                                                                                    <option value="1">
                                                                                                        1
                                                                                                    </option>
                                                                                                    <option value="2">
                                                                                                        2
                                                                                                    </option>
                                                                                                    <option value="3">
                                                                                                        3
                                                                                                    </option>
                                                                                                    <option value="4">
                                                                                                        4
                                                                                                    </option>
                                                                                                    <option value="5">
                                                                                                        5
                                                                                                    </option>
                                                                                                    <option value="6">
                                                                                                        6
                                                                                                    </option>
                                                                                                    <option value="7">
                                                                                                        7
                                                                                                    </option>
                                                                                                    <option value="8">
                                                                                                        8
                                                                                                    </option>
                                                                                                    <option value="9">
                                                                                                        9
                                                                                                    </option>
                                                                                                    <option value="10">
                                                                                                        10
                                                                                                    </option>
                                                                                                    <option value="11">
                                                                                                        11
                                                                                                    </option>
                                                                                                    <option value="12">
                                                                                                        12
                                                                                                    </option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class=" col-6">
                                                                                            <div class="form-group">
                                                                                                <h6>
                                                                                                    اختر الباقة الجديدة
                                                                                                </h6>
                                                                                                <select name="package_id"
                                                                                                    class="form-select "
                                                                                                    onchange="getPricePackage(event)">
                                                                                                    @foreach ($packages as $package)
                                                                                                        <option
                                                                                                            value="{{ $package->id }}">
                                                                                                            {{ $package->name }}
                                                                                                        </option>
                                                                                                    @endforeach
                                                                                                </select>
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
                                                                                </form>
                                                                                <!-- end tab3 -->
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                @else
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            عذرا المشترك مغلق
                                                                        </h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        هذا المشترك مغلق الرجاء التواصل مع مركز الخدمة
                                                                        لأعادة تفعيل
                                                                        المشترك
                                                                    </div>
                                                                    <div class="modal-footer">

                                                                        <span type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">الغاء</span>
                                                                    </div>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- </form> -->
                                                    <!-- end Modal charge1  -->
                                                </div>
                                                <!-- end charge1 -->

                                                <!-- start maintenance1 -->
                                                <div class="d-inline-block">
                                                    <a href="javascript:;"
                                                        class="px-1 text-xs text-secondary font-weight-bold "
                                                        data-toggle="tooltip" data-original-title="charge1 user"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#maintenance{{ $sub->id }}">
                                                        <i class="fas fa-wrench"></i>
                                                    </a>
                                                    <!-- satrt maintenance1 Modal -->
                                                    {{-- <!-- <form action="{{ route('point.subscribers.maintenance', $sub->id) }}" method="POST">
                                                @csrf
                                                @method('PUT') --> --}}
                                                    <div class="modal fade" id="maintenance{{ $sub->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        طلب صيانة </h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <ul class="mb-3 nav nav-tabs">
                                                                        <li class="nav-item">
                                                                            <button type="button" class="nav-link active"
                                                                                data-tab="tab4-{{ $sub->id }}"
                                                                                onclick="openTab(event)">نقل</button>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <button type="button" class="nav-link"
                                                                                data-tab="tab5-{{ $sub->id }}"
                                                                                onclick="openTab(event)">
                                                                                صيانة</button>
                                                                        </li>
                                                                    </ul>
                                                                    <div class="tab-content">
                                                                        <div class="tab-pane active"
                                                                            id="tab4-{{ $sub->id }}">
                                                                            <form
                                                                                action="{{ route('point.subscribers.transfer', $sub->id) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="type"
                                                                                    value="{{ App\Enums\SupportRequestTypeEnum::TRANSFER->value }}">
                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <h6>
                                                                                                اسم المشترك
                                                                                                <h6>
                                                                                                    {{ $sub->name }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <h6>
                                                                                                رقم الهاتف
                                                                                            </h6>
                                                                                            <bdi>{{ $sub->phone }}</bdi>
                                                                                        </div>
                                                                                    </div>


                                                                                    <div class="col-12">
                                                                                        <div class="form-group">
                                                                                            <label>
                                                                                                ملاحظات
                                                                                            </label>
                                                                                            <textarea name="note" cols="30" rows="3" class="form-control"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit"
                                                                                        class="btn btn-info">إرسال</button>
                                                                                    <span type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-bs-dismiss="modal">الغاء</span>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        <div class="tab-pane "
                                                                            id="tab5-{{ $sub->id }}">
                                                                            <form
                                                                                action="{{ route('point.subscribers.maintenance', $sub->id) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="type"
                                                                                    value="{{ App\Enums\SupportRequestTypeEnum::MAINTENANCE->value }}">
                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <h6>
                                                                                                اسم المشترك
                                                                                                <h6>
                                                                                                    {{ $sub->name }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <h6>
                                                                                                رقم الهاتف
                                                                                            </h6>
                                                                                            <bdi>{{ $sub->phone }}</bdi>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class=" col-6">
                                                                                        <div class="form-group">
                                                                                            <h6>
                                                                                                اختر سبب الصيانة </h6>
                                                                                            <select
                                                                                                name="maintenance_request_type"
                                                                                                class="form-select ">
                                                                                                <option>انترنت ضعيف
                                                                                                </option>
                                                                                                <option>انترنت مقطوع
                                                                                                </option>
                                                                                                <option>فصل ووصل في
                                                                                                    الانترنت</option>
                                                                                                <option>تغيير كلمة المرور
                                                                                                    للراوتر</option>
                                                                                                <option>نقل اللايت من مكان
                                                                                                    لآخر</option>
                                                                                                <option>تغيير مكان الراوتر
                                                                                                </option>
                                                                                                <option>تبديل راوتر
                                                                                                </option>
                                                                                                <option>تبديل لايت
                                                                                                </option>
                                                                                                <option>تبديل كبل</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <div class="form-group">
                                                                                            <label>
                                                                                                ملاحظات
                                                                                            </label>
                                                                                            <textarea name="note" cols="30" rows="3" class="form-control"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit"
                                                                                        class="btn btn-info">إرسال</button>
                                                                                    <span type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-bs-dismiss="modal">الغاء</span>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end Modal charge1  -->
                                                </div>
                                                <!-- end maintenance1 -->
                                            </td>
                                        </tr>
                                        {{-- @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- start pagination -->
                    {{-- {{ $subs->links() }} --}}
                    <!-- end pagination -->
                </div>
            @elseif($search)
                لا يوجد نتائج لعملية البحث هذه يمكن البحث فقط عن طريق رقم الهاتف او رقم المشترك او T.C
            @else
                <!-- else -->
                <div class="col-12">
                    <div class="mb-4 card">
                        <div class="pb-0 card-header">
                            <div class="row">
                                <div class="col-12">
                                    <h6>عمليات التسديد لليوم</h6>
                                </div>
                            </div>
                        </div>
                        <div class="px-0 pt-0 pb-2 card-body">
                            <div class="p-0 table-responsive">
                                <table class="table mb-0 align-items-center">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">
                                                التاريخ
                                            </th>

                                            <th
                                                class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                البيان </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reports as $report)
                                            <tr>
                                                <td>
                                                    <p class="mb-0 text-xs font-weight-bold">
                                                        <bdi>{{ $report->created_at }}</bdi>
                                                    </p>
                                                </td>

                                                <td>
                                                    <p class="mb-0 text-xs font-weight-bold">{{ $report->report }}</p>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
