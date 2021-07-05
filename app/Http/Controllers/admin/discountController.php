<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\addNewDiscountRequest;
use App\Models\Actions;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class discountController extends Controller
{
    public function index(){

        try {
            $discount=Discount::selection()->paginate(PAGINATION_COUNT);
            return view('admin.discount.discount', compact('discount'));

        }catch (\Exception $ex){
            return redirect()->route('admin.discount')->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
        }

    }

    public function createDiscount(){
        return view('admin.discount.addNewDiscount');
    }

    public function storeDiscount(addNewDiscountRequest $request){

        try{
            $table_id=2;
            $us = Auth::user()->username;
                $discount=Discount::create(
                    [
                        'company_name'=>$request->company_name,
                        'discount_type'=>$request->discount_type,
                        'company_finantial_recivable'=>$request->company_finantial_recivable,
                        'laboratory_finantial_recivable'=>$request->laboratory_finatial_recivable,
                        'discount_parcenteg'=>$request->discount_percentage,

                        'user_id'=>auth()->user()->id,
                        'update_user_id'=>auth()->user()->id
                    ]
                );
          $mess = "the user ".$us." add a new discount: ".$request->company_name." of type ".$request->discount_type;
            $action = Actions::create(
                [
                    'action_name'=>$mess,
                    'user_id'=>auth()->user()->id,
                    'table_id'=>$table_id
                ]
            );

                return redirect()->route('admin.discount')->with(['success'=>'تم الحفظ بنجاح']);
            }catch(\Exception $ex){

                return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
            }
     }

        public function search(Request $request){
            try{
                $q=$request->name;
                $discount=Discount::where('company_name','LIKE','%'.$q.'%')->paginate(PAGINATION_COUNT);
                $pagination = $discount->appends ( array (
                    'name' => $request->name,
                ) );
                return view('admin.discount.discount', compact("discount","q"));
            }catch(\Exception $ex){
                return $ex;
                return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
            }
        }

        public function edit($discount_id){
            try{
                $discount=Discount::where('discount_id',$discount_id)->selection()->first();
                if(!$discount){
                    return redirect()->route('admin.discount')->with(['error'=>'هذاالتأمين غير موجود']);
                }
                return view('admin.discount.edit',compact('discount'));
            }catch(\Exception $ex){

                return redirect()->back()->with(['error'=>'هناك خطأ مل يرجى المحاولة فيما بعد']);
            }
        }



        public function update(addNewDiscountRequest $request ,$id){
            try{
                $table_id=2;
                $us = Auth::user()->username;
                $discount =Discount::selection()->where('discount_id',$id)->get();
         Discount::where('discount_id',$id)
            ->update(
                [
                    'company_name'=>$request->company_name,
                    "discount_type"=>$request->discount_type,
                    "discount_parcenteg"=>$request->discount_percentage,
                    "company_finantial_recivable"=>$request->company_finantial_recivable,
                    "laboratory_finantial_recivable"=>$request->laboratory_finatial_recivable,
                    'update_user_id'=>auth()->user()->id
                ]
            );
                 $mess = "the user ".$us." make an update on discount: ".$request->company_name." of type ".$request->discount_type.
                " from : [ ".$discount[0]->company_name.' , '.$discount[0]->discount_type.' , '.$discount[0]->discount_parcenteg.' , '.
                $discount[0]->company_finantial_recivable.' , '.$discount[0]->laboratory_finantial_recivable.
                " ] to :[ ".$request->company_name.' , '.$request->discount_type.' , '.$request->discount_percentage.' , '.
                $request->company_finantial_recivable.' , '.$request->laboratory_finatial_recivable. ' ] ';

                $action = Actions::create(
                    [
                        'action_name'=>$mess,
                        'user_id'=>auth()->user()->id,
                        'table_id'=>$table_id
                    ]
                );
         return redirect()->route('admin.discount')->with(['success'=>'تم التعديل بنجاح']);
            }
         catch(\Exception $ex){

         return redirect()->back()->with(['error'=>'هناك خطأ, يجب عدم تكرار اسم الشركة ونوع التأمين']);
             }
    }



}
