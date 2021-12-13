<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Click;
use Validator;

class clickController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request )
    {
        //


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        try {
            
            $type = "Doctor";
            $decrypted = $request->input("key_Doc");
            $rules = ['key_Doc' => 'min:8|max:255|required'];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->Error($validator->errors()->first(), 401);
            }

            if (!$this->Decrypt($decrypted))
                return $this->Error("Error Data key_Doc ", 401);
            $clcick =Click::where("user_id","=", $decrypted)->get();
            if($clcick->count() > 0){
     
              $clcick =Click::where("user_id","=", $decrypted)->increment('click' , 1);

            }else{

                $clcick = Click::create([      
                                         "user_id" =>$decrypted,
                                         "click" => 1
                                        ]);
            }
            $message = "Success add new Click";
            return $this->Success($message, 200);

        } catch (\Exception $ex) {
              return $this->Error($ex->getMessage(), 400);
        }

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
        //
    }
}
