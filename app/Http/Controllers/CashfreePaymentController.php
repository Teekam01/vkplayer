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

class CashfreePaymentController extends Controller
{
     public function create(Request $request)
     {
          return view('payment-create');
     }

     public function store(Request $request)
     {

		$cashfree_details = PaymentSetting::where('name','Cashfree')->first();

		$order_id ='order_'.rand(1111111111,9999999999);
		$vplay_id = $request->vplay_id;
		$user_id = Auth::user()->id;
		$mobile = $request->mobile;
		$amount = $request->amount;

		 $payment  = new Payment;
		 $payment->order_id  = $order_id;
		 $payment->vplay_id  = $vplay_id;
		 $payment->user_id  = $user_id;
		 $payment->mobile  = $mobile;
		 $payment->amount  = $amount;
		 $payment->status  = 'ACTIVE';
		 $payment->save();
	   	 $payment_id = $payment->id;


          $url = "https://sandbox.cashfree.com/pg/orders";

          $headers = array(
               "Content-Type: application/json",
               "x-api-version: 2022-01-01",
               "x-client-id: ".$cashfree_details->parameter_one,
               "x-client-secret: ".$cashfree_details->parameter_two
          );

          $data = json_encode([
               'order_id' =>  $order_id,
               'order_amount' => $request->amount,
               "order_currency" => "INR",
               "customer_details" => [
                    "customer_id" => str_replace(' ', '', $request->vplay_id).'_'.rand(11,99),
                    "customer_phone" => $request->mobile,
               ],
               "order_meta" => [
                    "return_url" => 'https://vkludopalyer.com/cashfree/payments/success/?order_id={order_id}&order_token={order_token}&order_status={order_status}'
               ]
          ]);

          $curl = curl_init($url);

          curl_setopt($curl, CURLOPT_URL, $url);
          curl_setopt($curl, CURLOPT_POST, true);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
          curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

          $resp = curl_exec($curl);

		 /*print_r($resp);*/
          curl_close($curl);

          return redirect()->to(json_decode($resp)->payment_link);
     }

     public function success(Request $request)
     {

		 $cashfree_details = PaymentSetting::where('name','Cashfree')->first();
		 $order_id = $request->order_id;

		  $payment  = Payment::where('order_id', $order_id)->first();
		  	if($payment->status == 'PAID'){
			    	// Alert::success(' !!', '');
					return redirect('/add-funds');
			}


		 $curl = curl_init();
		 $url = "https://sandbox.cashfree.com/pg/orders/".$order_id;

		 $headers = array(
               "Content-Type: application/json",
               "x-api-version: 2022-01-01",
               "x-client-id: ".$cashfree_details->parameter_one,
               "x-client-secret: ".$cashfree_details->parameter_two
          );

		  curl_setopt($curl, CURLOPT_URL, $url);
          curl_setopt($curl, CURLOPT_POST, false);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);



          $resp = curl_exec($curl);

		 $order_status = json_decode($resp)->order_status;

		 $payment  = Payment::where('order_id', $order_id)->first();
		 $payment->order_token  = $request->order_token;
		 $payment->status  = $order_status;
		 $payment->save();

		 if($order_status == 'PAID'){
			 $user_id  = $payment->user_id;
			 $new_amount  = $payment->amount;

			 $user_data = User::where('id', $user_id)->first();
			 $total_deposite_cash = $user_data->total_deposite_cash;
			 $wallet = $user_data->wallet;
			 $total_deposite_cash = $user_data->total_deposite_cash;

			     $user  = User::where('id', $user_id)->first();
				 $user->wallet  = $wallet+$new_amount;
				 $user->total_deposite_cash  = $total_deposite_cash+$new_amount;
				 $user->save();


			 $Trans_hist = new TransactionHistory;
			 $Trans_hist->user_id = $user_id;
			 $Trans_hist->payment_id = $payment->id;
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
			  Alert::error('Error Occur!!', 'A Error occur during payment, please try again.');
			// return view('user.payment_failed');
			 return redirect('/add-funds');
		 }
     }
}
