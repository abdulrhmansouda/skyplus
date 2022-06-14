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
                                <p class="mb-0 text-sm text-capitalize font-weight-bold">الرصيد + الربح</p>
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
                                <p class="mb-0 text-sm text-capitalize font-weight-bold">الربح</p>
                                <h5 class="mb-0 font-weight-bolder">
                                    {{ Auth::user()->point->daily_profit }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-start">
                            <div class="text-center shadow icon icon-shape bg-gradient-info border-radius-md">
                                <i class="fas fa-coins" text-lg="" opacity-10="" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- if search  -->
        @if ($search && $sub)

        <div class="col-12">
            <div class="mb-4 card">
                <div class="pb-0 card-header">
                    <div class="row">
                        <div class="col-12">
                            <h6>المشتركين</h6>
                        </div>
                    </div>
                </div>
                <div class="px-0 pt-0 pb-2 card-body">
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
                    <div class="p-0 table-responsive">
                        <table class="table mb-0 align-items-center">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">
                                        الاسم
                                    </th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        T.C </th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        رقم المشترك
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
                                {{-- @foreach ($subs as $sub) --}}
                                <tr>
                                    <td>
                                        <h6 class="mb-0 text-sm">{{ $sub->name }}</h6>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $sub->t_c }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $sub->subscriber_number }}
                                        </p>
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
                                        <!-- start view1 -->
                                        <div class="d-inline-block">
                                            <a href="javascript:;" class="px-1 text-xs text-secondary font-weight-bold " data-toggle="tooltip" data-original-title="view user" data-bs-toggle="modal" data-bs-target="#view{{ $sub->id }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <!-- satrt view1 Modal -->
                                            <div class="modal fade" id="view{{ $sub->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                عرض المشترك </h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            اسم المشترك
                                                                            <h6>
                                                                                {{ $sub->name }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            T.c
                                                                        </h6>
                                                                        {{ $sub->t_c }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            رقم المشترك
                                                                        </h6>
                                                                        {{ $sub->subscriber_number }}
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            رقم الهاتف
                                                                        </h6>
                                                                        <bdi>{{ $sub->phone }}</bdi>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            اسم الباقة
                                                                        </h6>
                                                                        {{ $sub->package ? $sub->package->name : 'الباقة محذوفة' }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            سعر الباقة
                                                                        </h6>
                                                                        {{ $sub->package->price }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            تاريخ البدء
                                                                        </h6>
                                                                        {{ $sub->start_package }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            تاريخ الانتهاء
                                                                        </h6>
                                                                        {{ $sub->end_package }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            الايام المتبقية
                                                                        </h6>
                                                                        {{ $sub->days_to_end }}
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            حالة المستخدم
                                                                        </h6>
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

                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            العنوان
                                                                        </h6>
                                                                        <p>
                                                                            {{ $sub->address }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            مكان التركيب
                                                                        </h6>
                                                                        <p>
                                                                            {{ $sub->installation_address }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-info" data-bs-dismiss="modal">اغلاق</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end Modal view1  -->
                                        </div>
                                        <!-- end view1 -->

                                        <!-- start charge1 -->
                                        <div class="d-inline-block">
                                            <a href="javascript:;" class="px-1 text-xs text-secondary font-weight-bold " data-toggle="tooltip" data-original-title="charge{{ $sub->id }} user" data-bs-toggle="modal" data-bs-target="#charge{{ $sub->id }}">
                                                <i class="fas fa-money-bill-wave-alt"></i>
                                            </a>
                                            <!-- satrt charge1 Modal -->
                                            <form action="{{ route('point.subscribers.charge', $sub->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                {{-- <input type="text"> --}}
                                                <div class="modal fade" id="charge{{ $sub->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            @if ($sub->status !== 'closed')
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
                                                                                اسم الباقة </h6>
                                                                            {{ $sub->package->name }}
                                                                        </div>
                                                                    </div>
                                                                    <div class=" col-6">
                                                                        <div class="form-group">
                                                                            <h6>
                                                                                سعر الباقة </h6>
                                                                            <span class="price">
                                                                                {{ $sub->package->price }}
                                                                            </span>
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
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <input class="" name="pay" type="radio" value="true" id="allow{{ $sub->id }}" checked onChange="HideShowSelect(event)">
                                                                            <label class="" for="allow{{ $sub->id }}">
                                                                                تسديد</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <input class="" name="pay" type="radio" value="false" id="notALlow{{ $sub->id }}" onChange="HideShowSelect(event)">
                                                                            <label class="" for="notALlow{{ $sub->id }}">
                                                                                الغاء تسديد</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <input class="" name="pay" type="radio" value="upgrate" id="upgrate{{ $sub->id }}" onChange="HideShowSelect(event)">
                                                                            <label class="" for="upgrate{{ $sub->id }}">
                                                                                ترقية</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class=" col-6 form-packages d-none">
                                                                        <div class="form-group">
                                                                            <h6>
                                                                                اختر الباقة الجديدة </h6>
<<<<<<< HEAD
                                                                            <select name=""  class="form-select " onchange="getPricePackage(event)">
                                                                                @foreach ($packages as $package)
                                                                                <option value="{{ $package->id }}">{{ $package->name }}</option>
                                                                                @endforeach
=======
                                                                            <select name="" class="form-select " onchange="getPricePackage(event)">
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
>>>>>>> 246c87906eef15ef0177999b9bc5612fc1fbbd0e
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-info">حفظ</button>
                                                                <span type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</span>
                                                            </div>
                                                            @else
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">
                                                                    عذرا المشترك مغلق
                                                                </h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                هذا المشترك مغلق الرجاء التواصل مع مركز الخدمة
                                                                لأعادة تفعيل
                                                                المشترك
                                                            </div>
                                                            <div class="modal-footer">

                                                                <span type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</span>
                                                            </div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- end Modal charge1  -->
                                        </div>
                                        <!-- end charge1 -->

                                        <!-- start maintenance1 -->
                                        <div class="d-inline-block">
                                            <a href="javascript:;" class="px-1 text-xs text-secondary font-weight-bold " data-toggle="tooltip" data-original-title="charge1 user" data-bs-toggle="modal" data-bs-target="#maintenance{{ $sub->id }}">
                                                <i class="fas fa-wrench"></i>
                                            </a>
                                            <!-- satrt maintenance1 Modal -->
                                            <form action="{{ route('point.subscribers.maintenance',$sub->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal fade" id="maintenance{{ $sub->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    طلب صيانة </h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <h6>
                                                                                اسم المشترك
                                                                                <h6>
                                                                                    {{ $sub->name }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <h6>
                                                                                رقم الهاتف
                                                                            </h6>
                                                                            <bdi>{{ $sub->phone }}</bdi>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 ">
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                <div class="form-group">
<<<<<<< HEAD
                                                                                    <input class="" name="type" type="radio" value="{{App\Enums\SupportRequestTypeEnum::MAINTENANCE->value}}" id="maintenancea{{ $sub->id }}" checked >
=======
                                                                                    <input class="" name="type" type="radio" value="transfer" id="maintenancea{{ $sub->id }}" checked onchange="HideShowSelectmaintenance(event)">
>>>>>>> 246c87906eef15ef0177999b9bc5612fc1fbbd0e
                                                                                    <label class="" for="maintenancea{{ $sub->id }}">
                                                                                        نقل</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div class="form-group">
<<<<<<< HEAD
                                                                                    <input class="" name="type" type="radio" value="{{App\Enums\SupportRequestTypeEnum::TRANSFER->value}}" id="maintenancea{{ $sub->id }}"  >
                                                                                    <label class="" for="maintenancea{{ $sub->id }}">
                                                                                        نقل</label>
=======
                                                                                    <input class="" name="type" type="radio" value="maintenance" id="maintenanceb{{ $sub->id }}" onchange="HideShowSelectmaintenance(event)">
                                                                                    <label class="" for="maintenanceb{{ $sub->id }}">
                                                                                        صيانة</label>
>>>>>>> 246c87906eef15ef0177999b9bc5612fc1fbbd0e
                                                                                </div>
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                    *****
                                                                    <div class=" col-6 form-maintenance d-none">
                                                                        <div class="form-group">
                                                                            <h6>
                                                                                اختر سبب الصيانة </h6>
                                                                            <select name="" class="form-select "  >

                                                                                <option value="1">انترنت ضعيف</option>
                                                                                <option value="2">انترنت مقطوع</option>
                                                                                <option value="3">فصل ووصل في الانترنت</option>
                                                                                <option value="4">تغيير كلمة المرور للراوتر</option>
                                                                                <option value="5">نقل اللايت من مكان لآخر</option>
                                                                                <option value="6">تغيير مكان الراوتر</option>
                                                                                <option value="7">تبديل راوتر </option>
                                                                                <option value="8">تبديل لايت</option>
                                                                                <option value="9">تبديل كبل</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                ملاحظات
                                                                            </label>
                                                                            <textarea name="note" cols="30" rows="3" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-info">إرسال</button>
                                                                <span type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- end Modal charge1  -->
                                        </div>
                                        <!-- end maintenance1 -->
                                    </td>
                                </tr>
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- start pagination -->
            {{-- {{ $subs->links() }} --}}
            <!-- end pagination -->
        </div>
        @elseif($search)
        لا يوجد نتائج لعملية البحث هذه يمكن البحث فقط عن طريق رقم الهاتف او رقم المشترك او T.C
        @else
        <!-- else -->
        <div class="col-12">
            <div class="mb-4 card">
                <div class="pb-0 card-header">
                    <div class="row">
                        <div class="col-12">
                            <h6>عمليات التسديد لليوم</h6>
                        </div>
                    </div>
                </div>
                <div class="px-0 pt-0 pb-2 card-body">
                    <div class="p-0 table-responsive">
                        <table class="table mb-0 align-items-center">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">
                                        التاريخ
                                    </th>

                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        البيان </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $report)
                                <tr>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">
                                            <bdi>{{ $report->created_at }}</bdi>
                                        </p>
                                    </td>

                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $report->report }}</p>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection