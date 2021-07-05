<?php

namespace App\Http\Controllers\manager;
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
    use App\Models\Users;
    use App\Models\financial_managment;

    use App\Models\NotifyInformation;
    use App\Models\Notifications;
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
     use Illuminate\Support\Str;



    class patientManagmentController extends Controller
    {

        public function index(){
            $patient=Patient::selection()->paginate(PAGINATION_COUNT);
            return view('manager.patientmanagment.PatientsManagment', compact("patient"));
        }
        public function edit($patient_id){
         try{
           $patient=Patient::where('patient_id',$patient_id)->selection()->first();
            if(!$patient){
                return redirect()->route('manager.patientManagment')->with(['error'=>'هذاالمريض غير موجود']);
            }
            return view('manager.patientmanagment.UpdatePInformation',compact('patient'));
         }catch(\Exception $ex){
            return redirect()->back()->with(['error'=>'هناك خطأ مل يرجى المحاولة فيما بعد']);
          }
        }
         public function update(UpdatePatientRequest $request,$patient_id){
            try{
                $table_id=4;
                $us = Auth::user()->username;
                $p =  Patient::where('patient_id',$patient_id)->get();
                $pat="[ ".$p[0]->f_name." , ".$p[0]->m_name." , ".$p[0]->l_name." , ".$p[0]->gender." , ".
                    $p[0]->email." , ".$p[0]->phone." , ".$p[0]->address." , ".$p[0]->birthday." ]";
               Patient::where('patient_id',$patient_id)
              ->update(
                 [
                     "f_name"=>$request["f_name"],
                     "m_name"=>$request["m_name"],
                     "l_name"=>$request["l_name"],
                     "address"=>$request["address"],
                     "phone"=>$request["phone"],
                     "email"=>$request["email"],
                     "birthday"=>$request["birthday"],
                     "gender"=>$request["gender"],
                     'update_user_id'=>auth()->user()->id

                 ]
              );
                $p_name = $request["f_name"]." ".$request["m_name"]." ".$request["l_name"];
                $mess = "the user ".$us." update on patient ".$p_name." from: ".$pat. " to: [ ".
                    $request["f_name"]." , ".$request["m_name"]." , ".$request["l_name"]." , ".
                    $request["gender"]." , ".$request["email"]." , ".
                    $request["phone"]." , ".$request["address"]." , ".
                    $request["birthday"]." ]";
                $action = Actions::create(
                    [
                        'action_name'=>$mess,
                        'user_id'=>auth()->user()->id,
                        'table_id'=>$table_id
                    ]
                );
             return redirect()->route('manager.patientManagment')->with(['success'=>'تم التعديل بنجاح']);
              }catch(\Exception $ex){
              return redirect()->back()->with(['error'=>'هناك خطأ مل يرجى المحاولة فيما بعد']);
            }
    }
    public function create(){
        return view('manager.patientmanagment.AddPatients');
    }
    public function store(AddPatientRequest $request){
        try{
            $table_id=4;
            $us = Auth::user()->username;
             $patient=Patient::create(
                [
                    'f_name'=>$request->f_name,
                    'm_name'=>$request->m_name,
                    'l_name'=>$request->l_name,
                    'phone'=>$request->phone,
                    'email'=>$request->email,
                    'address'=>$request->address,
                    'gender'=>$request->gender,
                    'birthday'=>$request->birthday,
                    'user_id'=>auth()->user()->id,
                     'update_user_id'=>auth()->user()->id
                ]
            );
            $p = "[ ".$request->f_name." , ".$request->m_name." , ".$request->l_name." , ".$request->phone." , ".
                $request->email." , ".$request->address." , ".$request->gender." , ".$request->birthday." ]";
            $mess = "the user ".$us." add a new patient: ".$p;
            $action = Actions::create(
                [
                    'action_name'=>$mess,
                    'user_id'=>auth()->user()->id,
                    'table_id'=>$table_id
                ]
            );

            return redirect()->route('manager.patientManagment')->with(['success'=>'تم الحفظ بنجاح']);
            }catch(\Exception $ex){
                return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
            }
    }
    public function search(Request $request){
        try{
            $q=$request->name;
            $patient=Patient::where(DB::raw("CONCAT(f_name,' ',m_name,' ',l_name)"),'LIKE','%'.$q.'%')
            ->paginate(PAGINATION_COUNT);
            $pagination = $patient->appends ( array (
                'name' => $request->name,
             ) );
            return view('manager.patientmanagment.PatientsManagment', compact("patient","q"));
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

        return view('manager.patientmanagment.patientHistory' ,compact(['analysis','patient_id']));
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

         return view('manager.patientmanagment.patientHistory' ,compact(['analysis','patient_id','search']));
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
        //
         $normal_range =NormalRange::with('input','analysis')->where('analysis_id',$analysis_id)->get();

        $patient=Patient::where('patient_id',$patient_id)->select(DB::raw("CONCAT(f_name,' ',m_name,' ',l_name) AS PATIENTNAME"),'gender','birthday','address')->first();
        $age=\Carbon\Carbon::parse($patient->birthday)->diff(\Carbon\Carbon::now())->format('%y');

        return view('manager.patientmanagment.result',compact(['results','normal_range','doctor_name','age','patient']));
       }catch(\Exception $ex){
        return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
      }
    }
    public function analysisWating(){
        try{
             $patient =Analysis_requierd::select('patient_id', DB::raw('count(*) as total'))
                 ->groupBy('patient_id')
                 ->where('done',0)
                 ->paginate(PAGINATION_COUNT);
          return view('manager.patientmanagment.AnalysisWaitingResult',compact('patient'));
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
            return view('manager.patientmanagment.AnalysisWaitingResult', compact("patient","search"));
        }catch(\Exception $ex){

            return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
        }
    }
  public function showRequiredAnalysis($patient_id){
    try{
       $analysis=Analysis_requierd::with('analysis')->select('id','analysis_id','created_at')->where([['patient_id','=',$patient_id],['done','=',0]])->paginate(PAGINATION_COUNT);;
       $patient=Patient::where('patient_id',$patient_id)->select(DB::raw("CONCAT(f_name,' ',m_name,' ',l_name) AS PATIENTNAME"),'patient_id')->first();
      return view('manager.patientmanagment.patientAnalysis',compact(['analysis','patient']));
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
        return view('manager.patientmanagment.enterResult',compact(['analysis','analysis_id','patient','age','normal_range','data','analysis_required_id']));
     }catch(\Exception $ex){
     return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
     }
  }
  public function saveResult(storeResultRequest $request,$analysis_required_id,$analysis_id){
       try{
           $table_id=4;
           $us = Auth::user()->username;
           $p_id = Analysis_requierd::where('id',$analysis_required_id)->select('patient_id')->get();
           $id = $p_id[0]->patient_id;

           $p_name = Patient::where('patient_id',$id)->select('f_name','m_name','l_name')->get();

           $name = $p_name[0]->f_name." ".$p_name[0]->m_name." ".$p_name[0]->l_name;
           $an_id = Analysis::where('analysis_id',$analysis_id)->select('analysis_name')->get();

           $an_name= $an_id[0]->analysis_name;
         $input_name=$request->input_name;
         $result=$request->Data;
         $input_Op=$request->input_Op;
         $Data_Op=$request->Data_Op;

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
           $mess = "the user ".$us." add a result for patient ".$name." in analysis ".$an_name;
           $action = Actions::create(
               [
                   'action_name'=>$mess,
                   'user_id'=>auth()->user()->id,
                   'table_id'=>$table_id
               ]
           );
      DB::commit();
      return redirect()->route('manager.patientManagment.AnalysisWating')->with(['success'=>'تم حفظ النتائج بنجاح']);

    }catch(\Exception $ex){
        DB::rollback();
        return redirect()->back()->with(['error'=>' هناك خطأ ما يرجى اعادة المحاولة']);
     }
}

    public function addAnalysis(Request $request){
        try{
          $analysis_prevoius=$request->analysis;
          $p_name=$request->p_name;
          $d_name=$request->d_name;


            $patient=Patient::select(DB::raw("CONCAT(f_name,' ',m_name,' ',l_name) AS PATIENTNAME"))->get();
            $analysis=Analysis::select('analysis_name','price')->get();
            $doctor = Doctor::select(DB::raw("CONCAT(f_name,' ',m_name,' ',l_name) AS DOCTORNAME"))->get();

            return view('manager.patientmanagment.addPatientAnalysis', compact(['patient', 'analysis','doctor','p_name','d_name','analysis_prevoius']));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
        }
    }

    public function filter(FilterRequest $request){
        try{
            $patient_name=$request->patient_name;
            $test=$request->analysis_name;
            $doctor_name=$request->doctor_name;


            $total=0;
            foreach ( $test as $t) {
                $analysis[] = Analysis::select('analysis_id', 'analysis_name', 'price')->where('analysis_name', $t)->get();
            }
            foreach ($analysis as $index=>$a){
                foreach ($a as $price){
                $total+= $price->price;
            } }

             $discount = Discount::selection()->get();
            return view('manager.patientmanagment.confirmPatientAnalysis',compact(['patient_name','doctor_name','analysis','discount','total']));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
        }
    }



    public function confirmPayment(confirmPaymentRequest $request){
      try{
          $us = Auth::user()->username;
          $table_id=4;
          $ana_name=[];
          $comments=$request->comments;
          $test= $request->analysis;
          $analysis_price= $request->price;
           $company= $request->company;
          $patient_name = $request->p_name;
          $doctor_name= $request->d_name;
          $total = $request->total;
           $priceAfterDiscount=$request->after_discount;

         $patient_id=Patient::select('patient_id')->where(DB::raw("CONCAT(f_name,' ',m_name,' ',l_name)"),$patient_name)->first();
         $doctor_id=Doctor::select('doctor_id')->where(DB::raw("CONCAT(f_name,' ',m_name,' ',l_name)"),$doctor_name)->first();
         $discount = Discount::selection()->where('discount_id',$company)->get();
         $analysis=[];
         foreach ( $test as $t) {
             $analysis[] = Analysis::select('analysis_id', 'analysis_name', 'price')->where('analysis_name', $t)->get();
         }
         $ana_id="";
         for($i=0;$i<count($analysis);$i++){
             $ana_id =$ana_id . $analysis[$i][0]->analysis_id." ";
             $my_analysis[]=Analysis::select('analysis_id','analysis_name','price')->where('analysis_id',$analysis[$i][0]->analysis_id)->get();
         }
         $ana_price="";
         foreach($analysis_price as $analysisP){
             $ana_price =$ana_price . $analysisP." ";
         }
          for($i=0;$i<count($analysis);$i++){
              $my_analysis[]=Analysis::select('analysis_id','analysis_name','price')->where('analysis_id',$analysis[$i][0]->analysis_id)->get();
          }

          if($company == 16 && strlen($comments)==0 ){

          DB::beginTransaction();
           $financial_id=financial_managment::insertGetId([
            'total_price'=>$total,
            'discount_id'=>$company,
            'payment'=>$priceAfterDiscount,
            'patient_id'=>$patient_id->patient_id,
            'comments'=>$comments,
            'user_id'=>auth()->user()->id,
            'update_user_id'=>auth()->user()->id
        ]);


           for($count=0 ;$count <count($analysis);$count++){
               $data=array(
                   'analysis_id'=>$analysis[$count][0]->analysis_id,
                   'doctor_id'=>$doctor_id->doctor_id,
                   'patient_id'=>$patient_id->patient_id,
                   'financial_id'=>$financial_id,
                   'user_id'=>auth()->user()->id,
                   'update_user_id'=>auth()->user()->id

               );
               $insert_data2[]=$data;
           }
           Analysis_requierd::insert($insert_data2);

               //send notification to laboratory
              //  $manager=Users::select('id')->where('role_id',2)->get();
               $employee=Users::select('id')->where('role_id',3)->get();
               foreach($employee as $index=>$em){
                 Notifications::insert([
                 'sender_id'=>auth()->user()->id,
                 'recive_id'=>$em->id,
                 'data'=>'new patient is added '.$patient_name
                 ]);
                }
                // foreach($manager as $index=>$ma){
                //  Notifications::insert([
                //  'sender_id'=>auth()->user()->id,
                //  'recive_id'=>$ma->id,
                //  'data'=>'new patient is added '.$patient_name
                //  ]);
                // }
              $ana_name= join(" , ",$ana_name);
              $mess = "the user ".$us." confirm payment and add analysis  : ".$ana_name. " for patient ".$patient_name;
              $action = Actions::create(
                  [
                      'action_name'=>$mess,
                      'user_id'=>auth()->user()->id,
                      'table_id'=>$table_id
                  ]
              );
          DB::commit();

              return redirect()->route('manager.patientManagment.addAnalysis')->with(['success'=>'تم الحقظ بنجاح']);
          }
          else{

            DB::beginTransaction();
            //send notification to admin
            $recive_id=Users::select('id')->where('role_id',1)->get();
            $notify_id= Notifications::insertGetId([
                 'sender_id'=>auth()->user()->id,
                 'recive_id'=>$recive_id[0]->id,
                 'data'=>'confirm discount '.$patient_name
             ]);


             $ana_id = Str::of($ana_id)->trim();
             $ana_price = Str::of($ana_price)->trim();


            NotifyInformation::insert([
                'notify_id'=>$notify_id,
                'patient_name'=>$patient_name,
                'my_analysis'=>$ana_id,
                'doctor_name'=>$doctor_name,
                'priceAfterDiscount'=>$priceAfterDiscount,
                'analysis_price'=>$ana_price,
                'total'=>$total,
                'company'=>$company,
                'comments'=>$comments
              ]);
              $ana_name= join(" , ",$ana_name);
              $mess = "the user ".$us." send payment of analysis  : ".$ana_name. " for patient ".$patient_name;

              $action = Actions::create(
                  [
                      'action_name'=>$mess,
                      'user_id'=>auth()->user()->id,
                      'table_id'=>$table_id
                  ]
              );

                DB::commit();
              return redirect()->route('manager.patientManagment.addAnalysis')->with(['success'=>'تم ارسال طلب تأكيد الخصم للأدمن']);

            }

        }catch(\Exception $ex){
          DB::rollback();
          return $ex;
         return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
        }
  }



 }

