<?php

namespace App\Http\Controllers;

use App\Ventas;
use Illuminate\Http\Request;
use App\Http\Requests\VentaCrearRequest;
use App\Http\Requests\VentaUpdateRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Auth;
use DB;
class VentasController extends Controller{
 
    public function index(){
    	$usuario = Auth::user();
        $username = $usuario->username;
    
        $ventas = ventas::where('user_name','=',$username)->paginate(10);
        return view('ventas.listar_ventas',compact('ventas'));
    }

 
    public function create(){
        
        return view('ventas.ventas_create');
    }

  
    public function store(VentaCrearRequest $request){
         
         $usuario = Auth::user();
         $username = $usuario->username;
         Ventas::create([
            'user_name' => $username,
            'nom_empresa' => $request['nom_empresa'],
            'nom_app' => $request['nom_app'], 
            'nom_cli' => $request['nom_cli'],
            'desc_app' => $request['desc_app'],
            'valor_app' => $request['valor_app'],
            ]);
         
         return redirect('/ventaC');
    }

 
    public function show($id)
    {
        
    }

   
    public function edit($id)
    {
        $ventas_edit = ventas::find($id);
        return view('ventas.ventas_edit',['ventas'=>$ventas_edit]);
    }

   
    public function update(VentaUpdateRequest $request, $id)
    {
        $ventas_edit = ventas::find($id);
        $ventas_edit -> fill($request->all());
        $ventas_edit -> save();
        return redirect('/ventaC');
    }

 
    public function destroy($id)
    {
        ventas::destroy($id);
        return redirect('/ventaC');
    }
    
    public function actividad(Request $request)
    {
    
    	$usuario = Auth::user();
        $username = $usuario->username;
        
        DB::table('actividades')->insert(['username' => $username, 'venta_id' => $request['id'], 'actividad' => $request['actividad']]);
    	
    	return redirect('/ventaC?boxinfo='.$request['id']);
    }
    
}