<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Group extends Authenticatable
{
    //
    protected  $table='groups';
    protected $fillable = [
        	'group_id',	'group_name',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

     public function scopeSelection($query){
         return $query->select('group_id',	'group_name');
     }
     public function analysis(){
        return $this->hasMany('App\Models\Analysis', 'group_id', 'group_id');
     }

    }
