@extends('admin.dashboard')

@section('title', 'الاعدادات - اعدادات أخرى')

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
        <form action="{{ route('admin.setting.other.update') }}" method="POST">
            @csrf <div class="row">
                <div class="card col-md-7 mt-3">
                    <div class="card-header pb-0 p-3">
                        <h4 class="mb-0">اعدادات أُخرى</h4>
                    </div>
                    <div class="card-body p-3">

                        <div class="row">
                            <div class=" col-12">
                                <div class="form-group">
                                    <label>
                                        الحد الأعلى للدين المسموح لنقطة البيع
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input name="maximum_amount_of_borrowing" type="number" class="form-control" required
                                        value="{{ $maximum_amount_of_borrowing }}">
                                </div>
                            </div>
                            <div class="col-12">
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
