<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Notifications extends Authenticatable
{
    //
    protected  $table='notify';
    public $timestamps = true;
    protected $fillable = [


        'sender_id', 'recive_id',	'data',	'read'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

     public function scopeSelection($query){
         return $query->select('id','sender_id', 'recive_id',	'data',	'read','created_at','updated_at');
     }

     public function user(){
        return $this->hasOne('App\Models\Users', 'user_id', 'user_id');
     }




    }
