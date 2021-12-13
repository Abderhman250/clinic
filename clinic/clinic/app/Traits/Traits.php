<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\UserRole;
trait Traits
{ 
    public $City =array(
                        0=>"Amman",
                        1=>"Zarqa",
                        2=>"Irbid",
                        3=>"Aqaba",
                        4=>"Mafraq",
                        5=>"Madaba",
                        6=>"al-Balqa",
                        7=>"Jerash",
                        8=>"Ma'an",
                        9=>"Karak",
                        10=>"Tafilah",
                        11=>"Ajloun",
                    );


    public function Error($message, $numberStatus)
    {
        return response()->json([
            'status' => "Error",
            'Error' => true,
            'message' => $message
        ], $numberStatus);
    }


    public function Success($message = "", $numberStatus)
    {
        return response()->json([
            'status' => "Success",
            'Error' => false,
            "message" => $message
        ], $numberStatus);
    }

    public function Data($key, $value, $message = "", $numberStatus)
    {
        return response()->json([
            'status' => "Done",
            'Error' => false,
            $key => $value,
            "message" => $message
        ], $numberStatus);
    }

    public function CheckUserRole(&$User)
    {    

         
        if (isset($User)) {
            $UserRole = UserRole::find($User->role_id);
            unset($User->role_id);
            $nameRole = (app()->getLocale() == "en") ? $UserRole->name : "";
          
            $User->role_Name = $nameRole;

            return true;
        } else
            return false;
    }
    public function validEmail($str)
    {
        return (preg_match("/^([\w\W])+\@([\w\W])+$/", $str)) ? TRUE : False;
    }

    public function lang()
    {
        return app()->getLocale();
    }


    public  function Decrypt(&$Decrypt){

        try {
            $Decrypt = Crypt::decrypt($Decrypt);
            return true;
        } catch (DecryptException $ex) {
            //
            return false;
           
        }
    } 
    public function encryptAllUser(&$User)
    {
        try {
            foreach ($User  as &$user) {
                
                $id =  encrypt($user->id);
                unset($user->id);
                $user->key_Doc = $id;
            }
            return true;
        } catch (\Exception $ex) {
            return true;

        }
    }


    public function encryptId(&$encryptId)
    {
        try {
            $id =  encrypt($encryptId->id);
            unset($encryptId->id);
            $encryptId->key_Doc = $id;
            return true;
        } catch (\Exception $ex) {
            return true;

        }
    }
    public function encrypted(&$encrypt)
    {
        try {
            $encrypt =  encrypt($encrypt);
      
            return true;
        } catch (\Exception $ex) {
            return true;

        }
    }


}
