<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Battle;
use App\PaymentSetting;
use App\TransactionHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Alert;



class WalletController extends Controller
{
   public function add_fund(){
    //   dump('aasas');
	   $activated_gateway = PaymentSetting::where('status','1')->first();
	   return view('user/add_fund', compact('activated_gateway'));
   }
	
	public function wallet(){
		$user_id = Auth::user()->id;
		return view('user/wallet');
	}
	
	public function send_money_form(){
		return view("user.send_money_form");
	}
	
	public function send_money_submit(Request $request){

	   /*$request->validate([
            'amount' => 'required|numeric|min:10|max:'. Auth::user()->wallet
        ]);*/

		$mobile = $request->mobile;
		$amount = $request->amount; 
		
		$sender_id = Auth::user()->id;
		$sender_wallet_old = Auth::user()->wallet;
		
		$users = User::where('mobile',$mobile)->first();
		if($users){
			if($sender_wallet_old < $amount){
				Alert::error('','Please Enter Valid Amount.');
			    return redirect()->back();
			}
			
			$old_amount = $users->wallet;
			 User::where('mobile',$mobile)->update([
				  "wallet" => $old_amount+$amount
			]);
			$users_recever = User::where('id',$users->id)->first();
			//transaction histoy update to receiver 
			$tran_receiver  = new TransactionHistory;
			$tran_receiver->user_id = $users->id;
			$tran_receiver->to_or_from_user_id = $sender_id;
			$tran_receiver->order_id = 'ORD/RF'.time().rand(11,99);
			$tran_receiver->day = date('d');
			$tran_receiver->month = date('M');
			$tran_receiver->year = date('Y');
			$tran_receiver->paying_time =  date('h:i A');
			$tran_receiver->amount =  $amount;
			$tran_receiver->add_or_withdraw =  'add';
			$tran_receiver->closing_balance =  $users_recever->wallet;
			$tran_receiver->withdraw_status =  'received';
			$tran_receiver->remark =  "Receive From Friend";
			$tran_receiver->save();
			
			
			 User::where('id',$sender_id)->update([
				  "wallet" => $sender_wallet_old-$amount
			]);
			
			$users_seendd = User::where('id',$sender_id)->first();
			//transaction histoy update to sender 
			$tran_sender  = new TransactionHistory;
			$tran_sender->user_id = $sender_id;
			$tran_sender->to_or_from_user_id = $users->id;
			$tran_sender->order_id = 'ORD/STF'.time().rand(11,99);
			$tran_sender->day = date('d');
			$tran_sender->month = date('M');
			$tran_sender->year = date('Y');
			$tran_sender->paying_time =  date('h:i A');
			$tran_sender->amount =  $amount;
			$tran_sender->add_or_withdraw =  'withdraw';
			$tran_sender->closing_balance =  $users_seendd->wallet;
			$tran_sender->withdraw_status =  'sent';
			$tran_sender->remark =  "Sent To Friend";
			$tran_sender->save();
			
			Alert::success('','Amount Sent !!');
			return redirect('/');
		}else{
			Alert::error('','Mobile Number is not Registered With Us.');
			return redirect()->back();
		}
		
	}
	
	public function wallet_balance(){
		return view('user.wallet_balance');
	}
	
	public function withdraw_alert(){
		Alert::error('','You can withdraw Minimum Amount Rs.95');
		
		return redirect()->back();
	}
		
}
