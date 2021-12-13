<?php

namespace App\Http\Controllers\api;

use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Reservations;
use  App\Models\Appointments;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        //




    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function  GetSavenDate(Request  $request)
    {

        $current = Carbon::now();
        $day = array();

        for ($i = 0; $i < 7; $i++) {

            $day[$i]["Date"] = Carbon::now()->addDays($i)->format('D');
            $day[$i]["name_Day"] = Carbon::now()->addDays($i);
        }


        $message = "show specified  info date";
        return $this->Data('Data', [
            "day" =>  $day,
            "lang" => $this->lang(),

        ], $message, 200);
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

        try {
            $data = $request->all();

            $decrypted_res = $request->input("key_res");
            $User = Auth::guard('api')->user();
            // $reservations = Reservations::create($data);
            $validateForm = Validator::make($request->all(), ['key_res' => 'min:8|max:255|required',]);

            if ($validateForm->fails()) {
                return $this->Error($validateForm->errors()->first(), 401);
            }
            if ($User === null) {
                return $this->Error("Auth is not login ", 401);
            }

            if (!$this->Decrypt($decrypted_res))
                return $this->Error("Error Data key_Doc ", 401);


            $Reservations = Reservations::find($decrypted_res);

            if ($Reservations->status == 0) {
                $Appointments = Appointments::create([
                    'user_id' => $User->id,
                    'reservations_id' => $decrypted_res,
                    'status' => '0'
                ]);
                $Reservations->update(["status" => 1]);
            } else {

                return $this->Error("It is already booked ", 401);
            }


            $message = "Save new  Appointments";
            return $this->Data('Data', [
                "Appointments" =>  $Appointments,
                "lang" => $this->lang(),

            ], $message, 200);
        } catch (\Exception $ex) {
            return $this->Error($ex->getMessage(), 400);
        }
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
            $User = Auth::guard('api')->user();
            if ($User === null) {
                return $this->Error("Auth is not login ", 401);
            }
        //   dd(Auth::guard('api')->user()->id);
            $Appointments = Appointments::whereHas('reservation', function($q){
                $q->where('dr_id', '=',Auth::guard('api')->user()->id);
            })->get();
            
            $message = "Show Appointments";
            return $this->Data('Data', [
                "Appointments" =>  $Appointments,
                "lang" => $this->lang() ],
                 $message, 200);

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
