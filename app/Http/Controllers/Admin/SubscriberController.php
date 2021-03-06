<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserStatusEnum;
use App\Exports\AdminSubscribersExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TelegramController;
use App\Http\Requests\Admin\StoreSubscriberRequest;
use App\Http\Requests\Admin\UpdateSubscriberRrequest;
use App\Imports\AdminSubscribersImport;
use App\Imports\SubscribersImport;
use App\Models\Package;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $sort_by = $request->sort_by;
        $page = $request->page ?? 1;
        $s = $request->s ?? '';
        $subs = Subscriber::where('name', 'LIKE', "%$s%")
            ->orWhere('t_c', 'LIKE', "%$s%")
            ->orWhere('sub_id', 'LIKE', "%$s%")
            ->orWhere('subscriber_number', 'LIKE', "%$s%")
            ->orWhere('phone', 'LIKE', "%$s%");

        $pagination_number = $request->pagination_number ?? $subs->count();


        if ($sort_by) {
            $subs->orderBy($request->sort_by);
        }


        return view('admin.pages.subscribers', [
            'subs' => $subs->paginate($pagination_number)
                ->appends(['pagination_number' => $pagination_number, 'sort_by' => $sort_by, 's' => $s]),
            'packages' => Package::all(),
            'search' => $s,
            'page' => $page,
            'pagination_number' => $pagination_number,
            'sort_by' => $sort_by,
        ]);
        return redirect()->back()->with('success', ' تم التصدير بنجاح');
    }


    public function export(Request $request)
    {
        $export = new AdminSubscribersExport($request);
        $now = now();
        return Excel::download($export, "subscribers_$now.xlsx");
    }

    public function import(Request $request)
    {
        Excel::import(new AdminSubscribersImport, public_path('temp') . '/' . $request->file('subscribers')->store('excel', 'temp'));
        return redirect()->back()->with('success', ' تم الاستيراد بنجاح');
    }

    public function charge(Request $request, $id)
    {
        $request->validate([
            'days' => ['required', 'numeric',],
        ]);

        $days = $request->days;

        $sub = Subscriber::findOrFail($id);
        $message_telegram = "
        تم إضافة أيام من Super Admin

        للمشترك: {$sub->sub_username}

        عدد الأيام: {$days}
  
        http://192.168.106.24/issmanager/kullanici_detay&{$sub->sub_id}#tab2

        ➕➕➕➕➕➕➕➕➕➕➕➕";

        // العمليات المهمة جداً
        DB::transaction(function () use ($sub, $days, $message_telegram) {
            $sub->payDays($days);
            TelegramController::chargeMessage($message_telegram);
        }, 5);

        session()->flash('success', "تم اضافة $days يوم من قبل الspueradmin بنجاح");

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubscriberRequest $request)
    {
        $sub = Subscriber::create($request->validated());

        session()->flash('success', "تم اضافة المشترك $sub->name بنجاح");

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubscriberRrequest $request, $id)
    {
        // dd($request->all());
        $sub = Subscriber::findOrFail($id);
        $sub->update($request->validated());

        session()->flash('success', "تم تعديل المشترك $sub->name بنجاح");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $subscriber)
    {
        // if ($subscriber->status != 'closed') {
        $subscriber->status = UserStatusEnum::CLOSED->value;
        $subscriber->update();
        session()->flash('success', "تم اغلاق المشترك $subscriber->name بنجاح");
        // } else {
        //     session()->flash('error', "المشترك $subscriber->name مغلق بالفعل!");
        // }
        return redirect()->back();
    }
}
