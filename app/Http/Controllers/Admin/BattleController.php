<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Battle;
use App\Comission;
use App\BattleHistory;
use App\Permission;
use App\RefferalHistory;
use App\TransactionHistory;
use App\Game;
use Auth;
use View;
use Alert;
class BattleController extends Controller
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
    public function new_battle()
    {
	   $battles  = Battle::where('game_status','1')->orderBy('id', 'DESC')->get();
        return view('admin.battles.battle_new', compact('battles'));
    }

   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function new_battle_table()
    {
        $battles  = Battle::where('game_status','1')->orderBy('id', 'DESC')->get();
		
    	return view('admin.battles.battle_new_table', compact('battles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function running_battle()
    {
		
		$battles  = Battle::where('game_status','2')->where('is_running','yes')->orderBy('id', 'DESC')->get();
        return view('admin.battles.battle_running', compact('battles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function running_battle_table()
    {
        $battles  = Battle::where('game_status','2')->where('is_running','yes')->orderBy('id', 'DESC')->get();
		
    	return view('admin.battles.battle_running_table', compact('battles'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function battle_result()
    {
	   $battles  = Battle::where('game_status','3')->orderBy('id', 'DESC')->get();
       return view('admin.battles.battle_result', compact('battles'));
    }
	
	public function battle_result_table(){
    	return view('admin.battles.battle_running_table', compact('battles'));
    }
	
	public function battle_view($id){
		 $battle = Battle::where('id',$id)->first();
		$creator_details = User::where('id', $battle->creator_id)->first(); 
		$joiner_details = User::where('id', $battle->joiner_id)->first(); 
       return view('admin.battles.battle_view', compact('battle', 'creator_details', 'joiner_details'));
	}
	
	public function battle_pending($id){
		 $battle = Battle::where('id',$id)->first();
		$creator_details = User::where('id', $battle->creator_id)->first(); 
		$joiner_details = User::where('id', $battle->joiner_id)->first(); 
       return view('admin.battles.battle_pending', compact('battle', 'creator_details', 'joiner_details'));
	}

	public function update_result(Request $request, $id){
	   // dd("hell  ");
        $battle = Battle::where('id',$id)->first(); 
        $creator_details = User::where('id', $battle->creator_id)->first(); 
        $joiner_details = User::where('id', $battle->joiner_id)->first(); 
        $prize = $battle->prize;
		
		$winner = $request->winner;
		// commisstion
        $comissions = Comission::find(1);
        $battle_comission_with_referral= $comissions->battle_comission_with_referral;
        $battle_comission_without_referral= $comissions->battle_comission_without_referral;
        $refferal_comission= $comissions->refferal_comission;
        $battle_id = $battle->battle_id;
        $battle_details = Battle::where('battle_id',$battle_id)->first();
        $creator = User::where('id', $battle_details->creator_id)->first();
        $battle_uid =$battle_details->battle_id;

	    if($battle_details->approve == "approved"){
	       // dd('asdf');
           $battle_details->admin_update_again = 1;
           if($battle->creator_id == $winner){
                $joinerWallet = $joiner_details->wallet - $prize;
                $joinerWinningWallet =$joiner_details->wallet_winning_cash - $prize;
                $creatorWallet = $creator_details->wallet + $prize;
                $creatorWinningWallet = $creator_details->wallet_winning_cash + $prize;
                User::where('id', $battle_details->creator_id)->update([
                    'wallet' => $creatorWallet,
                    'wallet_winning_cash' => $creatorWinningWallet,
                ]);
                User::where('id', $battle->joiner_id)->update([
                    'wallet' => $joinerWallet,
                    'wallet_winning_cash' => $joinerWinningWallet,
                ]);
                return response()->json(['status'=>true, 'message'=>'Battle Updated Successfully.','url'=>'admin/battles-result']);
           }
           if($battle->joiner_id == $winner){
                //dd('joiner win');
                $creatorWallet = $creator_details->wallet - $prize;
                $creatorWinningWallet = $creator_details->wallet_winning_cash - $prize;
                $joinerWallet = $joiner_details->wallet + $prize;
                $joinerWinningWallet = $joiner_details->wallet_winning_cash + $prize;
                User::where('id', $battle_details->creator_id)->update([
                    'wallet' => $creatorWallet,
                    'wallet_winning_cash' => $creatorWinningWallet,
                ]);
                User::where('id', $battle->joiner_id)->update([
                    'wallet' => $joinerWallet,
                    'wallet_winning_cash' => $joinerWinningWallet,
                ]);
                return response()->json(['status'=>true, 'message'=>'Battle Updated Successfully.','url'=>'admin/battles-result']);
           }
	    }
	    else{
    		if($battle->creator_id == $winner){
    			
    			$battle = Battle::find($id);
    			$battle->creator_result = 'win';
    			$battle->joiner_result = 'lost';
    			$battle->winner_id = $winner;
    			$battle->loser_id = $battle->joiner_id;
    			$battle->is_running = 'no';
    			$battle->approve = 'approved';
    			$battle->is_admin_arroved = 1;
    			$battle->save();
    			
    			$user_g = User::where('id',$battle->creator_id)->first();
    			$old_wallet = $user_g->wallet;
    			$old_winning_cash = $user_g->wallet_winning_cash;
    			$old_game_win = $user_g->total_win;
    			
    			$creator_details = User::find($battle->creator_id); 
    			$creator_details->wallet = $old_wallet + $prize;
    			$creator_details->wallet_winning_cash = $old_winning_cash + $prize;
    			$creator_details->total_win = $old_game_win+1;
    			$creator_details->save();
    			
    				   //update lost in user table
    						 $joiner_details = User::find($battle->joiner_id);
    						 $old_lost = $joiner_details->total_lost;
    						 
    							 $joiner_details_u = User::find($battle->joiner_id);
    							 $joiner_details_u->total_lost = $old_lost+1;
    							 $joiner_details_u->save();
    			
    				  if($creator_details->reffered_by=='0'){
    								 $joining_amount = $battle_details->entry_fee;
    								 $admin_commision = $joining_amount * $battle_comission_without_referral / 100; 
    								 $admin_details = User::where('id',1)->first();
    								 $admin_old_wallet = $admin_details->wallet;
    								 $admin = User::find(1);
    								 $admin->wallet = $admin_old_wallet+$admin_commision;
    								 $admin->save();
    								 $battle_com_A = Battle::find($id);
            			             $battle_com_A->admin_commision = $admin_commision;
    				                 $battle_com_A->save();
    				  
    			      }else{
    			       
    				     $joining_amount = $battle->entry_fee;
    				  
    				     $comission = Comission::where('id','1')->first();
    				     $admin_comission = $comission->battle_comission_with_referral;
    				     $reffer_comission = $comission->refferal_comission;
    				  
    			         $admin_commision = ($joining_amount*2)-$prize-$reffer_comission;
    				     $admin_details = User::where('id',1)->first();
    				     $admin_old_wallet = $admin_details->wallet;
    				     $admin = User::find(1);
    				     $admin->wallet = $admin_old_wallet+$admin_commision;
    				     $admin->save();
    				  
    				     $reffer_user_comission = $joining_amount*$reffer_comission/100;
    				     $reffer_by = $creator_details->reffered_by;
    				     $refer_user = User::where('referral_code', $reffer_by)->first();
    				     $old_wallet_reffer = $refer_user->wallet_reffer;
    				  
    				     $reffer_user = User::find($refer_user->id);
    				     $reffer_user->wallet_reffer = $old_wallet_reffer+$reffer_user_comission;
    				     $reffer_user->save();
    				  
    				      //commision update in battle table
    					  $battle_com = Battle::find($id);
    					  $battle_com->admin_commision = $admin_commision;
    					  $battle_com->reffer_id = $refer_user->id;
    					  $battle_com->reffer_comission = $reffer_user_comission;
    					  $battle_com->save();
    					  
    					  //create Refferal history for refferal person
    					  $ref_history  = new RefferalHistory;
    				   	  $ref_history->user_id = $refer_user->id;
    					  $ref_history->battle_id = $battle_uid;
    					  $ref_history->by_user_id = $battle_details->creator_id;
    					  $ref_history->day = date('d');
    					  $ref_history->month = date('M');
    					  $ref_history->year = date('Y');
    					  $ref_history->refferal_id = time().rand(1,99);
    					  $ref_history->amount = $reffer_comission;
    					  $ref_history->remark = 'refferal added';
                          $ref_history->save();
    			  }
    			  $this->update_history_win($battle->battle_id, $winner, $battle->joiner_id, $battle->prize, $battle->entry_fee);
    		}
    		
    		if($battle->joiner_id == $winner){
    			$battle = Battle::find($id);
    			$battle->creator_result = 'lost';
    			$battle->joiner_result = 'win';
    			$battle->winner_id = $winner;
    			$battle->loser_id = $battle->creator_id;
    			$battle->is_running = 'no';
    			$battle->approve = 'approved';
    			$battle->is_admin_arroved = 1;
    			$battle->save();
    			
    			$user_j = User::where('id',$battle->joiner_id)->first();
    			$old_wallet = $user_j->wallet;
    			$old_winning_cash = $user_j->wallet_winning_cash;
    			$old_game_win = $user_j->total_win;
    			
    			$joiner_details = User::find($battle->joiner_id);
    			$joiner_details->wallet = $old_wallet+$prize;
    			$joiner_details->wallet_winning_cash = $old_winning_cash + $prize;
    			$joiner_details->total_win = $old_game_win+1;
    			$joiner_details->save();
    			
    			 //update lost in user table creator
    						 $creator_details = User::find($battle->creator_id);
    						 $old_lost = $creator_details->total_lost;
    						 
    							 $creator_details_u = User::find($battle->creator_id);
    							 $creator_details_u->total_lost = $old_lost+1;
    							 $creator_details_u->save();
    						
    			 if($joiner_details->reffered_by=='0'){
    			     $joining_amount = $battle_details->entry_fee;
    								 $admin_commision = $joining_amount * $battle_comission_without_referral / 100; 
    								 $admin_details = User::where('id',1)->first();
    								 $admin_old_wallet = $admin_details->wallet;
    								 $admin = User::find(1);
    								 $admin->wallet = $admin_old_wallet+$admin_commision;
    								 $admin->save();
    								 $battle_com_A = Battle::find($id);
            			             $battle_com_A->admin_commision = $admin_commision;
    				                 $battle_com_A->save();
    			     
    				//      $joining_amount = $battle->entry_fee;
    				  
    				//      $comission = Comission::where('id','1')->first();
    				//      $admin_comission = $comission->battle_comission_without_referral;
    				  
    			 //        $admin_commision = ($joining_amount*2)*$admin_comission/100;
    				//      $admin_details = User::where('id',1)->first();
    				//      $admin_old_wallet = $admin_details->wallet;
    				//      $admin = User::find(1);
    				//      $admin->wallet = $admin_old_wallet+$admin_commision;
    				//      $admin->save();
    				  
    				//       //commision update in battle table
    				// 	  $battle_com_A = Battle::find($id);
    				// 	  $battle_com_A->admin_commision = $admin_commision;
    				// 	  $battle_com_A->save();
    				  
    				  
    			  }else{
    			      $joining_amount = $battle->entry_fee;
    				  
    				     $comission = Comission::where('id','1')->first();
    				     $admin_comission = $comission->battle_comission_with_referral;
    				     $reffer_comission = $comission->refferal_comission;
    				  
    			         $admin_commision = ($joining_amount*2)-$prize-$reffer_comission;
    				     $admin_details = User::where('id',1)->first();
    				     $admin_old_wallet = $admin_details->wallet;
    				     $admin = User::find(1);
    				     $admin->wallet = $admin_old_wallet+$admin_commision;
    				     $admin->save();
    				  
    				     $reffer_user_comission = $joining_amount*$reffer_comission/100;
    				     $reffer_by = $joiner_details->reffered_by;
    				     $refer_user = User::where('referral_code', $reffer_by)->first();
    				     $old_wallet_reffer = $refer_user->wallet_reffer;
    				  
    				     $reffer_user = User::find($refer_user->id);
    				     $reffer_user->wallet_reffer = $old_wallet_reffer+$reffer_user_comission;
    				     $reffer_user->save();
    				  
    				      //commision update in battle table
    					  $battle_com = Battle::find($id);
    					  $battle_com->admin_commision = $admin_commision;
    					  $battle_com->reffer_id = $refer_user->id;
    					  $battle_com->reffer_comission = $reffer_user_comission;
    					  $battle_com->save();
    				  
    				  	  //create Refferal history for refferal person
    							  $ref_history  = new RefferalHistory;
    						   	  $ref_history->user_id = $refer_user->id;
    							  $ref_history->battle_id = $battle_uid;
    							  $ref_history->by_user_id = $battle_details->joiner_id;
    							  $ref_history->day = date('d');
    							  $ref_history->month = date('M');
    							  $ref_history->year = date('Y');
    							  $ref_history->refferal_id = time().rand(1,99);
    							  $ref_history->amount = $reffer_comission;
    							  $ref_history->remark = 'refferal added';
                                  $ref_history->save();
    				     
    			  }
    			       
    			
    			  $this->update_history_win($battle->battle_id,  $winner, $battle->creator_id, $battle->prize, $battle->entry_fee);	 
    			 
    		}
	    }
		
		// return redirect('admin/battles-result')->with('success','Battle Updated Successfully.');
		return response()->json(['status'=>true, 'message'=>'Battle Updated Successfully.','url'=>'admin/battles-result']);
	}
	
	
	public function cancel_battle($id){
		
		    $battle = Battle::find($id);
			$battle->creator_result = 'cancel';
			$battle->joiner_result = 'cancel';
			$battle->is_running = 'no';
			$battle->approve = 'approved';
			$battle->save();
	$battle_details = Battle::where('id',$id)->first();
	$battle_id = $battle->battle_id;
	    $entry_fee = $battle_details->entry_fee;
	     if($battle_details->joiner_result == 'cancel'){
						 $battle = Battle::find($battle_id);
					     $entry_fee = $battle_details->entry_fee;
					     
					     $creator = User::where('id', $battle_details->creator_id)->first();
					     $old_total_deposite_cash_creator = $creator->total_deposite_cash;
					     $old_wallet_creator = $creator->wallet;
					     $old_wallet_winning_cash_creater = $creator->wallet_winning_cash;
                         $holded_deposite_cash_creator = $creator->holded_deposite_cash;
					     $holded_winning_cash_creator = $creator->holded_winning_cash;
					     
					     $joiner = User::where('id',$battle_details->joiner_id)->first();
					     $old_total_deposite_cash_joiner = $joiner->total_deposite_cash;
					     $old_wallet_joiner = $joiner->wallet;
					     $old_wallet_winning_cash_joiner = $joiner->wallet_winning_cash;
					     $holded_deposite_cash_joiner = $joiner->holded_deposite_cash;
					     $holded_winning_cash_joiner = $joiner->holded_winning_cash;
					     
					     
						 //creator money back
						 if ($entry_fee < $old_total_deposite_cash_creator ){
				 		$user_creator = User::find($battle_details->creator_id);
				        $user_creator->wallet = $old_wallet_creator+$entry_fee;
						$user_creator->total_deposite_cash =$holded_deposite_cash_creator;
						$user_creator->wallet_winning_cash =$holded_winning_cash_creator+$old_wallet_winning_cash_creater;
						$user_creator->holded_deposite_cash	 =0;
						$user_creator->holded_winning_cash =0;
						} 
                        else
                        {
                        $user_creator = User::find($battle_details->creator_id);
                        $user_creator->wallet = $old_wallet_creator+$entry_fee;
		                $user_creator->total_deposite_cash = $holded_deposite_cash_creator ; 
		                $user_creator->wallet_winning_cash = $holded_winning_cash_creator ; 
		                $user_creator->holded_deposite_cash = 0 ; 
		                $user_creator->holded_winning_cash = 0 ; 
						
			        	}
						$user_creator->save();
	     }
						
						
						
						 //joiner money back
						  $joiner = User::where('id',$battle_details->joiner_id)->first();
					     $old_total_deposite_cash_joiner = $joiner->total_deposite_cash;
					     $old_wallet_joiner = $joiner->wallet;
					     $old_wallet_winning_cash_joiner = $joiner->wallet_winning_cash;
					     $holded_deposite_cash_joiner = $joiner->holded_deposite_cash;
					     $holded_winning_cash_joiner = $joiner->holded_winning_cash;
						if ($entry_fee < $old_total_deposite_cash_joiner ){
						    
						$user_joiner = User::find($battle_details->joiner_id);
						$user_joiner->wallet = $old_wallet_joiner+$entry_fee;
						$user_joiner->total_deposite_cash =$holded_deposite_cash_joiner;
						$user_joiner->wallet_winning_cash =$holded_winning_cash_joiner+ $old_wallet_winning_cash_joiner;
						$user_joiner->holded_deposite_cash	 =0;
						$user_joiner->holded_winning_cash =0;
						} 
                        else
                        {
                        $user_joiner = User::find($battle_details->joiner_id);
                        $user_joiner->wallet = $old_wallet_joiner+$entry_fee;
		                $user_joiner->total_deposite_cash = $holded_deposite_cash_joiner ; 
		                $user_joiner->wallet_winning_cash = $holded_winning_cash_joiner ; 
		                $user_joiner->holded_deposite_cash = 0 ; 
		                $user_joiner->holded_winning_cash = 0 ; 
						
			        	}
						
				
						$user_joiner->save();
						
		    $battle_details = Battle::where('id',$id)->first();
		    $entry_fee = $battle_details->entry_fee;
		    $creator_id = $battle_details->creator_id;
		    $joiner_id = $battle_details->joiner_id;
		
		    //for creator
						$battle_his = new BattleHistory;
						$battle_his->user_id = $creator_id;
						$battle_his->battle_id = $battle_id;
						$battle_his->day = date('d');
						$battle_his->month = date('M');
						$battle_his->year = date('Y');
						$battle_his->paying_time = date('h:i A');
						$battle_his->match_result = 'cancel';
						$battle_his->another_player_id = $joiner_id;
						$battle_his->winning_amount = $entry_fee;
						$battle_his->lossing_amount = $entry_fee;
						$battle_his->closing_balance = $user_creator->wallet;
						$battle_his->remark = 'Cancelled by Admin';
						$battle_his->save();
						 
						  //for joiner
						$battle_his = new BattleHistory;
						$battle_his->user_id = $joiner_id;
						$battle_his->battle_id = $battle_id;
						$battle_his->day = date('d');
						$battle_his->month = date('M');
						$battle_his->year = date('Y');
						$battle_his->paying_time = date('h:i A');
						$battle_his->match_result = 'cancel';
						$battle_his->another_player_id = $creator_id;
						$battle_his->winning_amount = $entry_fee;
						$battle_his->lossing_amount = $entry_fee;
						$battle_his->closing_balance =  $user_joiner->wallet;
					    $battle_his->remark = 'Cancelled by Admin';
						$battle_his->save();
		
			 
						 //transaction history for creator
						$tran_receiver  = new TransactionHistory;
						$tran_receiver->user_id = $creator_id;
						$tran_receiver->order_id = $battle_id;
						$tran_receiver->day = date('d');
						$tran_receiver->month = date('M');
						$tran_receiver->year = date('Y');
						$tran_receiver->paying_time =  date('h:i A');
						$tran_receiver->amount =  $entry_fee;
						$tran_receiver->add_or_withdraw =  'cancel';
						$tran_receiver->closing_balance = $user_creator->wallet;
						$tran_receiver->withdraw_status =  'received';
						$tran_receiver->where_to_show =  "admin";
						$tran_receiver->save();
		
					//transaction history for joiner
						$tran_receiver  = new TransactionHistory;
						$tran_receiver->user_id = $joiner_id;
						$tran_receiver->order_id = $battle_id;
						$tran_receiver->day = date('d');
						$tran_receiver->month = date('M');
						$tran_receiver->year = date('Y');
						$tran_receiver->paying_time =  date('h:i A');
						$tran_receiver->amount =  $entry_fee;
						$tran_receiver->add_or_withdraw =  'cancel';
						$tran_receiver->closing_balance = $user_joiner->wallet;
						$tran_receiver->withdraw_status =  'received';
						$tran_receiver->where_to_show =  "admin";
						$tran_receiver->save();
		    
			// return redirect('admin/battles-result')->with('success','Battle Updated Successfully.');
						return response()->json(['status'=>true, 'message'=>'Battle Updated Successfully.','url'=>'admin/battles-result']);
		
	}
	
	
	public function update_history_win($battle_id, $winner_id, $loser_id, $prize, $joining_amount){
		
		$battle_details = Battle::where('battle_id',$battle_id)->first();
		$loser_details = User::where('id',$loser_id)->first();
		$winner_details = User::where('id',$winner_id)->first();
		
		//for winner
        $battle_his = new BattleHistory;
        $battle_his->user_id = $winner_id;
        $battle_his->battle_id = $battle_id;
        $battle_his->day = date('d');
        $battle_his->month = date('M');
        $battle_his->year = date('Y');
        $battle_his->paying_time = date('h:i A');
        $battle_his->match_result = 'win';
        $battle_his->another_player_id = $loser_id;
        $battle_his->winning_amount = $prize;
        $battle_his->lossing_amount = $battle_details->entry_fee;
        $battle_his->closing_balance = $winner_details->wallet;
        $battle_his->remark = 'Approved by Admin';
        $battle_his->save();
        
        //for loser	 
        $battle_his = new BattleHistory;
        $battle_his->user_id = $loser_id;
        $battle_his->battle_id = $battle_id;
        $battle_his->day = date('d');
        $battle_his->month = date('M');
        $battle_his->year = date('Y');
        $battle_his->paying_time = date('h:i A');
        $battle_his->match_result = 'lost';
        $battle_his->another_player_id = $winner_id;
        $battle_his->winning_amount = 0;
        $battle_his->lossing_amount = $battle_details->entry_fee;
        $battle_his->closing_balance = $loser_details->wallet;
        $battle_his->remark = 'Approved by Admin';
        $battle_his->save();
        
        //transaction history for winner
        $tran_receiver  = new TransactionHistory;
        $tran_receiver->user_id = $winner_id;
        $tran_receiver->order_id = $battle_id;
        $tran_receiver->day = date('d');
        $tran_receiver->month = date('M');
        $tran_receiver->year = date('Y');
        $tran_receiver->paying_time =  date('h:i A');
        $tran_receiver->amount = $prize;
        $tran_receiver->add_or_withdraw =  'add';
        $tran_receiver->closing_balance =  $winner_details->wallet;
        $tran_receiver->withdraw_status =  'received';
        $tran_receiver->where_to_show =  "admin";
        $tran_receiver->save();
        
        //transaction history for loser
        $tran_receiver  = new TransactionHistory;
        $tran_receiver->user_id = $loser_id;
        $tran_receiver->order_id = $battle_id;
        $tran_receiver->day = date('d');
        $tran_receiver->month = date('M');
        $tran_receiver->year = date('Y');
        $tran_receiver->paying_time =  date('h:i A');
        $tran_receiver->amount =  $battle_details->entry_fee;
        $tran_receiver->add_or_withdraw =  'withdraw';
        $tran_receiver->closing_balance =  $loser_details->wallet;
        $tran_receiver->withdraw_status =  'sent';
        $tran_receiver->where_to_show =  "admin";
        $tran_receiver->save();
			 
	}
	
}
