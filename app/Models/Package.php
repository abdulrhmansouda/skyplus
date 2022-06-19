<?php

namespace App\Models;

use App\Enums\UserStatusEnum;
use App\Models\Subscriber;
// use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\Database\Eloquent\Builder;
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

        // Global Scope
        // protected static function booted()
        // {
        //     static::addGlobalScope('active', function (Builder $builder) {
        //         $builder->where('status', UserStatusEnum::ACTIVE->value);
        //     });
        // }

        //Local Scope
        public function scopeActive($query)
        {
            $query->where('status', UserStatusEnum::ACTIVE->value);
        }

        // helpers 
        public function status(){
            switch($this->status){
                case(UserStatusEnum::ACTIVE->value):    return '<span class="badge badge-sm bg-gradient-success">مفعل</span>';
                // case(UserStatusEnum::INACTIVE->value):  return '<span class="badge badge-sm bg-gradient-warning">غير مفعل</span>';
                case(UserStatusEnum::CLOSED->value):    return '<span class="badge badge-sm bg-gradient-danger">مغلق</span>';
            }
            //        <span class="badge badge-sm bg-gradient-secondary text-white">مغلق</span>
        }

        // Relations
    public function subscribers(){
        return $this->hasMany(Subscriber::class);
    }
}
