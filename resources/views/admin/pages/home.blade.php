@extends('admin.dashboard')


@section('title', 'الصفحة الرئيسية')

@section('content')
<div class="py-4 container-fluid">
    <div class="row">
        <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">النقد</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $current_box_cash }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-start">
                            <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                            <i class="fas fa-money-bill-wave text-lg opacity-10"></i>

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
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">البنك</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $current_box_bank }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-start">
                            <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                            <i class="fas fa-money-check text-lg opacity-10"></i>
                            	
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
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">الدين</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $current_debts }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-start">
                            <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                            <i class="fas fa-hand-holding-usd"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
    </div>
    <div class="mt-4 row">
        <div class="mb-4 col-lg-7 mb-lg-0">
            <div class="card">
                <div class="p-3 pb-4 card-body">
                    <div class="row">
                        <div class="mb-4 col-12 mb-lg-0">
                            <div class="d-flex flex-column h-100">
                                <form action="" method="GET">
                                    <div class="gap-2 d-flex align-items-center">
                                        <input name="daterange" type="text" class="form-control daterange" required value="{{ $daterange }}" />
                                        <button type="submit" class="mb-0 btn btn-secondary btn-sm ps-3 pe-3">بحث</button>
                                    </div>

                                </form>
                                <span class="text-xs text-info p-3">اختر تاريخ مختلف لعرض قيمه</span>
                            </div>
                        </div>
                        <div class=" col-12">
                            <h6 class="font-weight-bolder"> نظرة عامة على فواتير شحن المشتركين</h6>
                            <ul class="p-0 list-group">
                                <li class="pt-0 pb-0 text-sm border-0 list-group-item ps-0"><strong class="text-dark">عدد الفواتير
                                        :</strong>&nbsp; {{ $count }}</li>
                                <li class="pb-0 text-sm border-0 list-group-item ps-0"><strong class="text-dark">مجموع قيمة الفواتير
                                        :</strong> &nbsp; {{ $sum }}</li>
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
                                    <div class="text-center shadow icon icon-shape icon-sm border-radius-sm bg-gradient-success ms-2 d-flex align-items-center justify-content-center">
                                        <i class="cursor-pointer fa fa-user fs-6" aria-hidden="true"></i>
                                    </div>
                                    <p class="mt-1 mb-0 text-sm font-weight-bold">نشط</p>
                                </div>
                                <h4 class="font-weight-bolder">{{ $active }}</h4>
                            </div>
                            <div class="pt-3 col-sm-4 col-6 ps-0">
                                <div class="mb-0 d-flex">
                                    <div class="text-center shadow icon icon-shape icon-sm border-radius-sm bg-gradient-info ms-2 d-flex align-items-center justify-content-center">
                                        <i class="cursor-pointer fa fa-user fs-6" aria-hidden="true"></i>
                                    </div>
                                    <p class="mt-1 mb-0 text-sm font-weight-bold">غير نشط</p>
                                </div>
                                <h4 class="font-weight-bolder">{{ $deactive }}</h4>
                            </div>
                            <div class="pt-3 col-sm-4 col-6 ps-0">
                                <div class="mb-0 d-flex">
                                    <div class="text-center shadow icon icon-shape icon-sm border-radius-sm bg-gradient-danger ms-2 d-flex align-items-center justify-content-center">
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
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('js')

<!--   Core JS Files   -->

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $(function() {
        $('.daterange').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                .format('YYYY-MM-DD'));
        });
    });
</script>


@endsection