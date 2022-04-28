<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function point()
    {
        return $this->belongsTo(Point::class);
    }

    public function getTypeReportAttribute(){
        switch($this->type){
            case "charge_point": return 'شحن رصيد لنقطة';
            case "charge_subscriber": return 'تفعيل باقة لمشترك';
        }
    }

}
