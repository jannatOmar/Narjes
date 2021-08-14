<?php

namespace App\Http\Controllers\employee;
    use App\Http\Requests\FilterRequest;
    use App\Models\Actions;
    use App\Models\Analysis;
    use App\Models\NormalRange ;
    use App\Models\All_Results;
    use App\Models\Analysis_requierd;
    use App\Models\Discount;
    use App\Models\Inputs;
    use App\Models\Options;
    use App\Models\Patient;
    use App\Models\Doctor;
    use App\Models\financial_managment;
    use App\Models\active_update;
    use DB;
    use Illuminate\Support\Facades\Auth;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Http\Requests\UpdatePatientRequest;
    use App\Http\Requests\storeResultRequest;
    use App\Http\Requests\AddPatientRequest;
    use App\Http\Requests\EditResultRequest;
    use App\Http\Requests\confirmPaymentRequest;
    use Illuminate\Support\Facades\Config;

    use Carbon\Carbon;
        class patientManagmentController extends Controller
    {

        public function index(){
            $patient=Patient::selection()->paginate(PAGINATION_COUNT);
            return view('employee.patientmanagment.PatientsManagment', compact("patient"));
        }


    public function search(Request $request){
        try{
            $q=$request->name;
            $patient=Patient::where(DB::raw("CONCAT(f_name,' ',m_name,' ',l_name)"),'LIKE','%'.$q.'%')->paginate(PAGINATION_COUNT);
            $pagination = $patient->appends ( array (
                'name' => $request->name,
             ) );
            return view('employee.patientmanagment.PatientsManagment', compact("patient","q"));
        }catch(\Exception $ex){

            return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
        }
    }

    public function history($patient_id){
     try{
          $analysis=Analysis_requierd::where(
           [
               ['patient_id','=',$patient_id],
               ['done','=',1],
           ]
        )->with('doctor','analysis')->paginate(PAGINATION_COUNT);
        foreach($analysis as $rr){
            if(Carbon::now()->diff(Carbon::parse($rr->result_time))->format('%d %H:%I:%S') > '1 00:00:00' ){
              active_update::where('id',$rr->id)
              ->update(
                 [
                    "status"=>0,
                 ]
               );
             }
        }

        return view('employee.patientmanagment.patientHistory' ,compact(['analysis','patient_id']));
      }catch(\Exception $ex){
        return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
      }
    }

    public function searchHistory(Request $request,$patient_id){
      try{
           $search=$request->name;
           $analysis=Analysis_requierd::where(
            [
                ['patient_id','=',$patient_id],
                ['done','=',1],
            ]
         )->with('doctor','analysis')
         ->whereHas('analysis',function($q) use($search){
              $q->where(DB::raw("CONCAT(analysis_name)"),'LIKE','%'.$search.'%');
          })
          ->paginate(PAGINATION_COUNT);
         foreach($analysis as $rr){
             if(Carbon::now()->diff(Carbon::parse($rr->result_time))->format('%d %H:%I:%S') > '1 00:00:00' ){
               active_update::where('id',$rr->id)
               ->update(
                  [
                     "status"=>0,
                  ]
                );
              }
         }

         return view('employee.patientmanagment.patientHistory' ,compact(['analysis','patient_id',"search"]));
      }catch(\Exception $ex){
          return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
      }
  }

    public function showResults($analysis_id,$patient_id,$analysis_required_id){
        try{
            $results =All_Results::with('input','required_analysis')->whereHas('required_analysis',function($q) use($analysis_required_id){
            $q->where([['done','=',1],['analysis_required_id','=',$analysis_required_id]]);
         })->get();

          $doctor_id=$results[0]->required_analysis->doctor_id;
          $doctor_name=Doctor::select(DB::raw("CONCAT(f_name,' ',m_name,' ',l_name) AS doctor_name"))->where('doctor_id',$doctor_id)->get();

         $normal_range =NormalRange::with('input','analysis')->where('analysis_id',$analysis_id)->get();

        $patient=Patient::where('patient_id',$patient_id)->select(DB::raw("CONCAT(f_name,' ',m_name,' ',l_name) AS PATIENTNAME"),'gender','birthday','address')->first();
        $age=\Carbon\Carbon::parse($patient->birthday)->diff(\Carbon\Carbon::now())->format('%y');

        return view('employee.patientmanagment.result',compact(['results','normal_range','doctor_name','patient','age']));
       }catch(\Exception $ex){
         return $ex;
        return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
      }
    }

    public function analysisWating(){
        try{
            $patient =Analysis_requierd::select('patient_id', DB::raw('count(*) as total'))
                 ->groupBy('patient_id')
                 ->where('done',0)
                 ->paginate(PAGINATION_COUNT);
          return view('employee.patientmanagment.AnalysisWaitingResult',compact('patient'));
      }catch(\Exception $ex){
        return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
      }
    }
    public function searchAnalysisWaitingResult(Request $request){
        try{
            $search=$request->name;
                $patient=Analysis_requierd::select( 'patient_id',DB::raw('count(*) as total'))
               ->where('done',0)->with('patient')
               ->whereHas('patient',function($q) use($search){
                 $q->where(DB::raw("CONCAT(f_name,' ',m_name,' ',l_name)"),'LIKE','%'.$search.'%');
              })
              ->groupBy('patient_id')
              ->paginate(PAGINATION_COUNT);

            $pagination = $patient->appends ( array (
                'name' => $request->name,
        ) );
            return view('employee.patientmanagment.AnalysisWaitingResult', compact("patient","search"));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
        }
    }

  public function showRequiredAnalysis($patient_id){
    try{
       $analysis=Analysis_requierd::with('analysis')->select('id','analysis_id','created_at')->where([['patient_id','=',$patient_id],['done','=',0]])->paginate(PAGINATION_COUNT);;
       $patient=Patient::where('patient_id',$patient_id)->select(DB::raw("CONCAT(f_name,' ',m_name,' ',l_name) AS PATIENTNAME"),'patient_id')->first();
      return view('employee.patientmanagment.patientAnalysis',compact(['analysis','patient']));
   }catch(\Exception $ex){
   return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
   }
  }
  public function enterResult($analysis_id,$patient_id,$analysis_required_id){
    try{
           $data=[];
      $analysis=Analysis_requierd::with('analysis','doctor')->selection()->where([
            'id'=>$analysis_required_id
            ])->get();
          $analysis_id=$analysis[0]->analysis_id;
        $patient=Patient::where('patient_id',$patient_id)->select(DB::raw("CONCAT(f_name,' ',m_name,' ',l_name) AS PATIENTNAME"),'gender','birthday','address')->first();
        $age=\Carbon\Carbon::parse($patient->birthday)->diff(\Carbon\Carbon::now())->format('%y');

        $normal_range =NormalRange::with('input')->where('analysis_id',$analysis_id)->get();


         $options =Options::select('input_id')->with('input')->distinct()->where('analysis_id',$analysis_id)->get();
        foreach($options as $op){
           $opt=Options::select('option_name')->where('analysis_id',$analysis_id)->where('input_id',$op->input[0]->input_id)->get();
            $data[]= array($op->input[0]->input_name => $opt);
            $opt=[];
        }
        $last_date=All_Results::whereHas('required_analysis', function($q) use($analysis_id){
          $q->where('analysis_id', $analysis_id);
           })
           ->select(DB::raw('MAX(created_at) as last_date'))->get();
          $last_result=All_Results::select('data')->
            whereHas('required_analysis', function($q) use($analysis_id){
            $q->where('analysis_id', $analysis_id);
             })
          ->where(
            [
              'created_at'=>$last_date[0]->last_date,
            ]
          )->get();
        return view('employee.patientmanagment.enterResult',compact(['analysis','analysis_id','patient','age','normal_range','data','analysis_required_id','last_result']));
     }catch(\Exception $ex){
     return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
     }
  }
  public function saveResult(storeResultRequest $request,$analysis_required_id,$analysis_id){
       try{
           $valid = 1;
           if($request->has('invalide'))
               $valid=0;

           Analysis::where('analysis_id',$analysis_id)->update(['valid'=>$valid]);
           // return $valid;
           $an = Analysis::where('analysis_id',$analysis_id)->get()[0]->analysis_name;
           $p_id = Analysis_requierd::where('id',$analysis_id)->get()[0]->patient_id;
           $p = Patient::where('patient_id',$p_id)->get()[0];
           $us = Auth::user()->username;
           $table_id=4;
           $n="";
           $o="";
         $input_name=$request->input_name;
         $result=$request->Data;
         $input_Op=$request->input_Op;
         $Data_Op=$request->Data_Op;

         for($i=0; $i<count($input_name); $i++){
             $n .=$input_name[$i].": ".$result[$i]." ";
         }
       //  return $n;
        for($i=0; $i<count($input_Op); $i++){
            $o.= $input_Op[$i].": ".$Data_Op[$i]." ";
        }
       // return $o;
         $insert_data1=[];
         $insert_data2=[];
         $input_id1=[];
         $input_id2=[];

      DB::beginTransaction();
     if(!empty($input_name)){
        for($count=0 ;$count <count($input_name);$count++){
          $input_id1[]=Inputs::select('input_id')->where('analysis_id',$analysis_id)->where('input_name',$input_name[$count])->get();
       }
      for($count=0 ;$count <count($input_name);$count++){
         $data1=array(
           'input_id'=>$input_id1[$count][0]->input_id,
           'data'=>$result[$count],
           'analysis_required_id'=>$analysis_required_id,
           'user_id'=>auth()->user()->id,
           'update_user_id'=>auth()->user()->id
         );
       $insert_data1[]=$data1;
      }
         All_Results::insert($insert_data1);
    }
    if(!empty($input_Op)){

      for($count=0 ;$count <count($input_Op);$count++){
        $input_id2[]=Inputs::select('input_id')->where('analysis_id',$analysis_id)->where('input_name',$input_Op[$count])->get();
     }
      for($count=0 ;$count <count($input_Op);$count++){
        $data2=array(
          'input_id'=>$input_id2[$count][0]->input_id,
          'data'=>$Data_Op[$count],
          'analysis_required_id'=>$analysis_required_id,
          'user_id'=>auth()->user()->id,
          'update_user_id'=>auth()->user()->id
        );
      $insert_data2[]=$data2;
     }

         All_Results::insert($insert_data2);
    }

      Analysis_requierd::where('id',$analysis_required_id)
      ->update(
          [
          "done"=>1,
          'result_time'=>Carbon::now(),
          'update_user_id'=>auth()->user()->id
          ]
        );
        active_update::create([
          'id'=>$analysis_required_id,
        ]);

        $mess = "the user ".$us." add a result to patient:".$p->f_name." ".$p->m_name." ".$p->l_name.
           " of analysis ".$an." with result: ".$n.$o;
           $action = Actions::create(
               [
                   'action_name'=>$mess,
                   'user_id'=>auth()->user()->id,
                   'table_id'=>$table_id
               ]
           );

      DB::commit();

      return redirect()->route('employee.patientManagment.AnalysisWating')->with(['success'=>'تم حفظ النتائج بنجاح']);

    }catch(\Exception $ex){
        DB::rollback();
        return redirect()->back()->with(['error'=>' هناك خطأ ما يرجى اعادة المحاولة']);
     }
}



 }

