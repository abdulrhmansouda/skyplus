<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\TruePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('accountant.pages.setting-change-password');
    }

    public function update(Request $request)
    {
        // dd($request);
        $request->validate([
            'pre_password' => ['required', new TruePassword],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);
        // dd($request->all());
        $user = User::findOrFail(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->update();
        // dd(1);
        session()->flash('success', 'تم تعديل كلمة المرور بنجاح');

        return redirect()->back();
    }
}
