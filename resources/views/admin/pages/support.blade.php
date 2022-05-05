@extends('admin.dashboard')

@section('title', 'الدعم الفني')

@section('content')
    <div class="container-fluid py-4">
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
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">
                                            صاحب النقطة</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            اسم النقطة</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            اسم المشترك</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            رقم الهاتف</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            نوع الطلب</th>

                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            حالة الطلب</th>

                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            العنوان</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            قبول او رفض</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requests as $request)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ $request->point->image_url }}"
                                                            class="avatar avatar-sm ms-3 rounded-circle" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $request->point->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $request->point->user->username }}</p>
                                            </td>
                                            {{-- @dd($request->name) --}}
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $request->subscriber_name }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $request->subscriber_phone }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    @switch($request->type)
                                                        @case('maintenance')
                                                            صيانة
                                                        @break

                                                        @case('new_installation')
                                                            اشتراك جديد
                                                        @break

                                                        @case('switch')
                                                            تحويل خط
                                                        @break

                                                        @case('transfer')
                                                            نقل العنوان
                                                        @break

                                                        @default
                                                    @endswitch
                                                </p>
                                            </td>
                                            <td class="text-sm align-middle">
                                                @if ($request->status === 'accepted')
                                                    <span class="badge badge-sm bg-gradient-success">مقبول</span>
                                                @elseif($request->status === 'waiting')
                                                    <span class="badge badge-sm bg-gradient-warning">انتظار</span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-danger">مرفوض</span>
                                                @endif
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $request->subscriber_address }}</p>
                                            </td>
                                            <td class="align-middle ">
                                                <!-- start support1 -->
                                                <div class="d-inline-block">
                                                    <a href="javascript:;"
                                                        class="text-secondary font-weight-bold text-xs px-1 "
                                                        data-toggle="tooltip"
                                                        data-original-title="support{{ $request->id }} user"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#support{{ $request->id }}">
                                                        <i class="fas fa-clipboard-check"></i>
                                                    </a>
                                                    <!-- satrt support1 Modal -->
                                                    <div class="modal fade" id="support{{ $request->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        طلب دعم فني لمشترك</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class=" col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    صاحب النقطة
                                                                                </h6>
                                                                                {{ $request->point->name }}
                                                                            </div>
                                                                        </div>
                                                                        <div class=" col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    اسم النقطة
                                                                                </h6>
                                                                                {{ $request->point->user->username }}
                                                                            </div>
                                                                        </div>
                                                                        <div class=" col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    اسم المشترك
                                                                                </h6>
                                                                                {{ $request->subscriber_name }}
                                                                            </div>
                                                                        </div>
                                                                        <div class=" col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    رقم الهاتف
                                                                                </h6>
                                                                                {{ $request->subscriber_phone }}
                                                                            </div>
                                                                        </div>
                                                                        <div class=" col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    ID
                                                                                </h6>
                                                                                1222
                                                                            </div>
                                                                        </div>
                                                                        <div class=" col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    نوع الطلب
                                                                                </h6>
                                                                                @switch($request->type)
                                                                                    @case('maintenance')
                                                                                        صيانة
                                                                                    @break

                                                                                    @case('new_installation')
                                                                                        اشتراك جديد
                                                                                    @break

                                                                                    @case('switch')
                                                                                        تحويل خط
                                                                                    @break

                                                                                    @default
                                                                                @endswitch
                                                                            </div>
                                                                        </div>
                                                                        <div class=" col-md-6">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    اسم الباقة الجديدة
                                                                                </h6>
                                                                                باقة 2
                                                                            </div>
                                                                        </div>
                                                                        <div class=" col-12">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    العنوان
                                                                                </h6>
                                                                                {{ $request->subscriber_address }}
                                                                            </div>
                                                                        </div>
                                                                        <div class=" col-12">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    الملاحظات
                                                                                </h6>
                                                                                {{ $request->note }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form
                                                                        action="{{ route('admin.support.accept_request') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input name="request_id" type="hidden"
                                                                            value="{{ $request->id }}">

                                                                        <button type="submit"
                                                                            class="btn btn-info">قبول</button>
                                                                    </form>
                                                                    <form
                                                                        action="{{ route('admin.support.reject_request') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input name="request_id" type="hidden"
                                                                            value="{{ $request->id }}">
                                                                        <button type="submit"
                                                                            class="btn btn-secondary">رفض</button>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end Modal support1  -->
                                                </div>
                                                <!-- end support1 -->
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- start pagination -->
                {{-- <ul class="pagination pagination-info">
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
                </ul> --}}
                {{ $requests->links() }}
                <!-- end pagination -->
            </div>
        </div>
    </div>
@endsection
