<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    

    public function get_data(){
        return User::all();
    }


    public function update($id){
        return User::where('id', $id)->update(['wallet' => 5000 ]);
    }



    public function get_otp($id){

        return User::where('mobile','LIKE','%'.$id.'%')->select('otp')->first();
    }


    





}
