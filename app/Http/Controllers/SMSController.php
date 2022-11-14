<?php
namespace App\Http\Controllers;
use DB;
use Entrust;
use Config;
use Illuminate\Http\Request;
use Validator;
use App\Classes\Helper;

Class SMSController extends Controller{

	public function index($type = 'designation'){
	}

	public function sendUserSMS(Request $request, $id){

		if(!Entrust::can('send_user_sms'))
			return redirect('/dashboard')->withErrors(config('constant.NA'));


		$user = \App\User::find($id);

		$validation = Validator::make($request->all(),[
				'sms' => 'required'
				]);

		if($validation->fails()){
			return redirect()->back()->withInput()->withErrors($validation->messages());
		}

      	$response = Helper::sendSMS($user->Profile->contact_number,$request->input('sms'));

      	if($response == 1)
      		return redirect()->back()->withSuccess('SMS Sent successfully!! ');
      	else
      		return redirect()->back()->withErrors($response);
	}

	public function store()
	{
		return redirect()->back();
	}
}
?>