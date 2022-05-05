<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePointRequest;
use App\Http\Requests\Admin\UpdatePointRequest;
use App\Models\Point;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $s = $request->s ?? '';
        $points = Point::join('users', 'users.id', '=', 'points.user_id')
            ->select('points.*', 'users.username')
            ->where('name', 'LIKE', "%$s%")
            ->orWhere('users.username', 'LIKE', "%$s%");

        // dd($points->get());
        return view('admin.pages.points', [
            'points' => $points->paginate(10),
            'search' => $s,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePointRequest $request)
    {
        // dd($request->all());
        $point = new Point;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $point->image = $image->store('points', 'images');
        }

        $point->user_id = User::create([
            'username' => $request->username,
            'role' => 'point',
            'password' => Hash::make($request->password),
        ])->id;

        if ($request->borrowing_is_allowed === 'ture') {
            $point->borrowing_is_allowed = true;
        }

        $point->name = $request->name;

        $point->account = $request->account;

        $point->charge_commission = $request->charge_commission;

        $point->new_commission = $request->new_commission;

        $point->switch_commission = $request->switch_commission;

        $point->t_c = $request->t_c;

        $point->phone = $request->phone;

        $point->address = $request->address;

        $point->save();

        session()->flash('success', 'تم أنشاء النقطة الجديدة بنجاح');

        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePointRequest $request, $id)
    {

        // dd($id);
        // dd($request->all());
        $point = Point::findOrFail($id);
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $point->image = $image->store('points', 'images');
        }

        $point->user->update([
            'username' => $request->username,
            'role' => 'point',
            'password' => is_null($request->password) ? $point->user->password : Hash::make($request->password),
        ]);

        if ($request->borrowing_is_allowed === 'true') {
            $point->borrowing_is_allowed = true;
        }

        if ($request->borrowing_is_allowed === 'false') {
            $point->borrowing_is_allowed = false;
        }

        $point->name = $request->name;

        $point->account = $request->account;

        $point->charge_commission = $request->charge_commission;

        $point->new_commission = $request->new_commission;

        $point->switch_commission = $request->switch_commission;

        $point->t_c = $request->t_c;

        $point->phone = $request->phone;

        $point->address = $request->address;

        $point->status = $request->status;


        $point->update();

        session()->flash('success', 'تم تعديل النقطة الجديدة بنجاح');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Point $point)
    {
        if ($point->status !== 'closed') {
            $point->status = 'closed';
            $point->update();
            session()->flash('success', "تم اغلاق النقطة $point->name بنجاح");
        } else {
            session()->flash('error', "النقطة $point->name مغلق بالفعل!");
        }
        return redirect()->back();
    }
}
