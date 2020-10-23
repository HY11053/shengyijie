<?php

namespace App\AdminModel;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public $timestamps=false;
    protected $fillable=[ 'parentid','regionname','type'];
}
