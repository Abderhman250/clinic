<?php

namespace App\Http\Controllers\Admin;
date_default_timezone_set('Asia/Amman');

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservations;
use App\Models\User;
use App\Models\UserRole;

use \Validator;
use \Session;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        if(Auth::user()->role_id == 1)
          $reservations = Reservations::all();
        else
        $reservations = Reservations::where('dr_id','=',Auth::user()->id)->get();     
          return view('admin.reservations.index', ['reservations' => $reservations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $doctor_role =  UserRole::where("name", "=", "Doctor")->first();
        $doctor =  User::where("role_id", "=", $doctor_role->id)->get();
        return view('admin.reservations.create', ["Doctors" => $doctor]);
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

        $data =$request->all();


        // $reservations = Reservations::create($data);
        $validateForm = Validator::make($request->all(), [
            'date' => ['required'],
            'start' => ['required'],
            'end' => ['required'],
            "dr_id"=> ['required'],
        ]);

        if ($validateForm->fails()) {

            session()->flash('errors', $validateForm->errors());
            return redirect()->back();
        }

        $StartDate =date("Y-m-d H:i:s", strtotime($request->input('date')." ".$request->input('start')));
        $endtDate =date("Y-m-d H:i:s", strtotime($request->input('date')." ".$request->input('end')));
        $startTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',  $StartDate);
        $endTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $endtDate);


        // $currentTime = \Carbon\Carbon::now();
        // $time =array($startTime,$StartDate , $endTime ,$endtDate,  $currentTime);
        // if(!$currentTime->between($startTime, $endTime, true)){
           
        //     return back()->with("error","is not validation check data time");
     
        // }
        if( $data["dr_id"] == 0 ||  $data["dr_id"] == null ){
           
            return back()->with("error","You did not specify a doctor");
     
        }
        // $reservations = Reservations::all();

        $data  = array();
        $data =$request->all();
        $data['status']=0;
        
        $reservations = Reservations::create($data);
        $doctor_role =  UserRole::where("name", "=", "Doctor")->first();
        $doctor =  User::where("role_id", "=", $doctor_role->id)->get();
        return view('admin.reservations.create', ["Doctors" => $doctor,"success"=>true]);
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
        $reservation = Reservations::findOrFail($id);
        return view('admin.reservations.edit', ['reservation' => $reservation]);
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
        try {

            $validateForm = Validator::make($request->all(), [
                'name' => ['required', 'string']
            ]);

            if ($validateForm->fails()) {

                session()->flash('errors', $validateForm->errors());
                return redirect()->back();
            }

            $reservationData = $request->all();

            $reservation = Reservations::findOrFail($id);
            $reservation->fill($reservationData)->save();

            session()->flash('success', trans('messages.data_has_been_updated_successfully'));
            return redirect()->route('reservations.index');
        } catch (Exception $e) {

            return $e->getMessage();
            report($e);
            return redirect('/admin/somethingwrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $reservation = Reservations::find($id);
            $reservation->delete();

            session()->flash('success', trans('messages.data_has_been_deleted_successfully'));
            return redirect()->route('reservations.index');
        } catch (Exception $e) {
            report($e);
            return redirect('/admin/somethingwrong');
        }
    }
}
