@extends('layouts.default')

	@section('content')
		
<div class="body content rows scroll-y">
	@include('alerts.request')			
	<div class="container">	
			<div class="row">
				<div class="col-sm-8">
				<div class="col-md-7">
					<div class="box-info">
						<h2><strong>{!! trans('Agregar') !!} </strong> {!! trans('Ventas') !!}</h2>
						
				     		{!!Form::open(['route'=>'ventas.store', 'method'=>'POST'])!!}
							<!--<div class="form-group">
							<label for="foto_app">Foto</label><br>
				       		<input type="file" name="foto_app" id="photo" class="btn btn-default" title="Seleccionar foto" >
							</div>
							-->
							<div class="form-group">
							{!! Form::label('nombre Empresa:')!!}
							{!! Form::text('nom_empresa',null,['class'=>'form-control','placeholder'=>'Ingrese Nombre de Empresa'])!!}	
							</div>
	
							<div class="form-group">
							{!! Form::label('nombre App:')!!}
							{!! Form::text('nom_app',null,['class'=>'form-control','placeholder'=>'Ingrese Nombre de App'])!!}	
							</div>
	
							<div class="form-group">
							{!! Form::label('Nombre Cliente:')!!}
							{!! Form::text('nom_cli',null,['class'=>'form-control','placeholder'=>'Ingrese Nombre Cliente'])!!}	
							</div>
	
							<div class="form-group">
							{!! Form::label('Descripcion App:')!!}
							{!! Form::textarea('desc_app',null,['class'=>'form-control','placeholder'=>'Ingrese Descripcion App'])!!}	
							</div>
	
							<div class="form-group">
							{!! Form::label('Valor app:')!!}
							{!! Form::text('valor_app',null,['class'=>'form-control','placeholder'=>'Ingrese Valor App'])!!}	
							</div>
	
							{!!Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
	
							{!!Form::Close()!!}
	
	
					</div>
				</div>
			</div>
		</div>	
</div>
						

@stop