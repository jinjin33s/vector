<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'person';

    public function interests(){
    	return $this->hasMany('App\Interest');
    }
}
