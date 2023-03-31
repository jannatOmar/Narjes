<?php
namespace App\Http\Controllers\admin;
use App\Models\Actions;
use App\Models\DeleteInput;
use App\Models\Group;
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
use Illuminate\Support\Facades\Auth;

class AnalysisController extends Controller
{
    public function index(){
        $analysis=Analysis::selection()->paginate(PAGINATION_COUNT);
        return view('admin.analysis.viewAnalysis', compact("analysis"));
    }

    public function filter(Request $request){
        $group=$request->group;
        if($group == 0){
            $analysis=Analysis::selection()->paginate(PAGINATION_COUNT);
        }else{
            $analysis= Analysis::where('group_id', $request->group)->paginate(PAGINATION_COUNT);
            $pagination = $analysis->appends ( array (
                'group' => $request->group,
        ) );
        }
        return view('admin.analysis.viewAnalysis', compact("analysis","group"));
    }
    public function search(Request $request){
     try{
       $q=$request->name;
       $analysis=Analysis::where('analysis_name','LIKE','%'.$q.'%')->orWhere('price',$q)->paginate(PAGINATION_COUNT);
       $pagination = $analysis->appends ( array (
        'name' => $request->name,
        ) );
       return view('admin.analysis.viewAnalysis', compact("analysis","q"));
     }catch(\Exception $ex){
        return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
     }
    }
     public function viewForm($analysis_id){
      try{

              $normal_range =NormalRange::selection()->with('input','analysis')->where('analysis_id',$analysis_id)->get();
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
        //   return var_dump($data);
         $countResult =Analysis_requierd::select("analysis_id",DB::raw("COUNT(analysis_id) as count_chick"))
          ->where([['analysis_id',$analysis_id],['done',1]])
          ->groupBy("analysis_id")
          ->get();
          $count_chick=0;
          if(!empty($countResult[0]->count_chick)){
          $count_chick=$countResult[0]->count_chick;
          }
          $i=0;
          $l=0;

        return view('admin.analysis.viewForm',compact('analysis','input','data_option','i','l','normal_range','data','count_chick'));
      }catch(\Exception $ex){
        return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
      }
     }
     public function createForm(){
        return view('admin.analysis.createNewForm');
     }
     public function storeForm(NewFormRequest $request){
      try{
          $us = Auth::user()->username;
          $table_id=1;
          $analysis_name=$request->analysis_name;
         $group_id=$request->group;
         $price=$request->price;
      DB::beginTransaction();
         $analysis_id=Analysis::insertGetId(
          [
              'analysis_name'=>$analysis_name,
              'price'=>$price,
              'group_id'=>$group_id,
              'user_id'=>auth()->user()->id,
              'update_user_id'=>auth()->user()->id
          ]
         );

          $input_name = $request->input;
          $option_input = $request->optioInput;




         if(!empty($input_name)) {

          $max_normal = $request->max_normal;
          $min_normal = $request->min_normal;
          $unit=$request->unit;

          for ($count = 0; $count < count($input_name); $count++) {
              $data = array(
                  'input_name' => $input_name[$count],
                  'analysis_id' => $analysis_id,
                  'user_id'=>auth()->user()->id,
                  'update_user_id'=>auth()->user()->id
              );
              $insert_data[] = $data;
          }
          foreach ($insert_data as $in_d) {
              $input_id[] = Inputs::insertGetId($in_d);
          }

          for ($count = 0; $count < count($input_name); $count++) {
              // if ($max_normal[$count] > $min_normal[$count]) {
                  $data = array(
                      'high_range' => $max_normal[$count],
                      'low_range' => $min_normal[$count],
                      'unit'=>$unit[$count],
                      'analysis_id' => $analysis_id,
                      'input_id' => $input_id[$count],
                      'user_id'=>auth()->user()->id,
                      'update_user_id'=>auth()->user()->id
                  );
                  $insert_data2[] = $data;
              // } else {
              //     return redirect()->back()->with(['error' => '  max-range must be bigger than  min-range']);
              // }
          }
          NormalRange::insert($insert_data2);
         }
         if(!empty($option_input)){
              for ($count = 0; $count < count($option_input); $count++) {
                  $data1 = array(
                      'input_name' => $option_input[$count],
                      'analysis_id' => $analysis_id,
                      'user_id'=>auth()->user()->id,
                      'update_user_id'=>auth()->user()->id
                  );

                  $insert_data3[] = $data1;
              }

              foreach ($insert_data3 as $in_d) {
                  $input_id1[] = Inputs::insertGetId($in_d);
              }
              for ($i = 0; $i<count($option_input); $i++){
                 $arr[] = "optionoption".($i+1);
              }

              for ($i = 0; $i<count($arr); $i++){
                $my_option[]=$request->input($arr[$i]);
                $insert_option=[];
             for($j=0; $j<count($my_option[$i]); $j++){
                 $option_data = array(
                     'input_id' => $input_id1[$i],
                     'analysis_id' => $analysis_id,
                     'user_id'=>auth()->user()->id,
                     'update_user_id'=>auth()->user()->id,
                     'option_name'=>$my_option[$i][$j]
                 );
                 $insert_option[]=$option_data;
             }
                Options::insert($insert_option);
              }
         }
         if(empty($input_name) && empty($option_input)){
           return redirect()->back()->with(['error'=>' يجب ادخال اتربيوت للتحليل المدخل']);
         }
         $mess = "the user ".$us." create a new form for analysis ".$analysis_name;
          $action = Actions::create(
              [
                  'action_name'=>$mess,
                  'user_id'=>auth()->user()->id,
                  'table_id'=>$table_id
              ]
          );

              DB::commit();
         return redirect()->route('admin.showAnalysis')->with(['success'=>'تم الحفظ بنجاح']);
         }catch(\Exception $ex){

          DB::rollback();
          return redirect()->back()->with(['error'=>' هناك خطأ ما يرجى اعادة المحاولة, يجب عدم تكرار اسم الحقل الواحد']);
        }
   }
     public function AddNewInputs($analysis_id){
       try{
          $analysis=Analysis::where('analysis_id',$analysis_id)->get();
          return view('admin.analysis.addNewInputs',compact('analysis'));
        }catch(\Exception $ex){
        return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
        }
   }
   public function storeNewInputs($analysis_id,addNewInputsRequest $request){
    try{
        $an = Analysis::where('analysis_id',$analysis_id)->get();
      DB::beginTransaction();
       $input_name = $request->input;
      $option_input = $request->optioInput;
      $us = Auth::user()->username;
      $table_id=1;
      $str = "";
      $st="";



     if(!empty($input_name)) {

      $max_normal = $request->max_normal;
      $min_normal = $request->min_normal;
      $unit = $request->unit;

     //return $word = join(" ",$input_name);


      for ($count = 0; $count < count($input_name); $count++) {
          $data = array(
              'input_name' => $input_name[$count],
              'analysis_id' => $analysis_id,
              'user_id'=>auth()->user()->id,
              'update_user_id'=>auth()->user()->id
          );
          $insert_data[] = $data;
      }
      foreach ($insert_data as $in_d) {
          $input_id[] = Inputs::insertGetId($in_d);
      }
     // return $input_id;
      for ($count = 0; $count < count($input_name); $count++) {
          // if ($max_normal[$count] > $min_normal[$count]) {
              $data = array(
                  'high_range' => $max_normal[$count],
                  'low_range' => $min_normal[$count],
                  'unit'=>$unit[$count],
                  'analysis_id' => $analysis_id,
                  'input_id' => $input_id[$count],
                  'user_id'=>auth()->user()->id,
                  'update_user_id'=>auth()->user()->id
              );
              $insert_data2[] = $data;
          // } else {
          //     return redirect()->back()->with(['error' => '  max-range must be bigger than  min-range']);
          // }
      }
      for($i=0; $i<count($insert_data2); $i++){
          $str.="input: ".$input_name[$i]." male range= ".$insert_data2[$i]["high_range"]." & female range= ".$insert_data2[$i]["low_range"]." ,";
      }
    // return $str;

     // return $insert_data2;



      NormalRange::insert($insert_data2);
     }

     if(!empty($option_input)){
          for ($count = 0; $count < count($option_input); $count++) {
              $data1 = array(
                  'input_name' => $option_input[$count],
                  'analysis_id' => $analysis_id,
                  'user_id'=>auth()->user()->id,
                  'update_user_id'=>auth()->user()->id
              );

              $insert_data3[] = $data1;
          }
        //  return $insert_data3;
          foreach ($insert_data3 as $in_d) {
              $input_id1[] = Inputs::insertGetId($in_d);
          }
          for ($i = 0; $i<count($option_input); $i++){
             $arr[] = "optionoption".($i+1);
          }
          for ($i = 0; $i<count($arr); $i++){
            $my_option[]=$request->input($arr[$i]);
            $insert_option=[];
            $st .= "input: ".$option_input[$i]." options[ ";
         for($j=0; $j<count($my_option[$i]); $j++){
             $option_data = array(
                 'input_id' => $input_id1[$i],
                 'analysis_id' => $analysis_id,
                 'user_id'=>auth()->user()->id,
                 'update_user_id'=>auth()->user()->id,
                 'option_name'=>$my_option[$i][$j]
             );
             $insert_option[]=$option_data;
             $st.=$option_data["option_name"].",";
         }
         $st.="] ";

             Options::insert($insert_option);
          }
      //   return $st;

     }if(empty($option_input) && empty($input_name)){
    return redirect()->back()->with(['error'=>' يجب ادخال اتربيوت للتحليل المراد تعديله']);
    }
     $mess = "the user ".$us." add new inputs ".$str." ".$st." for analysis ".$an[0]->analysis_name;
        $action = Actions::create(
            [
                'action_name'=>$mess,
                'user_id'=>auth()->user()->id,
                'table_id'=>$table_id
            ]
        );
     DB::commit();
     return redirect()->route('admin.showAnalysis')->with(['success'=>'تم الحفظ بنجاح']);


     }catch(\Exception $ex){
      DB::rollback();
      return redirect()->back()->with(['error'=>' هناك خطأ ما يرجى اعادة المحاولة, يجب عدم تكرار اسم الحقل الواحد']);
    }

   }

    public function analysisUpdateForm(UpdateFormRequest $request,$analysis_id){
         try{
             $us = Auth::user()->username;
             $table_id=1;
             $inp="";
             $opt="";
             $an = Analysis::where('analysis_id',$analysis_id)->select('analysis_name')->get()[0]->analysis_name;
          DB::beginTransaction();
          Analysis::where('analysis_id',$analysis_id)
            ->update(
             [
                 "price"=>$request["price"],
                 "group_id"=>$request["group"],
                 'update_user_id'=>auth()->user()->id
             ]
            );
          $gr = Group::where('group_id',$request["group"])->select('group_name')->get()[0]->group_name;
          $info1 = " the price= ".$request["price"]." & group: ".$gr;

          $input_name=$request->input_name;
          $option_input = $request->optioInput;
        if(!empty($input_name)) {
          $max_normal=$request->max_normal;
          $min_normal=$request->min_normal;
          $unit=$request->unit;

          for($i=0; $i<count($max_normal);$i++){
              $inp.="input:".$input_name[$i]." male range[".$max_normal[$i]."], female range[".$min_normal[$i]."] unit: ".
                  $unit[$i].", ";
          }
          for($count=0 ;$count <count($input_name);$count++){
             $data[]= $input_name[$count];
          }
          $input_id=Inputs::where('analysis_id',$analysis_id)->get('input_id');
          foreach($input_id as $inp_id){
            $input=NormalRange::select('input_id')->where('input_id',$inp_id->input_id)->get();

            if(count($input)>0){
            $input_id1[]=$input;
            }
             }
            for($i=0;$i<count($input_id1);$i++){
              Inputs::where(['analysis_id'=>$analysis_id,'input_id'=>$input_id1[$i][0]->input_id])->update(
                  [
                 'input_name'=>$data[$i],
                  'update_user_id'=>auth()->user()->id
                  ]);
            }

           for($count=0 ;$count <count($input_name);$count++){
             $data2=array(
               'high_range'=>$max_normal[$count],
               'low_range'=>$min_normal[$count],
               'unit'=>$unit[$count],
               'analysis_id'=>$analysis_id,
               'input_id'=>$input_id1[$count][0]->input_id,
               'update_user_id'=>auth()->user()->id

             );
           $insert_data2[]=$data2;
          }

          foreach($insert_data2 as $count=> $index){
               NormalRange::where(['analysis_id'=>$analysis_id,'input_id'=>$index['input_id']])->update(
                   [
              'high_range'=>$index['high_range'],
              'low_range'=>$index['low_range'],
              'unit'=>$index['unit'],
              'update_user_id'=>auth()->user()->id
               ]
            );

          }
        }

        if(!empty($option_input)){
            $input_id=[];
            $input_id1=[];
            $input=[];
             $input_id=Inputs::where('analysis_id',$analysis_id)->get('input_id');
            foreach($input_id as $inp_id){
                 $input=Options::select('input_id','option_id')->where('input_id',$inp_id->input_id)->distinct()->get();
                if(count($input)>0){
                $input_id1[]=$input;
                }
            }
            foreach($input_id1 as $key=> $index){
               Inputs::where('analysis_id',$analysis_id)->where('input_id',$index[0]->input_id)->update(
                    [
                    'input_name'=>$option_input[$key],
                    'update_user_id'=>auth()->user()->id
                    ]);
             }
            for ($i = 0; $i<count($option_input); $i++){
                $arr[] = "optionoption".($i+1);
             }
            for ($i = 0; $i<count($arr); $i++){
               $my_option[]=$request->input($arr[$i]);
               $insert_option=[];
               $Options= Options::select('option_name')->where('input_id',$option_input[$i])->where('analysis_id',$analysis_id)->get();

               foreach($input_id1[$i] as $key=> $index1){
                  Options::where('analysis_id',$analysis_id)->where('input_id',$index1->input_id)
                    ->where('option_id',$index1->option_id)->update(
                         [
                        'option_name'=>$my_option[$i][$key],
                         'update_user_id'=>auth()->user()->id
                        ]);
                 }
                }


            for($i=0; $i<count($option_input); $i++){
                    $opt.=" input ".$option_input[$i]." with options [ ";
                for($j=0; $j<count($my_option[$i]); $j++){
                    $opt.="".$my_option[$i][$j].", ";
                }
                $opt.=" ],";
            }
        //    return $opt;

                for ($i = 0; $i<count($arr); $i++){
                  $my_option[]=$request->input($arr[$i]);
                    foreach($input_id1[$i] as $key=> $index1){
                      $op[]= Options::select('option_name','input_id')
                      ->where('analysis_id',$analysis_id)
                      ->where('option_id',$index1->option_id)
                      ->where('input_id',$index1->input_id)
                      ->distinct()
                      ->get();
                    }
                    foreach($op as $key1=> $index2){
                      $options[]=$index2[0]->option_name;
                      $in=$index2[0]->input_id;
                    }

                    foreach($my_option[$i] as $key2=> $index3){
                       $existV=in_array($index3,$options);
                       if(!$existV){
                              Options::create([
                                   'input_id' => $in,
                                   'analysis_id' => $analysis_id,
                                   'user_id'=>auth()->user()->id,
                                   'update_user_id'=>auth()->user()->id,
                                   'option_name'=>$index3
                     ]);
                       }
                    }
                }
        }
                $mess="the user ".$us." update form of analysis ".$an." with new values: ".
                $info1." inputs{ ".$inp." ".$opt."}";
             $action = Actions::create(
                 [
                     'action_name'=>$mess,
                     'user_id'=>auth()->user()->id,
                     'table_id'=>$table_id
                 ]
             );
          DB::commit();
          return redirect()->route('admin.showAnalysis')->with(['success'=>'تم التعديل بنجاح']);
         }catch(\Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['error'=>'  هناك خطأ ما يرجى اعادة المحاولة, يجب عدم تكرار اسم الخيار الواحد للحقل الواحد في التحليل الواحد']);
          }

    }

    public function deleteInputName($analysis_id,$input_id){
        try{
            $us = Auth::user()->username;
            $table_id=1;
             $name = Inputs::where('input_id',$input_id)->where('analysis_id',$analysis_id)->get();
         Inputs::where(['analysis_id'=>$analysis_id,'input_id'=>$input_id])->delete();
            $an = Analysis::where('analysis_id',$analysis_id)->get();
             $i=DeleteInput::where(['analysis_id'=>$analysis_id,'input_name'=>$name[0]->input_name])->get();
            $mess = "the user ".$us." delete input ".$i[0]->input_name." in analysis ".$an[0]->analysis_name;
            $action = Actions::create(
                [
                    'action_name'=>$mess,
                    'user_id'=>auth()->user()->id,
                    'table_id'=>$table_id
                ]
            );
         return redirect()->back()->with(['success'=>'تم الحذف بنجاح']);
         }catch(\Exception $ex){
            return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
        }
     }
    public function deleteInput($analysis_id,$input_id){
       try{
           $us = Auth::user()->username;
           $table_id=1;
        DB::beginTransaction();
        $n = Inputs::where(['analysis_id'=>$analysis_id,'input_id'=>$input_id])->get();
       $an = Analysis::where('analysis_id',$analysis_id)->get();
       $i_n = $n[0]->input_name;
        //   return $an[0]->analysis_name." ".$i_n;
        NormalRange::where(['analysis_id'=>$analysis_id,'input_id'=>$input_id])->delete();
        Inputs::where(['analysis_id'=>$analysis_id,'input_id'=>$input_id])->delete();
        $mess = "the user ".$us." delete input ".$i_n." from analysis ".$an[0]->analysis_name;
           $action = Actions::create(
               [
                   'action_name'=>$mess,
                   'user_id'=>auth()->user()->id,
                   'table_id'=>$table_id
               ]
           );
        DB::commit();

        return redirect()->back()->with(['success'=>'تم الحذف بنجاح']);
        }catch(\Exception $ex){
           DB::rollback();
           return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
       }
    }
    public function deleteOption($analysis_id,$input_id,$option_id){
        try{
            $us = Auth::user()->username;
            $table_id=1;
            $mess="";
            $opt=Options::select('option_name')->where(['analysis_id'=>$analysis_id,'input_id'=>$input_id,'option_id'=>$option_id])->get();
          $option = $opt[0]->option_name;
         // return $option;
            $n = Inputs::where(['analysis_id'=>$analysis_id,'input_id'=>$input_id])->get();
          //  return $n[0]->input_name;
            $an = Analysis::where('analysis_id',$analysis_id)->get();
          //  return $an[0]->analysis_name;
         DB::beginTransaction();
         Options::where(['analysis_id'=>$analysis_id,'option_id'=>$option_id,'input_id'=>$input_id])->delete();
        $opt=Options::select('option_id')->where(['analysis_id'=>$analysis_id,'input_id'=>$input_id])->get();
        $mess = "the user ".$us." delete option ".$option.
        " from input ".$n[0]->input_name." for analysis ".$an[0]->analysis_name;
        if(count($opt)<=0){
            Inputs::where(['analysis_id'=>$analysis_id,'input_id'=>$input_id])->delete();
            $mess = "the user ".$us." delete input ".$n[0]->input_name." from analysis ".$an[0]->analysis_name;
        }
            $action = Actions::create(
                [
                    'action_name'=>$mess,
                    'user_id'=>auth()->user()->id,
                    'table_id'=>$table_id
                ]
            );

         DB::commit();

         return redirect()->back()->with(['success'=>'تم الحذف بنجاح']);
         }catch(\Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
        }
     }

}
