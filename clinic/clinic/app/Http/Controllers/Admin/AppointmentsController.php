<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointments;
use Illuminate\Support\Facades\Auth;
class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if( Auth::user()->role_id  == 1)
        $Appointments = Appointments::all();
        else{

            $Appointments = Appointments::whereHas('reservation', function($q){
                $q->where('dr_id', '=', Auth::user()->id);
            })->get();
        }
        return view("admin.Appointments.index", ["Appointments" => $Appointments]);
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
        try {

            $Appointments = Appointments::find($id);
            $Appointments->delete();

            session()->flash('success', trans('messages.data_has_been_deleted_successfully'));
            return redirect()->route('Appointments.index');
        } catch (Exception $e) {
            report($e);
            return redirect('/admin/somethingwrong');
        }
    }
}
