@extends('admin.dashboard')

@section('title', 'الأعدادات-الربط')

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
        <form action="{{ route('admin.setting.binding-app.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="card col-md-7 mt-3">
                    <div class="card-header pb-0 p-3">
                        <h4 class="mb-0">اعدادات الربط</h4>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class=" col-12">
                                <div class="form-group">
                                    <label>
                                        bot_username
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="text" class="form-control" required name="bot_username" value="{{ $settings->bot_username }}">
                                </div>
                            </div>
                            <div class=" col-12">
                                <div class="form-group">
                                    <label>
                                         bot_token 
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="text" class="form-control" required name="bot_token" value="{{ $settings->bot_token }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>
                                         chat_id
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="text" class="form-control" required name="chat_id" value="{{ $settings->chat_id }}">
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
