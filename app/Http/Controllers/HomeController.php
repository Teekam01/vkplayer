<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use App\UserData;
use Alert;
use Auth;

class HomeController extends Controller
{
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$games = Game::where('status',1)->get();
// 		dd($userData->toArray());
        
		return view('welcome',compact('games'));
    }
}
