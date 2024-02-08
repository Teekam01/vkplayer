<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Battle;
use App\UserData;
use App\TransactionHistory;
use App\Setting;
use App\UserBankDetail;
use App\Payment;
use App\WithdrawRequest;
use Alert;
use Auth;
use App\Permission;
use View;
use App\Notification;

class WithdrawController extends Controller{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $permission = Permission::where('user_id', Auth::id())->first();
            View::share('permission', $permission);
            return $next($request);
        });
    }
    public function index(){
		$requests = WithdrawRequest::orderBy('id','DESC')->get();
		$withdraw_setting = Setting::where('url','withdraw_request_setting')->first();
		return view('admin.payments.withdraw_requests', compact('requests', 'withdraw_setting'));
	}
	
	public function withdraw_view($id){
		$request = WithdrawRequest::where('id',$id)->first();
		$userDetails = User::where('id',$request->user_id)->first();
		$userBank = UserBankDetail::where('id',$request->bank_details_id)->first();
		return view('admin.payments.withdraw_view', compact('request', 'userDetails', 'userBank'));
	}
	
	public function save_withdrawal_option(Request $request){
		$withdraw_option = $request->withdraw_option;
		Setting::where('name', 'Withdraw Request Setting')
			   ->update([
				   'options' => $withdraw_option
				]);
		Alert::success('','Withdraw Mode Changed.');
		return redirect('admin/withdraw-request');
	}
	
	public function withdraw_approved($id){
		$request_w = WithdrawRequest::find($id);
		$request_w->status = 'success';
		$request_w->save();
		
		$user_id = $request_w->user_id;
		
		$user = User::find($user_id);
		
		$trans  = TransactionHistory::where('order_id', $request_w->withdraw_id)->first();
		$trans->withdraw_status = 'SUCCESS';
		$trans->closing_balance = $user->wallet;
		$trans->save();
		
		// return redirect('admin/withdraw-request');
		return response()->json(['status'=>true, 'message'=>'Withdraw Successfully.','url'=>'admin/withdraw-request']);
	}
	
	public function withdraw_reject($id, Request $request){
	    $request_w = WithdrawRequest::find($id);
		$request_w->status = 'reject';
		$request_w->save();
		
		$user_id = $request_w->user_id;
		
		$user_r = User::find($user_id);
		$old_wallet = $user_r->wallet;
		$old_wallet_winning_cash = $user_r->wallet_winning_cash;
		
		$user = User::find($user_id);
		$user->wallet = $old_wallet+$request_w->amount;
		$user->wallet_winning_cash = $old_wallet_winning_cash+$request_w->amount;
		$user->save();
		
		$notification  = new Notification;
		$notification->title = "Withdraw Rejected.";
		$notification->text = $request->reject_reason;
		$notification->user_id = $user_id;
		$notification->reason = $request->reject_reason;
		$notification->save();
		
		$trans  = TransactionHistory::where('order_id',  $request_w->withdraw_id)->first();
		$trans->withdraw_status = 'reject';
		$trans->reason = $request->reject_reason;
		$trans->closing_balance = $user->wallet;
		$trans->save();
		
		// return redirect('admin/withdraw-request');
		return response()->json(['status'=>true, 'message'=>'Withdraw Rejected.','url'=>'admin/withdraw-request']);
	}
	
	public function save_withdrawal_creds(Request $request){
	   $clientId = $request->clientId;
	   $clientSecret = $request->clientSecret;
		Setting::where('name', 'Withdraw Request Setting')
			   ->update([
				   'clientId' => $clientId,
				   'clientSecret' => $clientSecret
				]);
		Alert::success('','Cashfree Payout Credentials Changed.');
		return redirect('admin/withdraw-request');
	}
	
	
}
