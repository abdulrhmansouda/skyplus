<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\Recharge;
use App\Models\Report;
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
        $amount = $request->amount;

        $recharge = new Recharge;
        $point = Point::findOrFail($id);

        $recharge->point_id = $id;
        $recharge->amount = $amount;
        $recharge->payment_method = $request->payment_method;
        $recharge->note = $request->note;

        $recharge->save();
        $pre_account = $point->account;
        $point->account = $point->account + $amount;
        $point->update();

        //make a report
        $report_message = "تم شحن الرصيد بقيمة $amount للنقطة $point->name طرقة الدفع : $request->payment_method.";
            $report = Report::create([
                'point_id' => $point->id,
                'report' => $report_message,
                'on_him' => 0,
                'to_him' => $amount,
                'pre_account' => $pre_account,
                'type' => 'charge_point',
            ]);

        session()->flash('success', "تم شحن المبلغ $amount الى النقطة $point->name بنجاح");
        return redirect()->back();
    }
}
