<?php

namespace App\Http\Controllers\Point;

use App\Http\Controllers\Controller;
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

        if ($request->s) {
            $subs = Subscriber::where('name', 'LIKE', "%$request->s%")
            ->orWhere('t_c', 'LIKE', "%$request->s%")
            ->orWhere('sub_id', 'LIKE', "%$request->s%")
            ->orWhere('subscriber_number', 'LIKE', "%$request->s%")
            ->orWhere('phone', 'LIKE', "%$request->s%")
            ->paginate(10);
        } else {
            $subs = Subscriber::paginate(10);
        }
        return view('point.pages.subscribers', [
            'subs' => $subs,
            // 'packages' => Package::all(),
            'search' => $request->s,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
