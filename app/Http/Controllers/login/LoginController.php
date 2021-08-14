<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\LOGIN_OUT;
use App\Http\Requests\LoginRequest;
use Carbon\Carbon;

class LoginController extends Controller
{
    //
    public function getLogin(){
        return view('layouts.login');
    }
    
   
    public function Login(LoginRequest $request){
     try{
    // $remember_me=$request->has('remember_me')?'true':'false';
      $username=$request->input('username');
       $pass=$request->input('password');
      
        $user=Users::where('username',$username)->selection()->first();
       if($user->status==1){
         $role_id=$user->role_id;
        if($role_id==1){
            $permetion='admin';
        }else if($role_id==2){
            $permetion='manager';
        }else if($role_id==3){
            $permetion='employee';
        }else if($role_id==4){
            $permetion='accountant';
        }
       $req=auth()->guard($permetion)->attempt(['username'=>$username,'password'=>$pass]);
          if($req){
            //login tabel
            LOGIN_OUT::create(
                [
                    'user_id'=>$user->id,
                ]
            );
            return redirect()->route($permetion.'.dashboard')->with(['success'=>'تم الدخول بنجاح']);
        }
        return redirect()->back()->with(['error'=>'هناك خطأ في كلمة المرور']);
    }else{
        return redirect()->back()->with(['error'=>'هذا المستخدم غير موجود ']);
    }
     }catch(\Exception $ex){
        return redirect()->back()->with(['error'=>'هناك خطأ في اسم المستخدم ']);
    }
}
}
