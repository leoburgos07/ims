@extends('layouts.default')
@section('content')
    <head>
    	{!! HTML::style('assets/css/arbol.css') !!}
        <title>Arbol</title>
    </head>

    <?php
    function display_menus($name_invited)
    {   
        //Obtener usuarios invitados por el usuario logeado
        $users = DB::select('select * from users where name_invited = :invited', ['invited'=>$name_invited] );

        //Imprimir usuarios invitados por el usuario logeado
        echo "<ul>";
        foreach($users as $usuario)
        {
            if($usuario->username != ''){
                $name_invited = $usuario->username;
                echo "<li> <a class='treeAvatar' href='#'></a><small>".$usuario->username."</small>";
                
                $invitados = DB::select('select * from users where name_invited = :invited', ['invited'=>$name_invited] );
                    if($invitados != null)
                    {
                        display_menus($name_invited);
                    }                
                
                echo "</li>";
            }
        }
	echo "</ul>";
    }
    //Obtener datos de usuario logeado
    $user = Auth::user();	
    $username = $user->username;

    //Impresion de usuario logeado y llamado de metodo
    
    echo "<div class='row'>";
    echo "<div class='panel panel-default table-responsive'>";
    echo "<div class='box-info'>";
	
    echo "<h2><strong>Arbol</strong> Organizacional</h2>";
    echo "<div class='center-block'>";
    echo "<div class='tree'>";
    echo "<ul>";
    echo "<li  class='main'> <a class='treeAvatar' href='#'></a><small>".$username."</small>";
    $invitado = DB::select('select * from users where name_invited = :invited', ['invited'=>$username] );
    if($invitado != null)
    {
        display_menus($username);
    } 
    echo "</li>";
    echo "</ul>";
    echo "</div>";
    echo "</div>";
    
    echo "</div>";
    echo "</div>";
    echo "</div>";
    ?>

@push('head')
<!-- Scripts -->
<script src="{{ asset('assets/js/arbol.js')}}"></script>
@endpush
@stop
