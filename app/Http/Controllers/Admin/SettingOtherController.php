<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectSetting;
use Illuminate\Http\Request;

class SettingOtherController extends Controller
{

    public function index()
    {
        return view('admin.pages.setting-other', [
            'maximum_amount_of_borrowing' => ProjectSetting::first()->maximum_amount_of_borrowing,
        ]);
    }

    public function update_maximum_amount_of_borrowing(Request $request)
    {
        $request->validate([
            'maximum_amount_of_borrowing' => ['required', 'numeric'],
        ]);

        $setting = ProjectSetting::firstOrFail();
        $setting->maximum_amount_of_borrowing = $request->maximum_amount_of_borrowing;
        $setting->update();

        session()->flash('success', 'تم تعديل الحد الاعلى المسموع بالدين بنجاح');
        return redirect()->back();
    }
}
