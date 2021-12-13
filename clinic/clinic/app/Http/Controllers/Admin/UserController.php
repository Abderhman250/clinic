<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserRole;
use App\Models\User;
use App\Models\City;
use App\Models\District;
use \Validator;
use \Session;
use App\Models\BestDoctor;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users     = User::where('block' , 0)->get();
        $BestDoctor  = BestDoctor::all();

        return view('admin.users.index' , ['users' => $users,'BestDoctor'=>$BestDoctor]);
    }

    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles     = UserRole::all();
        $cities    = City::all();
        $districts = District::all();
        $BestDoctor  = BestDoctor::all();

         return view('admin.users.create' , ['roles' => $roles,
                                             'cities' => $cities,
                                             'districts' => $districts,
                                            'BestDoctor'=>$BestDoctor,
                                            ]);
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
                'name'       => ['required', 'string'],
                'email'      => ['required', 'string'],
                'password'   => ['required', 'string'],
                'configPass' => ['required', 'string','same:password']
            ]);

            if($validateForm->fails()){

                session()->flash('errors', $validateForm->errors());
                return redirect()->back();
            }

            if ($request->input('role_id') == 0 ) {

                session()->flash('error', 'Choose role...');
                return redirect()->back();
                
            }

            $userData = $request->all();
            $userData["Password"] = 
            $user = User::create($userData);

            session()->flash('success' , trans('messages.data_has_been_added_successfully'));
            return redirect()->route('users.index');

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

        $roles     = UserRole::all();
        $cities    = City::all();
        $districts = District::all();
        $user = User::findOrFail($id);
         return view('admin.users.edit' , [
                                             'user' => $user,
                                             'roles' => $roles,
                                             'cities' => $cities,
                                             'districts' => $districts
                                            ]);

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

            $userData = $request->all();

            $user = User::findOrFail($id);
            $user->fill($userData)->save();

            session()->flash('success' , trans('messages.data_has_been_updated_successfully'));
            return redirect()->route('users.index');

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

            $user = User::find($id);
            $user->delete();

            session()->flash('success' , trans('messages.data_has_been_deleted_successfully'));
            return redirect()->route('users.index');
            
        } catch (Exception $e) {
            report($e);
            return redirect('/admin/somethingwrong');

        }
    }
}
