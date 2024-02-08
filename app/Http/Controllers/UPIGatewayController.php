<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Payment;
use App\PaymentSetting;
use App\User;
use App\TransactionHistory;
use RealRashid\SweetAlert\Facades\Alert;

class UPIGatewayController extends Controller
{
     public function create(Request $request){
        //  dd('asdf');
        // dd($request->toArray());
        $upi_gateway_details = PaymentSetting::where('name','UPI Gateway')->first();
        $key = $upi_gateway_details->parameter_one;
        $txnid = 'ORD/UPI'.rand(111111111,999999999);
        $firstname = $request->vplay_id;
        $user_id = $request->vplay_id;
        $phone = $request->mobile;
        $amount = $request->amount;

        // INITIATE UPI GATEWAY PAYMENT GATEWAY
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',  // Set the header as required by the API endpoint
            // Add any other necessary headers here
        ])
        ->post('https://api.ekqr.in/api/create_order', [
            "key"=> $key,
            "client_txn_id"=> $txnid, // order id or your own transaction id
            "amount"=> $amount,
            "p_info"=> "Game",
            "customer_name"=> $firstname, // customer name
            "customer_email"=> "rajludoplayer@gmail.com", // customer email
            "customer_mobile"=> $phone, // customer mobile number
            "redirect_url"=> url('upigateway/transaction-status'),
        ]);
        if($response['status'] == true)
            return redirect($response['data']['payment_url']);
    }

	public function transaction_status(Request $request){
        $upi_gateway_details = PaymentSetting::where('name','UPI Gateway')->first();
        $key = $upi_gateway_details['parameter_one'];
        //CHECK TRANSACTION STATUS
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])
        ->post('https://api.ekqr.in/api/check_order_status', [
            'key' => $key,
            'client_txn_id' => $request->client_txn_id,
            'txn_date' => date('d-m-Y'),
        ]);
        // dd($response->json());
        if($response['status']){
            $user = User::where('id', Auth::id())->first();

            $oldWalletBalance = $user->wallet;
            $oldTotalDepositeCash = $user->total_deposite_cash;
            $finalTransWalletClosingBalance = $user->wallet;
            if($response['data']['status'] == 'success'){

                $newWalletBalance = $oldWalletBalance + $response['data']['amount'];
                $newTotalDepositeCash = $oldTotalDepositeCash + $response['data']['amount'];
                $finalTransWalletClosingBalance = $newWalletBalance;

                // UPDATE USER WALLET BALANCE
                $updateWalletBalance = User::where('id', Auth::id())->update([
                'wallet' => $newWalletBalance,
                'total_deposite_cash' => $newTotalDepositeCash,
                ]);
            }


            //ADD IN PAYMENT DETAILS
            $payment = new Payment;
            $payment->order_id = $response['data']['client_txn_id'];
            $payment->vplay_id = Auth::user()->vplay_id;
            $payment->user_id = Auth::user()->id;
            $payment->mobile = Auth::user()->vplay_id;
            $payment->amount = $response['data']['amount'];
            $payment->status = $response['data']['status'];
            $payment->upigateway_date = date('Y-m-d H:i:s');
            $payment->save();

            //MAKE ENTRY IN TRANSACTION
            $Trans_hist = new TransactionHistory;
            $Trans_hist->user_id = Auth::id();
            $Trans_hist->payment_id = $payment->id;
            $Trans_hist->order_id = $request->client_txn_id;
            $Trans_hist->day = date('d');
            $Trans_hist->month = date('M');
            $Trans_hist->year = date('Y');
            $Trans_hist->paying_time = date('h:i A');
            $Trans_hist->amount =  $response['data']['amount'];
            $Trans_hist->add_or_withdraw = 'add';
            $Trans_hist->check_add_amount_status = $response['data']['status'];
            $Trans_hist->closing_balance = $finalTransWalletClosingBalance;
            $Trans_hist->save();



            //ADD DETAILS IN NOTIFICATION TABLE
            $notification = new Notification;
            $notification->title = "PAYMENT TRANSACTION CREATED";
            $notification->text = Auth::user()->vplay_id ." create payment and last status is " . $response['msg'];
            $notification->user_id = Auth::id();
            $notification->reason = 'PAYMENT ADD';
            $notification->save();
            
            
            Alert::error("Payment". $response['data']['status'] , '');
			 return redirect('/add-funds');



        }
        // dd($response->json());

        //         Alert::error('Record Not Found', '');
		// 		return redirect('/add-funds');

		// 	}
		// 	else{
		// 		if($response['data']['status'] != "failure"){

		// 			Payment::where('order_id', $client_txn_id)
		// 				   ->update([
		// 					   'order_token' => $txn_id,
		// 					   'status' => 'PAID'
		// 					]);


		// 				$user_data = User::where('id', $payment_details->user_id)->first();
		// 				$total_deposite_cash = $user_data->total_deposite_cash;
		// 				$wallet = $user_data->wallet;
		// 				$new_amount = $payment_details->amount;
		// 				$user_id = $payment_details->user_id;

		// 			 $user  = User::where('id', $user_id)->first();
		// 			 $user->wallet  = $wallet + $new_amount;
		// 			 $user->total_deposite_cash  = $total_deposite_cash+$new_amount;
		// 			 $user->save();

		// 			 $Trans_hist = new TransactionHistory;
		// 			 $Trans_hist->user_id = $user_id;
		// 			 $Trans_hist->payment_id = $payment_details->id;
		// 			 $Trans_hist->order_id = $client_txn_id;
		// 			 $Trans_hist->day = date('d');
		// 			 $Trans_hist->month = date('M');
		// 			 $Trans_hist->year = date('Y');
		// 			 $Trans_hist->paying_time = date('h:i A');
		// 			 $Trans_hist->amount = $new_amount;
		// 			 $Trans_hist->add_or_withdraw = 'add';
		// 			 $Trans_hist->closing_balance = $wallet+$new_amount;
		// 			 $Trans_hist->save();

		// 			Alert::success('Transaction Successfull !!', '');
		// 			 return redirect('/add-funds');

		// 			 }else{
		// 				Payment::where('order_id', $client_txn_id)
		// 					   ->update([
		// 						   'order_token' => $txn_id,
		// 						   'status' => 'FAILED'
		// 						]);
		// 				Alert::error('Payment Canceled!!', '');
		// 				 return redirect('/add-funds');
		// 			}
		// 	}
	}
}
