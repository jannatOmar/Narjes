<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Doctor extends Authenticatable
{
    //
    protected  $table='doctor';
    public $timestamps = true;
    protected $fillable = [


        'f_name','m_name','l_name', 'address' ,'phone', 'email','user_id','update_user_id'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

     public function scopeSelection($query){
         return $query->select('doctor_id','f_name','m_name','l_name', 'address' ,'phone', 'email','created_at','updated_at','user_id','update_user_id');
     }

     public function analysis_requierd(){
         return $this->hasMany('App\Models\Analysis_requierd', 'doctor_id', 'id');
     }




    }
