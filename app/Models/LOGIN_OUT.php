<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class LOGIN_OUT extends Authenticatable
{
    //
    protected  $table='login_out';
    public $timestamps=true;
    protected $fillable = [
         'user_id','logout'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

     public function scopeSelection($query){
         return $query->select('user_id','logout','created_at','updated_at');
     }
     public function user(){
        return $this->belongsTo('App\Models\Users', 'user_id','id');
    }

   




    }
