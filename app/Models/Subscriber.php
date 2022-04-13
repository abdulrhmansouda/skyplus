<?php

namespace App\Models;

use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    public function package(){
        return $this->belongsTo(Package::class);
    }

    public function getStartPackageAttribute(){
        return date_format(date_create($this->package_start), 'd/m/Y');
    }

    public function getEndPackageAttribute(){
        return date_format(date_create($this->package_end), 'd/m/Y');
    }

    public function getDaysToEndAttribute(){
        $d1 = new Carbon(now());
        $d2 = new Carbon($this->package_end);
        return $d1->diffInDays($d2,false);
    }

}
