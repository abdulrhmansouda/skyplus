<?php

namespace App\Models;

use App\Enums\UserStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $with = ['user'];

    protected $guarded = ['id'];
    // protected $fillable =[
    //     'user_id',
    //     't_c',
    //     'name',
    //     'phone',
    // ];

    //helper func
    public function status(){
        switch($this->status){
            case(UserStatusEnum::ACTIVE->value):    return '<span class="badge badge-sm bg-gradient-success">مفعل</span>';
            // case(UserStatusEnum::INACTIVE->value):  return '<span class="badge badge-sm bg-gradient-warning">غير مفعل</span>';
            case(UserStatusEnum::CLOSED->value):    return '<span class="badge badge-sm bg-gradient-danger">مغلق</span>';
        }
        //        <span class="badge badge-sm bg-gradient-secondary text-white">مغلق</span>
    }

// Relations
    public function user(){
        return $this->belongsTo(User::class);
    }

}
