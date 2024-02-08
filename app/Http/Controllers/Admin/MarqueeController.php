<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\UserBankDetail;
use App\UserData;
use App\MarqueeNotification;

class MarqueeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function marquee_view()
    {
		$marquee = MarqueeNotification::where('id','1')->first();
			
			return view('admin.marquee.marquee', compact('marquee'));
	}

    public function marquee_save(Request $request)
    {
		$text = $request->text;
		$status = $request->status;
		
		$marquee = MarqueeNotification::find(1);
		$marquee->marquee_text = $text;
		$marquee->status = $status;
		$marquee->save();
		
		return redirect()->back()->with('success','Marquee Notification Updated.');
	}

    
}
