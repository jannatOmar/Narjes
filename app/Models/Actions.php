<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Actions extends Authenticatable
{
    //
    protected  $table='action';
    public $timestamps=false;
    protected $fillable = [
        	'action_name','table_id',	'user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

     public function scopeSelection($query){
         return $query->select('action_id','action_name','table_id','user_id','created_at','updated_at');
     }
  
     public function user(){
        return $this->belongsTo('App\Models\Users', 'user_id', 'id');
     }
     






    }
