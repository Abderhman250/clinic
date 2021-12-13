<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Medicine;
use App\Models\User;
use App\Models\UserRole;
use \Validator;
use \Session;
use Illuminate\Support\Facades\Storage;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicines = Medicine::all();

        return view('admin.medicines.index', ['medicines' => $medicines]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $Pharmacy_role =  UserRole::where("name", "=", "Pharmacy")->first();
        $Pharmacy =  User::where("role_id", "=", $Pharmacy_role->id)->get();
        return view('admin.medicines.create', ["Pharmacy" => $Pharmacy]);
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
                'name' => ['required'],
                'user_id' => ['required'],
                'image' => ['required'],
                'price' => ['required'],
                'description' => ['required'],

            ]);

            if ($validateForm->fails()) {

                session()->flash('errors', $validateForm->errors());
                return redirect()->back();
            }

            $data = $request->all();


            if (!empty($request->file('image'))) {


                $file = $request->file('image');
                $file_name = time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = $file->storeAs('uploades/', $file_name);
                $data['image'] =  Storage::disk('local')->url('uploades/' . $file_name);
            } else {
                $data['image'] = null;
            }

            $roleData = $request->all();
            unset($data['_token']);
            $data['quantity'] = (float)$data['quantity'];
            $data['price'] = (int)$data['price'];


            // $Medicine = Medicine::create([
            //     "name" =>$data['name'],
            //     "description" =>$data['description'],
            //     "quantity" => ""."$data[quantity]",
            //     "price" => ""."$data[price]",
            //     "image" =>""."$data[image]",
            //     "user_id" =>$data['user_id'],
            // ]);
            // dd($data);
            $Medicine = new Medicine;
            $Medicine->name = $data['name'];
            $Medicine->description = $data['description'];
            $Medicine->quantity = $data['quantity'];
            $Medicine->price = $data['price'];
            $Medicine->image = $data['image'];
            $Medicine->user_id = $data['user_id'];
            $Medicine->save();
            session()->flash('success', trans('messages.data_has_been_added_successfully'));
            return redirect()->route('medicines.index');
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
        $role = Medicine::findOrFail($id);
        return view('admin.medicines.edit', ['role' => $role]);
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
                'name' => ['required'],
                'user_id' => ['required'],
                'image' => ['required'],
                'price' => ['required'],
                'description' => ['required'],

            ]);

            if ($validateForm->fails()) {

                session()->flash('errors', $validateForm->errors());
                return redirect()->back();
            }

            $roleData = $request->all();

            $role = Medicine::findOrFail($id);
            $role->fill($roleData)->save();

            session()->flash('success', trans('messages.data_has_been_updated_successfully'));
            return redirect()->route('medicines.index');
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

            $role = Medicine::find($id);
            $role->delete();

            session()->flash('success', trans('messages.data_has_been_deleted_successfully'));
            return redirect()->route('medicines.index');
        } catch (Exception $e) {
            report($e);
            return redirect('/admin/somethingwrong');
        }
    }
}
