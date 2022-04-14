<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
// use App\Http\Middleware\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


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

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'min:2',],
            'username' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            't_c' => ['required', 'string ', 'min:11', 'max:11'],
            'phone' => ['required', 'string ', 'max:100'],
        ]);
        // dd(1);
        // $user = 

        Admin::create([
            'name' => $request->name,
            'user_id' => User::create([
                'username' => $request->username,
                'role' => 'admin',
                'password' => Hash::make($request->password),
            ])->id,
            't_c' => $request->t_c,
            'phone' => $request->phone,
        ]);

        session()->flash('success', 'تم انشاء المشرف بنجاح');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        if ($admin->user->isSuperAdmin()) {
            session()->flash('error', 'هذا حساب الsuper admin لا يمكن حذفه');
            return redirect()->back();
        }

        $user = User::findOrFail($admin->user_id);
        $admin->delete();
        $user->delete();

        session()->flash('success', "تم حذف المشرف $admin->name بنجاح");
        return redirect()->back();
    }
}
