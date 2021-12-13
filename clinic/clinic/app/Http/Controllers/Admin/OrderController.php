<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\User;
use \Validator;
use \Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index' , ['orders' => $orders]);
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
        $order = Order::findOrFail($id);
        return view('admin.orders.edit',['order' => $order]);
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

            $orderData = $request->all();

            $order = Order::findOrFail($id);
            $order->fill($orderData)->save();

            session()->flash('success' , trans('messages.data_has_been_updated_successfully'));
            return redirect()->route('orders.index');

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

            $order = Order::find($id);
            $order->delete();

            session()->flash('success' , trans('messages.data_has_been_deleted_successfully'));
            return redirect()->route('orders.index');
            
        } catch (Exception $e) {
            report($e);
            return redirect('/admin/somethingwrong');

        }
    }
}
