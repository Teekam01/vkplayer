<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserData;
use App\UserBankDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Alert;
use Session;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public $successStatus = 200;

    public function login(Request $request){
		echo $request->referral_code;
      /*  Log::info($request);
        if(Auth::attempt(['mobile' => request('mobile'), 'password' => request('password')])){
            return view('home');
        }
        else{
            return Redirect::back ();
        }*/
    }

    public function loginWithOtp(Request $request){



		$mobile = $request->mobile;
		$otp = $request->otp;
        $user = User::where('mobile', $mobile)->first();

	    if($user){
			$is_blocked = User::where('mobile', $mobile)->where('otp', $otp)->where('is_blocked', '1')->first();
			if($is_blocked){
			    	$data['status']= false;
			    	$data['msg'] = "You Are Blocked By Admin, Contact us!";
			    	return response()->json($data);
				// Alert::error('','You Are Blocked By Admin, Contact us.');
				// 	return redirect()->back();
			}else{
				$user_re  = User::where('mobile', $mobile)->where('otp', $otp)->where('is_blocked', '0')->first();
				if($user_re){

					Auth::login($user, true);
					$login_token = Str::random(60);
					session()->put('token', $login_token);
					User::where('mobile','=',$request->mobile)->update(['otp' => null,'token'=> $login_token]);
					if($user->user_type==1 || $user->user_type==3){
					    $data['url'] ='/admin/dashboard';
				// 		return redirect('/admin/dashboard');
					}elseif($user->user_type==2){
					    	$data['url'] ='/user/dashboard';
				// 		return redirect('/user/dashboard');
					}else{
					    $data['url'] ='/admin/dashboard';
				// 		return redirect('/employee/dashboard');
					}
				}else{
					$data['status']= false;
			    	$data['msg'] = "Invalid OTP!";
			    	return response()->json($data);
				// 	Alert::error('','Invalid OTP');
				// 	return redirect()->back();
				}
				$data['status']= true;
				$data['msg'] = "Login Successfully";
				return response()->json($data);
			}

        }/*else{

			Alert::error('','You Are Blocked By Admin, Contact us.');
				return redirect()->back();


        }*/
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        User::create($input);

        return redirect('login');
    }

    public function sendOtp(Request $request){
        $otp = rand(100000,999999);
		$mobile_no = $request->mobile;
		 $reffered_by = $request->reffered_by ?? '0';
		$a=[];
		$user = User::where('mobile', $mobile_no)->first();
		if($user && $user->is_blocked == 1){
			$a['status']= false;
			$a['msg'] = "You Are Blocked By Admin, Contact us For More Details.";

			return response()->json($a);
		}
		if(!$user){
			$vplay_id = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 5).rand(111,999);
			$referral_code = substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVWXYZ", 2)), 0, 2).substr($request->mobile, -4);

			$new_user = new User;
			$new_user['vplay_id'] = $vplay_id;
			$new_user['mobile'] = $request->mobile;
			$new_user['otp'] = '0';
			$new_user['user_type'] = '2';
			$new_user['referral_code'] = $referral_code;
			$new_user['reffered_by'] = $reffered_by;
			$new_user->save();

			//user data table insertion
			$user_id = $new_user->id;
			$user_data = new UserData;
			$user_data['user_id'] = $user_id;
			$user_data['vplay_id'] = $vplay_id;
			$user_data->save();

			//bank table insertion
			$user_bank = new UserBankDetail;
			$user_bank['user_id'] = $user_id;
			$user_bank->save();

		}

// 		$key = "kTQhLBrM4611r2RGpPfvfHIIZVF9OylJopApgW9nd4qLfSmvO2YYP68c8xjn";
		$key = "6O5ZCIYsym2bxM7iLPSnQDf9RraT0XE1VNuWzt843BAdJGqklpbhNzkxW0SiYftnBKsT6gdopcy2LUGF";
		$route = "otp";
		$sender_id = "FTWSMS";
        $message = "Your Login OTP is ".$otp.".";
        $language = "english";
        $flash = "0";
        $numbers = $mobile_no;

		$message = urlencode($message);

	   // $data = "authorization=".$key."&route=".$route."&sender_id=".$sender_id."&message=".$message."&language=".$language."&flash=".$flash."&numbers=".$numbers;
	   $data = "authorization=".$key."&variables_values=".$otp."&route=".$route."&numbers=".$numbers;

		$ch =   curl_init('https://www.fast2sms.com/dev/bulkV2?'.$data);
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				 $response = curl_exec($ch);
				 curl_close($ch);

		$user = User::where('mobile','=',$mobile_no)->update(['otp' => $otp]);
		if($user){
			$a['status']= true;
			$a['msg'] = "Otp Sent Successfully";
			$a['otp'] = $otp;
		}else {
			$a['status']= false;
			$a['msg'] = "otp not sent!";
		}
        return response()->json($a);
    }

	public function loginWithOtpForm(){
		 return view('auth/OtpLogin');
	}


	public function rules(){
		return view('user.rules');
	}

	public function info_conditions(){
		return view('user.info_conditions');
	}

}
