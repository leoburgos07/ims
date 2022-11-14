<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use DB;
use Input;

class ValidatePayCode extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth/validate_code');
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function save($id, Request $request)
    {
        $users = DB::select('select * from users where id = :id', ['id'=>$id] );
        $codigo= $request->input('codigo');
        foreach($users as $user){
        	if ($user->pay_code == $codigo){
        	
        		DB::table('users')
		            ->where('id', $id)
		            ->update(['confirm_pay_code' => 1]);
		        return redirect('/');
        		
        	}else{
        		
        		return redirect()->back()->withErrors('Codigo no valido');
        		
        	}
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generate($id, Request $request)
    {
        
        DB::table('users')
            ->where('id', $id)
            ->update(['pay_code' => str_random(10)]);
            
        $plan= $request->input('plan');
        $paquete = $request->input('paquete');
        $users = DB::select('select * from users where id = :id', ['id'=>$id] );
        
        foreach($users as $user)
        {
            mail($user->email, "Codigo de Activacion", "Su codigo de activacion es ".$user->pay_code);
            $name_invited = $user->name_invited;
            $username = $user->username;
	    }
        //$this->resetComission();
        //$this->addComission($username, $name_invited, $paquete, $plan);
        return redirect('/user');				
    }
    public function addComission($username, $name_invited, $paquete, $plan)
    {
        $id_plan = $plan;
        $plan = DB::select("SELECT * FROM paquetes WHERE id = '$id_plan'");
        
        $renta_residual = $plan[0]->precio * 0.02;
        $renta_fija = $plan[0]->precio * 0.06;
        DB::table('comisiones')->insert([
            'username' => $username,
            'name_invited' => $name_invited,
            'id_tipo' => 2
        ]);
        
        DB::table('users')
            ->where('username', $username)
            ->update([
                'id_paquete' => $id_plan,
                'renta_fija' => $renta_fija
            ]);
           
            DB::table('users')
            ->where('username', $name_invited)
            ->increment('comision', $renta_residual);
    }
    public function resetComission(){
        $users = DB::table('users')->get();
        foreach($users as $user){
            DB::table('users')
            ->where('username', $user->username)
            ->update([
                'id_paquete' => NULL,
                'renta_temporal' => 0,
                'renta_fija' => 0,
                'comision' => 0
            ]);
        }
        DB::table('users')
            ->where('username','Admin')
            ->update([
                'id_paquete' => 4,
                'renta_fija' => 240
            ]);
        
        return redirect('/user');
    }
    
    private function comision($username, $name_invited, $paquete, $plan)
    {	
    
    	$id_plan = $plan;
        $plan = DB::select("SELECT * FROM paquetes WHERE id = '$id_plan'");
        $renta_fija = $plan[0]->precio * 0.06;
        $renta_residual = $plan[0]->precio * 0.02;
        if($paquete == 'uno' || $paquete == 'cinco')
        {
             DB::table('comisiones')->insert([
                'username' => $username,
                'name_invited' => $name_invited,
                'id_tipo' => 1
            ]);

            DB::table('users')
                ->where('username', $name_invited)
                ->increment('renta_temporal', 50);
        }else{
             DB::table('comisiones')->insert([
                'username' => $username,
                'name_invited' => $name_invited,
                'id_tipo' => 2
            ]);
            DB::table('users')
                ->where('username', $name_invited)
                ->increment('comision', $renta_residual);
        }
        DB::table('users')
            ->where('username', $username)
            ->update(['renta_fija'=> $renta_fija] );

        DB::table('users')
            ->where('username', $username)
            ->update(['id_paquete' => $id_plan]);

        $comision = DB::table('comisiones')
            ->where('username', $username)
            ->where('name_invited', $name_invited)
            ->get();
             if($name_invited != 'admin' && $paquete != 'diez' && $comision[0]->id_tipo == 1){
                 $this->asignacionComision($username, $name_invited, $plan, $paquete);
             }
    }

    private function asignacionComision($username, $name_invited, $plan, $paquete)
    {
        $renta_residual = $plan[0]->precio * 0.02;
        $padre = DB::table('users')->where('username',$name_invited)->get();
        $comision = DB::table('comisiones')
                ->where('username', $padre[0]->username)
                ->where('name_invited', $padre[0]->name_invited)
                ->get();
                if(count($comision) > 0){
                    if($comision[0]->id_tipo == 1)
                    {
                        $this->asignacionComision($padre[0]->username,$padre[0]->name_invited, $plan, $paquete);
                    }else{
            
                        DB::table('users')
                        ->where('username', $padre[0]->name_invited)
                        ->increment('comision', $renta_residual);
                    }
                }
        
        
    }
    private function consultas ($name_invited, $username, $paquete)
    {
    	$drop1 = DB::statement("DROP TABLE IF EXISTS comision1");
    	$drop2 = DB::statement("DROP TABLE IF EXISTS comision2");
 	    $comision1 = DB::statement("CREATE TABLE comision1 SELECT id, username, name_invited, created_at FROM users WHERE name_invited = '$name_invited' ORDER BY created_at LIMIT 0,2");
        $comision2 = DB::statement("CREATE TABLE comision2 SELECT id, username, name_invited, created_at FROM users WHERE name_invited = '$name_invited' ORDER BY created_at");
        $delete = DB::statement("DELETE FROM comision2 WHERE id in ( SELECT * FROM (SELECT id FROM comision1) as ti)");
        $comisiones = DB::select("SELECT * FROM comision2 WHERE username = '$username'"); 
        
        if ($comisiones != null)
        {
            if ($paquete == 'uno'){

            DB::table('users')
                ->where('username', $name_invited)
                ->increment('comision', 10 );
            
            }   
            if ($paquete == 'cinco'){
            
            DB::table('users')
                ->where('username', $name_invited)
                ->increment('comision', 10 );
            
            } 
            if ($paquete == 'diez'){
            
            DB::table('users')
                ->where('username', $name_invited)
                ->increment('comision', 30 );
            
            }
        }
        else{
        
        	$commisions = DB::select("SELECT * FROM users WHERE username = '$name_invited'");
        	foreach($commisions as $user)
        	{
        	
        		if ($user->name_invited != 'nada'){
        			$this->consultas($user->name_invited, $user->username, $paquete);
        		}
        	
        	}
        
        }
        
    }
}

//$comisiones = DB::select("SELECT * FROM comision1 WHERE username = '$username'");
        
        
        
        // if ($comisiones != null)
        // {

        //     if ($paquete == 'uno' || $paquete == 'cinco'){

        //         DB::table('users')
        //         ->where('username', $name_invited)
        //         ->update(['renta_fija' => 50]);
            
        //     }   
        //     if ($paquete == 'cinco'){
            
        //     DB::table('users')
        //         ->where('username', $name_invited)
        //         ->increment('comision', 50 );
            
        //     } 
        //     if ($paquete == 'diez'){
            
        //     DB::table('users')
        //         ->where('username', $name_invited)
        //         ->increment('comision', $plan[0]->precio * 0.02 );
        //     }
        //     DB::table('users')
        //         ->where('username', $username)
        //         ->increment('comision', $plan[0]->precio * 0.06 );
        //         DB::table('users')
        //         ->where('username', $username)
        //         ->update(['id_paquete' => $paquete]);

        // }
        // else{
        
        // 	$commisions = DB::select("SELECT * FROM users WHERE username = '$name_invited'");
        // 	foreach($commisions as $user)
        // 	{
        // 		if ($user->name_invited != 'nada'){
        // 			$this->consultas($user->name_invited, $user->username, $paquete);
                                            //leoburgos, fabio, cinco
        // 		}
        // 	}
        
        // }