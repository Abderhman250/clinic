<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class BlackListController extends Controller
{
    public function index(){

        $users = User::where('block' , 1)->get();
        return view('admin.blacklist.index' , ['users' => $users]);
    }


    public function  block($id){
 
      $user=  User::find($id);
      $arrayBlock =array("0"=>1,"1"=>0);
      $block =isset($arrayBlock[$user->block])?$arrayBlock[$user->block]:0;
      $user->update(['block'=>$block ]);


      $users = User::where('block' , 1)->get();
      return view('admin.blacklist.index' , ['users' => $users]);
;


    }


    public function  unblock($id){

        $user=  User::find($id)->update(['block'=>1]);
  
        $users = User::where('block' , 1)->get();
        return view('admin.blacklist.index' , ['users' => $users]);
  ;
  
  
      }
}
