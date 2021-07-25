<?php

namespace App\Http\Controllers\admin;
use App\Models\Analysis;
use App\Models\Analysis_requierd;
use App\Models\Patient;
use App\Models\Discount;
use App\Models\financial_managment;
use Carbon\Carbon;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\patientReportRequest;
use App\Http\Requests\analysisReportRequest;
use App\Http\Requests\discountReportRequest;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    //
    public function Patient(){

        return view('admin.reports.patientReport');
    }

    public function Analysis(){
        return view('admin.reports.analysisReport');
    }

    public function showPatientReport(patientReportRequest $request){
     try{
        
          $dateFrom=$request->dateFrom;
          $dateTo=$request->dateTo;
        if($dateTo==null){
            $dateTo = Carbon::now();
        }
        if($dateFrom > $dateTo){
            return redirect()->route('admin.report.patient')->with(['error'=>' يجب ادخال تاريخ البداية اقل من النهاية ']);
        }
          $ids=Analysis_requierd::select('financial_id','patient_id')->distinct()->whereBetween('time', [$dateFrom, $dateTo])->get();
            if(count($ids) == 0 ){
                return redirect()->route('admin.report.patient')->with(['error'=>' لا يوجد مرضى ضمن الفترة المدخلة']);
            }
            $idF=[];
            $idP=[];
            $data=[];
            $analysis=[];
            $sumPayment=0;
            $sumtotalPrice=0;
            $countP=0;
            $countF=0;

            foreach($ids as $index=>$id){
               if(!in_array($id->financial_id, $idF)){
                $idF[]=$id->financial_id;
               }
               if(!in_array($id->patient_id, $idP)){
                   $idP[]=$id->patient_id;
                }
            }
            $countP=count($idP);
           $countF=count($idF);
           foreach($idF as $index=>$f){
            $dataP=Analysis_requierd::select()->with('analysis','doctor','patient','financial')->where('financial_id',$f)->whereBetween('time', [$dateFrom, $dateTo])->get();
            foreach($dataP as $r){
                $analysis[]=$r->analysis[0]->analysis_name;
            }
            $data[]= array($f=> $analysis);
            $analysis=[];

            $data1[]=Analysis_requierd::select('patient_id','doctor_id','financial_id','created_at')->distinct()->with('doctor','patient','financial')->where('financial_id',$f)->whereBetween('time', [$dateFrom, $dateTo])->get();
            $sumPayment +=$dataP[0]->financial->payment;
            $sumtotalPrice +=$dataP[0]->financial->total_price;
        }

            return view('admin.reports.patientReport',compact('data','data1','countF','countP','dateFrom','dateTo','sumPayment','sumtotalPrice'));

     }catch(\Exception $ex){
        return redirect()->back()->with(['error'=>' هناك خطأ ما يرجى اعادة المحاولة']);
      }
    }

    public function showAnalysisReport(analysisReportRequest $request){
        $from = $request->from;
        $to = $request->to;
        if($to == null){
            $to = Carbon::now();
        }
        if($from>$to){
            return redirect()->route('admin.report.analysis')->with(['error'=>' يجب ادخال تاريخ البداية اقل من النهاية']);
        }
        $max = [];
        $sum=0;
        $analysis_name="";

        try {

            $analysis = Analysis_requierd::select('analysis_id', DB::raw('count(analysis_id) as name_count'))->with('analysis')->whereBetween('time', [$from, $to])->distinct()->groupBy('analysis_id')->get();

            if(count($analysis) == 0 ){
                return redirect()->route('admin.report.analysis')->with(['error'=>' لا يوجد تحاليل ضمن الفترة المدخلة']);
            }

            $high= $analysis[0]->analysis[0]->analysis_id;
             for($i=0; $i<count($analysis); $i++){

                $max[] = $analysis[$i]->name_count;
                $sum += $analysis[$i]->name_count;

                if($high<max($max)){
                    $high=max($max);
                    $analysis_name = $analysis[$i]->analysis[0]->analysis_name;
                }
             }
            // return $analysis_name;
            // return max($max);

            // $high_analysis = Analysis_requierd::select('analysis_id')->with('analysis')->where( DB::raw('count(analysis_id)'),$high)->groupBy('analysis_id')->get();
          //  return $high_analysis;
          //   return $sum;
            // return $analysis[0]->analysis[0]->analysis_name;
            $grouped = $analysis->groupBy('analysis_id')->map(function ($row) {
                return $row->count();
            });

            // return $grouped;
            $not_used = Analysis::select('analysis_id','analysis_name')->whereNotIn('analysis_id', $analysis)->distinct()->get();
          //   return $not_used;
            return view('admin.reports.analysisReport',compact('analysis','grouped','not_used','from','to','high','sum','analysis_name'));

        }catch(\Exception $ex){
            return redirect()->back()->with(['error'=>' هناك خطأ ما يرجى اعادة المحاولة']);
        }


    }


    public function Discount(){
        return view('admin.reports.discountReport');
    }
    public function ShowDiscount(discountReportRequest $request){
        try{
            $dateFrom=$request->dateFrom;
            $dateTo=$request->dateTo;

            if($dateTo==null){
                $dateTo = Carbon::now();
            }
            if($dateFrom > $dateTo){
                return redirect()->route('admin.report.showDiscount')->with(['error'=>' يجب ادخال تاريخ البداية اقل من النهاية ']);
            }
            $discounts=Discount::selection()->whereBetween('time',[$dateFrom, $dateTo])->get();

            if(count($discounts) == 0 ){
                return redirect()->route('admin.report.showDiscount')->with(['error'=>' لا يوجد تحاليل ضمن الفترة المدخلة']);
            }
         $count=Discount::select(DB::raw('sum(company_finantial_recivable) as total1'),DB::raw('sum(laboratory_finantial_recivable) as total2'))->whereBetween('time', [$dateFrom, $dateTo])->get();
         $countPatient=financial_managment::groupBy('discount_id')->select('discount_id',DB::raw('count(patient_id) as countPatient'))->whereBetween('time', [$dateFrom, $dateTo])->get();
         $count1=$count[0]->total1;
         $count2=$count[0]->total2;
        return view('admin.reports.discountReport',compact('discounts','dateFrom','dateTo','count1','count2','countPatient'));
        }catch(\Exception $ex){
          return redirect()->back()->with(['error'=>' هناك خطأ ما يرجى اعادة المحاولة']);
       }
    }
}
