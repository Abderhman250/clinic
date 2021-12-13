<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\BestDoctor;
use Illuminate\Foundation\Auth\User as AuthUser;
use Validator;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        try {
            $User = Auth::guard('api')->user();

            $this->searchDoctro = $request->input("searchDoctro");
            $type = "Doctor";

            $Doctor =  User::where('role_id', '=', 2)->get();

            if (!$this->encryptAllUser($Doctor))
                return $this->Error("you can tell the manager that ", 401);

            $message = "show all info Doctor";
            return $this->Data('Data', [
                "Doctor" => $Doctor,
                "lang" => $this->lang(),
                "type" => $type
            ], $message, 200);
        } catch (\Exception $ex) {

            return $this->Error($ex->getMessage(), 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    public function  BestDoctor(){

        $BestDoctor = BestDoctor::all();
        $User = array();
        foreach($BestDoctor as $bestDoctor){

            $User[] = User::find($bestDoctor->id_doctor);
            
        }
        $message ="Show all Best Doctor ";
        return $this->Data('BestDoctor', ["User" => $User, "lang" => $this->lang()], $message, 200);
 
 
     }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        try {
            $type = "Doctor";
            $decrypted = $request->input("key_Doc");
            $rules = ['key_Doc' => 'min:8|max:255|required',];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->Error($validator->errors()->first(), 401);
            }

            if (!$this->Decrypt($decrypted))
                return $this->Error("Error Data key_Doc ", 401);

            $Doctor =  User::where("role_id","=",2)->where("id", "=", $decrypted)->first();

            if (!$this->encryptId($Doctor))
                return $this->Error("you can tell the manager that ", 401);

            $message = "show specified  info Doctor";
            return $this->Data('Data', [
                "Doctor" =>   $Doctor,
                "lang" => $this->lang(),
                "type" => $type
            ], $message, 200);
        } catch (\Exception $ex) {

            return $this->Error($ex->getMessage(), 400);
        }
    }




    public function serch(Request $request)
    {
        try {
            $User = Auth::guard('api')->user();
            $this->searchDoctro = $request->input("searchDoctro");
            $type = "Doctor";
            
            // this is serch  
            $Doctor =  User::where("role_id","=",2)->where('name',  'like', '%' . $this->searchDoctro  . '%')->get();

            if (!$this->encryptAllUser($Doctor))
                return $this->Error("you can tell the manager that ", 401);

            $message = "show all info Doctor";
            return $this->Data('Data', [
                "Doctor" => $Doctor,
                "lang" => $this->lang(),
                "type" => $type
            ], $message, 200);
        } catch (\Exception $ex) {

            return $this->Error($ex->getMessage(), 400);
        }
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
