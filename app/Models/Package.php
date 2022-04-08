<?php

namespace App\Models;

use App\Models\Subscriber;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    public function subscribers(){
        return $this->hasMany(Subscriber::class);
    }
}
