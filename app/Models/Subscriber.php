<?php

namespace App\Models;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    public function package(){
        return $this->belongsTo(Package::class);
    }

}
