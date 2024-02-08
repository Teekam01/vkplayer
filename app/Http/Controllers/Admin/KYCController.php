<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use View;
use Auth;
use App\UserBankDetail;
use App\UserData;
use App\Permission;
use App\TransactionHistory;
use App\Notification;

class KYCController extends Controller
{
   public function __construct(){
        $this->middleware(function ($request, $next) {
            $permission = Permission::where('user_id', Auth::id())->first();
            View::share('permission', $permission);
            return $next($request);
        });
    }
    public function kyc_pending()
    {
		$pending = UserData::where('verify_status','0')->where('DOCUMENT_NAME','!=',null)->where('DOCUMENT_NUMBER','!=',null)->where('DOCUMENT_FIRST_NAME','!=',null)->where('DOCUMENT_LAST_NAME','!=',null)->where('DOCUMENT_DOB','!=',null)->where('DOCUMENT_STATE','!=',null)->where('DOCUMENT_FRONT_IMAGE','!=',null)->where('DOCUMENT_BACK_IMAGE','!=',null)->get();
		 return view('admin.kycs.pending',compact('pending'));
    }
	
	  public function kyc_view($id)
    {
		  $user_id = $id;
	      $user_kyc_details = UserData::where('user_id',$user_id)->first();
		  $user_details = User::where('id',$user_id)->first();
		  $user_bank_details = UserBankDetail::where('user_id',$user_id)->first();
		  return view('admin.kycs.kyc_view',compact('user_details','user_kyc_details','user_bank_details'));
    }

	public function kyc_approved()
    {
		$approved = UserData::where('verify_status','1')->get();
        return view('admin.kycs.approved',compact('approved'));
    }
	
	
	
	public function kyc_verify($id)
    {
		$userData = UserData::find($id);
		$userData->verify_status = '1';
		$userData->save();
		
		$notification  = new Notification;
		$notification->title = "KYC Verified Successfully";
		$notification->text = "Your submitted documents verified by our team.";
		$notification->user_id = $userData->user_id;
		$notification->save();
		
        // return redirect('/admin/kyc-pending');
        return response()->json(['status'=>true,'message'=>'User Kyc approved','url'=>'/admin/kyc-pending']);
    }
	
	public function kyc_rejected(Request $request)
    {
    	 // dd($request->all());
		$userData = UserData::find($request->rejected_id);
		$userData->DOCUMENT_NAME = null;
		$userData->DOCUMENT_NUMBER = null;
		$userData->DOCUMENT_FIRST_NAME = null;
		$userData->DOCUMENT_LAST_NAME = null;
		$userData->DOCUMENT_DOB = null;
		$userData->DOCUMENT_STATE = null;
		$userData->DOCUMENT_FRONT_IMAGE = null;
		$userData->DOCUMENT_BACK_IMAGE = null;
		$userData->verify_status = 0;
		$userData->save();
		
		$notification  = new Notification;
		$notification->title = "KYC Rejected.";
	    $notification->text = $request->reject_reason;
		$notification->user_id = $userData->user_id;
		$notification->reason = $request->reject_reason;
		$notification->save();
		
		
		
        // return redirect('/admin/kyc-pending');
        return response()->json(['status'=>true,'message'=>'User Kyc rejected','url'=>'/admin/kyc-pending']);
    }
	
	
	
  
}
