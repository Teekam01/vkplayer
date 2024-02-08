<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserData;
use App\Battle;
use App\UserBankDetail;
use App\WithdrawRequest;
use App\Setting;
use App\TransactionHistory;
use App\Withdrawal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Alert;



class WithdrawController extends Controller
{
	
   public function withdraw_check(){
	    $user_id = Auth::user()->id;
	    $user_kyc = UserData::where('user_id',$user_id)->first();
	    return view('user.withdraw_kyc_check', compact('user_kyc'));
   } 
	
	public function withdraw_through_upi(){
	    $user_id = Auth::user()->id;
	    $user_bank_details = UserBankDetail::where('user_id',$user_id)->first();
	    return view('user.withdraw_through_upi', compact('user_bank_details'));
   }
	public function withdraw_now(Request $request){
	    
	    $upi_id = $request->upi_id;
        $amount = $request->amount;
        $userid = $request->userid;
        $user = User::where('id', Auth::user()->id)->first();
        if($user->wallet < $request->amount){
            return response()->json(['status'=>false, "message"=>'dont have enough money to withdrawal']);
        }
		else{
    		$search_data = UserBankDetail::where('user_id', $userid)->first();
    		$upi_account_holder_name = $request->upi_account_holder_name;
    		if($search_data){
    			    $bank_details = UserBankDetail::find($search_data->id);
    				$bank_details->upi_account_holder_name = $upi_account_holder_name;
    				$bank_details->upi_id = $upi_id;
    				$bank_details->save();
    		}else{
    				$bank_details = new UserBankDetail;
    				$bank_details->upi_account_holder_name = $upi_account_holder_name;
    				$bank_details->upi_id = $upi_id;
    				$bank_details->user_id = $userid;
    				$bank_details->save();
    		}
    		
    		//UPDATE USER WALLET BALANCE
    		
    		$newWalletBalance = $user->wallet - $request->amount;
    		$newHoldWalletBalance = $user->holded_deposite_cash - $request->amount;
    		$newWinningBalance = $user->wallet_winning_cash - $request->amount;
    		$newHoldWinningBalance = $user->holded_winning_cash - $request->amount;
    		User::where('id', Auth::user()->id)->update([
                'wallet' => $newWalletBalance,
                'holded_deposite_cash' => 0,
                'wallet_winning_cash'=>$newWinningBalance,
                'holded_winning_cash'=>0,
    	    ]);
    	    //update wallet and winning cash end
    		//UPDATE IN WITHDRAWAL HISTORY
    		$withdraw  = new WithdrawRequest;
    		$withdraw->withdraw_id = time().rand(11,99);
    		$withdraw->user_id = $userid;
    		$withdraw->bank_details_id = $bank_details->id;
    		$withdraw->get_amount_via = $request->get_amount_via;
    		$withdraw->amount = $amount;
    		$withdraw->save();
    		
    		//UPDATE IN TRANSACTION HISTORY
    		$user  = User::where('id',$userid)->first();
    		$trans  = new TransactionHistory;
    		$trans->user_id = $userid;
    		$trans->order_id = $withdraw->withdraw_id;
    		$trans->day = date('d');
    		$trans->month = date('M');
    		$trans->year = date('y');
    		$trans->paying_time = date('h:i A');
    		$trans->amount = $amount;
    		$trans->add_or_withdraw = 'withdraw';
    		$trans->closing_balance = $user->wallet;
    		$trans->withdraw_status = 'pending';
    		$trans->save();
    	    
    	    
    	    return response()->json(['status'=>true, "message"=>'withdraw request sent successfully']);
		    
		}
	}
	
	public function withdraw_now1(Request $request){
		$wallet_winning_cash_old = User::where('id', Auth::user()->id)->first();
		$wallet_old = User::where('id', Auth::user()->id)->first();
		$max = $wallet_winning_cash_old->wallet_winning_cash ?? 0;
        $request->validate([
            'amount' => 'required|numeric|min:10|max:'.$max
        ]);
        $upi_account_holder_name = $request->upi_account_holder_name;
        $upi_id = $request->upi_id;
        $amount = $request->amount;
        $userid = $request->userid;
		 
		$search_data = UserBankDetail::where('user_id', $userid)->first();
		
		if($search_data){
			    $bank_details = UserBankDetail::find($search_data->id);
				$bank_details->upi_account_holder_name = $upi_account_holder_name;
				$bank_details->upi_id = $upi_id;
				$bank_details->save();
		}else{
				$bank_details = new UserBankDetail;
				$bank_details->upi_account_holder_name = $upi_account_holder_name;
				$bank_details->upi_id = $upi_id;
				$bank_details->user_id = $userid;
				$bank_details->save();
		}
		//update wallet and winning cash start
		$user = User::where('id', Auth::user()->id)->first();
		$newWalletBalance = $user->wallet - $request->amount;
		$newHoldWalletBalance = $user->holded_deposite_cash - $request->amount;
		$newWinningBalance = $user->wallet_winning_cash - $request->amount;
		$newHoldWinningBalance = $user->holded_winning_cash - $request->amount;
		User::where('id', Auth::user()->id)->update([
            'wallet' => $newWalletBalance,
            'holded_deposite_cash' => 0,
            'wallet_winning_cash'=>$newWinningBalance,
            'holded_winning_cash'=>0,
	    ]);
		//update wallet and winning cash end
		
		$withdraw  = new WithdrawRequest;
		$withdraw->withdraw_id = time().rand(11,99);
		$withdraw->user_id = $userid;
		$withdraw->bank_details_id = $bank_details->id;
		$withdraw->get_amount_via = $request->get_amount_via;
		$withdraw->amount = $amount;
		$withdraw->save();
		
		$user  = User::where('id',$userid)->first();
		
		$trans  = new TransactionHistory;
		$trans->user_id = $userid;
		$trans->order_id = $withdraw->withdraw_id;
		$trans->day = date('d');
		$trans->month = date('M');
		$trans->year = date('y');
		$trans->paying_time = date('h:i A');
		$trans->amount = $amount;
		$trans->add_or_withdraw = 'withdraw';
		$trans->closing_balance = $user->wallet;
		$trans->withdraw_status = 'pending';
		$trans->save();
		
		
		
	   //return redirect('/withdraw-request-success');
	   return response()->json(['status'=>true, "message"=>'withdraw request sent successfully']);
   }
	
	public function withdraw_request_success(){
	    $request = WithdrawRequest::where('user_id', Auth::user()->id)->first();
	   // dd($request->toArray());
		return view('user.withdraw_request_success', compact('request'));
	}
	
	public function withdraw_now_bank(Request $request){
	    $wallet_winning_cash_old = User::where('id', Auth::user()->id)->first();
        if( $request->amount >  $wallet_winning_cash_old->wallet_winning_cash){
            return response()->json(['status'=>false, 'message'=>'Not enough money to withdrawal.']);
        }
        else{
            
            $max = $wallet_winning_cash_old->wallet_winning_cash ?? 0;
            $request->validate([
                'amount' => 'required|numeric|min:95|max:'.$max
            ]);

	   $bank_account_holder_name = $request->bank_account_holder_name;
	   $bank_account_number = $request->bank_account_number;
	   $ifsc_code = $request->ifsc_code;
	   $amount = $request->amount;
	   $userid = $request->userid;
		
		$search_data = UserBankDetail::where('user_id', $userid)->first();
		
		if($search_data){
			    $bank_details = UserBankDetail::find($search_data->id);
				$bank_details->user_id = $userid;
				$bank_details->bank_account_holder_name = $bank_account_holder_name;
				$bank_details->bank_account_number = $bank_account_number;
				$bank_details->ifsc_code = $ifsc_code;
				$bank_details->save();
		}else{
				$bank_details = new UserBankDetail;
				$bank_details->user_id = $userid;
				$bank_details->bank_account_holder_name = $bank_account_holder_name;
				$bank_details->bank_account_number = $bank_account_number;
				$bank_details->ifsc_code = $ifsc_code;
				$bank_details->save();
		}
		
		
		$withdraw_setting = Setting::where('url','withdraw_request_setting')->first();
		
		if($withdraw_setting->options == 'automatic'){
			
			 $clientId = $withdraw_setting->clientId;
             $clientSecret = $withdraw_setting->clientSecret;
			
			$beneId = rand(100000,999999);
				
			$beneId = $beneId;
			$name = $bank_account_holder_name;
			$email = 'ludo'.rand(11,999).'@gmail.com';
			$phone = Auth::user()->mobile;
			$address1 = 'ludo';
			$city = 'jaipur';
			$state = 'rajasthan';
			$pincode = '333024';
		   //create Token
		   	$token = $this->create_token($clientId, $clientSecret);
// 			print_r($token); die();
			
			//beneficary details
				$beneficiary = array(
					'beneId' => $beneId,
					'name' => $name,
					'email' => $email,
					'phone' => $phone,
					'bankAccount' => $bank_account_number,
					'ifsc' => $ifsc_code,
					'address1' => $address1,
					'city' => $city,
					'state' => $state,
					'pincode' => $pincode,
		    	);
            $res = $this->isBeneficiary($bank_account_number ,$ifsc_code ,  $token ) ; 
            if($res->subCode != '200'){
                $benf_id = $beneId;
              $beneficary_added = $this->add_beneficiary($beneficiary, $clientId, $clientSecret, $token);

            }
            else {
                	$benf_id = $res->data->beneId;
    			$beneficary_details = $this->get_beneficiary($clientId, $clientSecret, $token, $benf_id);
            }
			
// 			if($beneficary_added->subCode == 409){
// 			    //get Beneficary Details if exists alrady
// 			    $user_id = Auth::user()->id;
// 			    $benf_id=  Withdrawal::where('user_id',$user_id)->orderBy('created_at', 'desc')->first()->beneId;
// 			  	$beneficary_details = $this->get_beneficiary($clientId, $clientSecret, $token, $benf_id);
			   
// 			}else {
			    
			    //get Beneficary Details
    		
// 			}
		
			
// 			echo "<pre>";
// 			print_r($beneficary_details); 
// 			echo "</pre>";
			//
			//transfer amount 
			
			$transfer_id = time().rand(1,9);
			$transfer = array(
				'beneId' => $benf_id,
				'amount' => $amount,
				'transferId' => $transfer_id,
			);
			
			$transfer_amount = $this->transfer_amount($clientId, $clientSecret, $token, $transfer);
// 			dump($clientId, $clientSecret, $token, $transfer);
// 			print_r($beneficary_details); die();
				// dd($transfer_amount);
			$user  = User::where('id',$userid)->first();
			
			$old_user_wallet = Auth::user()->wallet;
			$old_user_wallet_winning_cash = Auth::user()->wallet_winning_cash;
			
			$userr = User::find($userid);
			$userr->wallet = $old_user_wallet-$amount;
			$userr->wallet_winning_cash = $old_user_wallet_winning_cash-$amount;
			$userr->save();
			
			
			    $trans  = new TransactionHistory;
				$trans->user_id = $userid;
				$trans->order_id = $transfer_id;
				$trans->day = date('d');
				$trans->month = date('M');
				$trans->year = date('y');
				$trans->paying_time = date('h:i A');
				$trans->amount = $amount;
				$trans->add_or_withdraw = 'withdraw';
				$trans->closing_balance = $user->wallet;
				$trans->withdraw_status = $transfer_amount->status;
		     	$trans->save();
			
		
			
			$withdrawal = new Withdrawal;
			$withdrawal->user_id = Auth::user()->id;
			$withdrawal->beneId = $benf_id;
			$withdrawal->name = $name;
			$withdrawal->email = $email;
			$withdrawal->phone = $phone;
			$withdrawal->bankAccount = $bank_account_number;
			$withdrawal->ifsc = $ifsc_code;
			$withdrawal->address1 = $address1;
			$withdrawal->city = $city;
			$withdrawal->state = $state;
			$withdrawal->pincode = $pincode;
			$withdrawal->transferId = $transfer_id;
			$withdrawal->amount = $amount;
			$withdrawal->status = $transfer_amount->status;
			$withdrawal->method = 'Bank transfer';
			$withdrawal->save();
			
		
			if($transfer_amount->status == 'SUCCESS' || $transfer_amount->status == 'PENDING'){
				    // Alert::success('', 'Withdraw Successful.');
				    // return redirect('wallet');
				    return response()->json(['status'=>true, 'message'=>'Withdraw Successful.','url'=>'/wallet']);
				
				}else{
			 //       Alert::error('', 'Withdraw Failed.');
				//   return redirect('/wallet');
				return response()->json(['status'=>false, 'message'=>'Withdraw Failed.','url'=>'/wallet']);
				}
			
		
		}
		else{
			//update wallet and winning cash start
			$wallet_winning_cash_old = User::where('id', Auth::user()->id)->first();
		    $wallet_old = User::where('id', Auth::user()->id)->first();
		
		    $wallet_winning_old = $wallet_winning_cash_old->wallet_winning_cash;
		    $new_wallet_winning = $wallet_winning_old - $amount;
		
		 	$wallet_old = $wallet_old->wallet;
			$new_wallet = $wallet_old - $amount;
		
			$user_data = User::find(Auth::user()->id);
			$user_data->wallet = $new_wallet;
			$user_data->wallet_winning_cash = $new_wallet_winning;
			$user_data->save();
			//update wallet and winning cash end
			
			//withdrwa request start 
			$withdraw  = new WithdrawRequest;
			$withdraw->user_id = $userid;
			$withdraw->withdraw_id = time().rand(11,99);
			$withdraw->bank_details_id = $bank_details->id;
			$withdraw->get_amount_via = $request->get_amount_via;
			$withdraw->amount = $amount;
			$withdraw->save();
			//withdrwa request end
			
			$user  = User::where('id', $userid)->first();
            //transaction history  start 
			$trans  = new TransactionHistory;
			$trans->user_id = $userid;
			$trans->order_id = $withdraw->withdraw_id;
			$trans->day = date('d');
			$trans->month = date('M');
			$trans->year = date('y');
			$trans->paying_time = date('h:i A');
			$trans->amount = $amount;
			$trans->add_or_withdraw = 'withdraw';
			$trans->closing_balance = $user->wallet;
			$trans->withdraw_status = 'pending';
			$trans->save();
			 //transaction history  end 
			 //return redirect('/withdraw-request-success');
			 return response()->json(['status'=>true, 'message'=>'Withdraw Success.','url'=>'/withdraw-request-success']);
		}    
        }
		
	
	   
   }
	
	public function withdraw_through_bank_transfer(){
	    $user_id = Auth::user()->id;
	    $user_bank_details = UserBankDetail::where('user_id',$user_id)->first();
	    return view('user.withdraw_through_bank_transfer', compact('user_bank_details'));
   }
	
	
	public function create_token($clientId, $clientSecret){
		
		$auth_url = "https://payout-gamma.cashfree.com/payout/v1/authorize";

		$header = array(
			'X-Client-Id: '.$clientId,
			'X-Client-Secret: '.$clientSecret, 
			'Content-Type: application/json',
		);

		$data = array(
			 'token_id : '.rand(111,999),
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_URL, $auth_url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);
		if(!is_null($data)) curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 

		$r = curl_exec($ch);
		$r_array = json_decode($r);
		// print_r($r_array);  die();
		$token = $r_array->data->token;
		
		return $token;
	}
	
	
	public function add_beneficiary($beneficiary, $clientId, $clientSecret, $token){
			

		$header = array(
		'X-Client-Id: '.$clientId,
		'X-Client-Secret: '.$clientSecret, 
		'Content-Type: application/json',
		'Authorization: Bearer '.$token
		);


		//authentication API 
		$add_benf_url = "https://payout-gamma.cashfree.com/payout/v1/addBeneficiary";


		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_URL, $add_benf_url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);
		if(!is_null($beneficiary)) curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($beneficiary)); 


		$re = json_decode(curl_exec($ch));
        curl_close($ch);
		return $re;
		//return 1;

		/*if(json_decode($re)->subCode == '409'){
			return 0;
		}else{
			return 1;
		}*/

// 		if($re->status != 'SUCCESS '){
// 			return 0;
// 			/*print('error in posting');
// 			print(curl_error($ch));
// 			die();*/
// 		 }else{
// 			 return 1;
// 		 }
		

		
	}
	
	
	public function get_beneficiary($clientId, $clientSecret, $token, $benf_id){
	    
		$header = array(
         'Content-Type: application/json',
         'Authorization: Bearer '.$token
	);
	
	//authentication API 
	$get_benf_url = "https://payout-gamma.cashfree.com/payout/v1/getBeneficiary/$benf_id";


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $get_benf_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);
    
    $r = curl_exec($ch);
//   print_r($r . ' token : ' . $token); die();
		return json_decode($r);
	
	}
	
	
// 	check beneficiary 
	public function isBeneficiary($bank, $ifsc, $token){
	    
		$header = array(
         'Content-Type: application/json',
         'Authorization: Bearer '.$token
	);
	
	//authentication API 
	$get_benf_url = "https://payout-gamma.cashfree.com/payout/v1/getBeneId?bankAccount=$bank&ifsc=$ifsc";


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $get_benf_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);
    
    $r = curl_exec($ch);
//   print_r($r . 'url : ' . $get_benf_url); die();
    $res = json_decode($r) ; 
    
		return $res;
	
	}
	
	
	
	public function transfer_amount($clientId, $clientSecret, $token, $transfer){
		$header = array(
			'X-Client-Id: '.$clientId,
			'X-Client-Secret: '.$clientSecret, 
			'Content-Type: application/json',
			'Authorization: Bearer '.$token
			);


			//authentication API 
			$req_transfer_url = "https://payout-gamma.cashfree.com/payout/v1/requestTransfer";


			$ch = curl_init();
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_URL, $req_transfer_url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);
			if(!is_null($transfer)) curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($transfer)); 


			$re = curl_exec($ch);
            // print_r($re. $token ); die();
			return json_decode($re);  
	}
	
	public function view_withdrawal_details($transfer_id){
		$withdraw_details = Withdrawal::where('transferId',$transfer_id)->first();
		return view('user.view_withdraw_details', compact('withdraw_details'));
	}
}
