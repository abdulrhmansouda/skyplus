@extends('admin.dashboard')

@section('title', 'الدعم الفني')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">
                                            صاحب النقطة</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            اسم النقطة</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            اسم المشترك</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            رقم الهاتف</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            نوع الطلب</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            العنوان</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            قبول او رفض</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ asset('/assets/img/team-2.jpg') }}"
                                                        class="avatar avatar-sm ms-3 rounded-circle" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">John Michael</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">نقطة 1</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">احمد </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">52152245</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">صيانة </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">شارع اول ثاني </p>
                                        </td>
                                        <td class="align-middle ">
                                            <!-- start support1 -->
                                            <div class="d-inline-block">
                                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs px-1 "
                                                    data-toggle="tooltip" data-original-title="support1 user"
                                                    data-bs-toggle="modal" data-bs-target="#support1">
                                                    <i class="fas fa-clipboard-check"></i>
                                                </a>
                                                <!-- satrt support1 Modal -->
                                                <div class="modal fade" id="support1" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    طلب دعم فني لمشترك</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class=" col-md-6">
                                                                        <div class="form-group">
                                                                            <h6>
                                                                                صاحب النقطة
                                                                            </h6>
                                                                            John Michael
                                                                        </div>
                                                                    </div>
                                                                    <div class=" col-md-6">
                                                                        <div class="form-group">
                                                                            <h6>
                                                                                اسم النقطة
                                                                            </h6>
                                                                            نقطة 1
                                                                        </div>
                                                                    </div>
                                                                    <div class=" col-md-6">
                                                                        <div class="form-group">
                                                                            <h6>
                                                                                اسم المشترك
                                                                            </h6>
                                                                            احمد
                                                                        </div>
                                                                    </div>
                                                                    <div class=" col-md-6">
                                                                        <div class="form-group">
                                                                            <h6>
                                                                                رقم الهاتف
                                                                            </h6>
                                                                            05512365222
                                                                        </div>
                                                                    </div>
                                                                    <div class=" col-md-6">
                                                                        <div class="form-group">
                                                                            <h6>
                                                                                نوع الطلب
                                                                            </h6>
                                                                            صيانة
                                                                        </div>
                                                                    </div>
                                                                    <div class=" col-12">
                                                                        <div class="form-group">
                                                                            <h6>
                                                                                العنوان
                                                                            </h6>
                                                                            Lorem ipsum dolor sit amet,
                                                                        </div>
                                                                    </div>
                                                                    <div class=" col-12">
                                                                        <div class="form-group">
                                                                            <h6>
                                                                                الملاحظات
                                                                            </h6>
                                                                            Lorem ipsum dolor sit amet,
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="">
                                                                    <button type="submit"
                                                                        class="btn btn-info">قبول</button>
                                                                </form>
                                                                <form action="">
                                                                    <button type="submit"
                                                                        class="btn btn-secondary">رفض</button>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end Modal support1  -->
                                            </div>
                                            <!-- end support1 -->
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