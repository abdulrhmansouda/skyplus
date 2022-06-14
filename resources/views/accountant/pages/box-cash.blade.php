@extends('accountant.app')


@section('title', 'الصفحة الرئيسية')

@section('content')
<div class="py-4 container-fluid">
    <!-- start add -->
    <button type="button" class="btn bg-gradient-dark btn-sm" data-bs-toggle="modal" data-bs-target="#add">
        إضافة حركة
    </button>
    <!-- add Modal -->
    <form action="{{ route('accountant.box-cash.store') }}" method="POST">
        @csrf
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">إضافة حركة للصندوق</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class=" col-12">
                                <div class="form-group">
                                    <label>
                                        نوع الحركة
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <select name="transaction_type" required class="form-control">
                                        <option value="">اختر النوع</option>
                                        <option value="{{ App\Enums\MoneyTransactionTypeEnum::TAKE_MONEY->value }}">سحب</option>
                                        <option value="{{ App\Enums\MoneyTransactionTypeEnum::PUT_MONEY->value }}">ايداع</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>
                                        المبلغ
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="number" name="amount" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>
                                        البيان
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <textarea type="text" name="report" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>
                                        الملاحظات
                                    </label>
                                    <textarea type="text" name="note" class="form-control"></textarea>
                                </div>
                            </div>
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
    <!-- end add -->
    <div class="row mb-3">
        {{-- <div class="col-md-10 ">
            <form action="">
                <div class="d-flex gap-3">
                    <input name="daterange" type="text" class="form-control w-50 daterange"  />

                    <button class="btn btn-secondary mb-0  btn-sm ps-3 pe-3">بحث</button>
                </div>
            </form>
        </div> --}}

        <div class="col-md-10 ">
            <form action="" method="GET">
                <div class="gap-2 d-flex align-items-center">
                    <input name="daterange" type="text" class="form-control w-50 daterange" value="{{ $daterange ?? '' }}" />
                    <div class="gap-1 m-0 form-group d-flex">
                        <input name="all_date" class="form-check-input " type="checkbox" value="true" @if ($all_date==='true' ) checked @endif id="all">
                        <label class="form-check-label text-nowrap" for="all">كل المدة
                        </label>
                    </div>
                    *****
                    <select name="" class="form-select">
                        <option value="">شحن رصيد</option>
                        <option value="">بيع</option>
                        <option value="">دفع</option>
                    </select>
                    <button type="submit" class="mb-0 btn btn-secondary btn-sm ps-3 pe-3">بحث</button>
                </div>
            </form>
        </div>

        <div class="col-md-2">
            <form action="">
                <button class="btn btn-white  ps-3 pe-3 m-md-0 m-2">
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
                                <h6>الصندوق</h6>
                            </div>
                        </div>
                    </div>
                    <div class="p-0 table-responsive">
                        <table class="table mb-0 align-items-center">
                            <thead>
                                {{-- <tr>
                                    <th class="text-xs text-uppercase font-weight-bolder ps-3 bg-info  text-dark">
                                        الحساب : الكل
                                    </th>
                                    <th class="px-1 text-uppercase text-xs font-weight-bolder "></th>
                                    <th class="px-1 text-uppercase text-xs font-weight-bolder "></th>
                                    <th class="px-1 text-uppercase text-xs font-weight-bolder "></th>
                                    <th class="px-1 text-uppercase text-xs font-weight-bolder "></th>
                                    <th class="px-1 text-uppercase text-xs font-weight-bolder "></th>
                                    <th class="px-1 text-uppercase text-xs font-weight-bolder "></th>
                                </tr> --}}
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-xs text-uppercase font-weight-bolder ps-3">
                                        اعتبارا من {{ $from }} الى تاريخ {{ $to }}
                                    </td>
                                    <td class="px-1 text-xs text-uppercase font-weight-bolder ">
                                        {{-- الرصيد
                                            السابق{{ $pre }} --}}
                                    </td>
                                    <td class="px-1 text-xs text-uppercase font-weight-bolder ">
                                        {{-- {{ $pre_account }} --}}
                                    </td>
                                    <td class="px-1 text-uppercase text-xs font-weight-bolder "></td>
                                    <td class="px-1 text-uppercase text-xs font-weight-bolder "></td>
                                </tr>

                                <tr class="bg-aliceblue">
                                    <td class="text-uppercase  text-xs font-weight-bolder ps-3">التاريخ</td>
                                    {{-- <td class="text-uppercase  text-xs font-weight-bolder ps-3">اسم النقطة</td> --}}
                                    <td class="px-1 text-uppercase  text-xs font-weight-bolder">البيان</td>
                                    <td class="px-1 text-uppercase  text-xs font-weight-bolder">ملاحظات</td>
                                    <td class="px-1 text-uppercase  text-xs font-weight-bolder">نوع الحركة</td>
                                    <td class="px-1 text-uppercase  text-xs font-weight-bolder">قيمة الحركة</td>
                                    <td class="px-1 text-uppercase  text-xs font-weight-bolder">الرصيد</td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase text-secondary text-xs font-weight-bolder ps-3"></td>
                                    {{-- <td class="px-1 text-uppercase text-secondary text-xs font-weight-bolder"></td> --}}
                                    <td class="px-1 text-uppercase text-secondary text-xs font-weight-bolder">الكل</td>
                                    <td class="px-1 text-uppercase text-secondary text-xs font-weight-bolder"></td>
                                    <td class="px-1 text-uppercase text-secondary text-xs font-weight-bolder"></td>
                                    <td class="px-1 text-uppercase text-secondary text-xs font-weight-bolder"></td>
                                    <td class="px-1 text-uppercase text-secondary text-xs font-weight-bolder">
                                        {{ $pre_account }}
                                    </td>
                                </tr>
                                <!-- start foreach -->
                                @foreach ($boxCashs as $boxCash)
                                <tr>
                                    <td>
                                        <div class="px-2 py-1 d-flex">
                                            <p class="mb-0 text-xs font-weight-bold">{{ $boxCash->created_at }}
                                            </p>
                                        </div>
                                    </td>
                                    {{-- <td>
                                    <p class="mb-0 text-xs font-weight-bold">نقطة 1</p>
                                </td> --}}
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $boxCash->report }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $boxCash->note }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">
                                            {{ $boxCash->transaction_type() }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">
                                            {{ $boxCash->account - $boxCash->pre_account }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $boxCash->account }}</p>
                                    </td>

                                </tr>
                                @endforeach
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
                                    {{-- <td>
                                        </td> --}}
                                    <td class="bg-info text-dark">
                                        <p class="mb-0 text-xs font-weight-bold">{{ $boxCashs?->last()?->account ?? 0 }}</p>
                                    </td>
                                    <td>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- <!-- start pagination -->
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
                <!-- end pagination --> --}}
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

        // $('#mySelect2').select2({
        //     placeholder: "اختر نقطة بيع أوأكثر",
        //     ajax: {
        //         url: '/api/points',
        //         dataType: 'json',
        //         quietMillis: 100,
        //         data: function(params) {
        //             var queryParameters = {
        //             name: params.term
        //             }

        //             return queryParameters;
        //         },
        //         processResults: function(data) {
        //             return {
        //                 results: $.map(data.points, function(item) {
        //                     return {
        //                         text: item.name,
        //                         id: item.id
        //                     }
        //                 })
        //             };
        //         }
        //     }
        // });
    })
</script>


@endsection