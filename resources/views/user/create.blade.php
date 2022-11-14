@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('Agregar nuevo') !!} </strong> {!! trans('Usuario') !!}</h2>
					
			        {!! showMessage() !!}

					<form method="POST" action="/auth/register" accept-charset="UTF-8" class="user-form">
    				  	{!! csrf_field() !!}
						  <div class="form-group">
						    {!! Form::label('name',trans('Nombre'),[])!!}
							{!! Form::input('text','name','',['class'=>'form-control','placeholder'=>'Ingrese su nombre'])!!}
						  </div>
						  <div class="form-group">
						    {!! Form::label('role_id',trans('messages.Role'),[])!!}
							{!! Form::select('role_id', [''=>''] + $roles,'',['class'=>'form-control input-xlarge select2me','placeholder'=>'Seleccione Rol'])!!}
						  </div>	
						  <div class="form-group">
						    {!! Form::label('username',trans('Nombre de usuario'),[])!!}
							{!! Form::input('text','username','',['class'=>'form-control','placeholder'=>'Introduzca su nombre de usuario'])!!}
							<div class="help-box">Debe ser única para cada usuario.</div>
						  </div>
						  <div class="form-group">
						    {!! Form::label('email',trans('messages.Email'),[])!!}
							{!! Form::input('text','email','',['class'=>'form-control','placeholder'=>'Ingrese Email'])!!}
							<div class="help-box">Debe ser única para cada usuario.</div>
						  </div>
						  <div class="form-group">
						    {!! Form::label('password',trans('messages.Password'),[])!!}
							{!! Form::input('password','password','',['class'=>'form-control','placeholder'=>'Introducir la contraseña'])!!}
							<div class="help-box">Mínimo 6 caracteres.</div>
						  </div>
						  <div class="form-group">
						    {!! Form::label('password_confirmation',trans('Confirmar contraseña'),[])!!}
							{!! Form::input('password','password_confirmation','',['class'=>'form-control','placeholder'=>'Ingrese Confirmar Contraseña'])!!}
						  </div>

			  			  {{ App\Classes\Helper::getCustomFields('user-form',$custom_field_values) }}
						  <div class="col-sm-offset-2 col-sm-10">
						  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('Guardar'),['class' => 'btn btn-primary']) !!}
						  </div>
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="the-notes info"><h4>{!! trans('Ayuda') !!}</h4>
					En este módulo , se puede añadir personal o usuarios. Una vez creaod podrá acceder sin ningún tipo de activación de correo electrónico. Mantenga recordar que
					registrada desde el enlace de registro de usuario puede o no puede requerir para activar su cuenta por la activación de correo electrónico. <br />
					Para el papel de usuario, Identificación del departamento no es necesario. Cada función puede tener permiso personalizado. El módulo de autorización puede ser
					se accede desde la pestaña de configuración.
				</div>
			</div>
		</div>

	@stop