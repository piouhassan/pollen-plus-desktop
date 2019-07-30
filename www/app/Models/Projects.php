<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $guarded = ['updated_at'];
    
    
    public function customer()
    {
        return $this->belongsTo('App\Models\Customers');
    }
    
    public function user()
    {
        return $this->belongsToMany(Users::class);
    }
    
}