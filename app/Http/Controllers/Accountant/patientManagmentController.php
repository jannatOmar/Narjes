<?php

namespace App\Http\Controllers\Accountant;
    use App\Http\Requests\FilterRequest;
    use App\Models\Actions;
    use App\Models\Analysis;
    use App\Models\NormalRange ;
    use App\Models\All_Results;
    use App\Models\Analysis_requierd;
    use App\Models\Discount;
    use App\Models\Inputs;
    use App\Models\Options;
    use App\Models\Users;
    use App\Models\NotifyInformation;
    use App\Models\Patient;
    use App\Models\Doctor;
    use App\Models\Notifications;
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
    use Illuminate\Support\Str;

    use Carbon\Carbon;
        class patientManagmentController extends Controller
    {

        public function index(){
            try{
            $patient=Patient::selection()->paginate(PAGINATION_COUNT);
            return view('accountant.patientmanagment.PatientsManagment', compact("patient"));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error'=>'هناك خطأ مل يرجى المحاولة فيما بعد']);
          }
        }
        public function edit($patient_id){
         try{
           $patient=Patient::where('patient_id',$patient_id)->selection()->first();
            if(!$patient){
                return redirect()->route('admin.patientManagment')->with(['error'=>'هذاالمريض غير موجود']);
            }
            return view('accountant.patientmanagment.UpdatePInformation',compact('patient'));
         }catch(\Exception $ex){
            return redirect()->back()->with(['error'=>'هناك خطأ مل يرجى المحاولة فيما بعد']);
          }
        }
         public function update(UpdatePatientRequest $request,$patient_id){
            try{
                $us = Auth::user()->username;
                $table_id=4;
                $p = Patient::where('patient_id',$patient_id)->get();
                 $old = "".$p[0]->f_name." ".$p[0]->f_name." ".$p[0]->m_name." ".$p[0]->l_name.
                  " ".$p[0]->gender." ".$p[0]->email." ".$p[0]->phone." ".$p[0]->address." ".$p[0]->birthday;
                 $new = "".$request["f_name"]." ".$request["m_name"]." ".$request["l_name"].
                     " ".$request["address"]." ".$request["phone"]." ".$request["email"]." ".$request["birthday"].
                     " ".$request["gender"];
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
             $mess = " the user ".$us." update on patient".$p[0]->f_name." ".$p[0]->f_name." ".$p[0]->m_name." ".$p[0]->l_name.
             " FROM: ".$old." TO ".$new;
                $action = Actions::create(
                    [
                        'action_name'=>$mess,
                        'user_id'=>auth()->user()->id,
                        'table_id'=>$table_id
                    ]
                );
             return redirect()->route('accountant.patientManagment')->with(['success'=>'تم التعديل بنجاح']);
              }catch(\Exception $ex){
              return redirect()->back()->with(['error'=>'هناك خطأ مل يرجى المحاولة فيما بعد']);
            }
    }
    public function create(){
        return view('accountant.patientmanagment.AddPatients');
    }
    public function store(AddPatientRequest $request){
        try{
            $us = Auth::user()->username;
            $table_id=4;
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
             $mess = "the user ".$us." add a new patient: ".$request->f_name." "
                 .$request->m_name." ".$request->l_name." ".$request->phone." "
                 .$request->email." ".$request->address." ".$request->gender." "
                 .$request->birthday;

            $action = Actions::create(
                [
                    'action_name'=>$mess,
                    'user_id'=>auth()->user()->id,
                    'table_id'=>$table_id
                ]
            );

            return redirect()->route('accountant.patientManagment')->with(['success'=>'تم الحفظ بنجاح']);
            }catch(\Exception $ex){
                return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
            }
    }
    public function search(Request $request){
        try{
            $q=$request->name;
            $patient=Patient::where(DB::raw("CONCAT(f_name,' ',m_name,' ',l_name)"),'LIKE','%'.$q.'%')->paginate(PAGINATION_COUNT);
            $pagination = $patient->appends ( array (
                'name' => $request->name,
             ) );
            return view('accountant.patientmanagment.PatientsManagment', compact("patient","q"));
        }catch(\Exception $ex){

            return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
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

            return view('accountant.patientmanagment.addPatientAnalysis', compact(['patient', 'analysis','doctor','p_name','d_name','analysis_prevoius']));
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
            return view('accountant.patientmanagment.confirmPatientAnalysis',compact(['patient_name','doctor_name','analysis','discount','total']));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
        }
    }

    public function confirmPayment(confirmPaymentRequest $request){
      try{
          $us = Auth::user()->username;
          $table_id=4;
          $comments=$request->comments;
          $test= $request->analysis;
           $analysis_price= $request->price;
           $company= $request->company;
          $patient_name = $request->p_name;
          $doctor_name= $request->d_name;
          $total = $request->total;
           $priceAfterDiscount=$request->after_discount;

           $mess = "";

          $an = implode(" , ",$test);

           $patient_id=Patient::selection()->where(DB::raw("CONCAT(f_name,' ',m_name,' ',l_name)"),$patient_name)->first();

           $p_name = $patient_id->f_name." ".$patient_id->m_name." ".$patient_id->l_name;
           $doctor_id=Doctor::selection()->where(DB::raw("CONCAT(f_name,' ',m_name,' ',l_name)"),$doctor_name)->first();

          $d_name = $doctor_id->f_name." ".$doctor_id->m_name." ".$doctor_id->l_name;
         

         for($i=0;$i<count($test);$i++){
          $analysis[]=Analysis::select('analysis_id')->where([['analysis_name',$test[$i]],['price',$analysis_price[$i]]])->get();

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
           if($doctor_id->doctor_id == 16){
           $mess = "the user ".$us." add analysis " .$an." for patient ".$p_name.
           "  ,total price: ".$total;
           } else{
               $mess = "the user ".$us." add analysis ".$an." for patient ".$p_name.
                 " from doctor ".$d_name." ,total price: ".$total;
           }

         $action = Actions::create(
             [
                 'action_name'=>$mess,
                 'user_id'=>auth()->user()->id,
                 'table_id'=>$table_id
             ]
         );
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
                $manager=Users::select('id')->where('role_id',2)->get();
                $employee=Users::select('id')->where('role_id',3)->get();
                foreach($employee as $index=>$em){
                  Notifications::insert([
                  'sender_id'=>auth()->user()->id,
                  'recive_id'=>$em->id,
                  'data'=>'new patient is added '.$patient_name
                  ]);
                 }
                 foreach($manager as $index=>$ma){
                  Notifications::insert([
                  'sender_id'=>auth()->user()->id,
                  'recive_id'=>$ma->id,
                  'data'=>'new patient is added '.$patient_name
                  ]);
                 }

          DB::commit();
              return redirect()->route('accountant.patientManagment.addAnalysis')->with(['success'=>'تم الحقظ بنجاح']);
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

         if($doctor_id->doctor_id == 16){
             $doctor_name= "no doctor";
         }
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


         $type = Discount::where('discount_id',$company)->get()[0];
         $t = "company name: ".$type->company_name." , type : ".$type->discount_type." , parcenteg  : ".$type->discount_parcenteg."%";
          if($company == 16) {
              if($doctor_id->doctor_id == 16){
                  $mess = "the user ".$us." add analysis ".$an." for patient ".$p_name.
                      " ,total price: ".$total." and required price: ".$priceAfterDiscount." , comment: ".$comments;
              } else{
                  $mess = "the user ".$us." add analysis ".$an." for patient ".$p_name.
                      "from doctor ".$d_name." ,total price: ".$total." and required price: ".$priceAfterDiscount." , comment".$comments;
              }
          } else{
         if($doctor_id->doctor_id == 16){
             $mess = "the user ".$us." add analysis ".$an." for patient ".$p_name.
                 " ,total price: ".$total." and required price: ".$priceAfterDiscount.",  Discount type : ".$t;
         } else{
             $mess = "the user ".$us." add analysis ".$an." for patient ".$p_name.
                 "from doctor ".$d_name." ,total price: ".$total." and required price: ".$priceAfterDiscount." , Discount type : ".$t ." ";
         } }



          if($company != 16 && strlen($comments)>0 ){
              if($doctor_id->doctor_id == 16){
                  $mess = "the user ".$us." add analysis ".$an." for patient ".$p_name.
                      " ,total price: ".$total." and required price: ".$priceAfterDiscount." ,Discount type {".$t."} ,comment: ".$comments;
              } else{
                  $mess = "the user ".$us." add analysis ".$an." for patient ".$p_name.
                      "from doctor ".$d_name." ,total price: ".$total." and required price: ".$priceAfterDiscount." ,Discount type {".$t."} ,comment: ".$comments;;
              }
          }

         $action = Actions::create(
             [
                 'action_name'=>$mess,
                 'user_id'=>auth()->user()->id,
                 'table_id'=>$table_id
             ]
         );


         DB::commit();
            return redirect()->route('accountant.patientManagment.addAnalysis')->with(['success'=>'تم ارسال طلب تأكيد الخصم للأدمن']);

          }

        }catch(\Exception $ex){
          DB::rollback();
          return $ex;
         return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
        }
  }
 }

