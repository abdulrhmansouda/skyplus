@extends('accountant.app')


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
            <a class="card"href="">
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
            </a>
        </div>
        <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
            <a class="card" href="/">
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
            </a>
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
                                            <input name="daterange" type="text" class="form-control daterange" required
                                                value="{{ $daterange }}"/>
                                            <button type="submit"
                                                class="mb-0 btn btn-secondary btn-sm ps-3 pe-3">بحث</button>
                                        </div>

                                    </form>
                                    <span class="text-xs text-info p-3">اختر تاريخ مختلف لعرض قيمه</span>
                                </div>
                            </div>
                            <div class=" col-12">
                                <h6 class="font-weight-bolder"> نظرة عامة على فواتير شحن المشتركين</h6>
                                <ul class="p-0 list-group">
                                    <li class="pt-0 pb-0 text-sm border-0 list-group-item ps-0"><strong
                                            class="text-dark">عدد الفواتير
                                            :</strong>&nbsp; {{ $count }}</li>
                                    <li class="pb-0 text-sm border-0 list-group-item ps-0"><strong
                                            class="text-dark">مجموع قيمة الفواتير
                                            :</strong> &nbsp; {{ $sum }}</li>
                                </ul>
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
