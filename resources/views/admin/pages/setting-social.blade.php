@extends('admin.dashboard')

@section('title', 'الاعدادات - مهلومات التواصل')

@section('content')

    <div class="container-fluid py-4">
        <form action="{{ route('admin.setting.social.update') }}" method="POST">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="card col-md-7 mt-3">
                    <div class="card-header pb-0 p-3">
                        <h4 class="mb-0">اعدادات التواصل</h4>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class=" col-12">
                                <div class="form-group">
                                    <label>
                                        رابط موقع الويب
                                    </label>
                                    <input name="website" type="url" class="form-control" value="{{ $social->website }}"
                                        placeholder="https://example.com" dir="auto">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        رقم تواصل 1
                                    </label>
                                    <input name="phone1" type="tel" class="form-control" placeholder="00901234567891" dir="auto" value="{{ $social->phone1 }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        رقم تواصل 2
                                    </label>
                                    <input name="phone2" type="tel" class="form-control" placeholder="00901234567891" dir="auto" value="{{ $social->phone2 }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        الايميل
                                    </label>
                                    <input name="email" type="email" class="form-control" placeholder="example@gmail.com" dir="auto" value="{{ $social->email }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        رقم الواتساب
                                    </label>
                                    <input name="whatsapp" type="tel" class="form-control" value="00905312882165"
                                        placeholder="00901234567891" dir="auto" value="{{ $social->whatsapp }}">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        اسم صفحة الفيس
                                    </label>
                                    <input name="facebook_name" type="text" class="form-control" placeholder="facePage" dir="auto" value="{{ $social->facebook_name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        رابط صفحة الفيس
                                    </label>
                                    <input name="facebook_url" type="url" class="form-control" dir="auto"
                                        placeholder="https://www.facebook.com/facePage" value="{{ $social->facebook_url }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        اسم قناة التلغرام
                                    </label>
                                    <input name="telegram_name" type="text" class="form-control" placeholder="@telegramPage" dir="auto" value="{{ $social->telegram_name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        رابط قناة التلغرام
                                    </label>
                                    <input name="telegram_url" type="url" class="form-control" placeholder="https://t.me/telegramPage"
                                        dir="auto" value="{{ $social->telegram_url }}">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>
                                        العنوان
                                    </label>
                                    <textarea name="address" type="text" class="form-control"
                                        dir="auto">{{ $social->address }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info me-auto ms-0 d-block">تعديل</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

