<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\City;
use Validator;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request )
    {
        //
        $City = City::all();
        try {
          
         
            foreach($City  as $city){           
                $id = $city->id  ;
                $city_id =  $city->city_id;
                if (!$this->encrypted($id))
                    return $this->Error("you can tell the manager that ", 401);
                else
                $city->key_id =$id  ; 
             
           
                unset($city->id) ;  
              

        }
         $message = "Get all City successfully";
         return $this->Data('Data', ["City" =>$City, "lang" => $this->lang()], $message, 200);

        
        } catch (\Exception $ex) {
            return $this->Error($ex->getMessage(), 400);
        }
    }

    public function index2(Request $request )
    {
        //
        $District = District::all();
        try {
 
            foreach($District  as $districtlue){           
                    $id = $districtlue->id  ;
                    $city_id =  $districtlue->city_id;
                    if (!$this->encrypted($id))
                        return $this->Error("you can tell the manager that ", 401);
                    else
                    $districtlue->key_id =$id  ; 
                    if (!$this->encrypted($city_id))
                     return $this->Error("you can tell the manager that ", 401);
                    else
                    $districtlue->city_id =$city_id ; 
                    unset($districtlue->id) ;  
            }
         $message = "Get all City successfully";
         return $this->Data('Data', ["District" =>$District, "lang" => $this->lang()], $message, 200);

        
        } catch (\Exception $ex) {
            return $this->Error($ex->getMessage(), 400);
        }
    }


    public function location(Request $request )
    {
        //
        $District = District::all();
        try {
 
            foreach($District  as $districtlue){           
                    $id = $districtlue->id  ;
                    $city_id =  $districtlue->city_id;
                    if (!$this->encrypted($id))
                        return $this->Error("you can tell the manager that ", 401);
                    else
                    $districtlue->key_id =$id  ; 
                 
                    $districtlue->city_name =$districtlue->city->name; 
                    unset($districtlue->id) ;  
                    unset($districtlue->city) ;  
                    unset($districtlue->city_id) ;  

            }
         $message = "Get all City successfully";
         return $this->Data('Data', ["District" =>$District, "lang" => $this->lang()], $message, 200);

        
        } catch (\Exception $ex) {
            return $this->Error($ex->getMessage(), 400);
        }
    }

    
    public function locationShow(Request $request )
    {
        //
        
        try {
            $decrypted = $request->input("key_id");
            $rules = ['key_id' => 'min:8|max:255|required',];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->Error($validator->errors()->first(), 401);
            }

            if (!$this->Decrypt($decrypted))
                return $this->Error("Error Data key_id ", 401);

            $District =  District::where("city_id","=",$decrypted)->get();
      
            foreach($District  as $districtlue){           
                    $id = $districtlue->id  ;
                    $city_id =  $districtlue->city_id;
                    if (!$this->encrypted($id))
                        return $this->Error("you can tell the manager that ", 401);
                    else
                    $districtlue->key_id =$id  ; 
                 
                    $districtlue->city_name =$districtlue->city->name; 
                    unset($districtlue->id) ;  
                    unset($districtlue->city) ;  
                    unset($districtlue->city_id) ;  

            }
         $message = "Get all City successfully";
         return $this->Data('Data', ["District" =>$District, "lang" => $this->lang()], $message, 200);

        
        } catch (\Exception $ex) {
            return $this->Error($ex->getMessage(), 400);
        }
    }


    public function locationWithCity(Request $request )
    {
        $Loctions =array();
        
        $City = City::all();
        try {
          foreach($City as $city){
            $District =  District::where("city_id","=",$city->id)->get();
            $city_id =$city->id;

            foreach($District  as $districtlue){           
                    $id = $districtlue->id  ;
                    $city_id =  $districtlue->city_id;
                    if (!$this->encrypted($id))
                        return $this->Error("you can tell the manager that ", 401);
                    else
                    $districtlue->key_District =$id  ; 
                 

                    unset($districtlue->id) ;  
                    unset($districtlue->city) ;  
                    unset($districtlue->city_id) ;  

            }

            if (!$this->encrypted($city_id))
            return $this->Error("you can tell the manager that ", 401);
            else
            $Loctions[$city->name]["key_city"] = $city_id ; 
           
            $Loctions[$city->name]["District"] = $District; 
        } 
         $message = "Get all City successfully";
         return $this->Data('Data', ["Loctions" => $Loctions, "lang" => $this->lang()], $message, 200);

        
        } catch (\Exception $ex) {
            return $this->Error($ex->getMessage(), 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function CityAarry(Request $request )
    {
        try{
         $message = "Get all City successfully";
         return $this->Data('Data', ["Loctions" => array_flip($this->City), "lang" => $this->lang()], $message, 200);

        
        } catch (\Exception $ex) {
            return $this->Error($ex->getMessage(), 400);
        }
    }

    public function FindDistrict(Request $request )
    {
        try{
         $message = "Get all City successfully";

         $rules = ['id_city' => 'required',];

         $validator = Validator::make($request->all(), $rules);

         if ($validator->fails()) {
             return $this->Error($validator->errors()->first(), 401);
         }
         $City = isset($this->City[$request->input('id_city')])?$this->City[$request->input('id_city')]:null;
         if($City !==  null){
            $city = City::where('name', 'like', '%'.$City.'%')->first();
            $District =District::where("city_id","=",$city->id)->get();
            
         }else{

            return $this->Error("City does not exist", 401);
         }
         foreach($District  as $districtlue){           
            $id = $districtlue->id  ;
          
            if (!$this->encrypted($id))
                return $this->Error("you can tell the manager that ", 401);
            else
            $districtlue->key_id =$id  ; 
         
            $districtlue->city_name =$districtlue->city->name; 
            unset($districtlue->id) ;  
            unset($districtlue->city) ;  
            unset($districtlue->city_id) ;  

        }

         return $this->Data('Data', ["Loctions" => $District, "lang" => $this->lang()], $message, 200);

        
        } catch (\Exception $ex) {
            return $this->Error($ex->getMessage(), 400);
        }
    }


 

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
        //
    }
}
