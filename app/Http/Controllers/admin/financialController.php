<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Actions;
use App\Models\Analysis;
use App\Http\Requests\updatePriceRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class financialController extends Controller
{
    public function index (){
        $analysis = Analysis::select('analysis_id', 'analysis_name', 'price')->paginate(PAGINATION_COUNT);
        return view('admin.financialDetails.laboratoryAnalysisPrice', compact('analysis'));
    }

    public function search(Request $request){
        try{
            $q=$request->name;
            $analysis=Analysis::where('analysis_name','LIKE','%'.$q.'%')->paginate(PAGINATION_COUNT);
            $pagination = $analysis->appends ( array (
                'name' => $request->name,
            ) );
            return view('admin.financialDetails.laboratoryAnalysisPrice', compact("analysis","q"));
        }catch(\Exception $ex){
            return $ex;
            return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
        }
    }

    public function edit($analysis_id){
        try{
            $analysis=Analysis::where('analysis_id',$analysis_id)->selection()->first();
            if(!$analysis){
                return redirect()->route('admin.laboratoryDetails')->with(['error'=>'هذا التحليل غير موجود']);
            }
            return view('admin.financialDetails.editPrice',compact('analysis'));
        }catch(\Exception $ex){
            return $ex;
            return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى المحاولة فيما بعد']);
        }
    }

    public function update(updatePriceRequest $req,$analysis_id){
        try{
            $table_id=5;
            $us = Auth::user()->username;
            $an = Analysis::where('analysis_id',$analysis_id)->get();
            $my_an = $an[0]->analysis_name;
            $price=$an[0]->price;
            Analysis::where('analysis_id',$analysis_id)
                ->update(
                    [
                        "price"=>$req["price"],
                        'update_user_id'=>auth()->user()->id

                    ]
                );
           
             $mess = "the user ".$us." make an update on price of analysis: ".$my_an." from : ".$price." to be : " . $req["price"];
            $action = Actions::create(
                [
                    'action_name'=>$mess,
                    'user_id'=>auth()->user()->id,
                    'table_id'=>$table_id
                ]
            );

            return redirect()->route('admin.laboratryAnalysisPrice')->with(['success'=>'تم التعديل بنجاح']);
        }catch(\Exception $ex){
            return redirect()->back()->with(['error'=>'هناك خطأ مل يرجى المحاولة فيما بعد']);
        }
    }

}
