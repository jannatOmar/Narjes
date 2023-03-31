<?php
namespace App\Http\Controllers\employee;
use DB;
use App\Models\Analysis;
use App\Models\Inputs;
use App\Models\Options;
use App\Models\NormalRange ;
use App\Models\Analysis_requierd ;
use Illuminate\Http\Request;
use App\Http\Requests\NewFormRequest;
use App\Http\Requests\addNewInputsRequest;
use App\Http\Requests\UpdateFormRequest;
use App\Http\Controllers\Controller;

class AnalysisController extends Controller
{
    public function index(){
        $analysis=Analysis::selection()->paginate(PAGINATION_COUNT);
        return view('employee.analysis.viewAnalysis', compact("analysis"));
    }

    public function filter(Request $request){
        if($request->group == 0){
            $analysis=Analysis::selection()->paginate(PAGINATION_COUNT);
        }else{
            $analysis= Analysis::where('group_id', $request->group)->paginate(PAGINATION_COUNT);
            $pagination = $analysis->appends ( array (
                'group' => $request->group,
        ) );
        }
        return view('employee.analysis.viewAnalysis', compact("analysis"));
    }
    public function search(Request $request){
     try{
       $q=$request->name;
       $analysis=Analysis::where('analysis_name','LIKE','%'.$q.'%')->orWhere('price',$q)->paginate(PAGINATION_COUNT);
       $pagination = $analysis->appends ( array (
        'name' => $request->name,
        ) );
       return view('employee.analysis.viewAnalysis', compact("analysis"));
     }catch(\Exception $ex){
        return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
     }
    }
     public function viewForm($analysis_id){
      try{

              $normal_range =NormalRange::with('input','analysis')->where('analysis_id',$analysis_id)->get();
             if(!empty($normal_range)){
                   $ana =Analysis::where('analysis_id',$analysis_id)->get();
                  $analysis=$ana[0];
             }else{
                $analysis=$normal_range[0]->analysis;
             }
              $data=[];
              $data_option=[];
              $data_optionId=[];
              $input=Options::select('input_id')->with('input','analysis')->where('analysis_id',$analysis_id)->distinct()->get();
            foreach($input as $i=>$op){
               $optionName=Options::select('option_id','option_name','input_id')->with('input','analysis')->where('input_id',$op->input_id)->get();
               foreach($optionName as $i=>$kk){
                   $optionO[]=$optionName[$i]->option_name;
                  $data_optionId[]=$optionName[$i]->option_id;
                }
                $data_option[]=$data_optionId;
                $data_optionId=[];
                 $input_name=$op->input[0]->input_name;
               $data[]= array($input_name => $optionO);
               $optionO=[];
          }

        return view('employee.analysis.viewForm',compact('analysis','input','data_option','normal_range','data'));
      }catch(\Exception $ex){
        return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
      }
     }


}
