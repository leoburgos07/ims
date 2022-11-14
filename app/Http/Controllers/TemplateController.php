<?php
namespace App\Http\Controllers;
use Entrust;
use Config;
use Activity;
use Auth;
use File;
use Mail;
use App\Classes\Helper;
use Illuminate\Http\Request;

Class TemplateController extends Controller{

	public function index(){
		$templates = Helper::getTemplate();

		foreach($templates as $key => $template){
			$filename = base_path().'/config/template/'.DOMAIN.'/'.$key;
			$content = File::get($filename);

			if($key == 'forgot_password'){
				$content = File::get(base_path().'/resources/views/emails/password.blade.php');
				$content = str_replace('{!! url(\'password/reset/\'.$token) !!}','[LINK]',$content);
				$content = str_replace('{!! $user->name !!}','[NAME]',$content);
				$content = str_replace('{!! $user->email !!}','[EMAIL]',$content);
				$content = str_replace('{!! $user->username !!}','[USERNAME]',$content);
			}
			$template_content[$key] = $content;
		}

		return view('template.index',compact('templates','template_content'));
	}
	
	public function update(Request $request, $key){

		if(!Entrust::can('manage_template'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$templates = Helper::getTemplate();
		$templates[$key]['title'] = $request->input('template_subject');
		$filename = base_path().'/config/template/'.DOMAIN.'/'.$key;
		File::put($filename,$request->input('template_description'));

		if($key == 'forgot_password'){
			$content = $request->input('template_description');
			$filename = base_path().'/resources/views/emails/password.blade.php';
			$content = str_replace('[LINK]','{!! url(\'password/reset/\'.$token) !!}',$content);
			$content = str_replace('[NAME]','{!! $user->name !!}',$content);
			$content = str_replace('[EMAIL]','{!! $user->email !!}',$content);
			$content = str_replace('[USERNAME]','{!! $user->username !!}',$content);
			File::put($filename,$content);
		}

		$filename = base_path().'/config/template.php';
		File::put($filename,var_export($templates, true));
		File::prepend($filename,'<?php return ');
		File::append($filename, ';');

		$activity = 'Template updated';
		Activity::log($activity);
		return redirect('/template')->withSuccess(config('constants.UPDATED'));
	}

	public function welcomeEmail($user_id,$token){

    if(!Entrust::can('send_welcome_email'))
      return redirect('/dashboard')->withErrors(config('constants.NA'));

    if(!Helper::verifyCsrf($token))
      return redirect('/dashboard')->withErrors(config('constants.CSRF'));

    $user = \App\User::find($user_id);

	$filename = base_path().'/config/template/'.DOMAIN.'/welcome_mail';
    $content = File::get($filename);

    if(!$user)
      return redirect()->back()->withErrors(config('constants.INVALID_LINK'));
    
    $content = str_replace('[NAME]',$user->name,$content);
    $content = str_replace('[EMAIL]',$user->email,$content);
    $content = str_replace('[USERNAME]',$user->username,$content);

      Mail::send('template.mail', compact('content'), function($message) use ($user){
        $message->to($user->email, 'WM Lab')->subject('Welcome');
    });

    return redirect()->back()->withSuccess('Mail send successfully!! ');
  }
}
?>