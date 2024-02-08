<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Game;
use App\Battle;
use App\UserBankDetail;
use App\UserData;
use Auth;
use View;
use App\Permission;
use App\TransactionHistory;

class GameController extends Controller
{
   public function __construct(){
        $this->middleware(function ($request, $next) {
            $permission = Permission::where('user_id', Auth::id())->first();
            View::share('permission', $permission);
            return $next($request);
        });
    }
    public function index()
    {
		$games  = Game::orderBy('id', 'DESC')->get();
        return view('admin.games.games',compact('games'));
    }

	 public function create()
    {
        return view('admin.games.game_create');
    }
	
	
	 public function store(Request $request)
    {
		 $url = str_replace("-", " ", $request->name);
		 $game_id = 'game'.'_'.rand(1111,9999);
		 
		 
		   if ($request->hasFile('image')) {
               
                            $photo = $request->file('image');
                            $name = time().rand(1,9).'.'.$photo->getClientOriginalExtension();
                            $destinationPath = public_path('/images/games/');
                            $photo->move($destinationPath, $name);
                           

                                  Game::create([
                                      'game_id' => $game_id,
                                      'game_name' => $request->name,
                                      'game_image' => $name,
                                      'url' => $url,
                                      'customcode' => $request->customcode,
                                      'api_url' => $request->api_url,
                                      'status' => $request->status,
                                ]);
                                   
                 return redirect('admin/games/')->with('success',' Inserted Succefully !!');
                                   
                               }
    }
	
	
	public function show($id)
    {
        $game  = Game::where('id',$id)->first();
		
		return view('admin.games.game_view', compact('game'));
    }
	 /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $game  = Game::where('id',$id)->first();
		
		return view('admin.games.game_create', compact('game'));
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
       $url = str_replace("-", " ", $request->name);
		
		$game = Game::find($id);
		$game->game_name = $request->name;
		if ($request->hasFile('image')) {
               
                            $photo = $request->file('image');
                            $name = time().rand(1,9).'.'.$photo->getClientOriginalExtension();
                            $destinationPath = public_path('/images/games/');
                            $photo->move($destinationPath, $name);
                                      $game->game_image = $name;
		}
		$game->url = $url;
		$game->api_url = $request->api_url;
		$game->status = $request->status;
		$game->customcode = $request->customcode;
		$game->save();
		
		return redirect('admin/games')->with('success',' Updated Succefully !!');
		
       }
	
	
	 public function destroy($id)
    {
		  $game = Game::find($id);
		 
		  $image_path = public_path('images/games/'.$game->game_image);  
		  @unlink($image_path);
        
		 
         $battle_delete  = Battle::where('game_id',$id)->delete();
         $game_delete  = Game::where('id',$id)->delete();
		 
		 return redirect('admin/games/')->with('success','Game Deleted !!');
    }
 
}
