@extends('admin.dashboard')

@section('title', 'التقارير')



@section('content')
<div class="py-4 container-fluid">
    <div class="mb-3 row">
        <div class="col-md-12 ">
            <form action="" method="GET">
                <div class="gap-2 d-flex align-items-center">
                    <input name="daterange" type="text" class="form-control w-50 daterange" value="{{ $daterange ?? '' }}" />
                    <div class="gap-1 m-0 form-group d-flex">
                        <input name="all_date" class="form-check-input" type="checkbox" value="true" @if($all_date==="true" )checked @endif id="all">
                        <label class="form-check-label text-nowrap" for="all">كل المدة
                        </label>
                    </div>
                    <select name="points[]" class="js-data-example-ajax form-select" id="mySelect2" multiple>
                        <option value="0" @if(in_array("0",$_points)) selected @endif>الكل</option>
                        @foreach ($points as $point)
                        <option value="{{ $point->id }}" @if(in_array($point->id,$_points))selected @endif>{{ $point->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="mb-0 btn btn-secondary btn-sm ps-3 pe-3">بحث</button>
                </div>
            </form>
        </div>


    </div>
    <div class="mb-3 row justify-content-between">
        <div class="col-md-5 ">
            <form action="" method="GET">
                <select name="box_transaction_type" class="form-select">
                    <option value="">الكل</option>
                    <option>شحن </option>
                    <option>تسديد</option>
                    <option>عمولة</option>
                </select>
            </form>
        </div>
        <div class="col-md-2">
            <form action="{{ route('admin.reports.export') }}" method="POST">
                @csrf
                <input name="_daterange" type="hidden" value="{{ $daterange ?? '' }}" />
                <input name="all_date" type="hidden" value="{{ $all_date }}">

                <?php $value = base64_encode(serialize($_points)); ?>
                <input name="points" type="hidden" value="{{ $value }}">
                <button class="m-2 btn btn-white ps-3 pe-3 m-md-0 w-100">
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
                                    <th class="text-xs text-uppercase font-weight-bolder ps-3 bg-info text-dark">
                                        الحساب : {{ $name_points === '' ? 'الكل' : $name_points }}
                                    </th>
                                    <th class="px-1 text-xs text-uppercase font-weight-bolder "></th>
                                    <th class="px-1 text-xs text-uppercase font-weight-bolder "></th>
                                    <th class="px-1 text-xs text-uppercase font-weight-bolder "></th>
                                    <th class="px-1 text-xs text-uppercase font-weight-bolder "></th>
                                    <th class="px-1 text-xs text-uppercase font-weight-bolder "></th>
                                    <th class="px-1 text-xs text-uppercase font-weight-bolder "></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-xs text-uppercase font-weight-bolder ps-3">
                                        اعتبارا من {{ $from }} الى تاريخ {{ $to }}
                                    </td>
                                    <td class="px-1 text-xs text-uppercase font-weight-bolder ">
                                        {{-- الرصيد السابق
                                        {{ $pre }} --}}
                                    </td>
                                    <td class="px-1 text-xs text-uppercase font-weight-bolder ">
                                        {{-- {{ $pre_account }} --}}
                                    </td>
                                    <td class="px-1 text-xs text-uppercase font-weight-bolder "></td>
                                    <td class="px-1 text-xs text-uppercase font-weight-bolder "></td>
                                    <td class="px-1 text-xs text-uppercase font-weight-bolder "></td>
                                </tr>

                                <tr class="bg-aliceblue">
                                    <td class="text-xs text-uppercase font-weight-bolder ps-3">التاريخ</td>
                                    <td class="text-xs text-uppercase font-weight-bolder ps-3">اسم النقطة</td>
                                    <td class="text-xs text-uppercase font-weight-bolder ps-3">اسم الادمن</td>
                                    <td class="text-xs text-uppercase font-weight-bolder ps-3">اسم العميل</td>
                                    <td class="px-1 text-xs text-uppercase font-weight-bolder">نوع البيان</td>
                                    <td class="px-1 text-xs text-uppercase font-weight-bolder">البيان</td>
                                    <td class="px-1 text-xs text-uppercase font-weight-bolder">ملاحظات</td>
                                    <td class="px-1 text-xs text-uppercase font-weight-bolder">لنا</td>
                                    <td class="px-1 text-xs text-uppercase font-weight-bolder">له</td>
                                    <td class="px-1 text-xs text-uppercase font-weight-bolder">الرصيد</td>
                                </tr>
                                <tr>
                                    <td class="text-xs text-uppercase text-secondary font-weight-bolder ps-3"></td>
                                    <td class="px-1 text-xs text-uppercase text-secondary font-weight-bolder"></td>
                                    <td class="px-1 text-xs text-uppercase text-secondary font-weight-bolder"></td>
                                    <td class="px-1 text-xs text-uppercase text-secondary font-weight-bolder"></td>
                                    <td class="px-1 text-xs text-uppercase text-secondary font-weight-bolder"></td>
                                    <td class="px-1 text-xs text-uppercase text-secondary font-weight-bolder">الكل</td>
                                    <td class="px-1 text-xs text-uppercase text-secondary font-weight-bolder"></td>
                                    <td class="px-1 text-xs text-uppercase text-secondary font-weight-bolder"></td>
                                    <td class="px-1 text-xs text-uppercase text-secondary font-weight-bolder"></td>
                                    <td class="px-1 text-xs text-uppercase text-secondary font-weight-bolder">
                                        {{ $pre_account }}
                                    </td>
                                </tr>
                                <!-- start foreach -->
                                @foreach ($reports as $report)
                                <?php $pre_account = $pre_account - $report->to_him + $report->on_him; ?>
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
                                        <p class="mb-0 text-xs font-weight-bold">*****
                                        </p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">*****
                                        </p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $report->type_report }}
                                        </p>
                                    </td>

                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $report->report }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $report->note }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $report->on_him }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $report->to_him }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $pre_account }}</p>
                                    </td>

                                </tr>
                                @endforeach
                                <!-- end foreach -->
                                <tr>
                                    <td>
                                    </td>
                                    <td class="bg-success text-white">
                                        <p class="mb-0 text-xs font-weight-bold">مجموع شحن الأرصدة</p>
                                    </td>
                                   <td class="bg-success text-white">
                                    <p class="mb-0 text-xs font-weight-bold">*****</p>
                                    </td>
                                     <td class="bg-warning text-white">
                                        <p class="mb-0 text-xs font-weight-bold">مجموع  تسديد الفواتير</p>
                                    </td>
                                   <td class="bg-warning text-white">
                                    <p class="mb-0 text-xs font-weight-bold">*****</p>
                                    </td>
                                    <td class="bg-danger text-white">
                                        <p class="mb-0 text-xs font-weight-bold">مجموع العمولات</p>
                                    </td>
                                    
                                    <td class="bg-danger text-white">
                                        <p class="mb-0 text-xs font-weight-bold">*****</p>
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
            <!-- start pagination -->
            {{-- {{ $reports->links() }} --}}
            <!-- end pagination -->
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
<script src={{ asset('/assets/js/core/popper.min.js') }}></script>
<script src={{ asset('/assets/js/core/bootstrap.min.js') }}></script>
<script src={{ asset('/assets/js/plugins/perfect-scrollbar.min.js') }}></script>
<script src={{ asset('/assets/js/plugins/smooth-scrollbar.min.js') }}></script>
<script src={{ asset('/assets/js/plugins/fullcalendar.min.js') }}></script>
<script src={{ asset('/assets/js/plugins/chartjs.min.js') }}></script>
<script src={{ asset('/assets/js/plugins/choices.min.js') }}></script>
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

        $('#mySelect2').select2({
            placeholder: "اختر نقطة بيع أوأكثر",
            ajax: {
                url: '/api/points',
                dataType: 'json',
                quietMillis: 100,
                data: function(params) {
                    var queryParameters = {
                        name: params.term
                    }

                    return queryParameters;
                },
                processResults: function(data) {
                    return {
                        results: $.map(data.points, function(item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });
    })
</script>


@endsection