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

Class SMSTemplateController extends Controller{

	public function index(){
		$sms_templates = Helper::getSMSTemplate();

		foreach($sms_templates as $key => $template){
			$filename = base_path().'/config/sms_template/'.DOMAIN.'/'.$key;
			$content = File::get($filename);
			$template_content[$key] = $content;
		}

		return view('sms_template.index',compact('sms_templates','template_content'));
	}
	
	public function update(Request $request, $key){

		if(!Entrust::can('manage_sms_template'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$sms_templates = Helper::getSMSTemplate();
		$filename = base_path().'/config/sms_template/'.DOMAIN.'/'.$key;
		File::put($filename,$request->input('template_description'));

		$filename = base_path().'/config/sms_template.php';
		File::put($filename,var_export($sms_templates, true));
		File::prepend($filename,'<?php return ');
		File::append($filename, ';');

		$activity = 'SMS Template updated';
		Activity::log($activity);
		return redirect('/sms_template')->withSuccess(config('constants.UPDATED'));
	}
}
?>