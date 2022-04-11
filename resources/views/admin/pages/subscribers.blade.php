@extends('admin.dashboard')


@section('title', 'المشتركين')

@section('content')
<div class="py-4 container-fluid">
    <!-- start add  -->
    <button type="button" class="btn bg-gradient-dark btn-sm" data-bs-toggle="modal" data-bs-target="#add">
        إضافة
    </button>
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
                                        اسم المشترك
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="text" class="form-control" required name="name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>
                                        T_C
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
<<<<<<< HEAD
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            التاريخ
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input type="date" class="form-control" required name="subscribtion_date" value="{{ date("Y-m-d H:i:s") }}">
                                    </div>
=======
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>
                                        التاريخ
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="date" class="form-control" required name="subscribtion_date">
>>>>>>> 2761fe2dbe23733a3d120b90d8d3f779b375c90a
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>
                                        اسم الباقة
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <select class="form-control" required name="package_id">
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
                                    <select class="form-control" required name="status">
                                        <option value="active"> نشط</option>
                                        <option value="deactive"> غير نشط</option>
                                        <option value="closed">مغلق</option>
                                    </select>
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
        <div class="col-12">
            <div class="mb-4 card">
                <div class="px-0 pt-0 pb-2 card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">
                                        اسم المشترك</th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        T_C </th>
                                    {{-- <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ID</th> --}}
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        رقم المشترك</th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        اسم الأم</th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        رقم الهاتف</th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        تاريخ البدء </th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        تاريخ الانتهاء </th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        اسم الباقة </th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        حالة المستخدم </th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
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
                                        <p class="mb-0 text-xs font-weight-bold">{{ $sub->t_c }}</p>
                                    </td>
                                    {{-- <td>
                                                    <p class="mb-0 text-xs font-weight-bold">100 </p>
                                                </td> --}}
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $sub->subscriber_number }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $sub->mother }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $sub->phone }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">
                                            {{ $sub->created_at->format('d/m/Y') }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">
                                            {{ $sub->created_at->format('d/m/Y') }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $sub->package->name }}</p>
                                    </td>
                                    <td class="text-sm align-middle">
                                        @if ($sub->status === 'active')
                                        <span class="badge badge-sm bg-gradient-success">مفعل</span>
                                        @elseif($sub->status === 'deactive')
                                        <span class="badge badge-sm bg-gradient-danger">غير مفعل</span>
                                        @else
                                        <span class="badge badge-sm bg-gradient-danger">مغلق</span>
                                        @endif
                                    </td>
                                    <td class="align-middle ">
                                        <!-- start view1 -->
                                        <div class="d-inline-block">
                                            <a href="javascript:;" class="px-1 text-xs text-secondary font-weight-bold " data-toggle="tooltip" data-original-title="view user" data-bs-toggle="modal" data-bs-target="#view{{ $sub->id }}">
                                                <i class="fas fa-eye fs-6"></i>
                                            </a>
                                            <!-- satrt view1 Modal -->

                                            <!-- end Modal view1  -->
                                            <div class="modal fade" id="view{{ $sub->id }}" tabindex="-1" role="dialog" aria-labelledby="view1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="font-bold modal-title">عرض المشترك</h5>
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
                                                                            T_C
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
                                                                        {{ $sub->phone }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            التاريخ
                                                                        </h6>
                                                                        {{ $sub->created_at->format('d/m/Y') }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            اسم الباقة
                                                                        </h6>
                                                                        {{ $sub->package->name }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            حالة المستخدم
                                                                        </h6>
                                                                        @if ($sub->status === 'active')
                                                                        <span class="badge badge-sm bg-gradient-success">مفعل</span>
                                                                        @elseif($sub->status === 'deactive')
                                                                        <span class="badge badge-sm bg-gradient-danger">غير
                                                                            مفعل</span>
                                                                        @else
                                                                        <span class="badge badge-sm bg-gradient-danger">مغلق</span>
                                                                        @endif
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
                                                            <span type="button" class="btn btn-info" data-bs-dismiss="modal">اغلاق</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end view1 -->
                                        <!-- start edit 1 -->
                                        <div class="d-inline-block">
                                            <a href="javascript:;" class="px-1 text-xs text-secondary font-weight-bold " data-toggle="tooltip" data-original-title="Edit user" data-bs-toggle="modal" data-bs-target="#edit{{ $sub->id }}">
                                                <i class="fas fa-edit fs-6"></i>
                                            </a>
                                            <!-- satrt edit Modal -->
                                            <form action="">
                                                <div class="modal fade" id="edit{{ $sub->id }}" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
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
                                                                                اسم المشترك
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <input type="text" class="form-control" required value="{{ $sub->name }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                T_C
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <input type="text" class="form-control" required value="{{ $sub->t_c }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                ID
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <input type="number" class="form-control" required value="{{ $sub->sub_id }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4 col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                رقم المشترك
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <input type="number" class="form-control" required value="{{ $sub->subscriber_number }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                اسم الأم
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <input type="text" class="form-control" required value="{{ $sub->mother }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                رقم الهاتف
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <input type="tel" class="form-control" required value="{{ $sub->phone }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                التاريخ
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <input type="date" class="form-control" value="{{ $sub->created_at->format('d/m/Y') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                اسم الباقة
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <select required class="form-control" name="package_id">
                                                                                @foreach ($packages as $package)
                                                                                <option value="{{ $package->id }}" @if($sub->package_id===$package->id)selected @endif>
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
                                                                            <select name="package" required class="form-control" name="status">
                                                                                @switch($sub->status)
                                                                                @case('active')
                                                                                <option value="active" selected> نشط</option>
                                                                                <option value="deactive"> غير نشط</option>
                                                                                <option value="closed">مغلق</option>
                                                                                @break

                                                                                @case('active')
                                                                                <option value="active"> نشط</option>
                                                                                <option value="deactive" selected> غير نشط</option>
                                                                                <option value="closed">مغلق</option>
                                                                                @break

                                                                                @case('closed')
                                                                                <option value="active"> نشط</option>
                                                                                <option value="deactive"> غير نشط</option>
                                                                                <option value="closed" selected>مغلق</option>
                                                                                @break

                                                                                @default
                                                                                @endswitch

<<<<<<< HEAD
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        العنوان
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <textarea name="address" cols="30" rows="3" required class="form-control">{{ $sub->address }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        مكان التركيب
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <textarea name="installation_address" cols="30" rows="3" required class="form-control">{{ $sub->installation_address }}</textarea>
                                                                                </div>
                                                                            </div>
=======
                                                                            </select>
>>>>>>> 2761fe2dbe23733a3d120b90d8d3f779b375c90a
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                العنوان
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <textarea name="address" cols="30" rows="3" required class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                مكان التركيب
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <textarea name="location" cols="30" rows="3" required class="form-control"></textarea>
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
                                            <!-- end edit Modal -->
                                        </div>
                                        <!-- end edit 1 -->
                                        <!-- start delete 1 -->
                                        <div class="d-inline-block">
                                            <a href="javascript:;" class="px-1 text-xs text-secondary font-weight-bold " data-toggle="tooltip" data-original-title="Edit user" data-bs-toggle="modal" data-bs-target="#delete{{ $sub->id }}">
                                                <i class="fas fa-trash fs-6"></i>
                                            </a>
                                            <!--start delete Modal -->
                                            <div class="modal fade" id="delete{{ $sub->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="pb-0 text-center border-0 modal-header">
                                                            <h5 class="modal-title" id="deleteLabel ">هل تريد
                                                                أغلاق المشترك {{ $sub->name }} ؟</h5>
                                                        </div>
                                                        <div class="border-0 modal-footer">
                                                            <form action="{{ route('admin.subscribers.destroy', $sub->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-info">حذف</button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
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
            <!-- start pagination -->
            {{ $subs->links() }}
            <!-- end pagination -->
        </div>
    </div>
</div>
@endsection