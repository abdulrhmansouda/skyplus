<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubscriberRequest;
use App\Models\Package;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->s){
            $subs = Subscriber::where('name','LIKE',"%$request->s%")->paginate(10);
        }
        else{
            $subs = Subscriber::paginate(10);
        }
        return view('admin.pages.subscribers',[
            'subs' => $subs,
            'packages' => Package::all(),
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
        $sub->subscribtion_date = $request->subscribtion_date;
        $sub->package_id = $request->package_id;
        $sub->status = $request->status;
        $sub->address = $request->address;
        $sub->installation_address = $request->installation_address;
        $sub->save();

        session()->flash('success' ,"تم اضافة المشترك $sub->name بنجاح");

        return redirect(route('admin.subscribers'));
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

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
                // dd($request->all());
                $sub = Subscriber::findOrFail($id);

                $sub->name = $request->name;
                $sub->t_c = $request->t_c;
                $sub->sub_id = $request->sub_id;
                $sub->subscriber_number = $request->subscriber_number;
                $sub->mother = $request->mother;
                $sub->phone = $request->phone;
                $sub->subscribtion_date = $request->subscribtion_date;
                $sub->package_id = $request->package_id;
                $sub->status = $request->status;
                $sub->address = $request->address;
                $sub->installation_address = $request->installation_address;
                $sub->update();
        
                session()->flash('success' ,"تم تعديل المشترك $sub->name بنجاح");
        
                return redirect(route('admin.subscribers'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $subscriber)
    {
        // $subscriber->delete();
        $subscriber->status = 'closed';
        $subscriber->update();
        session()->flash('success',"تم اغلاق المشترك $subscriber->name بنجاح");
        return redirect(route('admin.subscribers'));
    }
}
