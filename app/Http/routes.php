<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
$domain = 'index';

/** Always accessible **/
Route::get('/', function(){
    return view('auth.login');
});
//get('/', 'Auth\AuthController@getLogin');
get('/documentation',function(){
	return view('documentation.index');
});

/** Before login **/
Route::group(['middleware' => 'guest'], function () use($domain) {

	if(config('configuration.'.$domain.'.enable_registration'))
	get('/register', 'Auth\AuthController@getUserRegister');   

	post('/user/register', 'Auth\AuthController@postUserRegister');
	get('/login', 'Auth\AuthController@getLogin');
	post('/login', 'Auth\AuthController@postLogin');
	get('/password/email', 'Auth\PasswordController@getEmail');
	post('/password/email', 'Auth\PasswordController@postEmail');
	get('/password/reset/{token}', 'Auth\PasswordController@getReset');
	post('/password/reset', 'Auth\PasswordController@postReset');

	if(config('configuration.'.$domain.'.installation_path'))
	resource('/install', 'InstallController',['only' => ['index', 'store']]);
	
	Route::get('/social/login/redirect/{provider}', ['uses' => 'Auth\AuthController@redirectToProvider', 'as' => 'social.login'])
		->where('provider', 'facebook|twitter|google|github');
	Route::get('/social/login/{provider}', 'Auth\AuthController@handleProviderCallback')
		->where('provider', 'facebook|twitter|google|github');

});

if(config('configuration.'.$domain.'.email_activation') == '1'){
	get('/resend_activation','ActivateController@resendActivation');
	post('/resend_activation','ActivateController@doResendActivation');
	get('/activate/{token}','ActivateController@activate');
}

/** After login **/
get('/logout', ['uses' => 'Auth\AuthController@getLogout', 'middleware' => 'auth']);

Route::post('/dept','UserController@testDept');
/** After login & Activation**/
Route::group(['middleware' => ['auth','activate']], function () {

	get('/comisiones', 'UserController@comisions');
	get('/transacciones', 'UserController@transactions');
	get('/addWallet', function(){
		return view('user.setWallet');
	});
	post('/setDirWallet', 'UserController@storeDirWallet');
	get('/withdrawal', function(){
		return view('user.withdrawal');
	});
	get('/deposit', function(){
		return view('user.deposit');
	});
	
	get('/validatepaycode', 'ValidatePayCode@index');
	get('/user/generatepaycode/{id}',['uses' => 'ValidatePayCode@generate']);
	get('/savecode/{id}', ['uses'=>'ValidatePayCode@save']);

	get('/dashboard','DashboardController@index');
	post('/dashboard',array('as' => 'dashboard.index', 'uses' => 'DashboardController@index'));

	Route::model('todo','\App\Todo');
	resource('/todo', 'TodoController'); 

	resource('/language', 'LanguageController'); 
	get('/setLanguage/{locale}','LanguageController@setLanguage');
	post('/language/addWords',array('as'=>'language.addWords','uses'=>'LanguageController@addWords'));
	patch('/language/updateTranslation/{id}', ['as' => 'language.updateTranslation','uses' => 'LanguageController@updateTranslation']);

	get('/user/create', 'Auth\AuthController@getRegister');
	post('/auth/register', 'Auth\AuthController@postRegister');
	Route::model('user','\App\User');
	Route::resource('/user', 'UserController',['except' => ['create', 'store']]);
	get('/user/list/{type}','UserController@index');
	patch('/users/profile/{id}', ['as' => 'user.profileUpdate', 'uses' => 'UserController@profileUpdate']);
	patch('/users/sms/{id}', ['as' => 'user.sendUserSMS', 'uses' => 'SMSController@sendUserSMS']);
	post('/setUsername',['as' => 'user.setUsername','uses' => 'UserController@setUsername']);
	get('/user/welcomeEmail/{user_id}/{token}','TemplateController@welcomeEmail');	

	get('/message/compose', 'MessageController@compose'); 
	post('/message', ['as' => 'message.store', 'uses' => 'MessageController@store']);
	get('/message/sent','MessageController@sent'); 
	get('/message','MessageController@inbox'); 
	get('/message/view/{id}/{token}', array('as' => 'message.view', 'uses' => 'MessageController@view'));
	get('/message/{id}/delete/{token}', array('as' => 'message.delete', 'uses' => 'MessageController@delete'));

	Route::model('custom_field','\App\CustomField');
	resource('/custom_field', 'CustomFieldController'); 
	
	Route::model('role','\App\Role');
	resource('/role', 'RoleController'); 
	post('/save-permission',array('as' => 'configuration.save_permission','uses' => 'ConfigController@savePermission'));

	get('/configuration', 'ConfigController@index'); 
	post('/configuration', array('as' => 'configuration.store','uses' => 'ConfigController@store')); 
	post('/sms-store', array('as' => 'configuration.smsStore','uses' => 'ConfigController@smsStore')); 
	post('/mail-store', array('as' => 'configuration.mailStore','uses' => 'ConfigController@mailStore')); 
	post('/social-login-store', array('as' => 'configuration.socialLoginStore','uses' => 'ConfigController@socialLoginStore')); 
	
	Route::get('arbol', 'ArbolController@index');
	Route::resource('cliente', 'VentasController@create');
	Route::resource('ventas', 'VentasController@store');
	Route::resource('wentas/update', 'VentasController@update');
	//aqui va el consultas
	Route::resource('ventaC', 'VentasController@index');
	Route::resource('venta', 'VentasController@index');
   	 //editar
	//Route::resource('', '');
	get('ventaEdit/{id}',['uses' => 'VentasController@edit']);
	//eliminar
	get('ventaEliminar/{id}',['uses' => 'VentasController@destroy']);

	post('guardaractividad', 'VentasController@actividad');
	
	resource('/template', 'TemplateController',['only' => ['index', 'update']]); 
	resource('/sms_template', 'SMSTemplateController',['only' => ['index', 'update']]); 

	get('/change_password', 'UserController@changePassword');
	post('/change_password',array('as'=>'change_password','uses' =>'UserController@doChangePassword'));
	patch('/change_user_password/{id}',array('as'=>'change_user_password','uses' =>'UserController@doChangeUserPassword'));
});