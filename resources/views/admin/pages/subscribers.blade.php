@extends('admin.dashboard')


@section('title', 'المشتركين')

@section('content')
<div class="py-4 container-fluid">
    <!-- start add  -->
    <button type="button" class="btn bg-gradient-dark btn-sm" data-bs-toggle="modal" data-bs-target="#add">
        إضافة
    </button>
    <!-- add Modal -->
    <form action="">
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
                                    <input type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>
                                        T_C
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="number" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>
                                        ID
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="number" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>
                                        aboona_no
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="number" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>
                                        اسم الأم
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>
                                        رقم الهاتف
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="tel" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>
                                        التاريخ
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="date" class="form-control"  value="2022-03-29">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>
                                        اسم الباقة
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <select name="package" required class="form-control">
                                        <option value="">اختر باقة</option>
                                        <option value="0"> باقة1</option>
                                        <option value="1"> باقة2</option>
                                        <option value="2"> باقة3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>
                                        حالة المستخدم
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <select name="package" required class="form-control">
                                        <option value="0"> نشط</option>
                                        <option value="1"> غير نشط</option>
                                        <option value="2">مغلق</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>
                                        العنوان
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <textarea name="address" cols="30" rows="3" required class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>
                                        مكان التركيب
                                        <span class="text-danger"> * </span>
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
    <!-- end add  -->
    <div class="row">
        <div class="col-12">
            <div class="mb-4 card">
                <div class="px-0 pt-0 pb-2 card-body">
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
                                        <p class="mb-0 text-xs font-weight-bold">{{ $sub->t_c}}</p>
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
                                        <p class="mb-0 text-xs font-weight-bold">{{ $sub->created_at }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">01/2/2020</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $sub->package->name }}</p>
                                    </td>
                                    <td class="text-sm align-middle">
                                        <span class="badge badge-sm bg-gradient-success">مفعل</span>
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
                                                                                احمد
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            T_C
                                                                        </h6>
                                                                        00000000000
                                                                    </div>
                                                                </div>
                                                                {{-- <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <h6>
                                                                        ID
                                                                    </h6>
                                                                    000000000000000000000000000
                                                                </div>
                                                            </div> --}}

                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            رقم المشترك
                                                                        </h6>
                                                                        44444444444444444
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            اسم الأم
                                                                        </h6>
                                                                        فاطمة
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            رقم الهاتف
                                                                        </h6>
                                                                        120505860
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            التاريخ
                                                                        </h6>
                                                                        1/2/2020
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            اسم الباقة
                                                                        </h6>
                                                                        باقة 1
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            حالة المستخدم
                                                                        </h6>
                                                                        نشط
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            العنوان
                                                                        </h6>
                                                                        <p>
                                                                            lorem ipsumn Dashboard
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            مكان التركيب
                                                                        </h6>
                                                                        <p>
                                                                            lorem ipsumn Dashboard
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
                                                                            <input type="text" class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                T_C
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <input type="number" class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                ID
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <input type="number" class="form-control" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4 col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                aboona_no
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <input type="number" class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                اسم الأم
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <input type="text" class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                رقم الهاتف
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <input type="tel" class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                التاريخ
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <input type="date" class="form-control"  value="2022-03-29">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                اسم الباقة
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <select name="package" required class="form-control">
                                                                                <option value="">اختر باقة
                                                                                </option>
                                                                                <option value="0"> باقة1
                                                                                </option>
                                                                                <option value="1"> باقة2
                                                                                </option>
                                                                                <option value="2"> باقة3
                                                                                </option>
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
                                                                            <select name="package" required class="form-control">
                                                                                <option value="0"> نشط</option>
                                                                                <option value="1"> غير نشط
                                                                                </option>
                                                                                <option value="2">مغلق</option>
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
                                                            <h5 class="modal-title" id="deleteLabel ">هل
                                                                تريد تأكيد حذف المشترك</h5>
                                                        </div>
                                                        <div class="border-0 modal-footer">
                                                            <form action="">
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
            {{ $subs->links() }}
            <!-- end pagination -->
        </div>
    </div>
</div>
@endsection

