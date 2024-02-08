<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Alert;
use App\User;
use App\UserData;
use App\AdminContactDetails;
use Redirect;

class CommonController extends Controller
{

    public function terms(){
	     return view('terms');
	}
	
	 public function privacy(){
	     return view('privacy');
	}
	
	 public function refund_policy(){
	     return view('refund_policy');
	}
	
	 public function contact_us(){
	     $adminSocialSettings = AdminContactDetails::where('id', 1)->first();
	     return view('contact_us', compact('adminSocialSettings'));
	}
	
	 public function responsible_gaming(){
	     return view('responsible_gaming');
	}
	
	public function sitemap_xml(){
	     return view('sitemap');
	}
	
	public function error404(Request $request){
		echo '<script type="text/javascript">'
			   , 'history.go(-1);'
			   , '</script>';
	}

}
