<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserData;
use App\TransactionHistory;
use App\Battle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Alert;


class RefferController extends Controller
{
    public function index(){
		$user_id = Auth::user()->id;
		$user = User::where('id',$user_id)->first();
		$referral_code = $user->referral_code;
		$total_refferal = User::where('reffered_by',$referral_code)->count();
        return view('user.referandearn', compact('user','total_refferal'));
    }
	
	public function referral_history(){
		$user_id = Auth::user()->id;
		$reffer_battle_earn = Battle::where('reffer_id',$user_id)->get();
	
		return view('user.referral_history', compact('reffer_battle_earn'));
    }
	
	public function comission_reedem(){
		$user = User::where('id', Auth::user()->id)->first();
		return view('user.comission_reedem', compact('user'));
	}
	
	public function comission_sent(Request $request){
		
		$amount = $request->amount;
		$user_id = Auth::user()->id;
		$wallet_old = Auth::user()->wallet;
		$old_total_deposite_cash = Auth::user()-> total_deposite_cash;
		$referral_wallet_old = Auth::user()->wallet_reffer;
		
		if($amount <= $referral_wallet_old){
			$user = User::find($user_id);
			$user->wallet = $wallet_old+$amount;
			$user->total_deposite_cash = $old_total_deposite_cash+$amount;
			$user->wallet_reffer = $referral_wallet_old-$amount;
			$user->save();
			
				//transaction history for winner
		        $tran_receiver  = new TransactionHistory;
		       	$tran_receiver->user_id = $user_id;
		    	$tran_receiver->order_id = 'REFF'.rand(1111,9999);
				$tran_receiver->day = date('d');
				$tran_receiver->month = date('M');
				$tran_receiver->year = date('Y');
				$tran_receiver->paying_time =  date('h:i A');
				$tran_receiver->amount =  $amount;
				$tran_receiver->add_or_withdraw =  'add';
				$tran_receiver->closing_balance =  $user->wallet;
				$tran_receiver->withdraw_status =  'reedem';
				$tran_receiver->remark =  'refferal';
				$tran_receiver->save();
			
			// Alert::success('','Thank you, Your refferal amount is add in your wallet.');
			// return redirect('refer-earn');
				return response()->json(['status'=>true,'message'=>'Thank you, Your refferal amount is add in your wallet.','url'=>'refer-earn']);
		}else{
			// Alert::error('','You do not have sufficient referral amount.');
			// return redirect()->back();
			return response()->json(['status'=>true,'message'=>'You do not have sufficient referral amount.','url'=>'comission-reedem']);
		}
		
		
		
	}
}
