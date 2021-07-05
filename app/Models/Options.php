<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    //
    protected  $table='option';
    protected $fillable = [
        	'analysis_id','user_id','option_name','update_user_id','input_id'
    ];
    protected $hidden = [

    ];
    public $timestamps=true;

    public function scopeSelection($query){
        return $query->select('analysis_id','user_id','option_name','update_user_id','input_id','created_at','updated_at');
    }

    public function analysis(){
        return $this->hasMany('App\Models\Analysis', 'analysis_id', 'analysis_id');
    }
    public function input(){
        return $this->hasMany('App\Models\Inputs', 'input_id', 'input_id');
    }
}
