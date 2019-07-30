<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    protected $guarded = [];
    
    
    public function users()
    {
        return $this->belongsTo(Users::class);
    }
    public function customers()
    {
        return $this->belongsTo(Customers::class);
    }
    
    public function products()
    {
        return $this->hasMany(Products::class);
    }
}