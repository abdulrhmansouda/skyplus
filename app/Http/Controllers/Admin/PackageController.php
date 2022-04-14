<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Exception;
use Illuminate\Http\Request;
use Mockery\Exception\InvalidOrderException;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->s) {
            $packages = Package::where('name', 'LIKE', "%$request->s%")->paginate(10);
        } else {
            $packages = Package::paginate(10);
        }
        return view('admin.pages.packages', [
            'packages' => $packages,
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string' ,'unique:packages','min:2','max:1000'],
            'price' => ['required','numeric'],
        ]);
        // dd($request->all());
        $package = new Package;
        $package->name = $request->name;
        $package->price = $request->price;
        $package->save();

        session()->flash('success','تم اضافة الباقة بنجاح');

        return redirect()->back();
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

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
        $request->validate([
            'name' => ['required','string' ,"unique:packages,name,$id",'min:2','max:1000'],
            'price' => ['required','numeric'],
        ]);
        // dd($request->all());

        $package = Package::findOrFail($id);
        $package->name = $request->name;
        $package->price = $request->price;
        $package->update();

        session()->flash('success','تم تعديل الباقة بنجاح');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $package->delete();
        session()->flash('success'," تم حذف الباقة $package->name بنجاح");
        // try {
        //     $package->delete();
        //     session()->flash('success'," تم حذف الباقة $package->name بنجاح");
        // } catch (Exception $e) {
        //     session()->flash('error',"لا يمكن حذف الباقة $package->name لوجود مشتركين لهذه الباقة");
        // }
 
        return redirect()->back();
    }
}
