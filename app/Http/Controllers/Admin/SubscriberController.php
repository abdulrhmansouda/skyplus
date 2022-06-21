<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserStatusEnum;
use App\Exports\SubscribersExport;
// use App\Helper\Script;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TelegramController;
use App\Http\Requests\Admin\StoreSubscriberRequest;
use App\Http\Requests\Admin\UpdateSubscriberRrequest;
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
        $sort_by = $request->sort_by;
        $page = ($request->page - 1) ?? 1;
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
        $subs = Subscriber::skip($page * $pagination_number)
            ->take($pagination_number);
        $export = new SubscribersExport($subs);
        $now = now();
        return Excel::download($export, "subscribers_$now.xlsx");
    }

    public function import(Request $request)
    {
        Excel::import(new SubscribersImport, $request->file('subscribers')->getRealPath());
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
        // dd($request->all());
        // $sub = new Subscriber;

        // $sub->name = $request->name;
        // $sub->t_c = $request->t_c;
        // $sub->sub_id = $request->sub_id;
        // $sub->sub_username = $request->sub_username;
        // $sub->subscriber_number = $request->subscriber_number;
        // $sub->mother = $request->mother;
        // $sub->phone = $request->phone;
        // $sub->package_start = $request->package_start;
        // $sub->package_end = $request->package_start;
        // $sub->package_id = $request->package_id;
        // $sub->status = $request->status;
        // $sub->address = $request->address;
        // $sub->installation_address = $request->installation_address;
        // $sub->mission_executor = $request->mission_executor;
        // $sub->note = $request->note;
        // $sub->save();
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

        // $sub->name = $request->name;
        // $sub->t_c = $request->t_c;
        // $sub->sub_id = $request->sub_id;
        // $sub->sub_username = $request->sub_username;
        // $sub->subscriber_number = $request->subscriber_number;
        // $sub->mother = $request->mother;
        // $sub->phone = $request->phone;
        // $sub->package_start = $request->package_start;
        // $sub->package_end = $request->package_start;
        // $sub->package_id = $request->package_id;
        // $sub->status = $request->status;
        // $sub->address = $request->address;
        // $sub->installation_address = $request->installation_address;
        // $sub->mission_executor = $request->mission_executor;
        // $sub->note = $request->note;
        // $sub->update();
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
        // if ($subscriber->status !== 'closed') {
            $subscriber->status = UserStatusEnum::CLOSED->value;
            $subscriber->update();
            session()->flash('success', "تم اغلاق المشترك $subscriber->name بنجاح");
        // } else {
        //     session()->flash('error', "المشترك $subscriber->name مغلق بالفعل!");
        // }
        return redirect()->back();
    }
}
