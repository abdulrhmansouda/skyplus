@extends('point.app')



@section('title', 'تسديد الفاتورة')

@section('content')
<div class="py-4 container-fluid">
    <div class="mb-3 row">
        <div class="mb-4 col-lg-3 col-sm-6 mb-lg-0">
            <div class="card">
                <div class="p-3 card-body">
                    <div class=" row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="mb-0 text-sm text-capitalize font-weight-bold">الرصيد </p>
                                <h5 class="mb-0 font-weight-bolder">
                                    {{ Auth::user()->point->account }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-start">
                            <div class="text-center shadow icon icon-shape bg-gradient-info border-radius-md">
                                <i class="text-lg fas fa-wallet opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="p-3 card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="mb-0 text-sm text-capitalize font-weight-bold">العمولة</p>
                                <h5 class="mb-0 font-weight-bolder">
                                    {{ Auth::user()->point->commission }}%
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-start">
                            <div class="text-center shadow icon icon-shape bg-gradient-info border-radius-md">
                                <i class="fas fa-shopping-cart" text-lg="" opacity-10="" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="mb-4 card">
                <div class="px-0 pt-0 pb-2 card-body">
                    <div class="p-0 table-responsive">
                        <table class="table mb-0 align-items-center">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">
                                        اسم المشترك
                                    </th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        T_C </th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID</th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        رقم المشترك
                                    </th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        اسم الأم</th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        رقم الهاتف
                                    </th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        تاريخ البدء </th>

                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        تاريخ الانتهاء </th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        اسم الباقة
                                    </th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        حالة
                                        المستخدم </th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subs as $sub)
                                <tr>
                                    <td>
                                        <h6 class="mb-0 text-sm">{{ $sub->name }}</h6>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $sub->t_c }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $sub->sub_id }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $sub->subscriber_number }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $sub->mother }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $sub->phone }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">
                                            {{ $sub->start_package }}
                                        </p>
                                    </td>

                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">
                                            {{ $sub->end_package }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $sub->package->name }}</p>
                                    </td>
                                    <td class="text-sm align-middle">
                                        @if ($sub->status === 'active')
                                        <span class="badge badge-sm bg-gradient-success">مفعل</span>
                                        @elseif($sub->status === 'deactive')
                                        <span class="badge badge-sm bg-gradient-danger">غير مفعل</span>
                                        @else
                                        <span class="badge badge-sm bg-gradient-danger">مغلق</span>
                                        @endif
                                    </td>
                                    <td class="align-middle ">
                                        <!-- start charge1 -->
                                        <div class="d-inline-block">
                                            <a href="javascript:;" class="px-1 text-xs text-secondary font-weight-bold " data-toggle="tooltip" data-original-title="charge1 user" data-bs-toggle="modal" data-bs-target="#charge{{ $sub->id }}">
                                                <i class="fas fa-money-bill-wave-alt"></i>
                                            </a>
                                            <!-- satrt charge1 Modal -->
                                            <form action="">
                                                <div class="modal fade" id="charge{{ $sub->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    دفع
                                                                    فاتورة للمشترك </h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class=" col-6">
                                                                        <div class="form-group">
                                                                            <h6>
                                                                                الاسم
                                                                            </h6>
                                                                            {{ $sub->name }}
                                                                        </div>
                                                                    </div>
                                                                    <div class=" col-6">
                                                                        <div class="form-group">
                                                                            <h6>
                                                                                الأيام المتبقية
                                                                            </h6>
                                                                            {{ $sub->days_to_end }}
                                                                        </div>
                                                                    </div>
                                                                    <div class=" col-6">
                                                                        <div class="form-group">
                                                                            <h6>
                                                                                حالة المشترك </h6>
                                                                            @if ($sub->status === 'active')
                                                                            <span class="badge badge-sm bg-gradient-success">مفعل</span>
                                                                            @elseif($sub->status === 'deactive')
                                                                            <span class="badge badge-sm bg-gradient-danger">غير
                                                                                مفعل</span>
                                                                            @else
                                                                            <span class="badge badge-sm bg-gradient-danger">مغلق</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class=" col-6">
                                                                        <div class="form-group">
                                                                            <h6>
                                                                                سعر الباقة </h6>
                                                                            {{ $sub->package->price }}
                                                                        </div>
                                                                    </div>
                                                                    <div class=" col-6">
                                                                        <div class="form-group">
                                                                            <h6>
                                                                                اسم الباقة </h6>
                                                                            {{ $sub->package->name }}
                                                                        </div>
                                                                    </div>
                                                                    <div class=" col-6">
                                                                        <div class="form-group">
                                                                            <h6>
                                                                                الأشهر </h6>
                                                                            <select name="month" id="" class="form-select">
                                                                                <option value="1">1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                                <option value="4">4</option>
                                                                                <option value="5">5</option>
                                                                                <option value="6">6</option>
                                                                                <option value="7">7</option>
                                                                                <option value="8">8</option>
                                                                                <option value="9">9</option>
                                                                                <option value="10">10</option>
                                                                                <option value="11">11</option>
                                                                                <option value="12">12</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 ">
                                                                        <div class="form-group">
                                                                            <input class=""name="pay" type="radio" value="true" id="allow{{ $sub->id }}" checked >
                                                                            <label class="" for="allow{{ $sub->id }}">
                                                                                تسديد</label>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input class="" name="pay"type="radio" value="false" id="notALlow{{ $sub->id }}">
                                                                            <label class="" for="notALlow{{ $sub->id }}">
                                                                                الغاء تسديد</label>
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
                                            <!-- end Modal charge1  -->
                                        </div>
                                        <!-- end charge1 -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- start pagination -->
            {{ $subs->links() }}
            <!-- end pagination -->
        </div>
    </div>
</div>
@endsection