@extends('admin.dashboard')


@section('title','الصفحة الرئيسية')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">أموال اليوم</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        $53,000
                                        <br>

                                        <span class="text-success text-sm font-weight-bolder">+55%</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-start">
                                <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                    <i class="fas fa-wallet text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">مستخدمو اليوم</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        2,300
                                        <br>
                                        <span class="text-success text-sm font-weight-bolder">+33%</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-start">
                                <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                    <i class="fas fa-calendar-alt text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">عملاء جدد</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        +3,462
                                        <br />
                                        <span class="text-danger text-sm font-weight-bolder">-2%</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-start">
                                <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                    <i class="fas fa-id-card text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">مبيعات</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        $103,430
                                        <br />
                                        <span class="text-success text-sm font-weight-bolder">+5%</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-start">
                                <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                    <i class="fas fa-shopping-cart" text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-body p-3 pb-4">
                        <div class="row">
                            <div class="col-lg-6 mb-lg-0 mb-4">
                                <div class="d-flex flex-column h-100">
                                    <h6 class="font-weight-bolder"> نظرة عامة على الفواتير</h6>
                                    <form action="">
                                        <div class="mb-3">
                                            <input type="date" class="form-control" aria-label="name"
                                                aria-describedby="name-addon" required value='2022-03-29'>
                                        </div>
                                    </form>
                                    <span class="text-info text-xs">اختر تاريخ مختلف لعرض قيمه</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ul class="list-group mt-4  p-0">
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm pb-0"><strong
                                            class="text-dark">عدد الفواتير
                                            :</strong>&nbsp; 100</li>
                                    <li class="list-group-item border-0 ps-0 text-sm pb-0"><strong
                                            class="text-dark">مجموع قيمة الفواتير
                                            :</strong> &nbsp; 2000</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <h6 class="ms-2 mb-0"> المستخدمين </h6>
                        <div class="container border-radius-lg px-md-3 px-0">
                            <div class="row">
                                <div class="col-sm-4 col-6 pt-3 ps-0">
                                    <div class="d-flex mb-0">
                                        <div
                                            class="icon icon-shape icon-sm shadow border-radius-sm bg-gradient-success  text-center ms-2 d-flex align-items-center justify-content-center">
                                            <i class="fa fa-user cursor-pointer fs-6" aria-hidden="true"></i>
                                        </div>
                                        <p class="text-sm mt-1 mb-0 font-weight-bold">نشط</p>
                                    </div>
                                    <h4 class="font-weight-bolder">86</h4>
                                </div>
                                <div class="col-sm-4 col-6 pt-3 ps-0">
                                    <div class="d-flex mb-0">
                                        <div
                                            class="icon icon-shape icon-sm shadow border-radius-sm bg-gradient-info text-center ms-2 d-flex align-items-center justify-content-center">
                                            <i class="fa fa-user cursor-pointer fs-6" aria-hidden="true"></i>
                                        </div>
                                        <p class="text-sm mt-1 mb-0 font-weight-bold">غير نشط</p>
                                    </div>
                                    <h4 class="font-weight-bolder">0</h4>
                                </div>
                                <div class="col-sm-4 col-6 pt-3 ps-0">
                                    <div class="d-flex mb-0">
                                        <div
                                            class="icon icon-shape icon-sm shadow border-radius-sm bg-gradient-danger  text-center ms-2 d-flex align-items-center justify-content-center">
                                            <i class="fa fa-user cursor-pointer fs-6" aria-hidden="true"></i>
                                        </div>
                                        <p class="text-sm mt-1 mb-0 font-weight-bold">مغلق</p>
                                    </div>
                                    <h4 class="font-weight-bolder">0</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">

            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>نظرة عامة على المبيعات</h6>
                        <p class="text-sm">
                            <i class="fa fa-arrow-up text-success"></i>
                            <span class="font-weight-bold">4% أكثر</span> في عام 2021
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="300px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
