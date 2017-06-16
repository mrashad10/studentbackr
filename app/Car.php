<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['date_manufacture','color','price','model_cars_id'];

    public function model(){
        return $this->belongsTo(ModelCar::class,'model_cars_id');
    }
}
