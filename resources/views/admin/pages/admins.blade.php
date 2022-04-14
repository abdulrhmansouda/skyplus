@extends('admin.dashboard')

@section('title', 'المشرفين')

@section('content')
    <div class="container-fluid py-4">
        <!-- start add  -->
        <button type="button" class="btn bg-gradient-dark btn-sm" data-bs-toggle="modal" data-bs-target="#add">
            إنشاء
        </button>
        <!-- add Modal -->
        <form action="{{ route('admin.admins.store') }}" method="POST">
            @csrf
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">انشاء مشرف جديد</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class=" col-12">
                                    <div class="form-group">
                                        <label>
                                            اسم المشرف
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input name="name" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class=" col-12">
                                    <div class="form-group">
                                        <label>
                                            اسم المستخدم
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input name="username" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>
                                            كلمة المرور
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input name="password" type="password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>
                                             تأكيد كلمة المرور
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input name="password_confirmation" type="password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>
                                             هاتف
                                            <span class="text-danger"> * </span>
                                        </label>
                                        <input name="phone" type="tel" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>
                                              t_c
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
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">
                                            اسم المشرف</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            اسم المستخدم</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            هاتف</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                            t_c</th>

                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <h6 class="mb-0 text-sm">{{ $admin->name }}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $admin->user->username }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $admin->phone }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $admin->t_c }}</p>
                                            </td>

                                            <td class="align-middle ">
                                                <!-- start view1 -->
                                                <div class="d-inline-block">
                                                    <a href="javascript:;"
                                                        class="text-secondary font-weight-bold text-xs px-1 "
                                                        data-toggle="tooltip" data-original-title="view user"
                                                        data-bs-toggle="modal" data-bs-target="#view{{ $admin->id }}">
                                                        <i class="fas fa-eye fs-6"></i>
                                                    </a>
                                                    <!-- satrt view1 Modal -->
                                                    <div class="modal fade" id="view{{ $admin->id }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        عرض المشرف </h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class=" col-12">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    اسم المشرف
                                                                                </h6>
                                                                                {{ $admin->name }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    اسم المستخدم
                                                                                </h6>
                                                                                {{ $admin->user->username }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    هاتف
                                                                                </h6>
                                                                                {{ $admin->phone }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <h6>
                                                                                    t_c
                                                                                </h6>
                                                                                {{ $admin->t_c }}
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <span type="button" class="btn btn-info"
                                                                        data-bs-dismiss="modal">اغلاق</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end Modal view1  -->
                                                    </div>
                                                </div>
                                                <!-- end view1 -->
                                                <!-- start delete 1 -->
                                                <div class="d-inline-block">
                                                    <a href="javascript:;"
                                                        class="text-secondary font-weight-bold text-xs px-1 "
                                                        data-toggle="tooltip" data-original-title="Edit user"
                                                        data-bs-toggle="modal" data-bs-target="#delete{{ $admin->id }}">
                                                        <i class="fas fa-trash fs-6"></i>
                                                    </a>
                                                    <!--start delete Modal -->
                                                    <div class="modal fade" id="delete{{ $admin->id }}" tabindex="-1" role="dialog"
                                                        aria-labelledby="deleteLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header border-0 text-center pb-0">
                                                                    <h5 class="modal-title" id="deleteLabel ">هل
                                                                        تريد تأكيد حذف المشرف</h5>
                                                                </div>
                                                                <div class="modal-footer border-0">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">الغاء</button>
                                                                    <form action="{{ route('admin.admins.destroy',$admin->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-info">حذف</button>
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
