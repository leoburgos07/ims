<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Response;
use Spatie\Activitylog\Models\Activity;
use DB;
use Auth;
use Entrust;
use App\Classes\Helper;

class DashboardController extends Controller
{
   public function index(Request $request){

      $start_date = ($request->input('start_date')) ? : date('Y-m-d',strtotime('-30 days'));
      $end_date = ($request->input('end_date')) ? : date('Y-m-d',strtotime(date('Y-m-d')));

      $users = \App\User::where('id','!=',Auth::user()->id)->get();

      $user_list = array();
      foreach($users as $user)
        $user_list[$user->id] = $user->name;

      $query = DB::table('activity_log')
          ->join('users','users.id','=','activity_log.user_id')
          ->select(DB::raw('name,activity_log.created_at AS created_at,text,user_id'));

      if(!Entrust::hasRole('admin'))
          $query->where('user_id','=',Auth::user()->id);
      
      $activities = $query->latest()->limit(100)->get();

      $todos = \App\Todo::where('user_id','=',Auth::user()->id)
          ->orWhere(function ($query)  {
              $query->where('user_id','!=',Auth::user()->id)
                  ->where('visibility','=','public');
          })->get();

      $events = array();
      foreach($todos as $todo){
          $start = $todo->date;
          $title = 'Evento: '.$todo->todo_title.' '.$todo->todo_description;
          $color = '#0182C2';
          $url = './todo/'.$todo->id.'/edit';
          $events[] = array('title' => $title, 'start' => $start, 'color' => $color, 'url' => $url);
      }

      $assets = ['calendar'];

      return redirect('/arbol');

      /*return view('arbol/arbol',compact(
          'assets','activities','events','start_date','end_date','user_list'
          ));*/
   }
}