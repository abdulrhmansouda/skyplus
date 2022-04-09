@extends('admin.dashboard')


@section('title', 'الباقات')

@section('content')
    <div class="py-4 container-fluid">
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
                            <h5 class="font-bold modal-title">إضافة باقة</h5>
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
                <div class="mb-4 card">

                    <div class="px-0 pt-0 pb-2 card-body">
                        <div class="p-0 table-responsive">
                            <table class="table mb-0 align-items-center">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">
                                            اسم الباقة</th>
                                        <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            سعر الباقة </th>
                                       
                                        <th
                                            class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($packages as $package)
                                        <tr>
                                            <td>
                                                <h6 class="mb-0 text-sm">{{ $package->name }}</h6>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold">{{ $package->price }}</p>
                                            </td>
                                         

                                            <td class="align-middle ">

                                                <!-- start edit 1 -->
                                                <div class="d-inline-block">
                                                    <a href="javascript:;"
                                                        class="px-1 text-xs text-secondary font-weight-bold "
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
                                                                        <h5 class="font-bold modal-title">تعديل الباقة
                                                                        </h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                اسم الباقة
                                                                                <span class="text-danger"> * </span>
                                                                            </label>
                                                                            <input type="text" class="form-control"
                                                                                required>
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
                                                    <a href="javascript:;"
                                                        class="px-1 text-xs text-secondary font-weight-bold "
                                                        data-toggle="tooltip" data-original-title="Edit user"
                                                        data-bs-toggle="modal" data-bs-target="#delete1">
                                                        <i class="fas fa-trash fs-6"></i>
                                                    </a>
                                                    <!--start delete Modal -->
                                                    <div class="modal fade" id="delete1" tabindex="-1" role="dialog"
                                                        aria-labelledby="deleteLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="pb-0 text-center border-0 modal-header">
                                                                    <h5 class="modal-title" id="deleteLabel ">هل تريد
                                                                        تأكيد حذف الباقة</h5>
                                                                </div>
                                                                <div class="border-0 modal-footer">
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
                {{ $packages->links() }}
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
    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
    <script src="../assets/js/plugins/fullcalendar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <script src="../assets/js/plugins/choices.min.js"></script>

    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
@endsection
