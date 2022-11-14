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

class UserController extends Controller
{
  protected $form = 'user-form';

  public function index(User $user, $type = null)
  {

    if (!Entrust::can('manage_user'))
      return redirect('/dashboard')->withErrors(config('constants.NA'));

    $query = $user->with('roles');

    if ($type != null)
      $query->whereHas('roles', function ($qry) use ($type) {
        $qry->where('name', '=', $type);
      });

    $users = $query->get();

    $col_data = array();
    $col_heads = array(
      trans('Opciones'),
      trans('Nombre'),
      trans('Usuario'),
      trans('Email'),
      trans('Telefono'),
      trans('Rol'),
      trans('Me invito')
    );

    $col_heads = Helper::putCustomHeads($this->form, $col_heads);
    $col_ids = Helper::getCustomColId($this->form);
    $values = Helper::fetchCustomValues($this->form);

    $token = csrf_token();
    foreach ($users as $user) {
      foreach ($user->roles as $role)
        $role_name = $role->display_name;
      $cols = array(
        '<div class="btn-group btn-group-xs">' .
          '<a href="./user/' . $user->id . '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver"> <i class="fa fa-share"></i></a> ' .
          //'<a href="./user/welcomeEmail/'.$user->id.'/'.$token.'" class="btn btn-default btn-xs" data-toggle="tooltip" title="Enviar e-mail de bienvenida"> <i class="fa fa-envelope"></i></a>'.
          '<a href="./user/' . $user->id . '/edit" class="btn btn-default btn-xs" data-toggle="tooltip" title="Editar"> <i class="fa fa-edit"></i></a> ' .
          delete_form(['user.destroy', $user->id]) .
          '</div>',

        $user->name,
        $user->username,
        $user->email,
        $user->telefono,
        $role_name,
        $user->name_invited,
      );
      $id = $user->id;

      foreach ($col_ids as $col_id)
        array_push($cols, isset($values[$id][$col_id]) ? $values[$id][$col_id] : '');
      $col_data[] = $cols;
    }

    Helper::writeResult($col_data);

    return view('user.index', compact('col_heads'));
  }
  public function transactions()
  {

    if (Auth::user()->tipo_invitado == 'admin') {
      $transactions = DB::table('users')
        ->join('transactions', 'users.id', "=", 'transactions.users_id')
        ->join('transactions_types', 'transactions.transactions_types_id', "=", 'transactions_types.id')
        ->select('name as usuario', 'monto', 'state', 'type', 'remainingDays', 'ends_at', 'transactions.created_at', 'transactions.id')
        ->get();

      $col_heads = array(
        trans('Usuario'),
        trans('Tipo de transaccion'),
        trans('Cantidad'),
        trans('Estado'),
        trans('Fecha de accion'),
        trans('Cadudicad'),
        trans('Días restantes')
      );
      $col_heads = Helper::putCustomHeads($this->form, $col_heads);
      $col_ids = Helper::getCustomColId($this->form);
      $values = Helper::fetchCustomValues($this->form);
      foreach ($transactions as $transaction) {
        if ($transaction->state == 1) {
          $cols = array(
            $transaction->usuario,
            $transaction->type,
            number_format($transaction->monto, 2) . " USD",
            "<span style='color:green;'>Activa</span>",
            $transaction->created_at,
            $transaction->ends_at,
            "<span style='color:green;'>$transaction->remainingDays</span>"
          );
        } else {
          $cols = array(
            $transaction->usuario,
            $transaction->type,
            number_format($transaction->monto, 2) . " USD",
            "<span style='color:red;'>Expirada</span>",
            $transaction->created_at,
            $transaction->ends_at,
            "<span style='color:red;'>$transaction->remainingDays</span>"
          );
        }
        $id = $transaction->id;

        foreach ($col_ids as $col_id)
          array_push($cols, isset($values[$id][$col_id]) ? $values[$id][$col_id] : '');
        $col_data[] = $cols;
      }
    } else {
      $transactions = DB::table('transactions')
        ->join('transactions_types', 'transactions.transactions_types_id', "=", 'transactions_types.id')
        ->where('transactions.users_id', Auth::user()->id)->get();

      $col_heads = array(
        trans('Tipo de transaccion'),
        trans('Cantidad'),
        trans('Estado'),
        trans('Fecha de accion'),
        trans('Cadudicad'),
        trans('Días restantes')
      );
      $col_heads = Helper::putCustomHeads($this->form, $col_heads);
      $col_ids = Helper::getCustomColId($this->form);
      $values = Helper::fetchCustomValues($this->form);
      foreach ($transactions as $transaction) {
        if ($transaction->state == 1) {
          $cols = array(
            $transaction->type,
            number_format($transaction->monto, 2) . " USD",
            "<span style='color:green;'>Activa</span>",
            $transaction->created_at,
            $transaction->ends_at,
            "<span style='color:green;'>$transaction->remainingDays</span>"
          );
        } else {
          $cols = array(
            $transaction->type,
            number_format($transaction->monto, 2) . " USD",
            "<span style='color:red;'>Expirada</span>",
            $transaction->created_at,
            $transaction->ends_at,
            "<span style='color:red;'>$transaction->remainingDays</span>"
          );
        }
        $id = $transaction->id;

        foreach ($col_ids as $col_id)
          array_push($cols, isset($values[$id][$col_id]) ? $values[$id][$col_id] : '');
        $col_data[] = $cols;
      }
    }



    Helper::writeResult($col_data);

    return view('user.transactions', compact('col_heads'));
  }
  public function comisions()
  {
    $user = Auth::user();
    return view('user.comission', compact('user'));
  }


  public function setUsername(UsernameRequest $request)
  {
    $user = Auth::user();

    if (isset($user->username))
      return redirect()->back()->withErrors('You already have a username.');

    $user->username = $request->input('username');
    $user->save();

    return redirect()->back()->withSuccess(config('constants.SAVED'));
  }


  public function storeDirWallet(Request $request)
  {

    $user = DB::table('users')
      ->where('id', Auth::user()->id)
      ->update(['dirWallet' => $request['wallet']]);
    return redirect('/');
  }


  public function show(User $user)
  {

    if (!Entrust::hasRole('admin'))
      $user = User::whereId(Auth::user()->id)->first();

    if (!$user)
      return redirect('/')->withErrors(config('constants.NA'));

    $profile = $user->Profile;
    $custom_field_values = Helper::getCustomFieldValues($this->form, $user->id);
    return view('user.show', compact('custom_field_values', 'user', 'profile'));
  }

  public function edit(User $user)
  {
    if (!Entrust::can('edit_user'))
      return redirect('/dashboard')->withErrors(config('constants.NA'));

    if (!Helper::getMode())
      return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

    foreach ($user->roles as $role)
      $role_id = $role->id;

    $roles = Role::lists('display_name', 'id')->all();

    $custom_field_values = Helper::getCustomFieldValues($this->form, $user->id);
    return view('user.edit', compact('user', 'roles', 'role_id', 'custom_field_values'));
  }

  public function profileUpdate(UserProfileRequest $request, $id)
  {

    if (Entrust::hasRole('admin'))
      $user = User::find($id);
    else
      $user = User::find(Auth::user()->id);

    if (!$user)
      return redirect('user')->withErrors(config('constants.INVALID_LINK'));

    if (!Helper::getMode())
      return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

    Activity::log('Profile updated');
    $profile = $user->Profile ?: new Profile;
    $photo = $profile->photo;
    $data = $request->all();
    $profile->fill($data);

    if ($request->hasFile('photo') && $request->input('remove_photo') != 1) {
      $filename = $request->file('photo')->getClientOriginalName();
      $extension = $request->file('photo')->getClientOriginalExtension();
      $file = $request->file('photo')->move('assets/user/' . DOMAIN . '/', $user->id . "." . $extension);
      $img = Image::make('assets/user/' . DOMAIN . '/' . $user->id . "." . $extension);
      $img->resize(200, null, function ($constraint) {
        $constraint->aspectRatio();
      });
      $img->save('assets/user/' . DOMAIN . '/' . $user->id . "." . $extension);
      $profile->photo = $user->id . "." . $extension;
    } elseif ($request->input('remove_photo') == 1) {
      File::delete('assets/user/' . DOMAIN . '/' . $profile->photo);
      $profile->photo = null;
    } else
      $profile->photo = $photo;

    Helper::updateCustomField($this->form, $user->id, $data);

    $user->profile()->save($profile);

    return redirect('/user/' . $id)->withSuccess(config('constants.SAVED'));
  }

  public function update(UserRequest $request, User $user)
  {
    if (!Entrust::can('edit_user'))
      return redirect('/dashboard')->withErrors(config('constants.NA'));

    if (!Helper::getMode())
      return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

    $data = $request->all();
    $profile = $user->Profile;
    $user->name_invited = $request->input('name_invited');
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $roles[] = $request->input('role_id');
    $user->roles()->sync($roles);
    $user->save();
    //$profile->save();
    Helper::updateCustomField($this->form, $user->id, $data);

    return redirect()->back()->withSuccess(config('constants.SAVED'));
  }

  public function changePassword()
  {
    $assets = ['hide_sidebar'];
    return view('auth.change_password', compact('assets'));
  }


  public function doChangePassword(Request $request)
  {
    if (!Helper::getMode())
      return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

    $this->validate($request, [
      'old_password' => 'required|valid_password',
      'new_password' => 'required|confirmed|different:old_password|min:4',
      'new_password_confirmation' => 'required|different:old_password|same:new_password'
    ]);
    $credentials = $request->only(
      'new_password',
      'new_password_confirmation'
    );

    $user = Auth::user();

    $user->password = bcrypt($credentials['new_password']);
    $user->save();
    return redirect('change_password')->withSuccess('Password has been changed!!');
  }

  public function doChangeUserPassword(Request $request, $id)
  {
    $user = User::find($id);

    if (!Helper::getMode())
      return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

    if (!Entrust::can('reset_user_password'))
      return redirect('/dashboard')->withErrors(config('constants.NA'));

    $this->validate($request, [
      'new_password' => 'required|confirmed|min:4',
      'new_password_confirmation' => 'required|same:new_password'
    ]);
    $credentials = $request->only(
      'new_password',
      'new_password_confirmation'
    );

    $user->password = bcrypt($credentials['new_password']);
    $user->save();
    return redirect()->back()->withSuccess('Password has been changed!!');
  }

  public function destroy(User $user)
  {

    if (!Entrust::can('delete_user'))
      return redirect('/dashboard')->withErrors(config('constants.NA'));

    if (!Helper::getMode())
      return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

    if ($user->id == Auth::user()->id)
      return redirect('/user')->withErrors('You cannot delete yourself!! ');

    Helper::deleteCustomField($this->form, $user->id);
    $user->delete();
    return redirect('/user')->withSuccess(config('constants.DELETED'));
  }

  public function testDept(Request $request)
  {
    $user = DB::table('users')
      ->where('username', $request['user']['username'])->first();

    $transaction = DB::table('transactions')
      ->where('users_id', $user->id)->get();

    $countLevel = 0;
    $username = strtolower($user->username);
    $name_invited = strtolower($user->name_invited);
    $monto = $request['monto'];


    if ($user) {
      if (count($transaction) == 0 && $monto >= 1000) {
        DB::table('users')
          ->where('username', $username)
          ->update(['thirdLevel' => 1]);
      }
      if ($user->name_invited != 'nada') {
        $countLevel++;
        $this->esLider($username, $name_invited, $countLevel, $monto);
      } else {
        $this->asignarComision($countLevel, $username, $name_invited, $monto);
      }
      // $transaction = DB::table('transactions')
      // ->where('users_id', $user->id)->first();
      // DB::table('transactions')
      //   ->insert([
      //     'monto' => $monto,
      //     'state' => 1,
      //     'users_id' => $user->id,
      //     'remainingDays' => $transaction->remainingDays,
      //     'ends_at' => date("Y-m-d H:i:s", strtotime($dateNow . "+ " . $transaction->remainingDays . " days")),
      //     'transactions_types_id' => 2,
      //     'created_at' => $dateNow
      //   ]);

      return response()->json([
        'status' => "OK",
        'msg' => "correct transaction"
      ], 200);
    } else {
      return response()->json([
        'status' => "false",
        'msg' => "El usuario no existe"
      ], 401);
    }
  }
  public function esLider($username, $name_invited, $level, $monto)
  {
    $padre = DB::table('users')->where('username', $name_invited)->first();
    if ($padre->leader || $level == 3) {
      $this->asignarComision($level, $username, $name_invited, $monto);
    } else {
      $level++;
      $this->esLider($username, $padre->name_invited, $level, $monto);
    }
  }
  public function asignarComision($level, $username, $name_invited, $monto)
  {
    $usuario = DB::table('users')->where('username', $username)->first();
    $dateNow = date("Y-m-d H:i:s");
    $levelOneComission = $monto * 0.05;
    $levelTwoComission = $monto * 0.03;
    $levelThreeComission = $monto * 0.02;
    if ($level == 0) {
      $dailyRoi = $monto * 0.015;
      $dateFinish = date("Y-m-d H:i:s", strtotime($dateNow . "+ 200 days"));
      $remainingDays = 200;
      DB::table('users')
        ->where('username', $username)
        ->increment('renta_fija', $dailyRoi);
    } else if ($level == 1) {
      $dailyRoi = ($monto - $levelOneComission) * 0.015;
      $dateFinish = date("Y-m-d H:i:s", strtotime($dateNow . "+ 215 days"));
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
    } else if ($level == 2) {
      $dailyRoi = ($monto - $levelOneComission - $levelTwoComission) * 0.015;
      $dateFinish = date("Y-m-d H:i:s", strtotime($dateNow . "+ 218 days"));
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
    } else {

      $dailyRoi = ($monto - $levelOneComission - $levelTwoComission) * 0.015;
      $userSecondLevel = DB::table('users')->where('username', $usuario->name_invited)->first();
      $dateFinish = date("Y-m-d H:i:s", strtotime($dateNow . "+ 218 days"));
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
      $lastUserComission = DB::table('users')->where('username', $name_invited)->first();

      if ($lastUserComission->thirdLevel) {
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
}
