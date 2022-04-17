<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubscriberRequest;
use App\Http\Requests\Admin\UpdateSubscriberRrequest;
use App\Models\Package;
use App\Models\Subscriber;
use Illuminate\Http\Request;
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
// dd($request->all());
        if ($request->s) {
            $subs = Subscriber::where('name', 'LIKE', "%$request->s%")
            ->orWhere('t_c', 'LIKE', "%$request->s%")
            ->orWhere('sub_id', 'LIKE', "%$request->s%")
            ->orWhere('subscriber_number', 'LIKE', "%$request->s%")
            ->orWhere('phone', 'LIKE', "%$request->s%")
            ->paginate($request->pagination_number);
        } else {
            $subs = Subscriber::paginate($request->pagination_number);
        }
        return view('admin.pages.subscribers', [
            'subs' => $subs,
            'packages' => Package::all(),
            'search' => $request->s,
            'page' => $request->page ?? 1,
            'pagination_number' => $request->pagination_number ?? 10,
        ]);
    }

    public function export(Request $request){
        // dd($request->all());
        $subs = Subscriber::skip($request->page*$request->pagination_number)->take($request->pagination_number);
        $export = new UsersExport($subs);
        return Excel::download($export,'subscribers.xlsx');
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
        $sub = new Subscriber;

        $sub->name = $request->name;
        $sub->t_c = $request->t_c;
        $sub->sub_id = $request->sub_id;
        $sub->subscriber_number = $request->subscriber_number;
        $sub->mother = $request->mother;
        $sub->phone = $request->phone;
        $sub->package_start = $request->package_start;
        $sub->package_end = $request->package_start;
        $sub->package_id = $request->package_id;
        $sub->status = $request->status;
        $sub->address = $request->address;
        $sub->installation_address = $request->installation_address;
        $sub->save();

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
        $sub = Subscriber::findOrFail($id);

        $sub->name = $request->name;
        $sub->t_c = $request->t_c;
        $sub->sub_id = $request->sub_id;
        $sub->subscriber_number = $request->subscriber_number;
        $sub->mother = $request->mother;
        $sub->phone = $request->phone;
        $sub->package_start = $request->package_start;
        $sub->package_end = $request->package_start;
        $sub->package_id = $request->package_id;
        $sub->status = $request->status;
        $sub->address = $request->address;
        $sub->installation_address = $request->installation_address;
        $sub->update();

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
        if ($subscriber->status !== 'closed') {
            $subscriber->status = 'closed';
            $subscriber->update();
            session()->flash('success', "تم اغلاق المشترك $subscriber->name بنجاح");
        } else {
            session()->flash('success', "المشترك $subscriber->name مغلق بالفعل!");
        }
        return redirect()->back();
    }
}
