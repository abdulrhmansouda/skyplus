<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $s = $request->s ?? '';

        $admins = Admin::where('name', 'LIKE', "%$s%")
            ->orWhere('t_c', 'LIKE', "%$s%")
            ->orWhere('phone', 'LIKE', "%$s%");

        return view('admin.pages.admins', [
            'admins' => $admins->paginate(10),
            'search' => $s,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {

        $user = User::create($request->validated()['user']);

        $admin = Admin::create(array_merge($request->validated()['admin'], ['user_id' => $user->id]));

        session()->flash('success', 'تم انشاء المشرف بنجاح');

        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->update();
        $admin = $user->admin;

        $admin->name    = $request->name;
        $admin->user_id = $user->id;
        $admin->t_c     = $request->t_c;
        $admin->phone   = $request->phone;
        $admin->status  = $request->status;

        $admin->update();

        session()->flash('success', 'تم تعديل المشرف بنجاح');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin->status = UserStatusEnum::CLOSED->value;
        $admin->update();
        session()->flash('success', "تم اغلاق المشرف $admin->name بنجاح");
        return redirect()->back();
    }
}
