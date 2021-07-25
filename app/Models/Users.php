<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Users extends Authenticatable
{

    //
    protected  $table='user';
    protected $fillable = [
        'role_id','f_name','m_name','l_name','age','username','password','phone','address','email','status','start_date','end_date','user_id','update_user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

     public function scopeSelection($query){
         return $query->select('id','role_id','f_name','m_name','l_name','age', 'username','password','phone','address','email','status','start_date','end_date','created_at','updated_at','user_id','update_user_id');
     }
     public function getActive(){
        return $this->status ==1?'active':'not active';
    }
    public function role(){
        return $this->belongsTo('App\Models\Role', 'role_id', 'role_id');
    }
    public function login_out(){
        return $this->hasMany('App\Models\LOGIN_OUT', 'user_id', 'user_id');
    }


    }
