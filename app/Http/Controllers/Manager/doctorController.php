<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\addNewDoctorRequest;
use App\Http\Requests\updateDoctorRequest;
use App\Models\Actions;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
class DoctorController extends Controller
{

    public function index(){
        try {
             $doctor=Doctor::selection()->whereNotNull('f_name')->whereNotNull('m_name')->whereNotNull('l_name')->paginate(PAGINATION_COUNT);

            return view('manager.doctor.doctorManagement', compact("doctor"));
        }
        catch (\Exception $ex ){
            return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
        }


    }


    public function addDoctor(){

        return view('manager.doctor.addDoctor');
    }

    public function storeDoctor(addNewDoctorRequest $request){

        try{
            $us = Auth::user()->username;
            $table_id = 3;
            $mess = "";
            $doctor=Doctor::create(
                [
                    'f_name'=>$request->first_name,
                    'm_name'=>$request->middle_name,
                    'l_name'=>$request->last_name,
                    'phone'=>$request->phone,
                    'email'=>$request->email,
                    'address'=>$request->address,

                    'user_id'=>auth()->user()->id,
                    'update_user_id'=>auth()->user()->id
                ]
            );
            $doctor_name = "" . $request->first_name . " ". $request->middle_name . " " . $request->last_name;
            $mess="the use ".$us. " add a new doctor: " . $doctor_name;
            $action = Actions::create(
                [
                    'action_name'=>$mess,
                    'user_id'=>auth()->user()->id,
                    'table_id'=>$table_id
                ]
            );

            return redirect()->route('manager.doctor.managment')->with(['success'=>'تم الحفظ بنجاح']);
        }catch(\Exception $ex){
            return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
        }
    }

    public function search(Request $request){
        try{

            $q=$request->name;
            $doctor=Doctor::where(DB::raw("CONCAT(f_name,' ',m_name,' ',l_name)"),'LIKE','%'.$q.'%')->paginate(PAGINATION_COUNT);
            $pagination = $doctor->appends ( array (
                'name' => $request->name,
            ) );
            return view('manager.doctor.doctorManagement', compact("doctor","q"));
        }catch(\Exception $ex){

            return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
        }
    }
    public function edit($doctor_id){
        try{
            $doctor=Doctor::where('doctor_id',$doctor_id)->selection()->first();
            if(!$doctor){
                return redirect()->route('manager.doctor.doctorManagement')->with(['error'=>'هذاالمريض غير موجود']);
            }
            return view('manager.doctor.updateDoctor',compact('doctor'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error'=>'هناك خطأ مل يرجى المحاولة فيما بعد']);
        }
    }

    public function update(updateDoctorRequest $request, $doctor_id){
        try{
            $us = Auth::user()->username;
            $table_id = 3;
            $mess = "";
            $doc = Doctor::where('doctor_id', $doctor_id)->get();
            $doctor_name = "" . $doc[0]->f_name . " ". $doc[0]->m_name . " " . $doc[0]->l_name;
            $doctor=Doctor::selection()->where('doctor_id', $doctor_id)->get();
            Doctor::where('doctor_id', $doctor_id)
                ->update(
                    [
                        "f_name"=>$request["first_name"],
                        "m_name"=>$request["middle_name"],
                        "l_name"=>$request["last_name"],
                        "address"=>$request["address"],
                        "phone"=>$request["phone"],
                        "email"=>$request["email"],
                        'update_user_id'=>auth()->user()->id
                    ]
                );
            $new = Doctor::where('doctor_id', $doctor_id)->get();
            $mess = "the user ".$us. " update a doctor:". $doctor_name ." from [ ".$doctor[0]->f_name. ' , '
                .$doctor[0]->m_name.' , '.$doctor[0]->l_name.' , '.$doctor[0]->address.' , '.$doctor[0]->phone.
                ' , '.$doctor[0]->email. " ] to  [ " .
                $request["first_name"] . " , " . $request["middle_name"] . " , " .$request["last_name"]. " , ".$request["address"]
                ." , ". $request["phone"] . " , " . $request["email"]." ]";

            $action = Actions::create(
                [
                    'action_name'=>$mess,
                    'user_id'=>auth()->user()->id,
                    'table_id'=>$table_id
                ]
            );
            return redirect()->route('manager.doctor.managment')->with(['success'=>'تم التعديل بنجاح']);
        }catch(\Exception $ex){

            return redirect()->back()->with(['error'=>'هناك خطأ يجب عدم تكرار رقم الهاتف والايميل ']);
        }

    }




}
