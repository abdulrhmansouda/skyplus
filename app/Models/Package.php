<?php

namespace App\Models;

use App\Models\Subscriber;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    // protected $fillable =[
    //     'name',
    //     'price',
    // ];
        protected $guarded = ['id'];

        // public function getIdAttribute(){
        //     return $this->id;
        // }

    public function subscribers(){
        return $this->hasMany(Subscriber::class);
    }
}
