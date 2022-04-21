@extends('point.app')

@section('title', 'معلومات التواصل')

@section('content')

    <div class="py-4 container-fluid">
        <form action="">
            <div class="row">
                <div class="mt-3 card col-md-7">
                    <div class="card-header pb-0 p-3">
                        <h4 class="mb-0">معلومات التواصل</h4>
                    </div>
                    <div class="card-body p-3 information-user">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <i class="fas fa-globe fa-lg"></i>
                                    <a href="{{ $social->website }}" class="h5">{{ $social->website }}</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <i class="fab fa-facebook  fa-lg"></i>
                                    <a href="{{ $social->facebook_url }}" class="h5">{{ $social->facebook_name }}</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <i class="fab fa-whatsapp fa-lg"></i>
                                    <a href="https://wa.me/{{ $social->whatsapp }}" class="h5">{{ $social->whatsapp }}</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <i class="fas fa-mobile-alt fa-lg"></i>
                                    <a href="tel:{{ $social->phone1 }}" class="h5">{{ $social->phone1 }}</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <i class="fas fa-mobile-alt fa-lg"></i>
                                    <a href="tel:{{ $social->phone2 }}" class="h5">{{ $social->phone2 }}</a>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <i class="fas fa-at fa-lg"></i>
                                    <a href="mailto:{{ $social->email }}" class="h5">{{ $social->email }}</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <i class="fab fa-telegram fa-lg"></i>
                                    <a href="{{ $social->telegram_url }}" class="h5">{{ $social->telegram_name }}</a>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <h5>
                                        <i class="fas fa-map-marker-alt"></i>
                                        العنوان
                                    </h5>
                                    <p>
                                        {{ $social->address }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
