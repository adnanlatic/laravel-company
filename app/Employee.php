<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // fillable attributes to avoid mass assignment
    protected $fillable = ['firstName','lastName','company_id','email','phone'];

    public function companies(){
    return $this->belongsTo('App\Company','company_id');
  }
}
