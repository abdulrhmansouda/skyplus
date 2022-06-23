<?php

namespace App\Exports;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;

class AdminSubscribersExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {

        $sort_by = $this->request->sort_by;
        $page = $this->request->page ?? 1;
        $s = $this->request->s ?? '';
        $subs = Subscriber::where('name', 'LIKE', "%$s%")
            ->orWhere('t_c', 'LIKE', "%$s%")
            ->orWhere('sub_id', 'LIKE', "%$s%")
            ->orWhere('subscriber_number', 'LIKE', "%$s%")
            ->orWhere('phone', 'LIKE', "%$s%");

        $number_of_rows = $this->request->pagination_number ?? $subs->count();


        if ($sort_by) {
            $subs->orderBy($this->request->sort_by);
        }
        $subs = $subs->skip($number_of_rows * ($page - 1));
        $subs = $subs->take($number_of_rows)->get();

        $col = Collection::make([['sub_id', 'sub_username', 'name', 't_c', 'phone', 'subscriber_number', 'mother', 'address', 'installation_address','status', 'package_start','package_end', 'mission_executor', 'note', 'package_name', 'package_price', 'package_status']]);
        foreach ($subs as $sub) {
            $col->add([
                $sub->sub_id,
                $sub->sub_username,
                $sub->name,
                $sub->t_c,
                $sub->phone,
                $sub->subscriber_number,
                $sub->mother,
                $sub->address,
                $sub->installation_address,
                $sub->status,
                $sub->package_start,
                $sub->package_end,
                $sub->mission_executor,
                $sub->note,
                $sub->package->name,
                $sub->package->price,
                $sub->status,
            ]);
        }

        return $col;
    }
}
