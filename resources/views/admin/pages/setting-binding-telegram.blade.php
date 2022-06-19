@extends('admin.dashboard')

@section('title', 'الأعدادات-الربط')

@section('content')
@foreach ($bots as $bot)
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
    <form action="{{ route('admin.setting.binding-telegram.bot-update',$bot->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="card col-md-7 mt-3">
                <div class="card-header pb-0 p-3">
                    <h4 class="mb-0">اعدادات الربط مع {{ $bot->name }}</h4>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class=" col-12">
                            <div class="form-group">
                                <label>
                                    bot_token
                                    <span class="text-danger"> * </span>
                                </label>
                                <input type="text" class="form-control" required name="bot_token"
                                    value="{{ $bot->bot_token }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>
                                    chat_id
                                    <span class="text-danger"> * </span>
                                </label>
                                <input type="text" class="form-control" required name="chat_id"
                                    value="{{ $bot->chat_id }}">
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
@endforeach

    {{-- <div class="container-fluid py-4">
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
        <form action="{{ route('admin.setting.binding-telegram.bot-update',2) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="card col-md-7 mt-3">
                    <div class="card-header pb-0 p-3">
                        <h4 class="mb-0">اعدادات الربط مع مجموعة الصيانة</h4>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class=" col-12">
                                <div class="form-group">
                                    <label>
                                        bot_token
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="text" class="form-control" required name="bot_token"
                                        value="{{ $maintenance_bot->bot_token }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>
                                        chat_id
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="text" class="form-control" required name="chat_id"
                                        value="{{ $maintenance_bot->chat_id }}">
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
        <form action="{{ route('admin.setting.binding-telegram.bot-update',3) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="card col-md-7 mt-3">
                    <div class="card-header pb-0 p-3">
                        <h4 class="mb-0">اعدادات الربط مع مجموعة نقل المنزل</h4>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class=" col-12">
                                <div class="form-group">
                                    <label>
                                        bot_token
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="text" class="form-control" required name="bot_token"
                                        value="{{ $transfer_bot->bot_token }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>
                                        chat_id
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="text" class="form-control" required name="chat_id"
                                        value="{{ $maintenance_bot->chat_id }}">
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
        <form action="{{ route('admin.setting.binding-telegram.bot-update',2) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="card col-md-7 mt-3">
                    <div class="card-header pb-0 p-3">
                        <h4 class="mb-0">اعدادات الربط مع مجموعة الصيانة</h4>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class=" col-12">
                                <div class="form-group">
                                    <label>
                                        bot_token
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="text" class="form-control" required name="bot_token"
                                        value="{{ $maintenance_bot->bot_token }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>
                                        chat_id
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="text" class="form-control" required name="chat_id"
                                        value="{{ $maintenance_bot->chat_id }}">
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
    </div> --}}
@endsection
