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

        $s = $request->s ?? '';

            $subs = Subscriber::where('t_c', "$s")
            ->orWhere('subscriber_number',"$s")
            ->orWhere('phone', "$s");

            // if($subs->get()->first())
            // dd($subs->get()->first());

            // where('t_c', 'LIKE', "%$s%")
            // // ->orWhere('name', 'LIKE', "%$s%")
            // // ->orWhere('sub_id', 'LIKE', "%$s%")
            // ->orWhere('subscriber_number', 'LIKE', "%$s%")
            // ->orWhere('phone', 'LIKE', "%$s%");

        return view('point.pages.subscribers', [
            'subs' => $subs->get(),
            // 'packages' => Package::all(),
            'search' => $s,
        ]);

    }


    public function charge(){
        
    }

}
