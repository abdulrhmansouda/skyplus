@extends('admin.dashboard')


@section('title', 'شحن الرصيد')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">
                                            الاسم</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            اسم المستخدم</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            الرصيد</th>


                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            T.C</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            شحن رصيد</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($points as $point)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ $point->image_url }}"
                                                            class="avatar avatar-sm ms-3 rounded-circle" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $point->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $point->user->username }}</p>
                                            </td>

                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $point->account }}</p>
                                            </td>



                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $point->t_c }}</p>
                                            </td>

                                            <td class="align-middle ">
                                                <!-- start charge1 -->
                                                <div class="d-inline-block">
                                                    <a href="javascript:;"
                                                        class="text-secondary font-weight-bold text-xs px-1 "
                                                        data-toggle="tooltip" data-original-title="charge1 user"
                                                        data-bs-toggle="modal" data-bs-target="#charge{{ $point->id }}">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                    </a>
                                                    <!-- satrt charge1 Modal -->
                                                    <form action="{{ route('admin.recharge.charge', $point->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal fade" id="charge{{ $point->id }}"
                                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            شحن
                                                                            رصيد لنقطة بيع
                                                                        </h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class=" col-12">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        اسم النقطة
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <input name="name" type="text"
                                                                                        class="form-control" readonly
                                                                                        required
                                                                                        value="{{ $point->name }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        المبلغ
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <input name="amount" type="number"
                                                                                        class="form-control" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        طريقة الدفع
                                                                                        <span class="text-danger"> *
                                                                                        </span>
                                                                                    </label>
                                                                                    <select name="payment_type" id=""
                                                                                        class="form-select">
                                                                                        <option value="{{ App\Enums\PaymentTypeEnum::CASH->value }}">نقد</option>
                                                                                        <option value="{{ App\Enums\PaymentTypeEnum::BANK->value }}">بنك</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                        ملاحظات
                                                                                    </label>
                                                                                    <textarea name="note" type="text" class="form-control"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit"
                                                                            class="btn btn-info">حفظ</button>
                                                                        <span type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">الغاء</span>
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
                {{ $points->links() }}
                <!-- end pagination -->
            </div>
        </div>
    </div>
@endsection
