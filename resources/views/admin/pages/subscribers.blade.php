@extends('admin.dashboard')


@section('title', 'المشتركين')

@section('content')
    <div class="container-fluid py-4">
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
                            <h5 class="modal-title font-bold">إضافة مشترك</h5>
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
                                        <input type="number" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            التاريخ
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <!-- <input type="number" class="form-control" required> -->
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
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">
                                            اسم المشترك</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            T_C </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            ID</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            aboona_no</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            اسم الأم</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            رقم الهاتف</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            التاريخ </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            اسم الباقة </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            حالة المستخدم </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0 text-sm">John Michael</h6>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">0000000</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">100 </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">10</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">فاطمة</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">8888888</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">12/12/2020</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">باقة</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class="badge badge-sm bg-gradient-success">مفعلة</span>
                                        </td>
                                        <td class="align-middle ">
                                            <!-- start view1 -->
                                            <div class="d-inline-block">
                                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs px-1 "
                                                    data-toggle="tooltip" data-original-title="view user"
                                                    data-bs-toggle="modal" data-bs-target="#view1">
                                                    <i class="fas fa-eye fs-6"></i>
                                                </a>
                                                <!-- satrt view1 Modal -->

                                                <!-- end Modal view1  -->
                                                <div class="modal fade" id="view1" tabindex="-1" role="dialog"
                                                    aria-labelledby="view1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-xl"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title font-bold">عرض المشترك</h5>
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
                                                                    <div class="col-lg-4 col-md-6">
                                                                        <div class="form-group">
                                                                            <h6>
                                                                                ID
                                                                            </h6>
                                                                            000000000000000000000000000
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4 col-md-6">
                                                                        <div class="form-group">
                                                                            <h6>
                                                                                aboona_no
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
                                                    class="text-secondary font-weight-bold text-xs px-1 "
                                                    data-toggle="tooltip" data-original-title="Edit user"
                                                    data-bs-toggle="modal" data-bs-target="#edit1">
                                                    <i class="fas fa-edit fs-6"></i>
                                                </a>
                                                <!-- satrt edit Modal -->
                                                <form action="">
                                                    <div class="modal fade" id="edit1" tabindex="-1" role="dialog"
                                                        aria-labelledby="add" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-xl"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title font-bold">تعديل الشترك
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
                                                                                <input type="text" class="form-control"
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
                                                                                <input type="number" class="form-control"
                                                                                    required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    ID
                                                                                    <span class="text-danger"> *
                                                                                    </span>
                                                                                </label>
                                                                                <input type="number" class="form-control"
                                                                                    required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    aboona_no
                                                                                    <span class="text-danger"> *
                                                                                    </span>
                                                                                </label>
                                                                                <input type="number" class="form-control"
                                                                                    required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    اسم الأم
                                                                                    <span class="text-danger"> *
                                                                                    </span>
                                                                                </label>
                                                                                <input type="text" class="form-control"
                                                                                    required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    رقم الهاتف
                                                                                    <span class="text-danger"> *
                                                                                    </span>
                                                                                </label>
                                                                                <input type="number" class="form-control"
                                                                                    required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    التاريخ
                                                                                    <span class="text-danger"> *
                                                                                    </span>
                                                                                </label>
                                                                                <!-- <input type="number" class="form-control" required> -->
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-6">
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    اسم الباقة
                                                                                    <span class="text-danger"> *
                                                                                    </span>
                                                                                </label>
                                                                                <select name="package" required
                                                                                    class="form-control">
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
                                                                                <select name="package" required
                                                                                    class="form-control">
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
                                                    class="text-secondary font-weight-bold text-xs px-1 "
                                                    data-toggle="tooltip" data-original-title="Edit user"
                                                    data-bs-toggle="modal" data-bs-target="#delete1">
                                                    <i class="fas fa-trash fs-6"></i>
                                                </a>
                                                <!--start delete Modal -->
                                                <div class="modal fade" id="delete1" tabindex="-1" role="dialog"
                                                    aria-labelledby="deleteLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0 text-center pb-0">
                                                                <h5 class="modal-title" id="deleteLabel ">هل
                                                                    تريد تأكيد حذف المشترك</h5>
                                                            </div>
                                                            <div class="modal-footer border-0">
                                                                <form action="">
                                                                    <button type="submit"
                                                                        class="btn btn-info">حذف</button>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- start pagination -->
                <ul class="pagination pagination-info">
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
                </ul>
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