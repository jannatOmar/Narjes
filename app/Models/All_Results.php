<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class All_Results extends Authenticatable
{
    //
    protected  $table='result';
    public $timestamps=true;
    protected $fillable = [
        'analysis_required_id', 'input_id','data','recived','user_id','update_user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

     public function scopeSelection($query){
         return $query->select('result_id',  'analysis_required_id', 'input_id','data','recived','created_at','updated_at','user_id','update_user_id');
     }

     public function required_analysis(){
         return $this->belongsTo('App\Models\Analysis_requierd', 'analysis_required_id','id');
     }

    public function input(){
        return $this->belongsTo('App\Models\Inputs', 'input_id', 'input_id');
    }




    }
