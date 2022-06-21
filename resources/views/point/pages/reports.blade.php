@extends('point.app')

@section('title', 'التقارير')



@section('content')
<div class="py-4 container-fluid">
    <div class="mb-3 row">
        <div class="col-md-10 ">
            <form action="" method="GET">
                <div class="gap-2 d-flex align-items-center">
                    <input name="daterange" type="text" class="form-control w-50 daterange" value="{{ $daterange ?? '' }}" />
                    <div class="gap-1 m-0 form-group d-flex">
                        <input name="all_date" class="form-check-input " type="checkbox" value="true" @if($all_date === "true")checked @endif id="all">
                        <label class="form-check-label text-nowrap" for="all">كل المدة
                            </label>
                    </div>

                    <button type="submit" class="mb-0 btn btn-secondary btn-sm ps-3 pe-3">بحث</button>
                </div>
            </form>
        </div>

        <div class="col-md-2">
            <form action="{{ route('point.reports.export') }}" method="POST">
                @csrf
                <input name="_daterange" type="hidden" value="{{ $daterange ?? '' }}" />
                <input name="all_date" type="hidden" value="{{ $all_date }}" >

                <button class="m-2 btn btn-white ps-3 pe-3 m-md-0">
                    تصدير الى excel
                    <i class="mx-1 fas fa-file-export"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="mb-4 card">
                <div class="px-0 pt-0 pb-2 card-body">
                    <div class="pb-0 card-header">
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
                                    {{-- @foreach() --}}
                                    <th class="text-xs text-uppercase font-weight-bolder ps-3 bg-info text-white">
                                        الحساب : {{ $name_point }}
                                    </th>
                                    <th class="px-1 text-xs text-uppercase font-weight-bolder "></th>
                                    <th class="px-1 text-xs text-uppercase font-weight-bolder "></th>
                                    <th class="px-1 text-xs text-uppercase font-weight-bolder "></th>
                                    <th class="px-1 text-xs text-uppercase font-weight-bolder "></th>
                                    {{-- <th class="px-1 text-xs text-uppercase font-weight-bolder "></th> --}}
                                    <th class="px-1 text-xs text-uppercase font-weight-bolder "></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-xs text-uppercase font-weight-bolder ps-3">
                                        اعتبارا من {{ $from }} الى تاريخ {{ $to }}
                                    </td>
                                    <td class="px-1 text-xs text-uppercase font-weight-bolder "></td>
                                    <td class="px-1 text-xs text-uppercase font-weight-bolder "></td>
                                    <td class="px-1 text-xs text-uppercase font-weight-bolder "></td>
                                    <td class="px-1 text-xs text-uppercase font-weight-bolder "></td>
                                    {{-- <td class="px-1 text-xs text-uppercase font-weight-bolder "></td> --}}
                                    <td class="px-1 text-xs text-uppercase font-weight-bolder "></td>
                                </tr>

                                <tr class="bg-aliceblue">
                                    <td class="text-xs text-uppercase font-weight-bolder ps-3">التاريخ</td>
                                    <td class="text-xs text-uppercase font-weight-bolder ps-3">اسم النقطة</td>
                                    <td class="px-1 text-xs text-uppercase font-weight-bolder">البيان</td>
                                    <td class="px-1 text-xs text-uppercase font-weight-bolder">ملاحظات</td>
                                    {{-- <td class="px-1 text-xs text-uppercase font-weight-bolder">لي</td>
                                    <td class="px-1 text-xs text-uppercase font-weight-bolder">علي</td> --}}
                                    <td class="px-1 text-xs text-uppercase font-weight-bolder">المبلغ</td>
                                    <td class="px-1 text-xs text-uppercase font-weight-bolder">الرصيد</td>
                                </tr>
                                <tr>
                                    <td class="text-xs text-uppercase text-secondary font-weight-bolder ps-3"></td>
                                    <td class="px-1 text-xs text-uppercase text-secondary font-weight-bolder"></td>
                                    <td class="px-1 text-xs text-uppercase text-secondary font-weight-bolder"></td>
                                    {{-- <td class="px-1 text-xs text-uppercase text-secondary font-weight-bolder"></td> --}}
                                    <td class="px-1 text-xs text-uppercase text-secondary font-weight-bolder"></td>
                                    <td class="px-1 text-xs text-uppercase text-secondary font-weight-bolder"></td>
                                    <td class="px-1 text-xs text-uppercase text-secondary font-weight-bolder">{{ $reports?->first()?->pre_account }}</td>
                                </tr>
                                <!-- start foreach -->
                                @foreach ($reports as $report)
                                <tr>
                                    <td>
                                        <div class="px-2 py-1 d-flex">
                                            <p class="mb-0 text-xs font-weight-bold">{{ $report->created_at }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $report->point->name }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $report->report }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $report->note }}</p>
                                    </td>
                                    {{-- <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $report->to_him }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $report->on_him }}</p>
                                    </td> --}}
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold
                                        @if($report->amount>0)
                                        bg-success text-white
                                        @elseif($report->amount<0)
                                        bg-danger text-white
                                        @else
                                        bg-warning text-dark
                                        @endif
                                        ">{{ $report->amount }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $report->account }}</p>
                                    </td>

                                </tr>
                                @endforeach
                                <!-- end foreach -->
                                {{-- <tr>
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
                                    <td>
                                    </td>
                                    <td class="bg-info text-dark">
                                        <p class="mb-0 text-xs font-weight-bold">{{ $report?->account ?? 0 }}</p>
                                    </td>
                                    <td>
                                    </td>
                                </tr> --}}
                                <tr>
                                    {{-- <td>
                                    </td> --}}
                                    <td class="bg-dark text-white">
                                        <p class="mb-0 text-xs font-weight-bold">مجموع شحوناتي للرصيد</p>
                                    </td>
                                   <td class="bg-dark text-white">
                                    <p class="mb-0 text-xs font-weight-bold">{{ $final_charge_point }}</p>
                                    </td>
                                     <td class="bg-warning text-white">
                                        <p class="mb-0 text-xs font-weight-bold">مجموع  تسديد الفواتير</p>
                                    </td>
                                   <td class="bg-warning text-white">
                                    <p class="mb-0 text-xs font-weight-bold">{{ $final_charge_subscriber }}</p>
                                    </td>
                                    <td class="bg-success text-white">
                                        <p class="mb-0 text-xs font-weight-bold">مجموع العمولات</p>
                                    </td>
                                    
                                    <td class="bg-success text-white">
                                        <p class="mb-0 text-xs font-weight-bold">{{ $final_commission }}</p>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="icon" type="image/png" href={{ asset('/assets/img/favicon.png') }}>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('js')

<!--   Core JS Files   -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
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