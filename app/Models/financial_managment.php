<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class financial_managment extends Authenticatable
{
    //
    protected  $table='financial';
    public $timestamps=true;

    protected $fillable = [
        'total_price',	'discount_id',	'payment',	'time',	'patient_id','comments','user_id','update_user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

     public function scopeSelection($query){
         return $query->select( 'total_price','discount_id','payment','time','financial_id','patient_id','comments','created_at','updated_at','user_id','update_user_id'
        
        );
     }

    public function discount(){
        return $this->hasMany('App\Models\Discount', 'discount_id', 'discount_id');
    }
    public function patient(){
        return $this->belongsTo('App\Models\Patient', 'patient_id', 'discount_id');
    }
    public function analysis_requierd(){
        return $this->hasMany('App\Models\Analysis_requierd', 'financial_id', 'id');
    }






    }