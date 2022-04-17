<?php

namespace App\Models;

use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $with=[
        'package',
    ];

    public function package(){
        return $this->belongsTo(Package::class);
    }

    public function getPackageNameAttribute(){
        return $this->package->name;
    }

    public function getStateAttribute(){
        switch($this->status){
            case 'active': return 'نشط';
            case 'deactive': return 'غير نشط';
            case 'closed': return 'مغلق';
        }
    }

    public function getStartPackageAttribute(){
        return date_format(date_create($this->package_start), 'Y-m-d');
    }

    public function getEndPackageAttribute(){
        return date_format(date_create($this->package_end), 'Y-m-d');
    }

    public function getDaysToEndAttribute(){
        $d1 = new Carbon(now());
        $d2 = new Carbon($this->package_end);
        return $d1->diffInDays($d2,false);
    }

}
