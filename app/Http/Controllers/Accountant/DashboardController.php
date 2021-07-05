<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LOGIN_OUT;
use App\Models\Notifications;

class DashboardController extends Controller
{
    //
    public function index(){
        return view('accountant.dashboard');
    }
    public function logout () {
        try{
        //logout user
         LOGIN_OUT::where('user_id',auth()->user()->id)->where('logout',0)->update(
            [
                'logout'=>1
            ]
        );

            auth()->logout();
        // redirect to homepage
             return redirect()->route('get.user.login');
            }catch(\Exception $ex){
              return redirect()->back()->with(['error'=>' هناك خطأ ما يرجى اعادة المحاولة']);
                 
            }
    }
    public function aboutus(){
        return view('accountant.aboutus');
    }
    public function readNotification($notify_id){
        try{
        Notifications::where('id',$notify_id)->update(['read'=>1]);
        return redirect()->back();
       }catch(\Exception $ex){
        return redirect()->back()->with(['error'=>' هناك خطأ ما يرجى اعادة المحاولة']);
           
      }
    }

}
