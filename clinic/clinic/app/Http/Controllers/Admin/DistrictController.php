<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\District;
use \Validator;
use \Session;
use App\Models\City;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = District::all();
        return view('admin.districts.index' , ['districts' => $districts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $City = City::all();
        return view('admin.districts.create',['City'=>$City ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {


            $validateForm = Validator::make($request->all(), [
                'name' => ['required', 'string'],
                'city_id'=>['required'],
            ]);

             if($validateForm->fails()){

                session()->flash('errors', $validateForm->errors());
                return redirect()->back();
            }
               
            $districtData = $request->all();
         
            $district = District::create($districtData);

            session()->flash('success' , trans('messages.data_has_been_added_successfully'));
            return redirect()->route('districts.index');

        } catch (Exception $e) {

            return $e->getMessage();
            report($e);
            return redirect('/admin/somethingwrong');
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
        $district = District::findOrFail($id);
        $City = City::all();
        return view('admin.districts.edit',['district' => $district,'City'=>$City ]);
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

            if($validateForm->fails()){

                session()->flash('errors', $validateForm->errors());
                return redirect()->back();
            }

            $districtData = $request->all();

            $district = District::findOrFail($id);
            $district->fill($districtData)->save();

            session()->flash('success' , trans('messages.data_has_been_updated_successfully'));
            return redirect()->route('districts.index');

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

            $district = District::find($id);
            $district->delete();

            session()->flash('success' , trans('messages.data_has_been_deleted_successfully'));
            return redirect()->route('districts.index');
            
        } catch (Exception $e) {
            report($e);
            return redirect('/admin/somethingwrong');

        }
    }
}
