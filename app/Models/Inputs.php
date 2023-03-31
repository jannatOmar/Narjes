<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inputs extends Model
{
    //
    protected  $table='inputs';
    protected $fillable = [
        	'input_name','analysis_id','user_id','update_user_id'
    ];
    protected $hidden = [

    ];
    public $timestamps=true;

    public function scopeSelection($query){
        return $query->select('input_id','input_name','analysis_id','created_at','updated_at','user_id','update_user_id');
    }
    public function analysis(){
       return $this->hasMany('App\Models\Analysis', 'group_id', 'analysis_id');
    }
    public function analysis_f(){
        return $this->belongsTo('App\Models\Analysis', 'input_id', 'analysis_id');
    }
    public function  normalrang(){
        return $this->hasOne('App\Models\NormalRange', 'input_id','id');
    }
    public function  result(){
        return $this->hasMany('App\Models\All_Results', 'input_id','result_id');
    }
    public function  option(){
        return $this->hasMany('App\Models\Options', 'input_id','option_id');
    }
   
}
