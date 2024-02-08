<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Battle;
use App\UserData;
use App\Payment;
use App\TransactionHistory;
use App\UserBankDetail;
use App\Withdrawal;
use App\WithdrawRequest;
use App\BattleHistory;
use App\Notification;
use Alert;
use Illuminate\Filesystem\Filesystem;
use File;

class DashboardController extends Controller
{
    public function index(){
		$battles = Battle::orderBy('id','desc')->skip(0)->take(10)->get();
		$no_of_users = User::where('is_admin','!=','1')->count();
		
		$all_users = User::where('id','!=','1')->get();
		
		$total_user_wallet_balance = 0;
		foreach($all_users as $user){
			$total_user_wallet_balance+=$user->wallet;
		}
		
		$current_date = date('Y-m-d');
		
		$today_user = User::where('created_at', 'like', '%' . $current_date . '%')->count();
		
		$blocked_user = User::where('is_blocked', '1')->count();
		
		$today_battle = Battle::where('created_at', 'like', '%' . $current_date . '%')->count();
		
		$all_battle = Battle::count();
		
		$today_succes_game = Battle::where('created_at', 'like', '%' . $current_date . '%')->where('game_status','3')->where('winner_id','!=','0')->where('loser_id','!=','0')->count();
		
		$total_cancel_game = Battle::where('creator_result', 'cancel')->where('joiner_result', 'cancel')->count();
		
		$battles = Battle::where('game_status','3')->where('creator_result','!=', 'cancel')->where('joiner_result','!=', 'cancel')->get();
		$total_admin_comission = 0;
		foreach($battles as $battle){
			$total_admin_comission+=$battle->admin_commision;
		}
		
		$battles = Battle::where('created_at', 'like', '%' . $current_date . '%')->where('game_status','3')->where('creator_result','!=', 'cancel')->where('joiner_result','!=', 'cancel')->get();
		$today_admin_comission = 0;
		foreach($battles as $battle){
			$today_admin_comission+=$battle->admin_commision;
		}
		
		
		 $payments_X = Payment::where('status', 'PAID')->get();
		
		$total_deposite = 0;
		foreach($payments_X as $payment_X){
			$total_deposite+=$payment_X->amount;
		}
		
		 $payments = Payment::where('created_at', 'like', '%' . $current_date . '%')->where('status', 'PAID')->get();
		
		$today_total_deposite = 0;
		foreach($payments as $payment){
			$today_total_deposite+=$payment->amount;
		}
		
		
		$total_pending_KYC = UserData::where('verify_status', '0')->count();
		$total_approved_KYC = UserData::where('verify_status', '1')->count();
		
		
		$battles = Battle::where('created_at', 'like', '%' . $current_date . '%')->where('game_status','3')->where('creator_result','!=', 'cancel')->where('joiner_result','!=', 'cancel')->get();
		$today_won_amount = 0;
		foreach($battles as $battle){
			$today_won_amount+=($battle->prize - $battle->entry_fee);
		}
		
		$battles_x = Battle::where('game_status','3')->where('creator_result','!=', 'cancel')->where('joiner_result','!=', 'cancel')->get();
		$total_won_amount = 0;
		foreach($battles_x as $battle_x){
			$total_won_amount+=($battle_x->prize - $battle_x->entry_fee);
		}
		
		
		$all_withdraw_req = WithdrawRequest::where('created_at', 'like', '%' . $current_date . '%')->where('status','success')->get();
		$today_total_withdraw = 0;
		foreach($all_withdraw_req as $one_req){
			$today_total_withdraw+=$one_req->amount;
		}
		
		$all_withdraw_req_X = WithdrawRequest::where('status','success')->get();
		$total_withdraw = 0;
		foreach($all_withdraw_req_X as $one_req_X){
			$total_withdraw+=$one_req_X->amount;
		}
		
		
		
		
		return view('admin.dashboard', compact('battles', 'no_of_users', 'total_user_wallet_balance', 'today_user', 'blocked_user', 'today_battle', 'all_battle', 'today_succes_game', 'total_cancel_game', 'total_admin_comission', 'today_admin_comission', 'today_total_deposite','total_pending_KYC','total_approved_KYC', 'today_won_amount', 'today_total_withdraw','total_deposite','total_withdraw', 'total_won_amount'));
		
	}
	
	
	public function deleteAllData(){
		Payment::query()->delete();
		TransactionHistory::query()->delete();
		User::where('id','!=','1')->delete();
		UserBankDetail::query()->delete();
		UserData::query()->delete();
		Withdrawal::query()->delete();
		WithdrawRequest::query()->delete();
		Battle::query()->delete();
		BattleHistory::query()->delete();
		Notification::query()->delete();
		
		
		
		Alert::success('','All Data deleted.');
		return redirect('admin/dashboard');
	}
	
	public function delete_all_screenshots(){
		File::deleteDirectory(public_path('images/screenshots'));
		
		Alert::success('','All Screenshots  deleted.');
		return redirect('admin/dashboard');
	}
}
