@extends('admin.dashboard')


@section('title','الصفحة الرئيسية')

@section('content')
    <div class="py-4 container-fluid">
        <div class="mt-4 row">
            <div class="mb-4 col-lg-7 mb-lg-0">
                <div class="card">
                    <div class="p-3 pb-4 card-body">
                        <div class="row">
                            <div class="mb-4 col-12 mb-lg-0">
                                <div class="d-flex flex-column h-100">
                                    <form action="" method="GET">
                                        <div class="mb-3">
                                            <input name="date" type="date" class="form-control daterange" aria-label="name"
                                                aria-describedby="name-addon" required value='{{ $date }}' onchange="form.submit()">
                                        </div>
                                    </form>
                                    <span class="text-xs text-info">اختر تاريخ مختلف لعرض قيمه</span>
                                </div>
                            </div>
                            <div class="mt-3 col-md-6">
                            <h6 class="font-weight-bolder"> نظرة عامة على الفواتير</h6>
                                <ul class="p-0 list-group">
                                    <li class="pt-0 pb-0 text-sm border-0 list-group-item ps-0"><strong
                                            class="text-dark">عدد الفواتير
                                            :</strong>&nbsp; {{ $count }}</li>
                                    <li class="pb-0 text-sm border-0 list-group-item ps-0"><strong
                                            class="text-dark">مجموع قيمة الفواتير
                                            :</strong> &nbsp; {{ $sum }}</li>
                                </ul>
                            </div>
                            <div class="mt-3 col-md-6">
                            <h6 class="font-weight-bolder"> نظرة عامة على حركة الصندوق</h6>
                                <ul class="p-0 list-group">
                                    <li class="pt-0 pb-0 text-sm border-0 list-group-item ps-0"><strong
                                            class="text-dark"> بنك
                                            :</strong>&nbsp; 10000</li>
                                    <li class="pb-0 text-sm border-0 list-group-item ps-0"><strong
                                            class="text-dark">دين
                                            :</strong> &nbsp; 12</li>
                                    <li class="pb-0 text-sm border-0 list-group-item ps-0"><strong
                                            class="text-dark">نقد
                                            :</strong> &nbsp; 12</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-4 col-lg-5 mb-lg-0">
                <div class="card">
                    <div class="p-3 card-body">
                        <h6 class="mb-0 ms-2"> المستخدمين </h6>
                        <div class="container px-0 border-radius-lg px-md-3">
                            <div class="row">
                                <div class="pt-3 col-sm-4 col-6 ps-0">
                                    <div class="mb-0 d-flex">
                                        <div
                                            class="text-center shadow icon icon-shape icon-sm border-radius-sm bg-gradient-success ms-2 d-flex align-items-center justify-content-center">
                                            <i class="cursor-pointer fa fa-user fs-6" aria-hidden="true"></i>
                                        </div>
                                        <p class="mt-1 mb-0 text-sm font-weight-bold">نشط</p>
                                    </div>
                                    <h4 class="font-weight-bolder">{{ $active }}</h4>
                                </div>
                                <div class="pt-3 col-sm-4 col-6 ps-0">
                                    <div class="mb-0 d-flex">
                                        <div
                                            class="text-center shadow icon icon-shape icon-sm border-radius-sm bg-gradient-info ms-2 d-flex align-items-center justify-content-center">
                                            <i class="cursor-pointer fa fa-user fs-6" aria-hidden="true"></i>
                                        </div>
                                        <p class="mt-1 mb-0 text-sm font-weight-bold">غير نشط</p>
                                    </div>
                                    <h4 class="font-weight-bolder">{{ $deactive }}</h4>
                                </div>
                                <div class="pt-3 col-sm-4 col-6 ps-0">
                                    <div class="mb-0 d-flex">
                                        <div
                                            class="text-center shadow icon icon-shape icon-sm border-radius-sm bg-gradient-danger ms-2 d-flex align-items-center justify-content-center">
                                            <i class="cursor-pointer fa fa-user fs-6" aria-hidden="true"></i>
                                        </div>
                                        <p class="mt-1 mb-0 text-sm font-weight-bold">مغلق</p>
                                    </div>
                                    <h4 class="font-weight-bolder">{{ $closed }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



