<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\City;
use \Validator;
use \Session;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        return view('admin.cities.index' , ['cities' => $cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
        return view('admin.cities.create');
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
                'name' => ['required', 'string']
                
            ]);

             if($validateForm->fails()){

                session()->flash('errors', $validateForm->errors());
                return redirect()->back();
            }

            $cityData = $request->all();

            $city = City::create($cityData);

            session()->flash('success' , trans('messages.data_has_been_added_successfully'));
            return redirect()->route('cities.index');

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
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::findOrFail($id);
        return view('admin.cities.edit',['city' => $city]);
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

            $cityData = $request->all();

            $city = City::findOrFail($id);
            $city->fill($cityData)->save();

            session()->flash('success' , trans('messages.data_has_been_updated_successfully'));
            return redirect()->route('cities.index');

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

            $city = City::find($id);
            $city->delete();

            session()->flash('success' , trans('messages.data_has_been_deleted_successfully'));
            return redirect()->route('cities.index');
            
        } catch (Exception $e) {
            report($e);
            return redirect('/admin/somethingwrong');

        }
    }
}
