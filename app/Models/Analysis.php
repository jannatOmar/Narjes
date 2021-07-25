<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Analysis extends Authenticatable
{
    //
    protected  $table='analysis';
    public $timestamps=true;
    protected $fillable = [
        	'group_id',	'parent_id','analysis_name','price','valid','user_id','update_user_id',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

     public function scopeSelection($query){
         return $query->select('analysis_id','group_id','parent_id','valid','analysis_name','price','created_at','updated_at','user_id','update_user_id');
     }
     public function parent(){
        return $this->hasMany(self::class,'perant_id');
    }
     public function group(){
         return $this->belongsTo('App\Models\Group', 'group_id', 'group_id');
     }
     public function input(){
        return $this->hasMany('App\Models\Inputs', 'input_id', 'input_id');
    }

    public function analysis_requierd(){
        return $this->belongsTo('App\Models\Analysis_requierd', 'analysis_id', 'analysis_id');
    }
    public function normal_range(){
        return $this->hasMany('App\Models\NormalRange', 'analysis_id', 'analysis_id');
    }
    public function option(){
         return $this->hasMany('App\Models\Options', 'analysis_id', 'option_id');
    }

    }
