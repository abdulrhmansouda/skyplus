<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SubscribersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubscriberRequest;
use App\Http\Requests\Admin\UpdateSubscriberRrequest;
use App\Models\Package;
use App\Models\Subscriber;
use Exception;
use Illuminate\Database\QueryException;
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

        $pagination_number = $request->pagination_number ?? 10;
        $sort_by = $request->sort_by ?? 'name';
        $page = $request->page ?? 1;
        $s = $request->s ?? '';
        $subs = Subscriber::where('name', 'LIKE', "%$request->s%")
            ->orWhere('t_c', 'LIKE', "%$request->s%")
            ->orWhere('sub_id', 'LIKE', "%$request->s%")
            ->orWhere('subscriber_number', 'LIKE', "%$request->s%")
            ->orWhere('phone', 'LIKE', "%$request->s%");

        if ($request->sort_by) {
                $subs->orderBy($request->sort_by);
        }


        return view('admin.pages.subscribers', [
            'subs' => $subs->paginate($request->pagination_number)
            ->appends(['pagination_number' => $pagination_number,'sort_by' => $sort_by]),
            'packages' => Package::all(),
            'search' => $s ,
            'page' => $page ,
            'pagination_number' => $pagination_number ,
            'sort_by' => $sort_by,
        ]);
    }

    public function export(Request $request)
    {
        // dd($request->all());
        $pagination_number = $request->pagination_number ?? 10;
        $sort_by = $request->sort_by ?? 'name';
        $page = ( $request->page -1 ) ?? 1;
        $subs = Subscriber::orderBy($sort_by)->skip($page * $pagination_number)
        ->take($pagination_number);
        $export = new SubscribersExport($subs);
        return Excel::download($export, 'subscribers.xlsx');
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
        $sub->mission_executor = $request->mission_executor;
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
        $sub->mission_executor = $request->mission_executor;
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
            session()->flash('error', "المشترك $subscriber->name مغلق بالفعل!");
        }
        return redirect()->back();
    }
}
