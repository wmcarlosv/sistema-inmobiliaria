<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $table = 'rents';

    public function city(){
        return $this->belongsTo('App\Models\City');
    }

    public function RentPhotos(){
        return $this->hasMany('App\Models\RentPhoto');
    }
}
