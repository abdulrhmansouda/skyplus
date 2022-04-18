<?php

namespace App\Http\Controllers\Admin;

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

        if ($request->s) {
            $admins = Admin::where('name', 'LIKE', "%$request->s%")
                ->orWhere('t_c', 'LIKE', "%$request->s%")
                ->orWhere('phone', 'LIKE', "%$request->s%")
                ->paginate(10);
        } else {
            $admins = Admin::paginate(10);
        }
        return view('admin.pages.admins', [
            'admins' => $admins,
            'search' => $request->s,
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

        $user = new User;
            $user->username = $request->username;
            $user->role = 'admin';
            $user->password = Hash::make($request->password);

            $user->save();

            $admin = new Admin;

            $admin->name = $request->name;
            $admin->user_id = $user->id;
            $admin->t_c = $request->t_c;
            $admin->phone = $request->phone;
            // $admin->status = $request->status;

            $admin->save();

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
        // dd($request->all());
        $user = User::findOrFail($id);
        $admin = $user->admin;

        $user->username = $request->username;
        // $user->role = 'admin';
        $user->password = $request->password ? Hash::make($request->password) : $user->password;

        $user->update();

        // $admin = new Admin;

        $admin->name = $request->name;
        $admin->user_id = $user->id;
        $admin->t_c = $request->t_c;
        $admin->phone = $request->phone;
        $admin->status = $request->status;
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
        if ($admin->status !== 'closed') {
            $admin->status = 'closed';
            $admin->update();
            session()->flash('success', "تم اغلاق المشرف $admin->name بنجاح");
        } else {
            session()->flash('error', "المشرف $admin->name مغلق بالفعل!");
        }
        return redirect()->back();
    }
}
