<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'image',
        'account',
        'tc',
        'note',
        'borrowingIsAllowed',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function getImageUrlAttribute()
    {

        $image = $this->image;

        if ($image) {
            return asset("images/$image");
        }

        return asset('images/default_user.png');
    }
}
