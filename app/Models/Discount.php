<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Discount extends Authenticatable

{
    public $timestamps=true;
    protected  $table='contracts';
    protected $fillable = [

         'company_name', 'discount_type', 'discount_parcenteg','company_finantial_recivable', 'laboratory_finantial_recivable','user_id','update_user_id'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

     public function scopeSelection($query){
         return $query->select('discount_id','company_name', 'discount_type','discount_parcenteg', 'company_finantial_recivable', 'laboratory_finantial_recivable','created_at','updated_at','user_id','update_user_id');
     }
     public function financial(){
        return $this->hasMany('App\Models\financial_managment', 'discount_id', 'financial_id');
    }





    }
