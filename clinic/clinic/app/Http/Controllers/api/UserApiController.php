<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\City;
use App\Models\User;
use Validator;

class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function login(Request $request)
    {


        try {
            $rules = [
                "email" => "required",
                "password" => "required"

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->Error($validator->errors()->first(), 401);
            }
            //login

            $credentials = $request->only(['email', 'password']);

            $token = Auth::guard('api')->attempt($credentials);


            if (!$token)
                return $this->Error("csas", 400);

            $User = Auth::guard('api')->user();
            $User->api_token = $token;

            if (!$this->CheckUserRole($User))
                return $this->Error("Invalid", 401);

                $User->District= isset($User->district->name)?$User->district->name:null;
                $User->citys= isset($User->city->name)?$User->city->name:null;
    
                unset($User->id,$User->password);
                unset($User->city,$User->city_id,$User->district_id,$User->district);
            $message = "login successfully ";
            return $this->Data('User', ["User" => $User, "lang" => $this->lang()], $message, 200);
        } catch (\Exception $ex) {
            return $this->Error($ex->getMessage(), 400);
        }
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
        try {
            $array_Role = array(2, 3, 4);
            $lng = (null !== $request->input('lng')) ? $request->input('lng') : null;
            $lat = (null !== $request->input('lat')) ? $request->input('lat') : null;
            $rules = [
                'name'         => ['required', 'string'],
                'email'        => ['required', 'string', 'unique:users'],
                'password'     => ['required', 'string'],
                'configPass'   => ['required', 'string', 'same:password'],
                'phone'        => ['required', 'string'],
                'Gender'       => ['required', 'string'],
                'Age'          => ['required'],
                'id_city'     => 'required',
                'key_District' => 'min:8|max:255|required',

            ];
            $key_District = $request->input('key_District');
            $role_id = (int)$request->input('role_id');
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->Error($validator->errors()->first(), 401);
            }
            if (!$this->validEmail($request->input("email")))
                return $this->Error("Invalid email address", 401);

            if (in_array($role_id, $array_Role) == false)
                $this->Error('Error Choose role... ', 404);


            if (!$this->Decrypt($key_District))
                return $this->Error("Error Data key_District ", 401);


            $City = isset($this->City[$request->input('id_city')]) ? $this->City[$request->input('id_city')] : null;
            if ($City !==  null) 
                $city = City::where('name', 'like', '%' . $City . '%')->first();
            else 
                 return $this->Error("City does not exist", 401);
            
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role_id' => $request->input('role_id'),
                'phone' => $request->input('phone'),
                'Gender' => $request->input('Gender'),
                'Age' => (int)$request->input('Age'),
                "city_id" => isset($city->id)?$city->id:0,
                "district_id" => $key_District,
                'lng' => $lng,
                'lat' => $lat,
            ]);

            $collection = $request->only(['email', 'password']);

            $token = Auth::guard('api')->attempt($collection);
            $user->api_token = $token;

            if (!$this->CheckUserRole($user))
                return $this->Error("Invalid", 401);

            $message = "register successfully";
            $user->District= isset($user->district->name)?$user->district->name:null;
            $user->citys= isset($user->city->name)?$user->city->name:null;

            unset($user->id,$user->password);
            unset($user->city,$user->city_id,$user->district_id,$user->district);

            return $this->Data('Data', ["User" => $user, "lang" => $this->lang()], $message, 200);
        } catch (\Exception $ex) {
            return $this->Error($ex->getMessage(), 400);
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
