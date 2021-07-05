<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Patient extends Authenticatable
{
    //
    protected  $table='patient';
    public $timestamps=true;
    protected $fillable = [
        'f_name','m_name','l_name','gender','birthday','phone','address','email','created_at','updated_at','user_id','update_user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

     public function scopeSelection($query){
         return $query->select('patient_id','f_name','m_name','l_name','gender','birthday','phone','address','email','created_at','updated_at','user_id','update_user_id');
     }
     public function analysis_required(){
        return  $this->hasMany('App\Models\Analysis_requierd', 'patient_id', 'patient_id');
   }
   public function financial(){
    return $this->hasMany('App\Models\financial_managment', 'patient_id', 'financial_id');
   }
   
    }
