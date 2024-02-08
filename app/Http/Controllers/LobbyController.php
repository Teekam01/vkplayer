<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Alert;
use App\User;
use App\Notification;
use App\Battle;
use App\Comission;
use App\BattleHistory;
use App\RefferalHistory;
use App\Game;
use App\AdminContactDetails;
use App\TransactionHistory;
use Illuminate\Support\Facades\Log;


class LobbyController extends Controller
{
	public function index($url)
	{
		$homePageNotice = AdminContactDetails::where('id', 1)->first();
		$game_detail = Game::where('url', $url)->first();
		if (!$game_detail) {
			return redirect('/');
		}
		$game_id = $game_detail->id;
		$customcode = $game_detail->customcode;

		$battle_created = Battle::where('game_status', 1)->where('is_running', 'no')->where('game_id', $game_id)->orderBy('id', 'DESC')->get();

		$battle_running = Battle::where('is_running', 'yes')->where('game_id', $game_id)->orderBy('id', 'DESC')->get();
		$getCommission = Comission::first();
		$commission = ($getCommission->battle_comission_with_referral);
		return view('user.battleground', compact('battle_created', 'battle_running', 'url', 'game_id', 'customcode', 'commission', 'homePageNotice'));
	}


	public function create(Request $request)
	{



		$game_url = $request->game_url;
		$game_details = Game::where('url', $game_url)->first();
		$userId = Auth::id();

		$battle = Battle::where(function ($query) use ($userId) {
			$query->where('creator_id', $userId)
				->orWhere('joiner_id', $userId);
		})
			->where('approve', '!=', 'approved')
			->get();

		if (!$battle->isEmpty()) {
			return response()->json(['status' => false, 'message' => 'You already created a Battle']);
		} else {




			//CHECK WALLET BALANCE
			$user_details = User::where('id', Auth::user()->id)->first();

			if (Auth::user()->wallet < $request->amount || Auth::user()->wallet == 0)
				return response()->json(['status' => false, 'title' => 'Insufficient Fund', 'message' => 'You have low balance in you wallet.']);
			// COMMISSION
			$comissions = Comission::find(1);
			$battle_comission_with_referral = $comissions->battle_comission_with_referral;
			$battle_comission_without_referral = $comissions->battle_comission_without_referral;
			$refferal_comission = $comissions->refferal_comission;
		}


		$token = '';
		$user_details = User::where('id', Auth::user()->id)->first();

		$old_wallet = $user_details->wallet;
		// 		dd($old_wallet);
		$old_wallet_winning_cash = $user_details->wallet_winning_cash;
		$old_total_deposite_cash = $user_details->total_deposite_cash;
		$holded_deposite_cash = $old_total_deposite_cash;

		// COMMISSION
		$comissions = Comission::find(1);
		$battle_comission_with_referral = $comissions->battle_comission_with_referral;
		$battle_comission_without_referral = $comissions->battle_comission_without_referral;
		$refferal_comission = $comissions->refferal_comission;




		if ($old_wallet < $request->amount || $old_wallet == 0) {
			return response()->json(['status' => false, 'title' => 'Insufficient Fund', 'message' => 'You have low balance in you wallet.']);
		} else {
			if (($request->amount < 50 || $request->amount >= 2000) && $game_details->id == 1)
				return response()->json(['status' => false, 'title' => 'Invalid Amount', 'message' => 'Amount should be greater than 50 and less then 2000.']);


			elseif ((($request->amount < 2000 || $request->amount >= 50000) && $game_details->id == 2))
				return response()->json(['status' => false, 'title' => 'Invalid Amount', 'message' => 'Amount should be greater than 2000 and less then 50000.']);

			else {
				//AMOUNT IS DIVISABLE OF 50 LIKE 50,100, 200, 500...
				if ($request->amount % 50)
					return response()->json(['status' => false, 'title' => 'Domination of 50', 'message' => 'Set battle domination of 50 like 50, 100, 150, 200 So on.... upto 2000']);
				else {
					$admin_commision = $request->amount * $battle_comission_with_referral / 100;
					$reffer_comission = $request->amount * $refferal_comission / 100;
					$prize = $request->amount + $request->amount - $admin_commision - $reffer_comission;

					//CREATE BATTLE
					$battle = new Battle;
					$battle->game_id = $game_details->id;
					$battle->battle_id = time() . rand(11, 99);
					$battle->LOBBY_ID = '';
					$battle->amount = $request->amount;
					$battle->creator_id = Auth::id();
					$battle->entry_fee = $request->amount;
					$battle->admin_commision = $admin_commision;
					$battle->reffer_comission = $reffer_comission;
					$battle->prize = $prize;
					$battle->game_status = 1;
					$battle->approve = '0';
					$battle->label = $request->label;
					$battle->difference = 0;
					if ($battle->save()) {
						$user = Auth::user();
						$amountToDeduct = $request->amount;

						// Determine the amount to be deducted from deposit and winning cash
						$deductFromDeposit = min($user->total_deposite_cash, $amountToDeduct);
						$deductFromWinning = $amountToDeduct - $deductFromDeposit;

						// Deduct the amounts from total balance and respective wallets
						$user->wallet -= $amountToDeduct;
						$user->total_deposite_cash -= $deductFromDeposit;


						// Add the deducted amounts to holded amounts
						$user->holded_deposite_cash += $deductFromDeposit;
						$user->holded_winning_cash += $deductFromWinning;

						$user->save();
					}
				}
			}
			return redirect('/lobby/' . $game_details->url);
		}
	}







	public function delete($id)
	{
		$battle_details = Battle::where('id', $id)->first();
		if (!$battle_details) {
			return redirect('/');
		}
		$battle_amount = $battle_details->amount;
		$battle_creator_id = $battle_details->creator_id;
		$difference = $battle_details->difference;
		$user_detailss = User::where('id', $battle_creator_id)->first();

		$user_detailss->wallet += $battle_amount;
		$user_detailss->total_deposite_cash += $user_detailss->holded_deposite_cash;
		// $user_detailss->wallet_winning_cash += $user_detailss->holded_winning_cash;
		$user_detailss->holded_deposite_cash = 0;
		$user_detailss->holded_winning_cash = 0;
		$user_detailss->save();
		Battle::where('id', $id)->delete();
		return redirect()->back();
	}

	public function send_request($id)
	{





		$check_battle = Battle::where('id', $id)->where('request_status', 2)->first();
		if ($check_battle) {
			// Alert::error('', 'this battle already started.');
			return redirect()->back();
		}
		$joiner_id = Auth::user()->id;

		$battle = Battle::where('creator_id', Auth::id())
			->where('approve', '!=', 'approved')
			->get();
		if (!$battle->isEmpty()) {
			return redirect()->back()->with('fail', 'You already created a Battle');
			return response()->json(['status' => false, 'message' => 'You already created a Battle']);
		}
		$battle_details = Battle::where('id', $id)->first();
		$entry_fee = $battle_details->entry_fee;

		$user_details = User::where('id', $joiner_id)->first();
		$old_total_deposite_cash = $user_details->total_deposite_cash;
		$holded_deposite_cash = $old_total_deposite_cash;
		$old_wallet_winning_cash = $user_details->wallet_winning_cash;

		if ($user_details->wallet < $entry_fee) {
			Alert::error('Insufficient Funds !!', 'Please Recharge Your Wallet. ');
			return redirect()->back();
		} else {
			// Calculate the amount to be deducted from deposit and winning cash
			$deductFromDeposit = min($user_details->total_deposite_cash, $entry_fee);
			$deductFromWinning = $entry_fee - $deductFromDeposit;

			// Deduct the amounts from the respective wallets
			$user_details->total_deposite_cash -= $deductFromDeposit;
			// $user_details->wallet_winning_cash -= $deductFromWinning;

			// Add the deducted amounts to the holded amounts
			$user_details->holded_deposite_cash += $deductFromDeposit;
			$user_details->holded_winning_cash += $deductFromWinning;

			// Reduce the total wallet balance by the entry fee
			$user_details->wallet -= $entry_fee;

			// Save the updated user details
			$user_details->save();
			//SAVE USER BID IN BATTLES
			$battle = Battle::find($id);
			$battle->joiner_id = $joiner_id;
			$battle->request_status = 2;
			$battle->send_request_time = date('Y-m-d H:i:s');
			$battle->save();

			return redirect()->back();
		}
	}

	public function cancel_request($id)
	{
		$joiner_id = Auth::user()->id;

		$battle = Battle::find($id);
		$battle->joiner_id = 0;
		$battle->request_status = 0;
		$battle->save();

		return redirect()->back();
	}


	public function reject_request($id)
	{
		$battle_details = Battle::where('id', $id)->where('request_status', '!=', '0')->first();
		$joiner = User::where('id', $battle_details->joiner_id)->first();

		//UPDATE BATTLE STATUS
		$battle = Battle::find($id);
		$battle->request_status = '0';
		$battle->save();
		$entry_fee = $battle_details->entry_fee;

		//UPDATE JOINER WALLET BALANCE
		$joiner->wallet += $entry_fee;
		$joiner->total_deposite_cash += $joiner->holded_deposite_cash;
		// $joiner->wallet_winning_cash += $joiner->holded_winning_cash;
		$joiner->holded_deposite_cash = 0;
		$joiner->holded_winning_cash = 0;

		$joiner->save();
	}



	public function start($id, Request $request)
	{

		$battle_details = Battle::where('id', $id)->first();
		$creator_id = Auth::user()->id;
		$joiner_id = $battle_details->joiner_id;

		$battle = Battle::find($id);
		$battle->request_status = 1;
		if ($request->has('roomcode')) {
			$battle->LOBBY_ID = $request->roomcode;
		}
		$battle->accept_request_time = date('Y-m-d H:i:s');;
		$battle->save();

		return redirect('view-battle/' . $battle_details->battle_id);
	}

	public function join_battle($id)
	{


		$battle_details = Battle::where('id', $id)->first();
		$creator_id = Auth::user()->id;
		$joiner_id = $battle_details->joiner_id;

		$battle = Battle::find($id);
		$battle->request_status = 2;
		$battle->request_status = 2;
		$battle->is_running = 'yes';
		$battle->save();

		return redirect('view-battle/' . $battle_details->battle_id);
	}

	public function view_battle($battle_id)
	{
		$battle_details = Battle::where('battle_id', $battle_id)->first();
		if (!$battle_details) {
			return redirect('/');
		}
		$creator_id = $battle_details->creator_id;
		$joiner_id = $battle_details->joiner_id;
		$creator_detail = User::where('id', $creator_id)->first();
		$joiner_detail =  User::where('id', $joiner_id)->first();

		return view('user.view_room_code', compact('creator_detail', 'joiner_detail', 'battle_details'));
	}

	public function battle_result($battle_id, Request $request)
	{

		$battle = Battle::find($battle_id);
		if ($battle->approve == 'approved') {
			Alert::error('Result Aready Declared', 'Your bet result declared please try next game.');
			return redirect()->route('home');
		}
		$battle->request_status = 0;
		$battle->game_status = 3;
		$battle->is_running = 'yes'; //edit yes
		$battle->save();

		// commisstion
		$comissions = Comission::find(1);
		$battle_comission_with_referral = $comissions->battle_comission_with_referral;
		$battle_comission_without_referral = $comissions->battle_comission_without_referral;
		$refferal_comission = $comissions->refferal_comission;

		//Game details
		$game_details  = Game::where('id', $battle->game_id)->first();



		$player_id = $request->player_id;
		$battle_result = $request->battleResult;
		$current_date_time = date('Y-m-d H:i:s');

		//check screenshot
		if ($request->hasFile('screenshot_image')) {
			$image = $request->file('screenshot_image');
			$image_name = time() . rand(11, 99) . '.' . $image->getClientOriginalExtension();
			$destinationPath = public_path('/images/screenshots/');
			$image->move($destinationPath, $image_name);
		} else {
			$image_name = 'n/a';
		}

		//update battle result for CREATOR
		Battle::where('id', $battle_id)->where('creator_id', $player_id)->update([
			"creator_result" => $battle_result,
			"creator_result_time" => $current_date_time,
			"creator_screenshot" => $image_name,
			"creator_cancel_reason" => $request->cancel_reason
		]);

		//update battle result for JOINER
		Battle::where('id', $battle_id)->where('joiner_id', $player_id)->update([
			"joiner_result" => $battle_result,
			"joiner_result_time" => $current_date_time,
			"joiner_screenshot" => $image_name,
			"joiner_cancel_reason" => $request->cancel_reason
		]);



		//Battle Details
		$battle_details = Battle::where('id', $battle_id)->first();
		$battle_uid = $battle_details->battle_id;




		//check result is updated or not
		if (strlen($battle_details->creator_result) > 0 && strlen($battle_details->joiner_result) > 0) {





			//CREATOR WIN  -   JOINER LOST/WIN/CANCEL
			if ($battle_details->creator_result == 'win') {
				//Update  creator winner details
				$battle = Battle::find($battle_id);
				$battle->winner_id = $battle_details->creator_id;
				$battle->save();



				if ($battle_details->joiner_result == 'lost') {
					//Update joiner loser details
					$battle = Battle::find($battle_id);
					$battle->loser_id = $battle_details->joiner_id;
					$battle->approve = "approved";
					$battle->save();

					//prize and entry fee of battle
					$prize = $battle_details->prize;
					$joining_amount = $battle_details->entry_fee;





					//creator old details
					$creator = User::where('id', $battle_details->creator_id)->first();
					$old_wallet = $creator->wallet;
					$old_wallet_winning_cash = $creator->wallet_winning_cash;
					$old_game_win = $creator->total_win;

					//update wining amount to creator
					$creator_details = User::find($battle_details->creator_id);
					$creator_details->wallet = $old_wallet + $prize;
					$creator_details->wallet_winning_cash = $old_wallet_winning_cash + $prize;
					$creator_details->total_win = $old_game_win + 1;
					$creator_details->holded_deposite_cash = 0;
					$creator_details->holded_winning_cash = 0;
					$creator_details->save();

					//update lost in user table
					$joiner_details = User::find($battle_details->joiner_id);
					$old_lost = $joiner_details->total_lost;

					$joiner_details_u = User::find($battle_details->joiner_id);
					$joiner_details_u->total_lost = $old_lost + 1;
					$joiner_details_u->holded_deposite_cash = 0;
					$joiner_details_u->holded_winning_cash = 0;
					$joiner_details_u->save();


					//update admin comission  & refferal person commision
					if ($creator->reffered_by == '0') {
						$joining_amount = $battle_details->entry_fee;
						//new commision start
						$admin_commision = $joining_amount * $battle_comission_without_referral / 100;
						//new commision end
						// update admin wallet for commission
						$admin_details = User::where('id', 1)->first();
						$admin_old_wallet = $admin_details->wallet;
						$admin = User::find(1);
						$admin->wallet = $admin_old_wallet + $admin_commision;
						$admin->save();
						//commision update in battle table
						$battle_com_A = Battle::find($battle_id);
						$battle_com_A->admin_commision = $admin_commision;
						$battle_com_A->save();
					} else {
						$joining_amount = $battle_details->entry_fee;
						//new commision start
						$admin_commision = $joining_amount * $battle_comission_with_referral / 100;
						$reffer_comission = $joining_amount * $refferal_comission / 100;
						//new commision end
						// update admin wallet for commission
						$admin_details = User::where('id', 1)->first();
						$admin_old_wallet = $admin_details->wallet;
						$admin = User::find(1);
						$admin->wallet = $admin_old_wallet + $admin_commision;
						$admin->save();
						// update refferal person wallet for commission
						$reffer_by = $creator->reffered_by;
						$refer_user = User::where('referral_code', $reffer_by)->first();
						$old_wallet_reffer = $refer_user->wallet_reffer;
						$reffer_user = User::find($refer_user->id);
						$reffer_user->wallet_reffer = $old_wallet_reffer + $reffer_comission;
						$reffer_user->save();
						//create Refferal history for refferal person
						$ref_history  = new RefferalHistory;
						$ref_history->user_id = $refer_user->id;
						$ref_history->battle_id = $battle_uid;
						$ref_history->by_user_id = $battle_details->creator_id;
						$ref_history->day = date('d');
						$ref_history->month = date('M');
						$ref_history->year = date('Y');
						$ref_history->refferal_id = time() . rand(1, 99);
						$ref_history->amount = $reffer_comission;
						$ref_history->remark = 'refferal added';
						$ref_history->save();
						//commision update in battle table
						$battle_com = Battle::find($battle_id);
						$battle_com->admin_commision = $admin_commision;
						$battle_com->reffer_id = $refer_user->id;
						$battle_com->reffer_comission = $reffer_comission;
						$battle_com->save();
					}
					//update battle is end
					$battle = Battle::find($battle_id);
					$battle->is_running = 'no';
					$battle->save();
					//set battle history
					$battle_id = $battle->battle_id;
					$winner_id = $battle_details->creator_id;
					$loser_id = $battle_details->joiner_id;
					$prize = $prize;
					$joining_amount = $battle->entry_fee;
					$this->update_history_win($battle_id, $winner_id, $loser_id, $prize, $joining_amount);

					// 		 Alert::success('', 'Thank You for Playing. ');
					// 		 return redirect('/lobby/'.$game_details->url);

					$notification = new Notification;
					$notification->title = "Battle Result Declared";
					$notification->text = "Battle won by $creator->vplay_id";
					$notification->user_id =  $creator->id;
					$notification->reason = "Battle Result Declared...";
					$notification->status = 0;
					$notification->save();

					return response()->json(['status' => true, 'message' => 'Thank You for Playing.', 'url' => '/lobby/' . $game_details->url]);
				}
				if ($battle_details->joiner_result == 'win') {
					$battle = Battle::find($battle_id);
					$battle->winner_id = 0;
					$battle->approve = "under_review";
					$battle->is_running = 'yes';
					$battle->save();

					$notification = new Notification;
					$notification->title = "Battle Result Under Review";
					$notification->text = "Battle id ($battle->battle_id) result is under reivew because creator and joiner both result is win";
					$notification->user_id =  $battle->battle_id;
					$notification->reason = "Battle Result Under Review...";
					$notification->status = 0;
					$notification->save();




					// Alert::error('', 'This Game is Under Review for wrong result submit, We will connect you soon. ');
					// return redirect('/lobby/'.$game_details->url);
					return response()->json(['status' => false, 'message' => 'This Game is Under Review for wrong result submit, We will connect you soon.', 'url' => '/lobby/' . $game_details->url]);
				}
				if ($battle_details->joiner_result == 'cancel') {
					$battle = Battle::find($battle_id);
					$battle->winner_id = 0;
					$battle->save();
					//Update baatle to under review details
					$battle_j = Battle::find($battle_id);
					$battle_j->approve = "under_review";
					$battle->save();

					//update battle is end
					$battle = Battle::find($battle_id);
					$battle->is_running = 'yes';
					$battle->save();

					//Alert::error('', 'This Game is Under Review for wrong result submit, We will connect you soon. ');
					//return redirect('/lobby/'.$game_details->url);
					return response()->json(['status' => false, 'message' => 'This Game is Under Review for wrong result submit, We will connect you soon.', 'url' => '/lobby/' . $game_details->url]);
				}
			}

			//CREATOR LOST  -   JOINER WIN/LOST/CANCEL
			if ($battle_details->creator_result == 'lost') {
				//Update  creator winner  details
				$battle = Battle::find($battle_id);
				$battle->winner_id = $battle_details->joiner_id;
				$battle->save();
				if ($battle_details->joiner_result == 'win') {
					//Update joiner loser details
					$battle = Battle::find($battle_id);
					$battle->loser_id = $battle_details->creator_id;
					$battle->approve = "approved";
					$battle->save();

					//prize and entry fee of battle
					$prize = $battle_details->prize;
					$joining_amount = $battle_details->entry_fee;

					//joiner old details
					$joiner = User::where('id', $battle_details->joiner_id)->first();
					$old_wallet = $joiner->wallet;
					$old_wallet_winning_cash = $joiner->wallet_winning_cash;
					$old_total_win = $joiner->total_win;

					//update wining amount to joiner
					$joiner_details = User::find($battle_details->joiner_id);
					$joiner_details->wallet = $old_wallet + $prize;
					$joiner_details->wallet_winning_cash = $old_wallet_winning_cash + $prize;
					$joiner_details->total_win = $old_total_win + 1;
					$joiner_details->save();

					//update lost in user table creator
					$creator_details = User::find($battle_details->creator_id);
					$old_lost = $creator_details->total_lost;

					$creator_details_u = User::find($battle_details->creator_id);
					$creator_details_u->total_lost = $old_lost + 1;
					$creator_details_u->save();




					//update admin comission  & refferal person commision
					if ($joiner->reffered_by == '0') {
						$joining_amount = $battle_details->entry_fee;
						// 	 if($joining_amount >= 50 && $joining_amount <= 250){
						// 	 //admin commisiion
						// 	$admin_commision = $joining_amount * 10 / 100;
						//  }elseif($joining_amount > 251 && $joining_amount <= 500){
						// 	  //admin commisiion
						// 	$admin_commision = 25;
						//  }elseif($joining_amount > 501){
						// 	 //admin commisiion
						// 	$admin_commision = $joining_amount * 5 / 100;
						//  }

						//new commision start
						$admin_commision = $joining_amount * $battle_comission_without_referral / 100;
						//new commision end
						// update admin wallet for commission
						$admin_details = User::where('id', 1)->first();
						$admin_old_wallet = $admin_details->wallet;
						$admin = User::find(1);
						$admin->wallet = $admin_old_wallet + $admin_commision;
						$admin->save();
						//commision update in battle table
						$battle_com_A = Battle::find($battle_id);
						$battle_com_A->admin_commision = $admin_commision;
						$battle_com_A->save();
					} else {
						$joining_amount = $battle_details->entry_fee;
						//new commision start
						$admin_commision = $joining_amount * $battle_comission_with_referral / 100;
						$reffer_comission = $joining_amount * $refferal_comission / 100;
						//new commision end
						// update admin wallet for commission
						$admin_details = User::where('id', 1)->first();
						$admin_old_wallet = $admin_details->wallet;
						$admin = User::find(1);
						$admin->wallet = $admin_old_wallet + $admin_commision;
						$admin->save();
						// update refferal person wallet for commission
						$reffer_by = $joiner->reffered_by;
						$refer_user = User::where('referral_code', $reffer_by)->first();
						$old_wallet_reffer = $refer_user->wallet_reffer;
						$reffer_user = User::find($refer_user->id);
						$reffer_user->wallet_reffer = $old_wallet_reffer + $reffer_comission;
						$reffer_user->save();
						//create Refferal history for refferal person
						$ref_history  = new RefferalHistory;
						$ref_history->user_id = $refer_user->id;
						$ref_history->battle_id = $battle_uid;
						$ref_history->by_user_id = $battle_details->joiner_id;
						$ref_history->day = date('d');
						$ref_history->month = date('M');
						$ref_history->year = date('Y');
						$ref_history->refferal_id = time() . rand(1, 99);
						$ref_history->amount = $reffer_comission;
						$ref_history->remark = 'refferal added';
						$ref_history->save();
						//commision update in battle table
						$battle_com = Battle::find($battle_id);
						$battle_com->admin_commision = $admin_commision;
						$battle_com->reffer_id = $refer_user->id;
						$battle_com->reffer_comission = $reffer_comission;
						$battle_com->save();
					}
					//update battle is end
					$battle = Battle::find($battle_id);
					$battle->is_running = 'no';
					$battle->save();
					//set battle history
					$battle_id = $battle->battle_id;
					$winner_id = $battle_details->joiner_id;
					$loser_id = $battle_details->creator_id;
					$prize = $prize;
					$joining_amount = $battle->entry_fee;
					$this->update_history_win($battle_id, $winner_id, $loser_id, $prize, $joining_amount);

					// 		 Alert::success('', 'Thank You for Playing. ');
					// 		 return redirect('/lobby/'.$game_details->url);
					return response()->json(['status' => true, 'message' => 'Thank You for Playing.', 'url' => '/lobby/' . $game_details->url]);
				}
				if ($battle_details->joiner_result == 'lost') {
					$battle = Battle::find($battle_id);
					$battle->winner_id = 0;
					$battle->approve = "under_review";
					$battle->is_running = 'yes';
					$battle->save();



					// Alert::error('', 'This Game is Under Review for wrong result submit, We will connect you soon. ');
					// return redirect('/lobby/'.$game_details->url);
					return response()->json(['status' => false, 'message' => 'This Game is Under Review for wrong result submit, We will connect you soon.', 'url' => '/lobby/' . $game_details->url]);
				}
				if ($battle_details->joiner_result == 'cancel') {
					$battle = Battle::find($battle_id);
					$battle->winner_id = 0;
					$battle->approve = "under_review";
					$battle->is_running = 'yes';
					$battle->save();



					//Alert::error('', 'This Game is Under Review for wrong result submit, We will connect you soon. ');
					//return redirect('/lobby/'.$game_details->url);
					return response()->json(['status' => false, 'message' => 'This Game is Under Review for wrong result submit, We will connect you soon.', 'url' => '/lobby/' . $game_details->url]);
				}
			}

			//CREATOR CANCEL  -   JOINER CANCEL/WIN/LOST
			if ($battle_details->creator_result == 'cancel') {

				if ($battle_details->joiner_result == 'cancel') {

					$battle = Battle::find($battle_id);
					$battle->approve = "approved";
					$battle->is_running = "no";
					$battle->save();

					$entry_fee = $battle_details->entry_fee;

					$creator = User::where('id', $battle_details->creator_id)->first();
					$creator->wallet = $creator->wallet + $entry_fee;
					$creator->wallet_winning_cash;
					$creator->total_deposite_cash += $creator->holded_deposite_cash;
					$creator->wallet_winning_cash += $creator->holded_winning_cash;
					$creator->holded_deposite_cash = 0;
					$creator->holded_winning_cash = 0;

					$creator->save();

					$joiner = User::where('id', $battle_details->joiner_id)->first();
					$joiner->wallet = $joiner->wallet + $entry_fee;
					$joiner->wallet_winning_cash;
					$joiner->total_deposite_cash += $joiner->holded_deposite_cash;
					$joiner->wallet_winning_cash += $joiner->holded_winning_cash;
					$joiner->holded_deposite_cash = 0;
					$joiner->holded_winning_cash = 0;
					$joiner->save();


					$battle = Battle::find($battle_id);
					$battle->is_running = 'no';
					$battle->save();

					//for creator
					$battle_his = new BattleHistory;
					$battle_his->user_id = $battle_details->creator_id;
					$battle_his->battle_id = $battle_uid;
					$battle_his->day = date('d');
					$battle_his->month = date('M');
					$battle_his->year = date('Y');
					$battle_his->paying_time = date('h:i A');
					$battle_his->match_result = 'cancel';
					$battle_his->another_player_id = $battle_details->joiner_id;
					$battle_his->winning_amount = $entry_fee;
					$battle_his->lossing_amount = $entry_fee;
					$battle_his->closing_balance = $creator->wallet;
					$battle_his->save();

					//for joiner
					$battle_his = new BattleHistory;
					$battle_his->user_id = $battle_details->joiner_id;
					$battle_his->battle_id = $battle_uid;
					$battle_his->day = date('d');
					$battle_his->month = date('M');
					$battle_his->year = date('Y');
					$battle_his->paying_time = date('h:i A');
					$battle_his->match_result = 'cancel';
					$battle_his->another_player_id = $battle_details->creator_id;
					$battle_his->winning_amount = $entry_fee;
					$battle_his->lossing_amount = $entry_fee;
					$battle_his->closing_balance = $joiner->wallet;
					$battle_his->save();

					//transaction history for creator
					$tran_receiver  = new TransactionHistory;
					$tran_receiver->user_id = $battle_details->creator_id;
					$tran_receiver->order_id = $battle_uid;
					$tran_receiver->day = date('d');
					$tran_receiver->month = date('M');
					$tran_receiver->year = date('Y');
					$tran_receiver->paying_time =  date('h:i A');
					$tran_receiver->amount =  $entry_fee;
					$tran_receiver->add_or_withdraw =  'cancel';
					$tran_receiver->closing_balance = $creator->wallet;
					$tran_receiver->withdraw_status =  'received';
					$tran_receiver->where_to_show =  "admin";
					$tran_receiver->check_add_amount_status = "failure";
					$tran_receiver->save();

					//transaction history for joiner
					$tran_receiver  = new TransactionHistory;
					$tran_receiver->user_id = $battle_details->joiner_id;
					$tran_receiver->order_id = $battle_uid;
					$tran_receiver->day = date('d');
					$tran_receiver->month = date('M');
					$tran_receiver->year = date('Y');
					$tran_receiver->paying_time =  date('h:i A');
					$tran_receiver->amount =  $entry_fee;
					$tran_receiver->add_or_withdraw =  'cancel';
					$tran_receiver->closing_balance =  $joiner->wallet;
					$tran_receiver->withdraw_status =  'received';
					$tran_receiver->where_to_show =  "admin";
					$tran_receiver->check_add_amount_status = "failure";
					$tran_receiver->save();


					$notification = new Notification;
					$notification->title = "table $battle_details->battle_id canceled";
					$notification->text = "table canceled by both user $joiner->vplay_id and $creator->vplay_id";
					$notification->user_id =  $creator->id;
					$notification->reason = "battle canceled";
					$notification->status = 0;
					$notification->save();


					return response()->json(['status' => true, 'message' => 'Thank You for Playing.', 'url' => '/lobby/' . $game_details->url]);
				}
				if ($battle_details->joiner_result == 'lost') {

					$battle = Battle::find($battle_id);
					$battle->winner_id = 0;
					$battle->approve = "under_review";
					$battle->is_running = 'yes';
					$battle->save();

					$notification = new Notification;
					$notification->title = "battle under reivew";
					$notification->text = "battle canceled by both user $creator->vplay_id and joiner submited: lost ";
					$notification->user_id =  $creator->id;
					$notification->reason = "battle canceled";
					$notification->status = 0;
					$notification->save();


					// Alert::error('', 'This Game is Under Review for wrong result submit, We will connect you soon. ');
					// return redirect('/lobby/'.$game_details->url);
					return response()->json(['status' => false, 'message' => 'This Game is Under Review for wrong result submit, We will connect you soon.', 'url' => '/lobby/' . $game_details->url]);
				}
				if ($battle_details->joiner_result == 'win') {
					$battle = Battle::find($battle_id);
					$battle->winner_id = 0;
					$battle->approve = "under_review";
					$battle->is_running = 'yes';
					$battle->save();


					$notification = new Notification;
					$notification->title = "battle under reivew";
					$notification->text = "battle canceled by both user $creator->vplay_id and joiner submited: win ";
					$notification->user_id =  $creator->id;
					$notification->reason = "battle canceled";
					$notification->status = 0;
					$notification->save();

					//Alert::error('', 'This Game is Under Review for wrong result submit, We will connect you soon. ');
					//return redirect('/lobby/'.$game_details->url);
					return response()->json(['status' => false, 'message' => 'This Game is Under Review for wrong result submit, We will connect you soon.', 'url' => '/lobby/' . $game_details->url]);
				}
			}
		} else {
			//  return response()->json(["status"=>false, 'message' => "in firsf"]);
			//Alert::success('', 'Thank You for Playing !!');
			//          return redirect('/lobby/'.$game_details->url);
			return response()->json(['status' => true, 'message' => 'Thank You for Playing !!.', 'url' => '/lobby/' . $game_details->url]);
		}
	}


	public function update_history_win($battle_id, $winner_id, $loser_id, $prize, $joining_amount)
	{

		$battle_details = Battle::where('battle_id', $battle_id)->first();
		$loser_details = User::where('id', $loser_id)->first();
		$winner_details = User::where('id', $winner_id)->first();

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


	public function battle_open($game_id)
	{
		$battle_created =  Battle::where('game_status', 1)->where('is_running', 'no')->where('game_id', $game_id)->orderBy('id', 'DESC')->get();
		return view('user.battle_open', compact('battle_created'));
	}

	public function battle_running($game_id)
	{
		$battle_running = Battle::where('is_running', 'yes')->where('game_id', $game_id)->orderBy('id', 'DESC')->get();
		return view('user.battle_running', compact('battle_running'));
	}
	public function updateRoomCode(Request $request)
	{
		Battle::where('battle_id', $request->battleid)->update([
			'LOBBY_ID' => $request->roomcode,
		]);
		return redirect()->back()->with('success', 'roomcode update successfully');
	}
}
