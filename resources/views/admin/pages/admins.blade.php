@extends('admin.dashboard')

@section('title', 'المشرفين')

@section('content')
<div class="py-4 container-fluid">
    <!-- start add  -->
    <button type="button" class="btn bg-gradient-dark btn-sm" data-bs-toggle="modal" data-bs-target="#add">
        إنشاء
    </button>
    <!-- add Modal -->
    <form action="{{ route('admin.admins.store') }}" method="POST">
        @csrf
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">انشاء مشرف جديد</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class=" col-md-6">
                                <div class="form-group">
                                    <label>
                                        اسم المشرف
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input name="name" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class=" col-md-6">
                                <div class="form-group">
                                    <label>
                                        اسم المستخدم
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input name="username" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        كلمة المرور
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input name="password" type="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        تأكيد كلمة المرور
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input name="password_confirmation" type="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        هاتف
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input name="phone" type="tel" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        T.C
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input name="t_c" type="number" class="form-control" required>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">حفظ</button>
                        <span type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</span>
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
                                        اسم المشرف</th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        اسم المستخدم</th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        هاتف</th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        T.C </th>
                                        <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        الحالة</th>
                                    <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                <tr>
                                    <td>
                                        <div class="px-2 py-1 d-flex">
                                            <h6 class="mb-0 text-sm">{{ $admin->name }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $admin->user->username }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $admin->phone }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-xs font-weight-bold">{{ $admin->t_c }}</p>
                                    </td>
                                    <td class="text-sm align-middle">
                                        {{-- @if ($admin->status == 'active')
                                        <span class="badge badge-sm bg-gradient-success">مفعل</span>
                                        @else
                                        <span class="badge badge-sm bg-gradient-danger">مغلق</span>
                                        @endif                                    </td> --}}
                                        {!! $admin->status() !!}
                                    <td class="align-middle ">
                                        <!-- start view1 -->
                                        <div class="d-inline-block">
                                            <a href="javascript:;" class="px-1 text-xs text-secondary font-weight-bold " data-toggle="tooltip" data-original-title="view user" data-bs-toggle="modal" data-bs-target="#view{{ $admin->id }}">
                                                <i class="fas fa-eye fs-6"></i>
                                            </a>
                                            <!-- satrt view1 Modal -->
                                            <div class="modal fade" id="view{{ $admin->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                عرض المشرف </h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class=" col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            اسم المشرف
                                                                        </h6>
                                                                        {{ $admin->name }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            اسم المستخدم
                                                                        </h6>
                                                                        {{ $admin->user->username }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            هاتف
                                                                        </h6>
                                                                        {{ $admin->phone }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            T.C
                                                                        </h6>
                                                                        {{ $admin->t_c }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <h6>
                                                                            حالة المستخدم
                                                                        </h6>
                                                                        {{-- @if ($admin->status == 'active')
                                                                        <span class="badge badge-sm bg-gradient-success">مفعل</span>
                                                                        @else
                                                                        <span class="badge badge-sm bg-gradient-danger">مغلق</span>
                                                                        @endif                                                                            </div> --}}
                                                                        {!! $admin->status() !!}
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <span type="button" class="btn btn-info" data-bs-dismiss="modal">اغلاق</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end Modal view1  -->
                                            </div>
                                        </div>
                                        <!-- end view1 -->
                                        <!-- start edit  -->
                                        <div class="d-inline-block">
                                            <a href="javascript:;" class="px-1 text-xs text-secondary font-weight-bold " data-toggle="tooltip" data-original-title="Edit user" data-bs-toggle="modal" data-bs-target="#edit{{ $admin->id }}">
                                                <i class="fas fa-edit fs-6" aria-hidden="true"></i>
                                            </a>
                                            <!-- satrt edit Modal -->
                                            <form action="{{ route('admin.admins.update',$admin->user->id)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="id" value="{{ $admin->user->id }}">
                                                <div class="modal fade" id="edit{{ $admin->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">
                                                                    تعديل </h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class=" col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                اسم المشرف
                                                                                <span class="text-danger"> * </span>
                                                                            </label>
                                                                            <input name="name" type="text" class="form-control" required value="{{ $admin->name }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class=" col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                اسم المستخدم
                                                                                <span class="text-danger"> * </span>
                                                                            </label>
                                                                            <input name="username" type="text" class="form-control" required value="{{ $admin->user->username }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                كلمة المرور
                                                                                {{-- <span class="text-danger"> * </span> --}}
                                                                            </label>
                                                                            <input name="password" type="password" class="form-control" >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                هاتف
                                                                                <span class="text-danger"> * </span>
                                                                            </label>
                                                                            <input name="phone" type="tel" class="form-control" required value="{{ $admin->phone }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                T.C
                                                                                <span class="text-danger"> * </span>
                                                                            </label>
                                                                            <input name="t_c" type="number" class="form-control" required value="{{ $admin->t_c }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                حالة المستخدم
                                                                                <span class="text-danger"> *
                                                                                </span>
                                                                            </label>
                                                                            <select required class="form-select" name="status">
                                                                                <option value="{{ App\Enums\UserStatusEnum::ACTIVE->value }}" @if($admin->status == App\Enums\UserStatusEnum::ACTIVE->value) selected @endif> مفعل</option>
                                                                                <option value="{{ App\Enums\UserStatusEnum::CLOSED->value }}" @if($admin->status == App\Enums\UserStatusEnum::CLOSED->value) selected @endif>مفلق</option>
                                                                            </select>
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
                                        <!-- end edit  -->
                                        <!-- start delete 1 -->
                                        <div class="d-inline-block">
                                            <a href="javascript:;" class="px-1 text-xs text-secondary font-weight-bold " data-toggle="tooltip" data-original-title="Edit user" data-bs-toggle="modal" data-bs-target="#delete{{ $admin->id }}">
                                                <i class="fas fa-ban fs-6"></i>
                                            </a>
                                            <!--start delete Modal -->
                                            <div class="modal fade" id="delete{{ $admin->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="pb-0 text-center border-0 modal-header">
                                                            <h5 class="modal-title" id="deleteLabel ">هل
                                                                تريد تأكيد ايقاف 
                                                                <strong>المشرف {{ $admin->name }}
                                                                </strong>
                                                            </h5>
                                                                
                                                        </div>
                                                        <div class="border-0 modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                                                            <form action="{{ route('admin.admins.destroy',$admin->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-info">ايقاف</button>
                                                            </form>
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
            <!-- start pagination -->
            {{ $admins->links() }}
            <!-- end pagination -->
        </div>
    </div>
</div>
@endsection