<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Role extends Authenticatable

{
    //
    protected  $table='role';
    protected $fillable = [
        	'role_id',	'role_name',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

     public function scopeSelection($query){
         return $query->select('role_id', 'role_name');
     }
     public function user(){
        return $this->hasMany('App\Models\Users', 'role_id', 'role_id');
     }

    }
