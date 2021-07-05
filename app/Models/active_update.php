<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class active_update extends Authenticatable
{
    //
    protected  $table='active_update';
    public $timestamps=false;
    protected $fillable = [
       'id','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

     public function scopeSelection($query){
         return $query->select('id','status');
     }

    public function analysis_req(){
        return $this->hasOne('App\Models\Analysis_requierd', 'id', 'id');
    }




    }