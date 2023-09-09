<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    public function verifyemailUsername(Request $request){
       $email = $request->email;
       $username = $request->username;

       $validate = User::where('email',$email)->orWhere('name',$username)->get();
            //
            function generateOTP() {
                $otp = '';
                for ($i = 0; $i < 6; $i++) {
                    $otp .= mt_rand(0, 9); 
                }
                return $otp;
            }
       if(count($validate)>=1){     
        session(['UniqueCode' => generateOTP()]);
        return redirect()->route('mail.sendOTP',['email'=>$validate[0]->email]);

       }
       return response()->json(['message'=>'nodata']);

      
       

    }

    public function verifyresetCode(Request $request){
        $entryCode = $request->entryCode;
          if($entryCode == session()->get('UniqueCode')){
            session(['codeVerified' => 1]);
            session()->forget('codeSend');
            return response()->json(['message'=>'match']);
          }

          return response()->json(['message'=>'doesnotmatch']);
    }
}
