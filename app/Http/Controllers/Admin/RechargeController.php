<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\Recharge;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RechargeController extends Controller
{
    public function index(Request $request)
    {

        $s = $request->s ?? '';

        $points = Point::where('status', 'active')->where('name', 'LIKE', "%$s%");

        return view('admin.pages.recharge', [
            'points' => $points->paginate(10),
            'search' => $s,
        ]);
    }

    public function charge(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'amount' => ['required', 'numeric'],
            'payment_method' => ['required', Rule::in(['cash', 'borrow', 'bank'])],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        // dd($request->all());

        $recharge = new Recharge;
        $point = Point::findOrFail($id);

        $recharge->point_id = $id;
        $recharge->amount = $request->amount;
        $recharge->payment_method = $request->payment_method;
        $recharge->note = $request->note;

        $recharge->save();
        $point->account = $point->account + $request->amount;
        $point->update();

        session()->flash('success', "تم شحن المبلغ $request->amount الى النقطة $point->name بنجاح");
        return redirect()->back();
    }
}
