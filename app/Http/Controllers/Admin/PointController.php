<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRoleEnum;
use App\Enums\UserStatusEnum;
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

        return view('admin.pages.points', [
            'points' => $points->paginate(10),
            'search' => $s,
        ]);
    }

    public function searchNameApi()
    {
        $search = request()->name ?? '';
        $points = Point::select('id', 'name')->without('user')->where('name', 'LIKE', "%$search%")->take(10)->get();

        return response()
            ->json(['points' => $points]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePointRequest $request)
    {
        $point = new Point;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $point->image = $image->store('points', 'images');
        }
        $point->user_id = User::create([
            'username'  => $request->username,
            'role'      => UserRoleEnum::POINT->value,
            'password'  => Hash::make($request->password),
        ])->id;
        $point->name = $request->name;
        $point->account = $request->account;
        $point->charge_commission = $request->charge_commission;
        $point->new_commission = $request->new_commission;
        $point->switch_commission = $request->switch_commission;
        $point->t_c = $request->t_c;
        $point->phone = $request->phone;
        $point->address = $request->address;
        $point->maximum_debt_limit = $request->maximum_debt_limit;
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

        $point = Point::findOrFail($id);
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $point->image = $image->store('points', 'images');
        }

        $point->user->update([
            'username' => $request->username,
            'role' => UserRoleEnum::POINT->value,
            'password' => is_null($request->password) ? $point->user->password : Hash::make($request->password),
        ]);

        $point->name = $request->name;
        $point->account = $request->account;
        $point->charge_commission = $request->charge_commission;
        $point->new_commission = $request->new_commission;
        $point->switch_commission = $request->switch_commission;
        $point->t_c = $request->t_c;
        $point->phone = $request->phone;
        $point->address = $request->address;
        // $point->status = $request->status;
        $point->maximum_debt_limit = $request->maximum_debt_limit;

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
        $point->status = UserStatusEnum::CLOSED->value;
        $point->update();
        session()->flash('success', "تم اغلاق النقطة $point->name بنجاح");
        return redirect()->back();
    }
}
