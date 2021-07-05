<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use DB;

class userController extends Controller
{
    public function index(){
        // if (auth()->check()) {}
        $user = auth()->user();
        $id = $user->id;
        $user=Users::with('role')->where('id',$id)->selection()->first();
       
         $role_name=$user->role->role_name;
        
        return view('accountant.userManagment.myprofile',compact(['user','role_name']));
    }



}
