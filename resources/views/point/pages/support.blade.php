@extends('point.app')

@section('title', 'طلبات الدعم')

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
        <form action="{{ route('point.support.support_request') }}" method="POST">
            @csrf
            <div class="row">
                <div class="mt-3 card col-md-7">
                    <div class="p-3 pb-0 card-header">
                        <h4 class="mb-0">طلبات الدعم</h4>
                    </div>
                    <div class="p-3 card-body">
                        <div class="row">
                            <div class=" col-md-6">
                                <div class="form-group">
                                    <label>
                                        الاسم
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input name="name" type="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        رقم الهاتف
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input name="phone" type="tel" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>
                                        العنوان
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <textarea name="address" cols="30" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>
                                        الملاحظات
                                    </label>
                                    <textarea name="note" cols="30" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-12 ">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <input class="" name="type" type="radio" value="switch"
                                                id="maintOptionA" checked="">
                                            <label class="" for="maintOptionA">
                                                قلب </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <input class="" name="type" type="radio" value="new_installation"
                                                id="maintOptionB">
                                            <label class="" for="maintOptionB">
                                                تركيب جديد</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info me-auto ms-0 d-block">ارسال</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection