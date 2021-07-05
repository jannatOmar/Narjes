<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class DeleteInput extends Authenticatable
{
    //
    protected  $table='deleteinput';
    public $timestamps=false;
    protected $fillable = [
        	'input_name','user_id',	'time','analysis_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

     public function scopeSelection($query){
         return $query->select('id','input_name','user_id',	'time','analysis_id');
     }






    }
