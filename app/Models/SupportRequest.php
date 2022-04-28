<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportRequest extends Model
{
    use HasFactory;

    protected $with = ['point'];

    protected $guarded = [ 'id' ];

    public function point(){
        return $this->belongsTo(Point::class);
    }
}
