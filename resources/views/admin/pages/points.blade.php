@extends('admin.dashboard')


@section('title', 'نقاط البيع')

@section('content')
<div class="py-4 container-fluid">
    <!-- start add  -->
    <button type="button" class="btn bg-gradient-dark btn-sm" data-bs-toggle="modal" data-bs-target="#add">
        إضافة
    </button>
    <!-- add Modal -->
    <form action="{{ route('admin.points.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">إضافة نقطة بيع</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="img" class="w-100">الصورة
                                        <input type="file" class="form-control d-none" id="img" name="image" onchange="readURL(this);">
                                        <img src="{{ asset('/assets/img/add.png') }}" alt="pos image" class="mx-auto border rounded-circle d-block" width="150">
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>اسم المستخدم
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="text" class="form-control" placeholder="ادخل الاسم المستخدم" name="username" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>الاسم
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="text" class="form-control" placeholder="ادخل الاسم" name="name" required>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>كلمة المرور
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="password" class="form-control" placeholder="ادخل كلمة المرور" name="password" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        T.C
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="number" class="form-control" required placeholder="ادخل ال T.C" name="t_c">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        رقم الهاتف
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="tel" class="form-control" placeholder="ادخل رقم الهاتف" required name="phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>الرصيد
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="number" class="form-control" placeholder="ادخل الرصيد" name="account" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        العمولة
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="number" class="form-control" required placeholder="الادخال بالنسبة المؤية مثلا 1" name="commission" step="0.01">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>العنوان</label>
                                    <textarea class="form-control" rows="3" name="address" placeholder="ادخل العنوان"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" value="true" id="isReligion" checked="" name="borrowing_is_allowed">
                                    <label class="form-check-label" for="isReligion">مسموح الدين</label>
                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">حفظ</button>
                        <span class="btn btn-secondary" data-bs-dismiss="modal">الغاء</span>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end add  -->
    <div class="row">
        <div class="col-12">
            <div class="mb-4 card">
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
                                        صاحب النقطة</th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        اسم النقطة</th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        العمولة</th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        رقم الهاتف</th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        T.C</th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($points as $point)
                                <tr>
                                    <td>
                                        <div class="px-2 py-1 d-flex">
                                            <div>
                                                <img src="{{ $point->imageUrl }}" class="avatar avatar-sm ms-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $point->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $point->user->username }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $point->commission }}%</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $point->phone }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $point->t_c }}</p>
                                    </td>


                                    <td class="align-middle ">
                                        <!-- start view1 -->
                                        <div class="d-inline-block">
                                            <a href="javascript:;" class="px-1 text-xs text-secondary font-weight-bold " data-toggle="tooltip" data-original-title="view user" data-bs-toggle="modal" data-bs-target="#view{{ $point->id }}"><i class="fas fa-eye fs-6"></i></a>

                                            <!-- satrt view1 Modal -->
                                            <div class="modal fade" id="view{{ $point->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered " role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">
                                                                عرض</h5>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <h6 class="w-100">الصورة
                                                                            <img src="{{ $point->imageUrl }}" alt="pos image" class="mx-auto border rounded-circle d-block" width="150">
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <h6>اسم المستخدم
                                                                        </h6>
                                                                        {{ $point->user->username }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>الاسم
                                                                        </h6>
                                                                        {{ $point->name }}
                                                                    </div>

                                                                </div>


                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            T.C
                                                                        </h6>
                                                                        {{ $point->t_c }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            رقم الهاتف
                                                                        </h6>
                                                                        {{ $point->phone }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>الرصيد
                                                                        </h6>
                                                                        {{ $point->account }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            العمولة
                                                                        </h6>
                                                                        {{ $point->commission }}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <h6>العنوان</h6>
                                                                        <p>{{ $point->address }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <h6>مسموح الدين</h6>
                                                                    {{ ($point->borrowing_is_allowed)? 'نعم' : 'لا' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <span class="btn btn-info" data-bs-dismiss="modal">اغلاق</span>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                        <!-- </div> -->
                                        <!-- end Modal view1  -->
                                        <!-- end view1 -->
                                        <!-- start edit 1 -->
                                        <div class="d-inline-block">
                                            <a href="javascript:;" class="px-1 text-xs text-secondary font-weight-bold " data-toggle="tooltip" data-original-title="Edit user" data-bs-toggle="modal" data-bs-target="#edit{{ $point->id }}">
                                                <i class="fas fa-edit fs-6"></i>
                                            </a>
                                            <!-- satrt edit Modal -->
                                            <form action="{{ route('admin.points.update', $point->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal fade" id="edit{{ $point->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">
                                                                    تعديل </h5>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="img{{ $point->id }}" class="w-100">الصورة
                                                                                <input type="file" class="form-control d-none" id="img{{ $point->id }}" name="image" onchange="readURL(this);">
                                                                                <img src="{{ $point->image ? $point->imageUrl : asset('images/no_image.webp') }}" alt="pos image" class="object-cover mx-auto border rounded-circle d-block" width="150" height="150">
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label>اسم المستخدم
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <input type="text" class="form-control" placeholder="ادخل الاسم المستخدم" name="username" value="{{ $point->user->username }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>الاسم
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <input type="text" class="form-control" placeholder="ادخل الاسم" name="name" value="{{ $point->name }}" required>
                                                                        </div>

                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>كلمة المرور
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <input type="password" class="form-control" placeholder="ادخل كلمة المرور الجديدة" name="password">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                T.C
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <input type="number" class="form-control" required placeholder="ادخل ال T.C" value="{{ $point->t_c }}"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                رقم الهاتف
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <input type="tel" class="form-control" placeholder="ادخل رقم الهاتف" required value="{{ $point->phone }}"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>الرصيد
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <input type="number" class="form-control" placeholder="ادخل الرصيد" name="account" value="{{ $point->account }}" required/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                العمولة
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <input type="number" class="form-control" required placeholder="الادخال بالنسبة المؤية مثلا 1"name="commission" value="{{ $point->commission }}"  step="0.01" >
                                                                            
                                                                        </div>
                                                                    </div>



                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label>العنوان</label>
                                                                            <textarea class="form-control" rows="3" name="description" placeholder="ادخل العنوان">{{ $point->address }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <input class="form-check-input" type="checkbox" value="true" id="isReligion{{ $point->id }}" @if($point->borrowing_is_allowed)checked="" @endif>
                                                                            <label class="form-check-label" for="isReligion{{ $point->id }}">مسموح
                                                                                الدين</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-info">تعديل</button>
                                                                <span class="btn btn-secondary" data-bs-dismiss="modal">الغاء</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- end Modal edit  -->

                                        <!-- start delete 1 -->
                                        <div class="d-inline-block">
                                            <a href="javascript:;" class="px-1 text-xs text-secondary font-weight-bold " data-toggle="tooltip" data-original-title="Edit user" data-bs-toggle="modal" data-bs-target="#delete{{ $point->id }}">
                                                <i class="fas fa-trash fs-6"></i>
                                            </a>
                                            <!--start delete Modal -->
                                            <div class="modal fade" id="delete{{ $point->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="pb-0 text-center border-0 modal-header">
                                                            <h5 class="modal-title" id="deleteLabel ">
                                                                هل انت متأكد من أنك تريد حذف
                                                                <strong>النقطة {{ $point->name }}
                                                                </strong>
                                                            </h5>
                                                        </div>
                                                        <div class="border-0 modal-footer">
                                                            <form action="{{ route('admin.points.destroy', $point->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-info">حذف</button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end delete Modal -->
                                        </div>
                                        <!-- end delete -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!-- start pagination -->

        {{ $points->links() }}
        <!-- end pagination -->
    </div>
</div>
@endsection

@section('js')
<!--   Core JS Files   -->
<script src="{{ asset('/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('/assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<script src="{{ asset('/assets/js/plugins/fullcalendar.min.js') }}"></script>
<script src="{{ asset('/assets/js/plugins/chartjs.min.js') }}"></script>
<script src="{{ asset('/assets/js/plugins/choices.min.js') }}"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('/assets/js/soft-ui-dashboard.js') }}"></script>
@endsection