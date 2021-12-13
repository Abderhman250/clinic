<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;
use App\Models\City;
use App\Models\District;
use App\Models\BestDoctor;
use \Validator;
use \Session;

class AccountController extends Controller
{

    public function login(Request $request){

          try {
          
            $validateForm = Validator::make($request->all(), [
                'email' => ['required'],
                'password' => ['required']
            ]);

            if ($validateForm->fails()) {

                session()->flash('errors', $validateForm->errors());
                return redirect()->back();
            }
            
           $email    = $request->input('email');
           $password = $request->input('password');

           $user = User::login($email,$password);
             if($user === false){

                return back();

             }
           $user =  Auth::attempt(['email' => $email , 'password' => $password]);
        
           $user     = User::count();
           $dr       = User::where('role_id' , 2)->count();
           $pharmacy = User::where('role_id' , 3)->count();
           $block    = User::where('block' , 1)->count();
           $credentials = $request->only(['email', 'password']);

          return redirect("home");

        } catch (\Exception $e) {

            report($e);
            return $e->getMessage();
            return redirect('/admin/somethingwrong');
        }
    }



    public function edit($id){

      
        $roles     = UserRole::all();
        $cities    = City::all();
        $districts = District::all();
        $user = User::findOrFail($id);
        $BestDoctor  = BestDoctor::all();
         return view('admin.users.edit' , [
                                             'user' => $user,
                                             'roles' => $roles,
                                             'cities' => $cities,
                                             'districts' => $districts,
                                             'BestDoctor' =>$BestDoctor,
                                            ]);

    }

    public function Pharmacies(){


        $users     = User::where('block' , 0)->where('role_id',"=",3)->get();
      
        return view('admin.users.index' , ['users' => $users]);
    } 

    public function doctor(){


        $users     = User::where('block' , 0)->where('role_id',"=",2)->get();
        $BestDoctor  = BestDoctor::all();
        return view('admin.users.index' , ['users' => $users,'BestDoctor'=>$BestDoctor]);
    } 


    public function logout(){

        $user = User::logout();
        return $user;

    }
}
