<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    public function city(){
        return $this->belongsTo('App\Models\City');
    }

    public function SalePhotos(){
        return $this->hasMany('App\Models\SalePhoto');
    }
}
