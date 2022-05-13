<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePackageRequest;
use App\Http\Requests\Admin\UpdatePackageRequest;
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
        $s = $request->s ?? '';
        
            $packages = Package::where('name', 'LIKE', "%$s%");

        return view('admin.pages.packages', [
            'packages' => $packages->paginate(10),
            'search' => $s,
        ]);
    }

    public function pricePackageApi()
    {
        $id = request()->id ?? '';

        $package_price = Package::findOrFail($id)->price;
        
            // $packages = Package::where('name', 'LIKE', "%$s%");

        return response()
        ->json([
            'package_price' => $package_price, 
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePackageRequest $request)
    {

        $package = new Package;
        $package->name = $request->name;
        $package->price = $request->price;

        $package->save();

        session()->flash('success','تم اضافة الباقة بنجاح');

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackageRequest $request, $id)
    {

        $package = Package::findOrFail($id);
        $package->name = $request->name;
        $package->price = $request->price;
        $package->status = $request->status;

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
        if ($package->status !== 'closed') {
            $package->status = 'closed';
            $package->update();
            session()->flash('success', "تم اغلاق الباقة $package->name بنجاح");
        } else {
            session()->flash('error', "الباقة $package->name مغلق بالفعل!");
        }
        return redirect()->back();
    }
}
