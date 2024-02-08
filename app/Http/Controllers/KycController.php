<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Alert;
use App\User;
use App\UserData;
use Illuminate\Support\Facades\Http;

class KycController extends Controller
{
	 
 /*  public function index(Request $request){
	    
		  
	  $user_id = Auth::user()->id;
	  $vplay_id = Auth::user()->vplay_id;
	  $user_details = User::where('id', $user_id)->first();
	  $user_data_count = UserData::where('user_id', $user_id)->count();
	  $user_data_details = UserData::where('user_id', $user_id)->first();
	  
	   
		  		if($user_data_count>0){
				
					if(isset($request->next1)){ 
						
						
						 $DOCUMENT_NAME = $request->DOCUMENT_NAME;
						if(strlen($request->DOCUMENT_NUMBER_UID)>0){
							$NUMBER = $request->DOCUMENT_NUMBER_UID;
						}
						if(strlen($request->DOCUMENT_NUMBER_DL)>0){
							$NUMBER = $request->DOCUMENT_NUMBER_DL;
						}
						if(strlen($request->DOCUMENT_NUMBER_VID)>0){
							$NUMBER = $request->DOCUMENT_NUMBER_VID;
						}
						
		                 $DOCUMENT_NUMBER = $NUMBER;
						
						UserData::where('user_id', $user_id)->where('vplay_id', $vplay_id)
								   ->update([
									   'DOCUMENT_NAME' => $DOCUMENT_NAME,
									   'DOCUMENT_NUMBER' => $DOCUMENT_NUMBER
									]);
						return redirect('/complete-kyc');
					}
					
					
					if(isset($request->next2)){
						 $firstName = $request->firstName;
						 $lastName = $request->lastName;
						 $dob = $request->dob;
						 $state = $request->state;
					   
						UserData::where('user_id', $user_id)->where('vplay_id', $vplay_id)
								   ->update([
									   'DOCUMENT_FIRST_NAME' => $firstName,
									   'DOCUMENT_LAST_NAME' => $lastName,
									   'DOCUMENT_DOB' => $dob,
									   'DOCUMENT_STATE' => $state,
									   ]);
						return redirect('/complete-kyc');
					}
					
					if(isset($request->complete)){
						 $firstName = $request->firstName;
						 $lastName = $request->lastName;
						
						if ($request->hasFile('frontPic')) {
						  $frontPic = $request->file('frontPic');
						  $frontPic_name = time().'frontpic.'.$frontPic->getClientOriginalExtension();
                          $destinationPath = public_path('/images/kycdata/'.$user_id.'/');
                          $frontPic->move($destinationPath, $frontPic_name);
						}
						if ($request->hasFile('backPic')) {
						  $backPic = $request->file('backPic');
						  $backPic_name = time().'backPic.'.$backPic->getClientOriginalExtension();
                          $destinationPath = public_path('/images/kycdata/'.$user_id.'/');
                          $backPic->move($destinationPath, $backPic_name);
						}
						
						UserData::where('user_id', $user_id)->where('vplay_id', $vplay_id)
								   ->update([
									   'DOCUMENT_FRONT_IMAGE' => $frontPic_name,
									   'DOCUMENT_BACK_IMAGE' => $backPic_name,
									   ]);
					  Alert::success('', 'We are verifying your details. You will be notified when your KYC is completed.');
						return redirect('/complete-kyc');
					} 
					
					return view('user.kycform',compact('user_data_details'));
			    }
	   
   }*/
	
	public function step1(){
	    
		$user_id = Auth::user()->id;
		$user_data_details = UserData::where('user_id',$user_id)->first();
		
// 		if($user_data_details->DOCUMENT_NAME == null && $user_data_details->DOCUMENT_NUMBER == null && $user_data_details->DOCUMENT_FIRST_NAME==null  && $user_data_details->DOCUMENT_LAST_NAME==null  && $user_data_details->DOCUMENT_DOB==null  && $user_data_details->DOCUMENT_STATE==null  && $user_data_details->DOCUMENT_FRONT_IMAGE==null  && $user_data_details->DOCUMENT_BACK_IMAGE==null){
// 				return view('user.kyc_step1', compact('user_data_details'));
// 			}
		
// 		if($user_data_details->DOCUMENT_NAME != null && $user_data_details->DOCUMENT_NUMBER != null && $user_data_details->DOCUMENT_FIRST_NAME==null  && $user_data_details->DOCUMENT_LAST_NAME==null  && $user_data_details->DOCUMENT_DOB==null  && $user_data_details->DOCUMENT_STATE==null  && $user_data_details->DOCUMENT_FRONT_IMAGE==null  && $user_data_details->DOCUMENT_BACK_IMAGE==null){
// 				return view('user.kyc_step2', compact('user_data_details'));
// 			}
		 
// 		if($user_data_details->DOCUMENT_NAME != null && $user_data_details->DOCUMENT_NUMBER != null && $user_data_details->DOCUMENT_FIRST_NAME!=null  && $user_data_details->DOCUMENT_LAST_NAME!=null  && $user_data_details->DOCUMENT_DOB!=null  && $user_data_details->DOCUMENT_STATE!=null  && $user_data_details->DOCUMENT_FRONT_IMAGE==null  && $user_data_details->DOCUMENT_BACK_IMAGE==null){
// 				return view('user.kyc_step3', compact('user_data_details'));
// 			}
		
// 		if($user_data_details->DOCUMENT_NAME != null && $user_data_details->DOCUMENT_NUMBER != null && $user_data_details->DOCUMENT_FIRST_NAME!=null  && $user_data_details->DOCUMENT_LAST_NAME!=null  && $user_data_details->DOCUMENT_DOB!=null  && $user_data_details->DOCUMENT_STATE!=null  && $user_data_details->DOCUMENT_FRONT_IMAGE!=null  && $user_data_details->DOCUMENT_BACK_IMAGE!=null){
// 				return view('user.kyc_submit');
// 			}
			
		$reference_id = "lll" . mt_rand(1000, 9999);
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'client_id' => 'MicrocomInternational_2_sop',
            'client_secret' => '830a7491d8f44d4eb862a5112c2bc20d',
            'content-type' => 'application/json',
            'module_secret' => '36fc63ea4b954a0da659a403081ecedf',
        ])->post('https://in.staging.decentro.tech/v2/kyc/aadhaar_connect', [
            'reference_id' => $reference_id,
            'consent' => true,
            'purpose' => 'Aadhaar verification',
        ]);	
        if($response["status"] == "SUCCESS"){
            $captchaImage = $response['data']['captchaImage'];
            $transId = $response['decentroTxnId'];
            // dd(Auth::user()->id);
            return view('user.kyc_step1', compact('captchaImage', 'transId', 'user_data_details'));
	    }
	    else{
	        return redirect()->back()->with('fail', 'something went wrong please try again...');
	    }

	}
	public function sendOtpToAadhar(Request $request){
	   // dd($request->toArray());
	    $reference_id = "lll" . mt_rand(1000, 9999);
	    $response = Http::withHeaders([
            'accept' => 'application/json',
            'client_id' => 'MicrocomInternational_2_sop',
            'client_secret' => '830a7491d8f44d4eb862a5112c2bc20d',
            'content-type' => 'application/json',
            'module_secret' => '36fc63ea4b954a0da659a403081ecedf',
        ])
        ->post('https://in.staging.decentro.tech/v2/kyc/aadhaar_connect/otp', [
            'reference_id' => $reference_id,
            'consent' => true,
            'purpose' => 'For Aadhaar Verification',
            'initiation_transaction_id' => $request->transId,
            'aadhaar_number' => $request->DOCUMENT_NUMBER,
            'captcha' => $request->captcha_input,
        ]);
        // return response()
        if($response['status'] == "FAILURE")
            return response()->json(["status" => "error", "message" => $response['message']],200);
        else
            return response()->json(["status" => "success", "message" => $response['message']],200);
	}
	
	public function submitaddhar(Request $request){
	   // dd($request->toArray());
	    $reference_id = "lll" . mt_rand(1000, 9999);
	    $response = Http::withHeaders([
            'accept' => 'application/json',
            'client_id' => 'MicrocomInternational_2_sop',
            'client_secret' => '830a7491d8f44d4eb862a5112c2bc20d',
            'content-type' => 'application/json',
            'module_secret' => '36fc63ea4b954a0da659a403081ecedf',
        ])->post('https://in.staging.decentro.tech/v2/kyc/aadhaar_connect/otp/validate', [
            'generate_pdf' => false,
            'generate_xml' => false,
            'reference_id' => $reference_id,
            'consent' => true,
            'purpose' => 'For Aadhaar Verification',
            'initiation_transaction_id' => $request->transId,
            'otp' => $request->otp_input,
        ]);
        // dd($response->json());
        
        UserData::where('user_id', Auth::id())->update([
            'DOCUMENT_NAME' => 'Aadhar Card',
            'DOCUMENT_NUMBER' => $request->DOCUMENT_NUMBER,
            'DOCUMENT_FIRST_NAME' => $response['data']['proofOfIdentity']['name'],
            'DOCUMENT_LAST_NAME' => null,
            'DOCUMENT_DOB' => $response['data']['proofOfIdentity']['dob'],
            'DOCUMENT_STATE' =>$response['data']['proofOfAddress']['house']. ', ' .  $response['data']['proofOfAddress']['street']. ', ' .  $response['data']['proofOfAddress']['state']. ', ' .  $response['data']['proofOfAddress']['pincode'],
            'verify_status' => 1
        ]);
        // dd($response->json());
        
	    Alert::success('', 'We are verifying your details. You will be notified when your KYC is completed.');
		
	return redirect('profile');
		
		
	   // return view('user.kyc_step2', compact('user_data_details'));
		
	}
	
	public function step3(Request $request){
		 
		     $user_id = Auth::user()->id;
			
		     //FORM DATA 
			  $firstName = $request->firstName;
			  $lastName = $request->lastName;
			  $dob = $request->dob;
			  $state = $request->state;
		
		     $user_data_details = UserData::where('user_id', $user_id)->first();
		
			
		
			UserData::where('user_id', $user_id)  // find your user by their email
			               ->update(array(
							   'DOCUMENT_FIRST_NAME' => $firstName,
							   'DOCUMENT_LAST_NAME' => $lastName,
							   'DOCUMENT_DOB' => $dob,
							   'DOCUMENT_STATE' => $state,
						   ));  // update the record in the DB. 
		
		
		
		    return view('user.kyc_step3', compact('user_data_details'));
		
	}
	
public function kyc_submit(Request $request){
		 
		     $user_id = Auth::user()->id;
			
		     //FORM DATA 
			  $firstName = $request->firstName;
			  $lastName = $request->lastName;
			  $dob = $request->dob;
			  $state = $request->state;
		
		     $user_data_details = UserData::where('user_id', $user_id)->first();
		
				if ($request->hasFile('frontPic')) {
						  $frontPic = $request->file('frontPic');
						  $frontPic_name = time().'frontpic.'.$frontPic->getClientOriginalExtension();
                          $destinationPath = public_path('/images/kycdata/'.$user_id.'/');
                          $frontPic->move($destinationPath, $frontPic_name);
						}
						if ($request->hasFile('backPic')) {
						  $backPic = $request->file('backPic');
						  $backPic_name = time().'backPic.'.$backPic->getClientOriginalExtension();
                          $destinationPath = public_path('/images/kycdata/'.$user_id.'/');
                          $backPic->move($destinationPath, $backPic_name);
						}
						
						UserData::where('user_id', $user_id)
								   ->update([
									   'DOCUMENT_FRONT_IMAGE' => $frontPic_name,
									   'DOCUMENT_BACK_IMAGE' => $backPic_name,
									   'verify_status' => '0',
									   ]);
					  Alert::success('', 'We are verifying your details. You will be notified when your KYC is completed.');
		
	return redirect('user/kyc-submit');
	   
		
	}
	
	public function kyc_submit_view(){
		$user_id = Auth::user()->id;
		$user_data_details = UserData::where('user_id', $user_id)->first();
		
		if($user_data_details->DOCUMENT_NAME != null && $user_data_details->DOCUMENT_NUMBER != null && $user_data_details->DOCUMENT_FIRST_NAME!=null  && $user_data_details->DOCUMENT_LAST_NAME!=null  && $user_data_details->DOCUMENT_DOB!=null  && $user_data_details->DOCUMENT_STATE!=null  && $user_data_details->DOCUMENT_FRONT_IMAGE!=null  && $user_data_details->DOCUMENT_BACK_IMAGE!=null){
			return view('user.kyc_submit');
		}else{
			return redirect('/complete-kyc/step1');
		}
		
	}

}
