<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class NotifyInformation extends Authenticatable
{
    //
    protected  $table='notify_information';
    public $timestamps = true;
    protected $fillable = [

 'notify_id', 'patient_name','my_analysis','doctor_name','priceAfterDiscount','analysis_price','total','company','comments'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

     public function scopeSelection($query){
         return $query->select( 'notify_id', 'patient_name','my_analysis','doctor_name','priceAfterDiscount','analysis_price','total','company','comments'
        );
     }

     public function notification (){
      return $this->hasOne('App\Models\Notifications', 'notify_id', 'notify_id');
   }
   



    }
