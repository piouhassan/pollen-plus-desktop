<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    
    protected $guarded = [];
    
    public function projects()
    {
        return $this->hasMany('App\Models\Projects','customer_id');
    }
    
}