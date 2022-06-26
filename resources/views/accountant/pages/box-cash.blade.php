@extends('accountant.app')


@section('title', 'الصندوق/النقد')

@section('content')
    <div class="py-4 container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- start add -->
        <button type="button" class="btn bg-gradient-dark btn-sm" data-bs-toggle="modal" data-bs-target="#add">
            إضافة فاتورة
        </button>
        <!-- add Modal -->
        <form action="{{ route('accountant.box-cash.store') }}" method="POST">
            @csrf
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">إضافة فاتورة للصندوق</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class=" col-12">
                                    <div class="form-group">
                                        <label>
                                            نوع نوع الفاتورة
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <select name="transaction_type" required class="form-control">
                                            <option value="">اختر النوع</option>
                                            <option value="{{ App\Enums\MoneyTransactionTypeEnum::TAKE_MONEY->value }}">
                                                سحب مال</option>
                                            <option value="{{ App\Enums\MoneyTransactionTypeEnum::PUT_MONEY->value }}">
                                                اضافة مال</option>
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
        <div class="mb-3 row">
           

            <div class="col-md-10 ">
                <form action="" method="GET">
                    <div class="flex flex-wrap gap-2 d-flex align-items-center">
                        <input name="daterange" type="text" class="form-control w-md-50 daterange"
                            value="{{ $daterange ?? '' }}" />
                        <div class="gap-1 m-0 form-group d-flex">
                            <input name="all_date" class="form-check-input " type="checkbox" value="true"
                                @if ($all_date == 'true') checked @endif id="all">
                            <label class="form-check-label text-nowrap" for="all">كل المدة
                            </label>
                        </div>
                        <select name="box_transaction_type" class="form-select w-md-50">
                            <option value="">الكل</option>
                            <option value="{{ App\Enums\BoxTransactionTypeEnum::CHARGE_POINT->value }}"
                                @if ($box_transaction_type == App\Enums\BoxTransactionTypeEnum::CHARGE_POINT->value) selected @endif>شحن رصيد</option>
                            <option value="{{ App\Enums\BoxTransactionTypeEnum::SELL->value }}"
                                @if ($box_transaction_type == App\Enums\BoxTransactionTypeEnum::SELL->value) selected @endif>بيع</option>
                            <option value="{{ App\Enums\BoxTransactionTypeEnum::PAY->value }}"
                                @if ($box_transaction_type == App\Enums\BoxTransactionTypeEnum::PAY->value) selected @endif>دفع</option>
                        </select>
                        <button type="submit" class="mb-0 btn btn-secondary btn-sm ps-3 pe-3">بحث</button>
                    </div>
                </form>
            </div>

            <div class="col-md-2">
                <form action="{{ route('accountant.box-cash.export') }}" method="POST">
                    @csrf
                    <input type="hidden" name="daterange" value="{{ $daterange ?? '' }}" />
                    <input type="hidden" name="all_date" value="{{ $$all_date ?? '' }}" />
                    <input type="hidden" name="box_transaction_type" value="{{ $$box_transaction_type ?? '' }}" />

                    <button type="submit" class="my-2 btn btn-white ps-3 pe-3 m-md-0">
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
                                    <h6>النقد</h6>
                                </div>
                            </div>
                        </div>
                        <div class="p-0 table-responsive">
                            <table class="table mb-0 align-items-center">
                                <thead>
                                    {{-- <tr>
                                    <th class="text-xs text-uppercase font-weight-bolder ps-3 bg-info text-dark">
                                        الحساب : الكل
                                    </th>
                                    <th class="px-1 text-xs text-uppercase font-weight-bolder "></th>
                                    <th class="px-1 text-xs text-uppercase font-weight-bolder "></th>
                                    <th class="px-1 text-xs text-uppercase font-weight-bolder "></th>
                                    <th class="px-1 text-xs text-uppercase font-weight-bolder "></th>
                                    <th class="px-1 text-xs text-uppercase font-weight-bolder "></th>
                                    <th class="px-1 text-xs text-uppercase font-weight-bolder "></th>
                                </tr> --}}
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-xs text-uppercase font-weight-bolder ps-3" colspan="7">
                                            اعتبارا من {{ $from }} الى تاريخ {{ $to }}
                                        </td>


                                    </tr>

                                    <tr class="bg-aliceblue">
                                        <td class="text-xs text-uppercase font-weight-bolder ps-3">التاريخ</td>
                                        <td class="text-xs text-uppercase font-weight-bolder ps-3">مشرف العملية</td>
                                        <td class="px-1 text-xs text-uppercase font-weight-bolder">البيان</td>
                                        <td class="px-1 text-xs text-uppercase font-weight-bolder">ملاحظات</td>
                                        <td class="px-1 text-xs text-uppercase font-weight-bolder">نوع الفاتورة</td>
                                        <td class="px-1 text-xs text-uppercase font-weight-bolder">قيمة الفاتورة</td>
                                        <td class="px-1 text-xs text-uppercase font-weight-bolder">الرصيد</td>
                                    </tr>
                                    <tr>
                                        <td class="text-xs text-uppercase text-secondary font-weight-bolder ps-3"></td>
                                        <td class="px-1 text-xs text-uppercase text-secondary font-weight-bolder"></td>
                                        <td class="px-1 text-xs text-uppercase text-secondary font-weight-bolder"></td>
                                        <td class="px-1 text-xs text-uppercase text-secondary font-weight-bolder"></td>
                                        <td class="px-1 text-xs text-uppercase text-secondary font-weight-bolder"></td>
                                        <td class="px-1 text-xs text-uppercase text-secondary font-weight-bolder"></td>
                                        <td class="px-1 text-xs text-uppercase text-secondary font-weight-bolder">
                                            {{ $boxCashs?->last()?->pre_acount ?? 0 }}
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
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold">
                                                    {{ $boxCash->operationSupervisor() }}</p>
                                            </td>
                                            <td title='{{ $boxCash->report }}'>
                                                <p class="mb-0 text-xs font-weight-bold ellipsis">{{ $boxCash->report }}
                                                </p>
                                            </td>
                                            <td title='{{ $boxCash->note }}'>
                                                <p class="mb-0 text-xs font-weight-bold ellipsis">{{ $boxCash->note }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold">
                                                    {{-- {{ $boxCash->transaction_type() }} --}}
                                                    {{ $boxCash->boxTransactionType() }}
                                                </p>
                                            </td>
                                            <td>
                                                <p
                                                    class="mb-0 text-xs font-weight-bold
                                        @if ($boxCash->amount > 0) bg-success text-white
                                        @elseif($boxCash->amount < 0)
                                        bg-danger text-white
                                        @else
                                        bg-warning text-dark @endif
                                        ">
                                                    {{ $boxCash->amount }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-xs font-weight-bold">{{ $boxCash->account }}</p>
                                            </td>

                                        </tr>
                                    @endforeach
                                    <!-- end foreach -->
                                    <tr>

                                        <td class="text-white bg-success">
                                            <p class="mb-0 text-xs font-weight-bold">مجموع شحن الأرصدة</p>

                                        </td>
                                        <td class="text-white bg-success">
                                            <p class="mb-0 text-xs font-weight-bold">{{ $final_charge_subscriber }}</p>
                                        </td>

                                        <td class="text-white bg-warning">
                                            <p class="mb-0 text-xs font-weight-bold">الوارد</p>
                                        </td>
                                        <td class="text-white bg-warning">
                                            <p class="mb-0 text-xs font-weight-bold">{{ $final_sell }}</p>
                                        </td>
                                        <td class="text-white bg-danger">
                                            <p class="mb-0 text-xs font-weight-bold">الصادر</p>
                                        </td>

                                        <td class="text-white bg-danger">
                                            <p class="mb-0 text-xs font-weight-bold">{{ $final_pay }}</p>
                                        </td>
                                        {{-- <!-- <td class="bg-info text-dark">
                                        <p class="mb-0 text-xs font-weight-bold">{{ $boxCashs?->last()?->account ?? 0 }}</p>
                                    </td> --> --}}

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
