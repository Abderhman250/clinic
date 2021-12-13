<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserRole;
use \Validator;
use \Session;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = UserRole::all();
        return view('admin.user_roles.index' , ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user_roles.create');
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

            $roleData = $request->all();

            $role = UserRole::create($roleData);

            session()->flash('success' , trans('messages.data_has_been_added_successfully'));
            return redirect()->route('roles.index');

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
        $role = UserRole::findOrFail($id);
        return view('admin.user_roles.edit',['role' => $role]);
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

            $roleData = $request->all();

            $role = UserRole::findOrFail($id);
            $role->fill($roleData)->save();

            session()->flash('success' , trans('messages.data_has_been_updated_successfully'));
            return redirect()->route('roles.index');

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

            $role = UserRole::find($id);
            $role->delete();

            session()->flash('success' , trans('messages.data_has_been_deleted_successfully'));
            return redirect()->route('roles.index');
            
        } catch (\Exception $e) {
            report($e);
            return redirect('/admin/somethingwrong');

        }
    }
}
