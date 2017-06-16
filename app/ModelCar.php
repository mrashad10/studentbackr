<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelCar extends Model
{
    protected  $fillable = ['name','mark','motor','year'];
}
