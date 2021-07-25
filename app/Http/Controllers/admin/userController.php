<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Actions;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddNewUserRequest;
use App\Http\Requests\UpdateUserRequest;
use DB;

class userController extends Controller
{
    public function index(){
        // if (auth()->check()) {}
        $user = auth()->user();
        $id = $user->id;
        $user=Users::where('id',$id)->selection()->first();
        $role_name=$user->role->role_name;

        return view('admin.userManagment.myprofile',compact(['user','role_name']));
    }
    public function create(){
        return view('admin.userManagment.addNewUser');
    }
    public function store(AddNewUserRequest $request){
        try{
            $table_id=5;
            $us = Auth::user()->username;
            $role_id=0;
             if($request->role_name=='manager'){
                $role_id=2;

             }else if($request->role_name=='accountant'){
                $role_id=4;

             }else if($request->role_name=='employee'){
                $role_id=3;
             }
              Users::create(
               [
                   'role_id'=>$role_id,
                   'f_name'=>$request->f_name,
                   'm_name'=>$request->m_name,
                   'l_name'=>$request->l_name,
                   'username'=>$request->username,
                   'age'=>$request->age,
                   'phone'=>$request->phone,
                   'email'=>$request->email,
                   'address'=>$request->address,
                   'start_date'=>$request->start_date,
                   'password'=> bcrypt($request->password),
                   'user_id'=>auth()->user()->id,
                   'update_user_id'=>auth()->user()->id
               ]
           );
                $mess = "the user ". $us. " add a new user: ".$request->username;
            $action = Actions::create(
                [
                    'action_name'=>$mess,
                    'user_id'=>auth()->user()->id,
                    'table_id'=>$table_id
                ]
            );
             return redirect()->route('admin.userManagment')->with(['success'=>'تم الحفظ بنجاح']);
           }catch(\Exception $ex){
               return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
           }
    }
    public function userManagment(){
        $user=Users::selection()->paginate(PAGINATION_COUNT);
        return view('admin.userManagment.usermanagment', compact('user'));
    }
    public function edit($user_id){
        try{

            $user=Users::where('id',$user_id)->selection()->first();
             if(!$user){
                 return redirect()->route('admin.userManagment')->with(['error'=>'هذاالمريض غير موجود']);
             }
             return view('admin.userManagment.editUserProfile',compact('user'));
          }catch(\Exception $ex){
             return redirect()->back()->with(['error'=>'هناك خطأ مل يرجى المحاولة فيما بعد']);
           }
    }
    public function update(UpdateUserRequest $request ,$user_id){
        try{
            $table_id=5;
            $us = Auth::user()->username;
            $role_id=0;
            if($request->role_name=='manager'){
               $role_id=2;

            }else if($request->role_name=='accountant'){
               $role_id=4;

            }else if($request->role_name=='employee'){
               $role_id=3;
            }
            if($request->has('password')){
               Users::where('id',$user_id)
               ->update(
                  [
                    "password"=>bcrypt($request["password"]),
                  ]
               );
            }
            if($request->status=='not active' || $request->has('end_date')){
                $status=0;
            }
            if($request->status=='active'){
                $status=1;
            }
             $user=Users::selection()->with('role')->where('id',$user_id)->get();
             if($user[0]->status==0 ){
                $sta="not active";
            }else{
                $sta="active";
            }
             $userInformation="[ ".$user[0]->role->role_name." , ".$user[0]->f_name." , ".$user[0]->m_name." , ".$user[0]->l_name." , ".$user[0]->age." , ".
            $user[0]->address." , ".$user[0]->phone." , ".$user[0]->email." , ".$user[0]->username." , ".$user[0]->end_date." , ".$sta." ]";
            // return Users::selection()->where('id',$user_id)->get();
            Users::where('id',$user_id)
           ->update(
              [
                 'role_id'=>$role_id,
                  "f_name"=>$request["f_name"],
                  "m_name"=>$request["m_name"],
                  "l_name"=>$request["l_name"],
                  "age"=>$request["age"],
                  "address"=>$request["address"],
                  "phone"=>$request["phone"],
                  "email"=>$request["email"],
                  "username"=>$request["username"],
                  "end_date"=>$request["end_date"],
                  "status"=>$status,
                  'update_user_id'=>auth()->user()->id
              ]
           );
           // return Users::selection()->where('id',$user_id)->get();
            $mess = "the user ".$us." make an update on user: ".$request["username"] .
           "from: ".$userInformation. " to: [ ".
                   $request["role_name"] ." , ".$request["f_name"]." , ".$request["m_name"]." , ".$request["l_name"]." , ".$request["age"]." , ".
                   $request["address"]." , ".$request["phone"]." , ".
                   $request["email"]." , ".$request["username"]." , ".
                   $request["end_date"].$request["status"]." ]";
            ;
            $action = Actions::create(
                [
                    'action_name'=>$mess,
                    'user_id'=>auth()->user()->id,
                    'table_id'=>$table_id
                ]
            );
           return redirect()->route('admin.userManagment')->with(['success'=>'تم التعديل بنجاح']);
        }catch(\Exception $ex){
           return redirect()->back()->with(['error'=>'هناك خطأ مل يرجى المحاولة فيما بعد']);
         }
    }

    public function filter(Request $request){
        $role=$request->role;
        if($role == 0){
            $user=Users::selection()->paginate(PAGINATION_COUNT);
        }else{
            $user= Users::where('role_id', $request->role)->paginate(PAGINATION_COUNT);
            $pagination = $user->appends (array (
                'role' => $request->role,
        ) );
        }
        return view('admin.userManagment.usermanagment', compact("user","role"));
    }

    public function search(Request $request){
        try{
            $q=$request->name;
            $user=Users::where(DB::raw("CONCAT(f_name,' ',m_name,' ',l_name)"),'LIKE','%'.$q.'%')
            ->orWhere('username','LIKE','%'.$q.'%')
            ->orWhere('address','LIKE','%'.$q.'%')
            ->orWhere('email','LIKE','%'.$q.'%')
            ->orWhere('phone','LIKE','%'.$q.'%')
            ->paginate(PAGINATION_COUNT);
            $pagination = $user->appends (array (
                'name' => $request->name,
        ) );
            return view('admin.userManagment.usermanagment', compact("user","q"));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى اعادة المحاولة']);
        }
    }


}
