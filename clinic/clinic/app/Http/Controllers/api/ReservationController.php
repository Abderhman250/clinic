<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Validator;
use Illuminate\Support\Arr;
use App\Models\Reservations;
use Illuminate\Support\Collection;


class ReservationController extends Controller
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

            $day = array();
            $Reservations = array();
            $decrypted = $request->input("key_Doc");
            $rules = [
                'key_Doc' => 'min:8|max:255|required',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->Error($validator->errors()->first(), 401);
            }

            if (!$this->Decrypt($decrypted))
                return $this->Error("Error Data key_Doc ", 401);


            $Reservations =  Reservations::whereRaw("date", $day)->get();
            
            foreach( $Reservations  as $key=>$res){
       
                $id = $res->id  ;
                $dr_id =  $res->dr_id;
                if (!$this->encrypted($id))
                    return $this->Error("you can tell the manager that ", 401);
                else
                $res->key_id =$id ;

                if (!$this->encrypted($dr_id))
                 return $this->Error("you can tell the manager that ", 401);
                else
                $res->key_doc =$dr_id ;

                unset($res->id);
                unset($res->dr_id);
                    

            }

            // $Reservations =  Reservations::where("dr_id","=",$decrypted)->whereIn("date",$day)->get();



            if (!$this->encryptId($Doctor))
                return $this->Error("you can tell the manager that ", 401);

            $message = "show all info Reservations specified Doctor";
            return $this->Data('Data', [
                "Reservations" =>  $Reservations,
                "lang" => $this->lang(),

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
        try {
            $data = $request->all();
            $decrypted = $request->input("key_Doc");


            $validateForm = Validator::make($request->all(), [
                'key_Doc' => 'min:8|max:255|required',
                'date' => ['required'],
                'start' => ['required'],
                'end' => ['required'],
            ]);

            if ($validateForm->fails()) {

                return $this->Error($validateForm->errors()->first(), 401);
            }

            if (!$this->Decrypt($decrypted))
                return $this->Error("Error Data key_Doc ", 401);

            $StartDate = date("Y-m-d H:i:s", strtotime($request->input('date') . " " . $request->input('start')));
            $endtDate = date("Y-m-d H:i:s", strtotime($request->input('date') . " " . $request->input('end')));
            if($StartDate  >= $endtDate  )
                 return $this->Error("Error Start Date End Date ", 401);
            if($StartDate  < Carbon::now()  )
                 return $this->Error("Error Day ", 401);

            $startTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',  $StartDate);
            $endTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $endtDate);

      

          


            $data  = array();
            $data = $request->all();
            $data["dr_id"] = $decrypted;
            $data['status'] = 0;

            $Reservations =  Reservations::where("dr_id","=",$data["dr_id"])->
                                                            where("date","=",$data["date"])->
                                                            whereBetween("end",[$data["start"],$data["end"]])->
                                                            orwhereBetween("start",[$data["start"],$data["end"]])->
                                                            where("date","=",$data["date"]);
            if($Reservations->count() == 0){

              $reservations = Reservations::create($data);

            }else{

                $message = "Worning add new Reservations time ";
                return $this->Error($message, 400);

            }
            $message = "Success add new Reservations";
            return $this->Success($message, 200);
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
    public function show($id)
    {
        //
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
