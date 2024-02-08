<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PlayerController extends Controller
{
    public function index(){
		
	   $winners =	User::orderBy('total_win','desc')->where('id','!=','1')->skip(0)->take(10)->get();
		
		return view('top_10_players', compact('winners'));
	}
}
