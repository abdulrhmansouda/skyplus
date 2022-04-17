<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $subs;

    public function __construct($subs){
        $this->subs = $subs;
    }

    public function collection()
    {
        return $this->subs->get();
    }
}
