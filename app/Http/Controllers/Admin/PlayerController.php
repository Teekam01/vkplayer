<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Notification;
use Illuminate\Http\Request;
use App\User;
use App\UserBankDetail;
use App\UserData;
use App\TransactionHistory;
use App\Permission;
use Auth;
use View;
use App\Payment;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(){
        $this->middleware(function ($request, $next) {
            $permission = Permission::where('user_id', Auth::id())->first();
            View::share('permission', $permission);
            return $next($request);
        });
    }
    public function index(){
		$users  = User::where('user_type','2')->where('is_blocked','0')->orderBy('id', 'DESC')->get();
// 		$persission = Permission::where('user_id', Auth::id())->first();
// 		dd($users->toArray());
        return view('admin.players.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function recharge_wallet($user_id)
    {
		$user = User::where('id', $user_id)->first();	
		return view('admin.players.recharge_wallet', compact('user'));
    }

    public function penelty($user_id)
    {
		$user = User::where('id', $user_id)->first();	
		return view('admin.players.penelty', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function recharge_now(Request $request)
    {
        $id = $request->id;
        $wallet = $request->wallet;
        $user_id = $request->vplay_id;
        $mobile = $request->mobile;
        $amount = $request->amount;
        $old_total_deposite_cash = $request->total_deposite_cash;
        
		$order_id = 'order_'.rand(1111111111,9999999999);
		
		$user = User::find($id);
		$old_total_deposite_cash = $user->total_deposite_cash;
		$old_wallet =$user->wallet;
		
		
		$user = User::find($id);
	    
		$new_amount = $old_wallet+$amount;
		$new_total_deposite_cash = $old_total_deposite_cash+$amount;
		$user->wallet  = $new_amount;
		$user->total_deposite_cash  = $new_total_deposite_cash;
		
		$user->save();
		
		     $Trans_hist = new TransactionHistory;
			 $Trans_hist->user_id = $id;
			 $Trans_hist->payment_id = 0;
			 $Trans_hist->order_id = $order_id;
			 $Trans_hist->day = date('d');
		   	 $Trans_hist->month = date('M');
			 $Trans_hist->year = date('Y');
			 $Trans_hist->paying_time = date('h:i A');
			 $Trans_hist->amount = $amount;
			 $Trans_hist->add_or_withdraw = 'add';
			 $Trans_hist->closing_balance = $new_amount;
			 $Trans_hist->withdraw_status =  'received';
			 $Trans_hist->reason =  $request->reason;
			 $Trans_hist->remark = 'By Admin';
			 $Trans_hist->save();
			 
			 
			 $payment = new Payment;
    		 $payment->order_id = $order_id;
    		 $payment->vplay_id = $user_id;
    		 $payment->user_id = $user->id;
    		 $payment->mobile = $mobile;
    		 $payment->amount = $amount;
    		 $payment->status = 'PAID';
    		 $payment->upigateway_date = date('d-m-yy');
    		 $payment->save();
			 
			 if($request->reason && !empty($request->reason)){
                $notification  = new Notification();
                $notification->title = "Cash Added By Admin";
                $notification->text = $request->reason;
                $notification->user_id = $id;
                $notification->save();
            }
		
		// return redirect('admin/recharge-user');
            return response()->json(['status'=>true,'message'=>'Recharge successfully','url'=>'admin/recharge-user']);
		
    }


    public function charge_penelty(Request $request)
    {

     
        $id = $request->id;
        $wallet = $request->wallet;
        $user_id = $request->vplay_id;
        $mobile = $request->mobile;
        $amount = $request->amount;
		$order_id = 'order_'.rand(1111111111,9999999999);
		
		$user = User::find($id);
		$old_total_deposite_cash = $user->total_deposite_cash;
		$old_wallet_winning_cash = $user->wallet_winning_cash;
		$old_wallet =$user->wallet;
		$user = User::find($id);
			if($old_total_deposite_cash > $amount){
						    $new_total_deposite_cash = $old_total_deposite_cash - $amount ; 
						    $user->total_deposite_cash = $new_total_deposite_cash;

						}
						else { 
						    $new_total_deposite_cash = 0 ; 
						    $new_wallet_winning_cash = $old_wallet_winning_cash - ($amount - $old_total_deposite_cash) ; 
						   $user->total_deposite_cash = $new_total_deposite_cash;
						    $user->wallet_winning_cash = $new_wallet_winning_cash;
            
						}
						
	    $new_amount = $old_wallet-$amount;
		$user->wallet = $new_amount;
// 		$user->wallet_winning_cash = $new_wallet_winning_cash;
		$user->save();
		
		     $Trans_hist = new TransactionHistory;
			 $Trans_hist->user_id = $id;
			 $Trans_hist->payment_id = 0;
			 $Trans_hist->order_id = $order_id;
			 $Trans_hist->day = date('d');
		   	 $Trans_hist->month = date('M');
			 $Trans_hist->year = date('Y');
			 $Trans_hist->paying_time = date('h:i A');
			 $Trans_hist->amount = $amount;
			 $Trans_hist->add_or_withdraw = 'withdraw';

			 $Trans_hist->withdraw_status = 'penelty';
			 $Trans_hist->closing_balance = $new_amount;
			 $Trans_hist->remark = 'Penalty';
			  $Trans_hist->reason =  $request->reason;
			 $Trans_hist->save();
			 
			  if($request->reason && !empty($request->reason)){
                $notification  = new Notification();
                $notification->title = "Penalty";
                $notification->text = $request->reason;
                $notification->user_id = $id;
                $notification->save();
            }
		
		// return redirect('admin/recharge-user');
            return response()->json(['status'=>true,'message'=>'Penalty user','url'=>'admin/recharge-user']);
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function player_view($id)
    {
       $user_details  = User::where('id',$id)->first();
       $user_bank_details  = UserBankDetail::where('user_id',$id)->first();
       $user_kyc_details  = UserData::where('user_id',$user_details->id)->first();
       
	   return view('admin.players.player_view ', compact('user_details', 'user_bank_details', 'user_kyc_details'));
    }
    public function playerUpdateWallet(Request $request){
        // dd($request->user_id);
        if($request->wallet)
            $updateValue = User::where('id', $request->user_id)->update([
                'wallet' => $request->wallet,
                'holded_deposite_cash' => $request->wallet,
            ]);
        else
            $updateValue = User::where('id', $request->user_id)->update([
                'wallet_winning_cash' => $request->wallet_winning_cash,
                'holded_winning_cash' => $request->wallet_winning_cash,
            ]);
        if($updateValue)
            return response()->json(['message' => 'Updated successfully.'], 200);
            
        else
            return response()->json(['message' => 'not update.'], 400);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function block_user($id)
    {
        $user = User::find($id);
		$user->is_blocked = '1';
		$user->save();	
		
		User::where('id', $id)
            ->update(['logout' => true]);
		
		return redirect('admin/players');
    } 
	
	public function unblock_user($id)
    {
        $user = User::find($id);
		$user->is_blocked = '0';
		$user->save();	
		
		return redirect('admin/players-blocked');
    }
	
	  public function block_players_list()
    {
        $blocked_users  = User::where('id','!=','1')->where('is_blocked','1')->orderBy('id', 'DESC')->get();
        return view('admin.players.block_players_list',compact('blocked_users'));
    }
}
