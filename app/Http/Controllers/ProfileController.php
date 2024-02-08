<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use Auth;
use App\User;
use App\BattleHistory;
use App\TransactionHistory;
use App\RefferalHistory;
use App\Notification;
use App\OnlineChat;
use App\UserData;

class ProfileController extends Controller
{
	 public $successStatus = 200;
	
   public function profile(){
	   $user_id = Auth::user()->id;
	   $user = User::where('id',$user_id)->first();
	    return view('user.profile', compact('user'));
   }
	
	public function saveVplayID(Request $request){
	    $user_id = Auth::user()->id;
	    $username = $request->username;
		
		$user = User::where('id','=',$user_id)->update(['vplay_id' => $username]);
		$user_data = UserData::where('user_id','=',$user_id)->update(['vplay_id' => $username]);
		$data = User::where('vplay_id' ,'=', $username)->first();
        // send otp to mobile no using sms api
        return response()->json($data);
	}
	
	public function update_email(Request $request){
		     $user_id = Auth::user()->id;
		       $user  = User::where('id', $user_id)->first();
				 $user->email  = $request->email;
				 $user->save();
		
		return redirect('/profile');
	}
	
	public function game_history(){
		$user_id =  Auth::user()->id;
		$battle_history = BattleHistory::where('user_id',$user_id)->orderBy('id','desc')->get(); // GAME HISTORY
// 		dd($battle_history->toArray());
		return view('user.game_history', compact('user_id','battle_history'));
	}
	
	public function transaction_history(){
		$user_id =  Auth::user()->id;
		$trans_history = TransactionHistory::where('user_id',$user_id)->orderBy('id','desc')->where('where_to_show', null)->get();
		$ref_history = RefferalHistory::where('user_id',$user_id)->orderBy('id','desc')->get(); // REFERRAL HISTORY
		$battle_history = BattleHistory::where('user_id',$user_id)->orderBy('id','desc')->get(); // GAME HISTORY
		
		
        $trans_history = TransactionHistory::where('user_id', $user_id)->where('where_to_show', null)->where('trans_type', 1)->get();
        $ref_history = RefferalHistory::where('user_id', $user_id)->get();
        $battle_history = BattleHistory::where('user_id', $user_id)->get();
        
        $sortedMerged = $trans_history->concat($ref_history)->concat($battle_history)->sortByDesc('id');
        // dd($sortedMerged->toArray());
		return view('user.transaction_history ', compact('user_id','trans_history', 'ref_history' , 'battle_history', 'sortedMerged'));
	}
	
	public function refferral_history(){
		$user_id =  Auth::user()->id;
		$ref_history = RefferalHistory::where('user_id',$user_id)->orderBy('id','desc')->get(); // TRANSACTION HISTORY
		return view('user.refferal_history ', compact('user_id','ref_history'));
	}
	
	
	public function notification(){
		$user_id =  Auth::user()->id;
		$notifications = Notification::where('user_id', $user_id)->orderBy('id','desc')->get();
		$user_data = UserData::where('user_id', $user_id)->first();
		return view('user.notification ', compact('user_id','notifications','user_data'));
	}
	
	public function support(){
		$user_id =  Auth::user()->id;
		
		return view('user.support ', compact('user_id'));
	}
	
	public function saveRefferBy(Request $request){
	     $user_id = Auth::user()->id;
	     $refferalID = $request->refferalID;
		$is_exist = User::where('referral_code',$refferalID)->first();
		if($is_exist){
			$user = User::where('id','=',$user_id)->update(['reffered_by' => $refferalID]);
		   $data = User::where('id' ,'=', $user_id)->first();
            // send otp to mobile no using sms api
            return response()->json($data);
		 }else{
			$data = "No any Referral ID Found";
			return response()->json($data);
			
		}
		
	}
	
	public function update_profile_picture(Request $request){
	
		$user_id = Auth::user()->id;
		
		$user  = User::find($user_id);
		if($request->hasFile('profile_image')){
			
			$image = $request->file('profile_image');
			$image_name = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/images/profilesImage/');
			$image->move($destinationPath, $image_name);
			
			$user->image = $image_name;
		}
		
		$user->save();
		Alert::success('', 'Profile Picture Updated!!');
		return redirect('/profile');
	}
	
	public function livechat(){
	    $messages = OnlineChat::where('user_id', Auth::id())->get();
	    return view('user.livechat', compact('messages'));
	}
	public function sendMessage(Request $request){
    $message = new OnlineChat;
    $message->user_id = auth()->id();
    $message->message = $request->message;
    $message->is_admin = false; // This message is from a user, not an admin
    $message->save();

    return response()->json(['status' => 'success']);
	    return view('user.livechat');
	}
	public function fetchMessages(){
        $user_id = auth()->id();
        $messages = OnlineChat::where('user_id', $user_id)
                       ->orWhere('is_admin', true)
                       ->orderBy('created_at', 'asc')
                       ->get(['message as text', 'is_admin']);
    
        return response()->json(['messages' => $messages]);
    }

}
