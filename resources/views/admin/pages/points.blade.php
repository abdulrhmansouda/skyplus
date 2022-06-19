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
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">إضافة نقطة بيع</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="img" class="w-100">
                                            <input type="file" class="form-control d-none" id="img" name="image"
                                                onchange="readURL(this);">
                                            <img src="{{ asset('/assets/img/add.png') }}" alt="pos image"
                                                class="mx-auto border rounded-circle d-block object-fit-cover" width="150"
                                                height="150">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>اسم المستخدم
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input type="text" class="form-control" placeholder="ادخل الاسم المستخدم"
                                            name="username" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>الاسم
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input type="text" class="form-control" placeholder="ادخل الاسم" name="name"
                                            required>
                                    </div>

                                </div>

                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>كلمة المرور
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input type="password" class="form-control" placeholder="ادخل كلمة المرور"
                                            name="password" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>
                                            T.C
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input type="number" pattern="\d{11}" class="form-control" required
                                            placeholder="ادخل ال T.C" name="t_c" />
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>
                                            رقم الهاتف
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input type="tel" class="form-control" placeholder="ادخل رقم الهاتف" required
                                            name="phone">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>الرصيد
                                        </label>
                                        <input type="number" class="form-control" placeholder="ادخل الرصيد" name="account"
                                            readonly value="0">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>الحد الأعلى للدين
                                        </label>
                                        <input type="number" class="form-control" placeholder="ادخل الحد الأعلى للدين"
                                            name="maximum_debt_limit" value="0">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>
                                            عمولة التسديد
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input type="number" class="form-control" required
                                            placeholder="الادخال بالنسبة المؤية مثلا 1" name="charge_commission"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>
                                            عمولة التركيب الجديد
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input type="number" class="form-control" required
                                            placeholder="الادخال بقيمة ثابتة مثلا 10" name="new_commission" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>
                                            عمولة القلب
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input type="number" class="form-control" required
                                            placeholder="الادخال بقيمة ثابتة مثلا 10" name="switch_commission" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-6">
                                    <div class="form-group">
                                        <label>العنوان</label>
                                        <textarea class="form-control" rows="3" name="address" placeholder="ادخل العنوان"></textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="true" id="isReligion" checked="" name="borrowing_is_allowed">
                                    <label class="form-check-label" for="isReligion">مسموح الدين</label>
                                </div>
                            </div> --}}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info">حفظ</button>
                            <span class="btn btn-secondary" data-bs-dismiss="modal">الغاء</span>
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
                                            الاسم </th>
                                        <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            اسم المستخدم</th>
                                        <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            الرصيد</th>
                                        <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            عمولة التسديد</th>
                                        <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            عمولة التركيب الجديد</th>
                                        <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            عمولة القلب</th>

                                        <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            T.C</th>
                                        <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            الحالة</th>
                                        <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($points as $point)
                                        <tr>
                                            <td>
                                                <div class="px-2 py-1 d-flex">
                                                    <div>
                                                        <img src="{{ $point->imageUrl }}"
                                                            class="avatar avatar-sm ms-3 object-fit-cover rounded-circle"
                                                            alt="user1" width="50" height="50">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $point->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold">{{ $point->user->username }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold
                                                @if($point->account>0)
                                                bg-success text-white
                                                @elseif($point->account<0)
                                                bg-danger text-white
                                                @else
                                                bg-warning text-white
                                                @endif
                                                " >{{ $point->account }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold">{{ $point->charge_commission }}%
                                                </p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold">{{ $point->new_commission }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold">{{ $point->switch_commission }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold">{{ $point->t_c }}</p>
                                            </td>
                                            {{-- ***** --}}

                                            <td class="text-sm align-middle">
                                                {!! $point->status() !!}
                                                {{-- @if ($point->status === 'active')
                                        <!-- positive  -->
                                        <span class="badge badge-sm bg-gradient-success">مفعل</span>
                                        <!-- zero  -->
                                        <!-- <span class="badge badge-sm bg-gradient-warning">مفعل</span> -->
                                        <!-- negative -->
                                        <!-- <span class="badge badge-sm bg-gradient-danger">مفعل</span> -->
                                        
                                        @else
                                        <span class="badge badge-sm bg-gradient-secondary text-white">مغلق</span>
                                        @endif --}}</td>
                                            <td class="align-middle ">
                                                <!-- start view1 -->
                                                <div class="d-inline-block">
                                                    <a href="javascript:;"
                                                        class="px-1 text-xs text-secondary font-weight-bold "
                                                        data-toggle="tooltip" data-original-title="view user"
                                                        data-bs-toggle="modal" data-bs-target="#view{{ $point->id }}"><i
                                                            class="fas fa-eye fs-6"></i></a>

                                                    <!-- satrt view1 Modal -->
                                                    <div class="modal fade" id="view{{ $point->id }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-xl"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">
                                                                        عرض</h5>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <h6 class="w-100">
                                                                                    <img src="{{ $point->imageUrl }}"
                                                                                        alt="pos image"
                                                                                        class="mx-auto border rounded-circle d-block object-fit-cover"
                                                                                        width="150" height="150">
                                                                                </h6>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-6">
                                                                            <div class="form-group">
                                                                                <h6>اسم المستخدم
                                                                                </h6>
                                                                                {{ $point->user->username }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-6">
                                                                            <div class="form-group">
                                                                                <h6>الاسم
                                                                                </h6>
                                                                                {{ $point->name }}
                                                                            </div>

                                                                        </div>


                                                                        <div class="col-md-4 col-sm-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    T.C
                                                                                </h6>
                                                                                {{ $point->t_c }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    رقم الهاتف
                                                                                </h6>
                                                                                <bdi>{{ $point->phone }}</bdi>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-6">
                                                                            <div class="form-group">
                                                                                <h6>الرصيد
                                                                                </h6>
                                                                                {{ $point->account }}
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-4 col-sm-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    عمولة التسديد
                                                                                </h6>
                                                                                {{ $point->charge_commission }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    عمولة التركيب الجديد
                                                                                </h6>
                                                                                {{ $point->new_commission }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    عمولة القلب
                                                                                </h6>
                                                                                {{ $point->switch_commission }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    حالة المستخدم
                                                                                </h6>
                                                                                @if ($point->status === 'active')
                                                                                    <span
                                                                                        class="badge badge-sm bg-gradient-success">مفعل</span>
                                                                                @else
                                                                                    <span
                                                                                        class="badge badge-sm bg-gradient-danger">مغلق</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-8 col-sm-6">
                                                                            <div class="form-group">
                                                                                <h6>العنوان</h6>
                                                                                <p>{{ $point->address }}</p>
                                                                            </div>
                                                                        </div>
                                                                        {{-- <div class="col-md-4 col-sm-6">
                                                                            <h6>مسموح الدين</h6>
                                                                            {{ $point->borrowing_is_allowed ? 'نعم' : 'لا' }}
                                                                        </div> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <span class="btn btn-info"
                                                                        data-bs-dismiss="modal">اغلاق</span>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end Modal view1  -->
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
                                                    <form action="{{ route('admin.points.update', $point->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="user_id"
                                                            value="{{ $point->user->id }}">
                                                        <div class="modal fade" id="edit{{ $point->id }}"
                                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-xl"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            تعديل </h5>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label for="img{{ $point->id }}"
                                                                                        class="w-100">
                                                                                        <input type="file"
                                                                                            class="form-control d-none"
                                                                                            id="img{{ $point->id }}"
                                                                                            name="image"
                                                                                            onchange="readURL(this);">
                                                                                        <img src="{{ $point->imageUrl }}"
                                                                                            alt="pos image"
                                                                                            class="mx-auto border rounded-circle d-block object-fit-cover"
                                                                                            width="150" height="150">
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-6 ">
                                                                                <div class="form-group">
                                                                                    <label>اسم المستخدم
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        placeholder="ادخل الاسم المستخدم"
                                                                                        name="username"
                                                                                        value="{{ $point->user->username }}"
                                                                                        required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-6 ">
                                                                                <div class="form-group">
                                                                                    <label>الاسم
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        placeholder="ادخل الاسم" name="name"
                                                                                        value="{{ $point->name }}"
                                                                                        required>
                                                                                </div>

                                                                            </div>

                                                                            <div class="col-md-4 col-sm-6 ">
                                                                                <div class="form-group">
                                                                                    <label>كلمة المرور
                                                                                    </label>
                                                                                    <input type="password"
                                                                                        class="form-control"
                                                                                        placeholder="ادخل كلمة المرور الجديدة"
                                                                                        name="password">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-6 ">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        T.C
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <input type="number"
                                                                                        class="form-control"
                                                                                        pattern="\d{11}" required
                                                                                        placeholder="ادخل ال T.C"
                                                                                        value="{{ $point->t_c }}"
                                                                                        name="t_c" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-6 ">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        رقم الهاتف
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <input type="tel"
                                                                                        class="form-control"
                                                                                        placeholder="ادخل رقم الهاتف"
                                                                                        required
                                                                                        value="{{ $point->phone }}"
                                                                                        name="phone" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-6 ">
                                                                                <div class="form-group">
                                                                                    <label>الرصيد
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <input type="number"
                                                                                        class="form-control"
                                                                                        placeholder="ادخل الرصيد"
                                                                                        name="account"
                                                                                        value="{{ $point->account }}"
                                                                                        required readonly />
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-6 ">
                                                                                <div class="form-group">
                                                                                    <label>الحد الأعلى للدين
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <input type="number"
                                                                                        class="form-control"
                                                                                        placeholder="ادخل الحد الأعلى للدين"
                                                                                        name="maximum_debt_limit"
                                                                                        value="{{ $point->maximum_debt_limit }}"
                                                                                        required />
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-6 ">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        عمولة التسديد
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <input type="number"
                                                                                        class="form-control" required
                                                                                        placeholder="الادخال بالنسبة المؤية مثلا 1"
                                                                                        name="charge_commission"
                                                                                        value="{{ $point->charge_commission }}"
                                                                                        step="0.01">

                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-6 ">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        عمولة التركيب الجديد
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <input type="number"
                                                                                        class="form-control" required
                                                                                        placeholder="الادخال قيمة ثابتة مثلا 10"
                                                                                        name="new_commission"
                                                                                        value="{{ $point->new_commission }}"
                                                                                        step="0.01">

                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-6 ">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        عمولة القلب
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <input type="number"
                                                                                        class="form-control" required
                                                                                        placeholder="الادخال قيمة ثابتة مثلا 10"
                                                                                        name="switch_commission"
                                                                                        value="{{ $point->switch_commission }}"
                                                                                        step="0.01">

                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-4 col-sm-6 ">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        حالة المستخدم
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <select required=""
                                                                                        class="form-select"
                                                                                        name="status">
                                                                                        <option value={{ App\Enums\UserStatusEnum::ACTIVE->value }}
                                                                                            @if ($point->status === App\Enums\UserStatusEnum::ACTIVE->value) selected @endif>
                                                                                            مفعل</option>
                                                                                        <option value={{ $point->status === App\Enums\UserStatusEnum::CLOSED->value }}
                                                                                            @if ($point->status === App\Enums\UserStatusEnum::CLOSED->value) selected @endif>
                                                                                            مفلق</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-4 col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>العنوان</label>
                                                                                    <textarea class="form-control" rows="3" name="description" placeholder="ادخل العنوان">{{ $point->address }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            {{-- <div class="col-md-4 col-sm-6">
                                                                                <div class="form-group">
                                                                                    <input name="borrowing_is_allowed"
                                                                                        class="form-check-input"
                                                                                        type="checkbox" value="true"
                                                                                        id="isReligion{{ $point->id }}"
                                                                                        @if ($point->borrowing_is_allowed) checked @endif>
                                                                                    <label class="form-check-label"
                                                                                        for="isReligion{{ $point->id }}">مسموح
                                                                                        الدين</label>
                                                                                </div>
                                                                            </div> --}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit"
                                                                            class="btn btn-info">تعديل</button>
                                                                        <span class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">الغاء</span>
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
                                                        <i class="fas fa-ban fs-6"></i>
                                                    </a>
                                                    <!--start delete Modal -->
                                                    <div class="modal fade" id="delete{{ $point->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="deleteLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="pb-0 text-center border-0 modal-header">
                                                                    <h5 class="modal-title" id="deleteLabel ">
                                                                        انت متأكد من أنك تريد ايقاف
                                                                        <strong>النقطة {{ $point->name }}
                                                                        </strong>
                                                                    </h5>
                                                                </div>
                                                                <div class="border-0 modal-footer">
                                                                    <form
                                                                        action="{{ route('admin.points.destroy', $point->id) }}"
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
                                                <!-- end delete -->
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

            {{ $points->links() }}
            <!-- end pagination -->
        </div>
    </div>
@endsection
