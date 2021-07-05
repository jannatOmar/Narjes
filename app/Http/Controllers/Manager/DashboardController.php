<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LOGIN_OUT;
use App\Models\Notifications;

class DashboardController extends Controller
{
    
    public function aboutus(){
        return view('manager.aboutus');
    }
    public function index(){
     try{
        return view('manager.dashboard');
     }catch(\Exception $ex){
        return redirect()->back()->with(['error'=>' هناك خطأ ما يرجى اعادة المحاولة']);
           
      }
    }
    public function logout () {
        try{
         LOGIN_OUT::where('user_id',auth()->user()->id)->where('logout',0)->update(
            [
                'logout'=>1
            ]
        );

            auth()->logout();
             return redirect()->route('get.user.login');
            }catch(\Exception $ex){
              return redirect()->back()->with(['error'=>' هناك خطأ ما يرجى اعادة المحاولة']);
                 
            }
    }
    public function readNotification($data,$created_at,$sender){
        try{
        Notifications::where('data',$data)->where('created_at',$created_at)->where('sender_id',$sender)->update(['read'=>1]);
        return redirect()->back();
      }catch(\Exception $ex){
        return redirect()->back()->with(['error'=>' هناك خطأ ما يرجى اعادة المحاولة']);
           
      }
    }


}
