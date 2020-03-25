<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = "companies";
    protected $fillable = ['name'];
    
    public function users()
    {
        return $this->hasMany('App\User');
    }
}