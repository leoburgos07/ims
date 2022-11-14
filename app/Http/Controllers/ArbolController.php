<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserProfileRequest;
use App\Http\Requests\UsernameRequest;
use App\Classes\Helper;
use App\User;
use App\Department;
use App\Role;
use Entrust;
use Auth;
use Config;
use Image;
use Activity;
use File;
use Mail;
use DB;

class ArbolController extends Controller{


	public function index(){

		return view('arbol/arbol');
	}

	public function consultar_arbol($user){
		

	}









}