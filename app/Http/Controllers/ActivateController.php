<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\ResendActivationRequest;
use Auth;
use Config;
use Mail;
use DB;
use File;
use App\User;

Class ActivateController extends Controller{

	public function activate($token = null){

		if(!Auth::check())
			$user = User::where('confirmation_code','=',$token)->first();
		else
			$user = Auth::user();

		if(!$user)
			return redirect('/')->withErrors('That was not a valid URL.');

		if($user->confirmed == 1)
			return redirect('/')->withErrors('Your account is already activated.');

		if($user->confirmation_code != $token)
			return redirect()->back()->withErrors('This is not a valid activation code.');

		$user->confirmed = 1;
		$user->save();
		
		$admins = DB::select('SELECT * FROM users u INNER JOIN role_user r ON u.id = r.user_id WHERE r.role_id =1');
		foreach($admins as $admin){
		
		mail($admin->email, "Usuario Registrado", "Estimado ".$admin->name." una persona recientemente se ha registrado en el sistema. Usuario: ".$user->username.". Contactese con este usuario para el respectivo proceso de pago." );
		
		}
		
		return redirect('/')->withSuccess('Your account has been activated.');
	}

	public function resendActivation(){

		if(Auth::check() && Auth::user()->confirmed == 1)
			return redirect('/dashboard')->withErrors('Your account is already activated.');
		
		$assets = ['hide_sidebar'];
		return view('auth.resend_activation',compact('assets'));
	}

	public function doResendActivation(ResendActivationRequest $request){

		if(Auth::check())
			$user = Auth::user();
		else
			$user = User::where('email','=',$request->input('email'))->first();

		if(!$user)
			return redirect()->back()->withErrors('This email id is never registered with us.');

		if($user->confirmed == 1)
			return redirect('/')->withErrors('Your account is already activated.');

		$confirmation_code = $user->confirmation_code;
        if (empty($confirmation_code))
        {
            $key = config('app.key');
            $confirmation_code = hash_hmac('sha256', str_random(40), $key);
            $user->confirmation_code = $confirmation_code;
            $user->save();
        }

		$filename = base_path().'/config/template/'.DOMAIN.'/activation_mail';
	    $content = File::get($filename);
	    $base_url = url('/');
	    $link = $base_url.'/activate/'.$confirmation_code;

	    $content = str_replace('[LINK]',$link,$content);
	    $content = str_replace('[EMAIL]',$user->email,$content);
	    $content = str_replace('[USERNAME]',$user->username,$content);
		
	    var_dump(mail($user->email, "Correo de Activacion", $content));
	    /*Mail::send('template.mail', compact('content'), function($message) use ($user){
        	$message->to($user->email, 'WM Lab')->subject('Activate your account');
    	});*/

		return redirect()->back()->withSuccess('Activation email sent to your registered mail id.');
	}
}