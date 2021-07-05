<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LOGIN_OUT;
use App\Models\Notifications;

class DashboardController extends Controller
{
    
    public function aboutus(){
        return view('admin.aboutus');
     }
    public function index(){
        try{
        return view('admin.dashboard');
      }catch(\Exception $ex){
        return redirect()->back()->with(['error'=>' هناك خطأ ما يرجى اعادة المحاولة']);
           
      }
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



}
