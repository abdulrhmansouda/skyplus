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

        $pagination_number = $this->request->pagination_number ?? $subs->count();


        if ($sort_by) {
            $subs->orderBy($this->request->sort_by);
        }

        $subs = $subs->take($pagination_number);
        $col = new Collection([Schema::getColumnListing('subscribers')]);
        $col = $col->merge($subs->get()->toArray());
        return $col;
    }
}
