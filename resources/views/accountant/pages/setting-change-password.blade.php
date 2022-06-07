@extends('accountant.app')

@section('title', 'الأعدادات-تغيير كلمة المرور')

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
        <form action="{{ route('accountant.setting.change-password.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="card col-md-7 mt-3">
                    <div class="card-header pb-0 p-3">
                        <h4 class="mb-0">تغيير كلمة المرور</h4>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class=" col-12">
                                <div class="form-group">
                                    <label>
                                        كلمة المرور السابقة
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="password" class="form-control" required name="pre_password">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>
                                        كلمة المرور الجديدة
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="password" class="form-control" required name="password">
                                </div>
                                <div class="form-group">
                                    <label>
                                        تأكيد كلمة المرور
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="password" class="form-control" required name="password_confirmation">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info me-auto ms-0 d-block">حفظ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
