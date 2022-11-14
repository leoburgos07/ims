<?php

namespace App\Http\Controllers\Auth;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Role;
use App\Department;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRegisterRequest;
use Entrust;
use App\Profile;
use App\Classes\Helper;
use Auth;
use DB;
use Config;
use Mail;
use File;
use Activity;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getLogout','getRegister','postRegister']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            
            'name_invited' => 'required|max:255|exists:users,username',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'telefono' => 'required|digits:11',
            
            
        ]);
    }
 /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name_invited' => $data['name_invited'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'telefono' => $data['telefono'],
        ]);
    }

    public function getUserRegister(){
        return view('auth.register');
    }

    public function getRegister()
    {
        if(!Entrust::can('create_user'))
            return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(Entrust::hasRole('admin'))
            $roles = Role::lists('name','id')->all();
        else
            $roles = Role::where('name','!=','admin')->lists('name','id')->all();

        return view('user.create',compact('roles'));
    }

    public function postRegister(RegisterRequest $request, User $user){
        
        if(!Entrust::can('create_user'))
            return redirect('/dashboard')->withErrors(config('constants.NA'));

        $user->fill($request->all());
        $user->password = bcrypt($request->input('password'));

        $key = config('app.key');
        $user->confirmation_code = hash_hmac('sha256', str_random(40), $key);
        $user->confirmed = 1;
        $user->telefono = $request->input('telefono');
        $user->save();

        $profile = new Profile;
        $profile->user()->associate($user);
        $profile->save();
        $user->attachRole($request->input('role_id'));

        $activity = Auth::user()->name.' Crear un usuario ('.$user->name.')';
        Activity::log($activity);
        return redirect()->back()->withSuccess('Usuario creado con exito. ');
    }

    public function postUserRegister(UserRegisterRequest $request, User $user){
        
        $username = strtolower($request->input('username'));
        $name_invited = strtolower($request->input('name_invited'));
        //$monto = $request->input('investment');
        $countLevel = 0;

        $user->fill($request->all());
        $user->password = bcrypt($request->input('password'));
        $user->comision = 0;
        $user->renta_fija = 0;
        $user->renta_temporal = 0;
        $user->username = $username;
        $user->tipo_invitado = 'usuario';
        $user->confirmed = 1;
        $user->confirm_pay_code = 1;

        
        if($name_invited){
            $user->name_invited = $name_invited;
            $user->leader = false;
        }else{
            $user->name_invited = 'nada';
            $user->leader = true;
        }
        //$user->thirdLevel = ($monto > 1000) ? 1 : 0;
        
        $key = config('app.key');
        $confirmation_code = hash_hmac('sha256', str_random(40), $key);
        $user->confirmation_code = $confirmation_code;
        $user->save();
        

        $filename = base_path().'/config/template/'.DOMAIN.'/activation_mail';
        $content = File::get($filename);
        $base_url = url('/');
        $link = $base_url.'/activate/'.$confirmation_code;

        $content = str_replace('[LINK]',$link,$content);
        $content = str_replace('[EMAIL]',$user->email,$content);
        $content = str_replace('[USERNAME]',$user->username,$content);
        
	    mail($user->email, "Correo de Activacion", $content);
        Mail::send('template.mail', compact('content'), function($message) use ($user){
           $message->to($user->email)->subject('Activate your account');
        });

        $profile = new Profile;
        $profile->user()->associate($user);
        $profile->save();

        $role = Role::where('name','=','user')->first();
        if($role)
        $user->attachRole($role->id);

        /**quitar el campo de monto en el registro y cada vez que la persona haga un deposito
         * estas funciones siguientes deben ir en userController para asignar comisiones cada deposiuto que se haga 
       
        if($user->name_invited != 'nada')
        {
            $countLevel++;
            $this->esLider($username, $name_invited, $countLevel, $monto);
        }else{
            $this->asignarComision($countLevel, $username, $name_invited, $monto);
        }**/
        
        return redirect()->back()->withSuccess('Usuario registrado Correctamente.');
    }
    public function esLider($username, $name_invited, $level, $monto)
    {
        $padre = DB::table('users')->where('username',$name_invited)->first();
        if($padre->leader || $level == 3)
        {
            $this->asignarComision($level, $username, $name_invited, $monto);
        }else{
            $level++;
            $this->esLider($username,$padre->name_invited,$level, $monto);
        }
    }
    public function asignarComision($level, $username, $name_invited, $monto)
    {
        $usuario = DB::table('users')->where('username', $username)->first();
        $dateNow = date("Y-m-d H:i:s");
        $levelOneComission = $monto * 0.05;
        $levelTwoComission = $monto * 0.03;
        $levelThreeComission = $monto * 0.02;
        if($level == 0)
        {
            $dailyRoi = $monto * 0.015;
            $dateFinish = date("Y-m-d H:i:s",strtotime($dateNow."+ 200 days"));
            $remainingDays = 200;
            DB::table('users')
                ->where('username', $username)
                ->increment('renta_fija', $dailyRoi);
        }
        else if($level == 1)
        {
            $dailyRoi = ($monto - $levelOneComission) * 0.015;
            $dateFinish = date("Y-m-d H:i:s",strtotime($dateNow."+ 215 days"));
            $remainingDays = 215;
            DB::table('users')
                ->where('username', $username)
                ->increment('renta_fija', $dailyRoi);
            DB::table('users')
                ->where('username', $name_invited)
                ->increment('comision', $levelOneComission);
            DB::table('users')
            ->where('username', $name_invited)
            ->increment('wallet', $levelOneComission);
        }
        else if($level == 2)
        {
            $dailyRoi = ($monto - $levelOneComission - $levelTwoComission) * 0.015;
            $dateFinish = date("Y-m-d H:i:s",strtotime($dateNow."+ 218 days"));
            $remainingDays = 218;
            DB::table('users')
                ->where('username', $username)
                ->increment('renta_fija', $dailyRoi);
            DB::table('users')
                ->where('username', $name_invited)
                ->increment('comision', $levelTwoComission);
            DB::table('users')
                ->where('username', $usuario->name_invited) 
                ->increment('comision', $levelOneComission);
            DB::table('users')
                ->where('username', $name_invited)
                ->increment('wallet', $levelTwoComission);
            DB::table('users')
                ->where('username', $usuario->name_invited) 
                ->increment('wallet', $levelOneComission);
        }
        else
        {
            
            $dailyRoi = ($monto - $levelOneComission - $levelTwoComission) * 0.015;
            $userSecondLevel = DB::table('users')->where('username',$usuario->name_invited )->first();
            $dateFinish = date("Y-m-d H:i:s",strtotime($dateNow."+ 218 days"));
            $remainingDays = 218;

            DB::table('users')
                ->where('username', $username)
                ->increment('renta_fija', $dailyRoi);

            DB::table('users')
                ->where('username', $usuario->name_invited) 
                ->increment('comision', $levelOneComission);
            
            DB::table('users')
                ->where('username', $userSecondLevel->name_invited) 
                ->increment('comision', $levelTwoComission);
            DB::table('users')
                ->where('username', $usuario->name_invited) 
                ->increment('wallet', $levelOneComission);
            
            DB::table('users')
                ->where('username', $userSecondLevel->name_invited) 
                ->increment('wallet', $levelTwoComission);
            $lastUserComission = DB::table('users')->where('username',$name_invited)->first();

            if( $lastUserComission->thirdLevel){
                DB::table('users')
                    ->where('username', $name_invited)
                    ->increment('comision', $levelThreeComission);
                DB::table('users')
                    ->where('username', $name_invited)
                    ->increment('wallet', $levelThreeComission);
            }
        }

        DB::table('transactions')->insert([
            'monto' => $monto,
            'state' => 1,
            'transactions_types_id' => 2,
            'users_id' => $usuario->id,
            'created_at' => $dateNow,
            'ends_at' => $dateFinish,
            'remainingDays' => $remainingDays
        ]);
    }

    public function assignComission($name_invited, $username, $monto, $countLevel){
        
        $countLevel++;
        $firstLevelComission = $monto * 0.05;

        
        //llamar aqui dailyComission
        
        DB::table('users')
            ->where('username', $name_invited)
            ->increment('comision', $firstLevelComission);

        DB::table('users')
            ->where('username', $name_invited)
            ->increment('wallet', $firstLevelComission);

            $padre = DB::table('users')->where('username',$name_invited)->first();
        
        if(!$padre->leader){
                var_dump($padre);
                die;
               $this->levelUpComission($name_invited, $username, $monto, $countLevel);
        }
        else{
            $this->assignDailyComission($username,$monto, $countLevel);
        }


    }
    public function levelUpComission($name_invited, $username, $monto, $countLevel){
        $padre = DB::table('users')->where('username',$name_invited)->get(); 
        $secondLevelComission = $monto *0.03;
        $thirdLeveComission = $monto *0.02;

        if($countLevel == 2){
            //llamar aqui a asingDailyComission
            DB::table('users')
            ->where('username', $padre[0]->name_invited)
            ->increment('comision', $thirdLeveComission);

            DB::table('users')
            ->where('username', $padre[0]->name_invited)
            ->increment('wallet', $thirdLeveComission);
        }else{
            //probando llamar dailyComission
            //$this->assignDailyComission($username, $monto, $countLevel);
        DB::table('users')
            ->where('username', $padre[0]->name_invited)
            ->increment('comision', $secondLevelComission);

            DB::table('users')
            ->where('username', $padre[0]->name_invited)
            ->increment('wallet', $secondLevelComission); 

       /** Preguntar aqui si es lider */ if($padre[0]->name_invited != 'Admin'){
            $countLevel++;
            $this->levelUpComission($padre[0]->name_invited, $padre[0]->username, $monto, $countLevel);
        }else{

        }
     }
    }

    public function assignDailyComission($username, $monto, $countLevel){
        if($countLevel == 0)
        {
            $dailyComission = $monto * 0.015;
            DB::table('users')
                ->where('username', $username)
                ->increment('renta_fija', $dailyComission);
                //transaccion 0 - 200
        }
        else if($countLevel == 1)
        {
            $dadComission = $monto * 0.05;
            $dailyRoi = ($monto - $dadComission) * 0.015;
            DB::table('users')
                ->where('username', $username)
                ->increment('renta_fija', $dailyRoi);
                //transaccion 1 - 215
        }
        
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    
    public function handleProviderCallback($provider)
    {

        $user_detail = Socialite::driver($provider)->user();

        $data = [
            'email' => $user_detail->getEmail()
        ];

        Auth::login(User::firstOrCreate($data));

        $user = Auth::user();
        $user->name = ($user->name) ? : $user_detail->getName();
        $user->username = ($user->username) ? : null;
        $user->confirmed = 1;
        $user->provider = $provider;
        $user->save();

        $profile = $user->Profile ?: new Profile;
        $profile->user()->associate($user);
        $profile->save();

        if(!count($user->roles)){
            $role = Role::where('name','=','user')->first();
            if($role)
            $user->attachRole($role->id);
        }

        return redirect($this->redirectPath());
    }
    
    protected $username = 'username';
    protected $redirectPath = '/';
    protected $loginPath = '/';
}