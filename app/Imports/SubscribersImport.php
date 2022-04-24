<?php

namespace App\Imports;

use App\Models\Package;
use App\Models\Subscriber;
use Exception;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SubscribersImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function collection(Collection $rows)
    {
        $subs = Subscriber::all()->pluck('subscriber_number')->toArray();
        $message = null;
        try {
            foreach ($rows->skip(1) as $row) {

                if (!in_array($row[6], $subs)) {
                    $pack = json_decode($row[16], true);
                    $pack_name = $pack['name'];

                    $package = Package::where('name', 'LIKE', "%$pack_name%")->first();
                    if (!isset($package)) {
                        $package = Package::create([
                            'name' => $pack['name'],
                            'price' => $pack['price'],
                        ]);
                    }
                    Subscriber::create([

                        'package_id' => $package->id,
                        'sub_id' => $row[2],
                        'name' => $row[3],
                        't_c' => $row[4],
                        'phone' => $row[5],
                        'subscriber_number' => $row[6],
                        'mother' => $row[7],
                        'address' => $row[8],
                        'installation_address' => $row[9],
                        'status' => $row[10],
                        'package_start' => $row[11],
                        'package_end' => $row[12],
                        'mission_executor' => $row[13],
                    ]);
                } else {
                    $message = $message . "\n" . $row[6];
                }
            }
            if ($message)
                session()->flash('error', "المشتركين اصاحاب الارقام التالية مضافين بالفعل$message");
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }
}
