@extends('layouts.default')

@section('content')
<head>
	{!! HTML::style('assets/css/activity.css') !!}
</head>
<body>
	<div class="panel panel-default table-responsive">
		<div class="panel-body">
			<table id="ventas" class="table table-condensed text-justify table table-hover table-striped" style ="border:0px; border-top:1px solid #ddd; border-bottom:1px solid #ddd;">
				<thead class="text-capitalize">
					<tr>
						<th class="active" style="text-align: center;">Operaciones</th>
						<th class="active" style="text-align: center;">Nombre De Empresa</th>
						<th class="active" style="text-align: center;">Nombre De APP</th>
						<th class="active" style="text-align: center;">Nombre De cliente</th>
						<th class="active" style="text-align: center;">Descripcion De App</th>
						<th class="active" style="text-align: center;">Valor App</th>
					</tr>

				</thead>

				<tbody>
					@foreach($ventas as $ven)
					<tr>
						<td> 

							<div class="btn-group btn-group-xs">
							<a href="?boxinfo={{$ven->id}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="Registro de Actividades"> <i class="fa fa-bars"></i></a> 
							<a href="ventaEdit/{{$ven->id}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
							<a href="ventaEliminar/{{$ven->id}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-remove"></i></a>
							</div>
						</td>
						<td class="active" style="text-align: center;">{{$ven->nom_empresa}}</td>
						<td class="active" style="text-align: center;">{{$ven->nom_app}}</td>
						<td class="active" style="text-align: center;">{{$ven->nom_cli}}</td>
						<td class="active" style="text-align: center;">{{$ven->desc_app}}</td>
						<td class="active" style="text-align: center;">{{$ven->valor_app}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			
			{!! str_replace('/?', '?', $ventas->render()) !!}
		</div>
	</div>	
	
	<div id="loggedout">
    	<a id="connectLink" href="#">conectar a trello</a>
	</div>

	<div id="loggedin">
    	<div id="header">
        	Sesión iniciada como <span id="fullName"></span> 
     		<a id="disconnect" href="#">Cerrar sesión</a>
   		</div>
    
    	<div id="output"></div>
	</div>


	<script src="http://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
  	<script src="https://api.trello.com/1/client.js?key=0d50588c7ceee19476cb60f3d61aa6fc"></script>

<script type="text/javascript">
  	
  	var onAuthorize = function() {
    
    updateLoggedIn();
    $("#output").empty();
    
    Trello.members.get("me", function(member){
        $("#fullName").text(member.fullName);
    
        var $cards = $("<div>")
            .text("Loading Cards...")
            .appendTo("#output");

        // Output a list of all of the cards that the member 
        // is assigned to
        Trello.get("members/me/cards", function(cards) {
            $cards.empty();
            $.each(cards, function(ix, card) {
                $("<a>")
                .attr({href: card.url, target: "trello"})
                .addClass("card")
                .text(card.name)
                .appendTo($cards);
            });  
        });
    });

};

var updateLoggedIn = function() {
    var isLoggedIn = Trello.authorized();
    $("#loggedout").toggle(!isLoggedIn);
    $("#loggedin").toggle(isLoggedIn);        
};
    
var logout = function() {
    Trello.deauthorize();
    updateLoggedIn();
};
                          
Trello.authorize({
    interactive:false,
    success: onAuthorize
});

$("#connectLink")
.click(function(){
    Trello.authorize({
        type: "popup",
        success: onAuthorize
    })
});
    
$("#disconnect").click(logout);

</script>

	<?php

		if (!empty($_GET['boxinfo'])) {
			mostrarActividad($_GET['boxinfo']);
		}

		function mostrarActividad($id){
		
			$clientes = DB::select("SELECT * FROM ventas WHERE id = :id", ['id'=>$id]);

			echo "<div class='panel panel-default table-responsive'>";
			echo "<div class='panel-body'>";
			
	  		
			foreach($clientes as $cliente){

				$actividades = DB::select ("SELECT * FROM actividades WHERE username = :user AND venta_id = :ventas", ['user'=>$cliente->user_name, 'ventas'=>$cliente->id]);

				if ($actividades != null){
					echo "<div class='comments-container'>";
					echo "<h4>Registro de actividades</h4>";
					echo "<ul id='comments-list' class='comments-list'>";
				}	

				foreach($actividades as $actividad){
					?>
					<li>
						<div class='comment-main-level'>
								<!-- Contenedor del Comentario -->
							<div class='comment-box'>
								<div class='comment-head'>
									<h6 class='comment-name by-author'><a href='#'>{{$actividad->username}}</a></h6>
									<span></span>
								</div>
								<div class='comment-content'>
									{{$actividad->actividad}}
								</div>
							</div>
						</div>
					</li>
					<?php
				}
				echo "</ul>";
				echo "</div>";
			}
			
			echo Form::open(array('url' => 'guardaractividad', 'method' => 'POST'));
	  		echo "<div class='form-group'>";
	  		echo Form::hidden('id', $id);
	  		echo Form::textarea('actividad',null,['class'=>'form-control','placeholder'=>'Ingrese Nueva Actividad','required']);
	  		echo "</div>";
	  		echo "<div class='form-group'>";
	  		echo Form::submit('Guardar', ['class'=>'btn btn-primary']);
	  		echo "</div>";
	  		echo Form::close();
				
			echo "</div>";
			echo "</div>";

		}
	?>
<body>

@stop