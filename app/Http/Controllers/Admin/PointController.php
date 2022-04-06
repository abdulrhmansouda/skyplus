<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePointRequest;
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
    public function index()
    {
        return view('admin.pages.points',[
            'points' => Point::with('user')->paginate(10),
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
    public function store(StorePointRequest $request)
    {
        $point = new Point;
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $image = $request->file('image');
            $point->image = $image->store('points','images');
        }

        $point->user_id = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'role' => 'point',
            'password' => Hash::make($request->password),
        ])->id;

        $point->account = $request->account;

        $point->description = $request->description;

        $point->save();

        session()->flash('success' ,'تم أنشاء النقطة الجديدة بنجاح');

        return redirect(route('admin.points'));

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
    public function destroy(Point $point)
    {
        User::findOrFail($point->user_id)->delete();
        $point->delete();
        session()->flash('success','تم حذف النقطة بنجاح');
        return redirect(route('admin.points'));
    }
}