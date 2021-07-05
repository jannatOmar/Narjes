<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LOGIN_OUT;
use App\Models\Actions;
use Carbon\Carbon;
use App\Http\Requests\userActionRequest;

use App\Http\Requests\loggingRequest;

class actionController extends Controller
{
    public function index(){
        return view('admin.actions.action');
    }
    public function getUserAction(userActionRequest $request){
        try{
        $dateFrom=$request->dateFrom;
        $dateTo=$request->dateTo;
         $table=$request->table;
      if($dateTo==null){
          $dateTo = Carbon::now();
      }
      if($dateFrom > $dateTo){
          return redirect()->route('admin.action.index')->with(['error'=>' يجب ادخال تاريخ البداية اقل من النهاية ']);
      }

       $dateFrom=$dateFrom.' 00:00:00';
       $dateTo=$dateTo.' 00:00:00';
        if($table!=6){
           $data=Actions::selection()->with('user')->where('table_id',$table)->whereBetween('created_at', [$dateFrom, $dateTo])->get();
        }else{
           $data=Actions::selection()->with('user')->whereBetween('created_at', [$dateFrom, $dateTo])->get();
        }
       if(count($data) == 0 ){
              return redirect()->route('admin.action.index')->with(['error'=>' لا يوجد نشاط للموظفين ضمن الفترة المدخلة']);
          }
          return view('admin.actions.action',compact('data','dateFrom','dateTo','table'));

   }catch(\Exception $ex){
      return redirect()->back()->with(['error'=>' هناك خطأ ما يرجى اعادة المحاولة']);
    }
    }
    public function getLogging(){

        return view('admin.actions.login_out');
    }
    public function showDetialsLogging(loggingRequest $request){
        try{
            $dateFrom=$request->dateFrom;
            $dateTo=$request->dateTo;
          if($dateTo==null){
              $dateTo = Carbon::now();
          }
          if($dateFrom > $dateTo){
              return redirect()->route('admin.action.logging')->with(['error'=>' يجب ادخال تاريخ البداية اقل من النهاية ']);
          }
          $dateFrom=$dateFrom.' 00:00:00';
          $dateTo=$dateTo.' 00:00:00';
           $data=LOGIN_OUT::selection()->with('user')->whereBetween('created_at', [$dateFrom, $dateTo])->get();
              if(count($data) == 0 ){
                  return redirect()->route('admin.action.logging')->with(['error'=>' لا يوجد نشاط للموظفين ضمن الفترة المدخلة']);
              }
              return view('admin.actions.login_out',compact('data','dateFrom','dateTo'));

       }catch(\Exception $ex){
           return $ex;
          return redirect()->back()->with(['error'=>' هناك خطأ ما يرجى اعادة المحاولة']);
        }



    }
    
}
