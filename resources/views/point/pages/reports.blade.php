@extends('point.app')

@section('title', 'التقارير')

@section('content')

    <div class="py-4 container-fluid">
        <div class="row mb-3">
            <div class="col-md-6">
                <form action="">
                    <div class="d-flex gap-3">
                        <input type="text" name="daterange" class="form-control" />
                        <button class="btn btn-secondary mb-0  btn-sm ps-3 pe-3">بحث</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <form action="">
                    <button class="btn btn-white  ps-3 pe-3">
                        تصدير الى excel
                        <i class="fas fa-file-export mx-1"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="mb-4 card">

                    <div class="px-0 pt-0 pb-2 card-body">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-12">
                                    <h6>التقارير</h6>
                                </div>
                            </div>
                        </div>
                        <div class="p-0 table-responsive">
                            <table class="table mb-0 align-items-center">
                                <thead>
                                    <tr>
                                        <th class="text-xs text-uppercase font-weight-bolder ps-3 bg-info  text-dark">
                                            الحساب : الاء
                                        </th>
                                        <th class="px-1 text-uppercase text-xs font-weight-bolder "></th>
                                        <th class="px-1 text-uppercase text-xs font-weight-bolder "></th>
                                        <th class="px-1 text-uppercase text-xs font-weight-bolder "></th>
                                        <th class="px-1 text-uppercase text-xs font-weight-bolder "></th>
                                        <th class="px-1 text-uppercase text-xs font-weight-bolder "></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-xs text-uppercase font-weight-bolder ps-3">
                                            اعتبارا من 21/01/2021 الى تاريخ 15/04/2022
                                        </td>
                                        <td class="px-1 text-uppercase text-xs font-weight-bolder ">الرصيد السابق 31/12/2020
                                        </td>
                                        <td class="px-1 text-uppercase text-xs font-weight-bolder ">250</td>
                                        <td class="px-1 text-uppercase text-xs font-weight-bolder "></td>
                                        <td class="px-1 text-uppercase text-xs font-weight-bolder "></td>
                                        <td class="px-1 text-uppercase text-xs font-weight-bolder "></td>
                                    </tr>

                                    <tr class="bg-aliceblue">
                                        <td class="text-uppercase  text-xs font-weight-bolder ps-3">التاريخ</td>
                                        <td class="px-1 text-uppercase  text-xs font-weight-bolder">البيان</td>
                                        <td class="px-1 text-uppercase  text-xs font-weight-bolder">ملاحظات</td>
                                        <td class="px-1 text-uppercase  text-xs font-weight-bolder">عليه</td>
                                        <td class="px-1 text-uppercase  text-xs font-weight-bolder">له</td>
                                        <td class="px-1 text-uppercase  text-xs font-weight-bolder">الرصيد</td>
                                    </tr>
                                    <tr>
                                        <td class="text-uppercase text-secondary text-xs font-weight-bolder ps-3"></td>
                                        <td class="px-1 text-uppercase text-secondary text-xs font-weight-bolder">الاء</td>
                                        <td class="px-1 text-uppercase text-secondary text-xs font-weight-bolder"></td>
                                        <td class="px-1 text-uppercase text-secondary text-xs font-weight-bolder"></td>
                                        <td class="px-1 text-uppercase text-secondary text-xs font-weight-bolder"></td>
                                        <td class="px-1 text-uppercase text-secondary text-xs font-weight-bolder">250</td>
                                    </tr>
                                    <!-- start foreach -->
                                    <tr>
                                        <td>
                                            <div class="px-2 py-1 d-flex">
                                                <p class="mb-0 text-xs font-weight-bold">15/04/2022</p>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="mb-0 text-xs font-weight-bold">تم تعبئة الرصيد بقيمة 500 ليرة نقدا</p>
                                        </td>
                                        <td>
                                            <p class="mb-0 text-xs font-weight-bold"> </p>
                                        </td>
                                        <td>
                                            <p class="mb-0 text-xs font-weight-bold">0</p>
                                        </td>
                                        <td>
                                            <p class="mb-0 text-xs font-weight-bold">500.00</p>
                                        </td>
                                        <td>
                                            <p class="mb-0 text-xs font-weight-bold">750.00</p>
                                        </td>

                                    </tr>
                                    <!-- end foreach -->
                                    <tr>
                                        <td>
                                        </td>
                                        <td>
                                            <p class="mb-0 text-xs font-weight-bold">الرصيد</p>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                        <td class="bg-info text-dark">
                                            <p class="mb-0 text-xs font-weight-bold">1560.00</p>
                                        </td>
                                        <td>
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script>
        $(function() {
            // $('input[name="daterange"]').val("")
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                    .format('YYYY-MM-DD'));
            });
        });
    </script>
@endsection
