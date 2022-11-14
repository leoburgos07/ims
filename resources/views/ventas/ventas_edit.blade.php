@extends('layouts.default')

	@section('content')
		@include('alerts.request')

		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('Editar') !!} </strong> {!! trans('Ventas') !!}</h2>
					
			     		{!!Form::model($ventas,['url'=> ['/wentas/update', $ventas->id],'method'=>'PUT'])!!}
						
						<div class="form-group">
						{!! Form::label('nombre Empresa:')!!}
						{!! Form::text('nom_empresa',null,['class'=>'form-control','placeholder'=>'ingrese Nombre de Empresa'])!!}	
						</div>

						<div class="form-group">
						{!! Form::label('nombre App:')!!}
						{!! Form::text('nom_app',null,['class'=>'form-control','placeholder'=>'ingrese Nombre de App'])!!}	
						</div>

						<div class="form-group">
						{!! Form::label('Nombre Cliente:')!!}
						{!! Form::text('nom_cli',null,['class'=>'form-control','placeholder'=>'ingrese Nombre Cliente'])!!}	
						</div>

						<div class="form-group">
						{!! Form::label('Descripcion App:')!!}
						{!! Form::textarea('desc_app',null,['class'=>'form-control','placeholder'=>'Ingrese Descripcion App'])!!}	
						</div>

						<div class="form-group">
						{!! Form::label('Valor app:')!!}
						{!! Form::text('valor_app',null,['class'=>'form-control','placeholder'=>'ingrese Valo App'])!!}	
						</div>

						{!!Form::submit('Editar',['class'=>'btn btn-primary']) !!}

						{!!Form::Close()!!}
				</div>
			</div>		
		</div>



@stop