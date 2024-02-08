<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Battle;
use App\Comission;
use App\Permission;
use App\UserData;
use App\AdminContactDetails;
use App\Payment;
use App\OnlineChat;
use Alert;
use View;
use Illuminate\Support\Facades\DB;
use Auth;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $permission = Permission::where('user_id', Auth::id())->first();
            View::share('permission', $permission);
            return $next($request);
        });
    }
    public function settings(){
	 $comission = Comission::first();
	 $profile = User::where('id','1')->first();
	 $adminContactDetails = AdminContactDetails::where('id','1')->first();
		return view('admin.admins.settings', compact('comission', 'profile', 'adminContactDetails'));
	}
	
	public function update_commision(Request $request, $id){
	   $comisson = Comission::find($id);
	   $comisson->battle_comission_with_referral = $request->battle_comission_with_referral;
	   $comisson->refferal_comission = $request->refferal_comission;
	   $comisson->battle_comission_without_referral = $request->battle_comission_without_referral;
	   $comisson->save();
		
		return redirect()->back()->with('success','Details Changed!!');
	}
	
	public function permissions(){
	  $permission = Permission::where('user_type',3)->first();
	  return view('admin.employee.permission', compact('permission'));
	}
	
	public function employees(){
	  $employees = User::where('user_type',3)->get();
	   return view('admin.employee.employees', compact('employees'));
	}
	
	public function create_employee(){
	   return view('admin.employee.employee_create');
	}
	
	public function save_employee(Request $request){
		
		$this->validate($request,[
				'mobile' => 'unique:users',
			]);
		
		$name = $request->name;
		$email = $request->email;
		$mobile = $request->mobile;
		$image = 'Avatar2.png';
		$user_type = '3';
		$employee_id = 'EM-'.rand(1,999);
		
		$employee = new User;
		$employee->vplay_id = $employee_id;
		$employee->name = $name;
		$employee->email = $email;
		$employee->mobile = $mobile;
		$employee->image = $image;
		$employee->user_type = $user_type;
		$employee->save();
		
		$createdUserID = $employee->id;
		$permission = New Permission;
		$permission->user_id = $createdUserID;
		$permission->save();
		
		return redirect('admin/employees');
	}
	
	public function view($id){
		
		$employee = User::where('id',$id)->first();
		$allowed_menus = Permission::where('user_type',3)->first();
		$permission = Permission::where('user_id', $id)->first();
		
		return view('admin.employee.employee_view', compact('employee', 'allowed_menus', 'permission'));
	}
	
	public function edit($id){
		
		$employee = User::where('id',$id)->first();
		
		return view('admin.employee.employee_create', compact('employee'));
	}
	
	public function update(Request $request, $id){
		
		$name = $request->name;
		$email = $request->email;
		$mobile = $request->mobile;
		
		$employee = User::find($id);
		$employee->name = $name;
		$employee->email = $email;
		$employee->mobile = $mobile;
		$employee->save();
		
		return redirect('admin/employees');
	}
	public function updateSocialLinks(Request $request){
	   // dd($request->toArray());
	    AdminContactDetails::where('id', 1)->update([
	        'whatsapp_number' => $request->whatsapp_number,
	        'telegram' => $request->telegram,
	        'instagram' => $request->instagram,
	        'email' => $request->email,
	        'calling_number' => $request->calling_number,
	        'support' => $request->support,
	        'youtube_link' => $request->youtube_link,
	        'home_page_notice' => $request->home_page_notice,
	    ]);
	    return redirect()->back()->with('successSocial', 'social links updated successfully...');
	}
	public function destroy($id){
	
		$employee = User::find($id);
		$employee->delete();
		
		return redirect('admin/employees');
	}
	
	public function permissions_update(Request $request, $id){
		//print_r($request->players);
		$per = Permission::find($id);
		$per->players = $request->players;
		$per->all_players = $request->all_players;
		$per->block_players = $request->blocked_players;
		$per->kyc = $request->kyc;
		$per->pending_kyc = $request->pending_kyc;
		$per->approved_kyc = $request->approved_kyc;
		$per->employees_management = $request->employee_management;
		$per->employees = $request->employees;
		$per->permission = $request->permission;
		$per->battle = $request->battle;
		$per->new_battle = $request->new_battle;
		$per->battle_running = $request->running_battle;
		$per->battle_result = $request->battle_result;
		$per->payments = $request->payments;
		$per->payment_received = $request->payment_received;
		$per->recharge_to_user = $request->recharge_to_user;
		$per->payment_settings = $request->payment_settings;
		$per->withdraw_request = $request->withdrawal_requests;
		$per->admin_settings = $request->admin_settings;
		$per->games = $request->games;
		$per->marquee_notification = $request->marquee_notification;
		$per->support = $request->support;
		$per->save();
		
		Alert::success('Permission allowed', 'You submit permission for employees.');
		return redirect()->back();
	}
	
	public function update_profile(Request $request){
		$user_id = Auth::user()->id;
		
		$vplay_id = $request->id;
		$name = $request->name;
		$email = $request->email;
		$mobile = $request->mobile;
		
		$user = User::find($user_id);
		$user->vplay_id = $vplay_id;
		$user->name = $name;
		$user->email = $email;
		$user->mobile = $mobile;
		$user->save();
		
		Alert::success('Saved !', 'Your Details Saved Successfully.');
		return redirect()->back();	
	}
	public function livechat(){
	    $usersWithUnreadMessages = OnlineChat::select('users.id as user_id', 'users.vplay_id', DB::raw('count(onlinechats.id) as unread_messages'), DB::raw('max(onlinechats.updated_at) as last_updated'))
        ->join('users', 'users.id', '=', 'onlinechats.user_id')
        ->where('onlinechats.read_at', 0)
        ->groupBy('users.id', 'users.vplay_id')
        ->get();
        
        $allUserMessages = OnlineChat::select('users.id as user_id', 'users.vplay_id', DB::raw('count(onlinechats.id) as unread_messages'), DB::raw('max(onlinechats.updated_at) as last_updated'))
        ->join('users', 'users.id', '=', 'onlinechats.user_id')
        // ->whereNull('onlinechats.read_at')
        ->groupBy('users.id', 'users.vplay_id')
        ->get();
	    return view('admin.livechat.index', compact('usersWithUnreadMessages', 'allUserMessages'));
	}
    // 	LIVE CHAT
	public function livechatUser(){
	    $users = User::select('users.id', 'users.vplay_id', DB::raw('count(onlinechats.id) as unread_messages'))
            ->leftJoin('onlinechats', function ($join) {
                $join->on('users.id', '=', 'onlinechats.user_id')
                     ->where('onlinechats.read_at', 0);
            })
            ->groupBy('users.id', 'users.vplay_id')
            ->get();
            // dd(Auth::id());

	    return view('admin.livechat.livechatuser', compact('users'));
	}
	public function fetchUserMessages($userId){
        $messages = OnlineChat::where('user_id', $userId)
            ->orderBy('created_at', 'asc')
            ->get(['message', 'is_admin']);
    
        return response()->json(['messages' => $messages]);
    }
    public function storeAdminMessage(Request $request, $userId){
        $message = new OnlineChat;
        $message->user_id = $userId;
        $message->message = $request->message;
        $message->is_admin = true; // This message is from an admin
        $message->save();

        return response()->json(['status' => 'success', 'message' => $message]);
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
