<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QueryController extends Controller
{
    public function verifyemailUsername(Request $request){
       $email = $request->email;
       $username = $request->username;

       

    }
}
