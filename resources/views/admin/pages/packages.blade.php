@extends('admin.dashboard')


@section('title', 'الباقات')

@section('content')
    <div class="container-fluid py-4">
        <!-- start add  -->
        <button type="button" class="btn bg-gradient-dark btn-sm" data-bs-toggle="modal" data-bs-target="#add">
            إضافة
        </button>
        <!-- add Modal -->
        <form action="">
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xs" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-bold">إضافة باقة</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>
                                    اسم الباقة
                                    <span class="text-danger"> * </span>
                                </label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>
                                    سعر الباقة
                                    <span class="text-danger"> * </span>
                                </label>
                                <input type="number" class="form-control" required>
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
                                            اسم الباقة</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            سعر الباقة </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            ID</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            admin_id</th>
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
                                            <p class="text-xs font-weight-bold mb-0">200</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">100 </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">10</p>
                                        </td>

                                        <td class="align-middle ">

                                            <!-- start edit 1 -->
                                            <div class="d-inline-block">
                                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs px-1 "
                                                    data-toggle="tooltip" data-original-title="Edit user"
                                                    data-bs-toggle="modal" data-bs-target="#edit1">
                                                    <i class="fas fa-edit fs-6"></i>
                                                </a>
                                                <!-- satrt edit Modal -->
                                                <form action="">
                                                    <div class="modal fade" id="edit1" tabindex="-1" role="dialog"
                                                        aria-labelledby="add" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-xs"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title font-bold">تعديل الباقة
                                                                    </h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label>
                                                                            اسم الباقة
                                                                            <span class="text-danger"> * </span>
                                                                        </label>
                                                                        <input type="text" class="form-control" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>
                                                                            سعر الباقة
                                                                            <span class="text-danger"> * </span>
                                                                        </label>
                                                                        <input type="number" class="form-control"
                                                                            required>
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
                                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs px-1 "
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
                                                                <h5 class="modal-title" id="deleteLabel ">هل تريد
                                                                    تأكيد حذف المشترك</h5>
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
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/fullcalendar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <script src="../assets/js/plugins/choices.min.js"></script>

    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
@endsection