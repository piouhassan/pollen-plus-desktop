<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $guarded = [];
    private $username;
    
    public function project()
    {
        return $this->belongsToMany(Projects::class);
    }
    
    public function invoice()
    {
        return $this->hasMany(Invoices::class);
    }
    public function roles()
    {
        return $this->hasOne(Roles::class, 'user_id');
    }

}