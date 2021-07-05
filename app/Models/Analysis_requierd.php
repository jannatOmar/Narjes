<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Analysis_requierd extends Authenticatable
{
    //
    protected  $table='analysis_required';
    public $timestamps=true;
    protected $fillable = [
         'analysis_id', 'patient_id', 'doctor_id', 'result_time','done','financial_id','user_id','update_user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

     public function scopeSelection($query){
         return $query->select('id', 'analysis_id', 'patient_id', 'doctor_id','result_time','done','time','financial_id','created_at','updated_at','user_id','update_user_id');
     }

     public function analysis(){
         return $this->hasMany('App\Models\Analysis', 'analysis_id', 'analysis_id');
     }
     public function financial(){
        return $this->belongsTo('App\Models\financial_managment', 'financial_id', 'financial_id');
    }
    public function doctor(){
        return $this->hasMany('App\Models\Doctor', 'doctor_id', 'doctor_id');
    }
    public function result(){
        return $this->hasMany('App\Models\All_Results', 'analysis_required_id', 'result_id');
    }
    public function patient(){
         return  $this->hasMany('App\Models\Patient', 'patient_id', 'patient_id');
    }
    public function active_update(){
        return $this->hasOne('App\Models\active_update', 'id', 'id');
    }
    }
