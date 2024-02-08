<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use App\Payment;
use App\PaymentSetting;
use App\User;
use App\TransactionHistory;
use Alert;

class UPIAPIController extends Controller
{
     public function create(Request $request)
     {

		   $upi_api_details = PaymentSetting::where('name','UPI API')->first();

		   $key = $upi_api_details->parameter_one;


		   // you can get your key from https://merchant.upigateway.com/user/api_credentials
		   $firstname = $request->vplay_id;
		   $txnid = 'ORD/UPIAPI'.rand(1111111,9999999);
		   $user_id = $request->vplay_id;
		   $phone = $request->mobile;
		   $amount =$request->amount;
		   $datejoinds=date("d-m-Y");

		 $payment = new Payment;
		 $payment->order_id = $txnid;
		 $payment->vplay_id = $user_id;
		 $payment->user_id = Auth::user()->id;
		 $payment->mobile = $phone;
		 $payment->amount = $amount;
		 $payment->status = 'ACTIVE';
		 $payment->upigateway_date = $datejoinds;
		 $payment->save();

			 $content = json_encode(array(
					"token"=> $key,
					"orderId"=> $txnid, // order id or your own transaction id
					"txnAmount"=> $amount,
					"txnNote"=> "Game",
					"customerName"=> $firstname, // customer name
					"customerEmail"=> "rajludoplayer@gmail.com", // customer email
					"customerMobile"=> $phone, // customer mobile number
					"callbackUrl"=> "https://vkludopalyer.com/upiapi/transaction-status-check?order_id=".$txnid, // redirect url after payment, with ?client_txn_id=&txn_id=
			 ));


	        $url = "https://upiapi.in/order/create";

			 $curl = curl_init($url);
			 curl_setopt($curl, CURLOPT_HEADER, false);
			 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			 curl_setopt($curl, CURLOPT_HTTPHEADER,
					array("Content-type: application/json"));
			 curl_setopt($curl, CURLOPT_POST, true);
			 curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

			 $json_response = curl_exec($curl);
			 $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	    	 /* echo "<pre>";
		      print_r(json_decode($status));
		    */

			 if ( $status != 200 ) {
				die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
			 }
			 curl_close($curl);
			 $response = json_decode($json_response, true);
			 //dd($response);

			 if($response['status']==true){

				header("Location: ".$response["result"]["payment_url"]);
				die();

			 }else{
                return redirect('add-funds');
			 }
     }


	public function transaction_status_check(Request $request){


			$order_id = $request->order_id;
			$txn_id = $order_id;

		    $payment_details = Payment::where('order_id', $order_id)->first();

		    if($payment_details->status == 'PAID'){
			    	// Alert::success(' !!', '');
					return redirect('/add-funds');
			}

			$upi_api_details = PaymentSetting::where('name','UPI API')->first();
			$key = $upi_api_details->parameter_one;

			 $content = json_encode(array(
				"token"=> $key,
				"orderId"=> $order_id,
			 ));


			$url = "https://upiapi.in/order/status";

			 $curl = curl_init($url);
			 curl_setopt($curl, CURLOPT_HEADER, false);
			 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			 curl_setopt($curl, CURLOPT_HTTPHEADER,
					array("Content-type: application/json"));
			 curl_setopt($curl, CURLOPT_POST, true);
			 curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
			 $json_response = curl_exec($curl);

		//print_r($json_response); die();
			 $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			 if ( $status != 200 ) {
				// You can handle Error yourself.
				die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
			 }
			 curl_close($curl);
			 $response = json_decode($json_response, true);


			if($response['message']=="Record not found"){

					Payment::where('order_id', $order_id)
						   ->update([
							   'order_token' => $txn_id,
							   'status' => 'FAILED'
							]);


				return redirect('/add-funds');

			}else{
				if($response['result']['txnStatus'] == "COMPLETED"){

					Payment::where('order_id', $order_id)
						   ->update([
							   'order_token' => $txn_id,
							   'status' => 'PAID'
							]);


			            $user_data = User::where('id', $payment_details->user_id)->first();
						$total_deposite_cash = $user_data->total_deposite_cash;
						$wallet = $user_data->wallet;
						$new_amount = $payment_details->amount;
						$user_id = $payment_details->user_id;

					 $user  = User::where('id', $user_id)->first();
					 $user->wallet  = $wallet + $new_amount;
					 $user->total_deposite_cash  = $total_deposite_cash+$new_amount;
					 $user->save();


					 $Trans_hist = new TransactionHistory;
					 $Trans_hist->user_id = $user_id;
					 $Trans_hist->payment_id = $payment_details->id;
					 $Trans_hist->order_id = $order_id;
					 $Trans_hist->day = date('d');
					 $Trans_hist->month = date('M');
					 $Trans_hist->year = date('Y');
					 $Trans_hist->paying_time = date('h:i A');
					 $Trans_hist->amount = $new_amount;
					 $Trans_hist->add_or_withdraw = 'add';
					 $Trans_hist->closing_balance = $wallet+$new_amount;
					 $Trans_hist->save();

					Alert::success('Transaction Successfull !!', '');
					 return redirect('/add-funds');

					 }else{
						Payment::where('order_id', $order_id)
							   ->update([
								   'status' => 'FAILED'
								]);
						Alert::error('Payment Canceled!!', '');
						 return redirect('/add-funds');
					}
			}
	}
}
