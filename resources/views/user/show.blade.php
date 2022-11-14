	@extends('layouts.default')
	
	@section('content')
		<div class="row">
			<div class="col-sm-3">
				<!-- Begin user profile -->
				<div class="box-info">
					@include('auth.user_detail',['user' => $user, 'name' => 1, 'email' => 1,'role' => 1])
				</div><!-- End div .box-info -->

				@if(Entrust::can('send_user_sms'))
					<div class="box-info">
						<h4>Send SMS</h4>
						{!! Form::model($user,['method' => 'PATCH','action' => ['SMSController@sendUserSMS',$user->id] ,'class' => 'sms-form', 'role' => 'form']) !!}
	    				  	<div class="form-group">
								{!! Form::textarea('sms','',['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Enter SMS','onkeyup'=>'countChar(this)','maxlength' => 160])!!}
				  				<div class="help-box" id="charNum"></div>
							</div>
							{!! Form::submit(isset($buttonText) ? $buttonText : 'Send SMS',['class' => 'btn btn-primary']) !!}
						{!! Form::close() !!}
						<script>
					      function countChar(val) {
					        var len = val.value.length;
					          $('#charNum').text(160 - len + ' characters left');
					      };
					    </script>
					</div>
				@endif
				@if(Entrust::can('reset_user_password'))
				<div class="box-info">
					<h4>Restablecer la contraseña</h4>
					{!! Form::model($user,['method' => 'PATCH','route' => ['change_user_password',$user->id] ,'class' => 'change-user-password-form']) !!}
					  <div class="form-group">
						{!! Form::input('password','new_password','',['class'=>'form-control','placeholder'=>'Introduzca nueva contraseña'])!!}
					  </div>
					  <div class="form-group">
						{!! Form::input('password','new_password_confirmation','',['class'=>'form-control','placeholder'=>'
						Introduzca Confirmar nueva contraseña'])!!}
					  </div>
					  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('Guardar'),['class' => 'btn btn-primary']) !!}
					{!! Form::close() !!}
				</div>
				@endif
				<!-- Begin user profile -->
			</div><!-- End div .col-sm-4 -->
			
			<div class="col-sm-9">
				<div class="box-info">
					<h2><strong>{!! trans('Información básica') !!}</strong></h2>
					{!! showMessage() !!}
							
						{!! Form::model($user,['files' => true, 'method' => 'PATCH','action' => ['UserController@profileUpdate',$user->id] ,'class' => 'user-profile-update-form', 'role' => 'form']) !!}
	    				  	<div class="col-sm-6">
		    				  	<div class="form-group">
								    {!! Form::label('contact_number',trans('Número de contacto'))!!}
									{!! Form::input('text','contact_number',isset($profile->contact_number) ? $profile->contact_number : '',['class'=>'form-control','placeholder'=>'Introduzca Contacto Número'])!!}
								</div>
								<div class="form-group">
								    {!! Form::label('alternate_contact_number',trans('Número de contacto alternativo'))!!}
									{!! Form::input('text','alternate_contact_number',isset($profile->alternate_contact_number) ? $profile->alternate_contact_number : '',['class'=>'form-control','placeholder'=>'Ingrese número de contacto alternativo'])!!}
								</div>
								<div class="form-group">
								    {!! Form::label('alternate_email',trans('Correo electrónico alternativo'))!!}
									{!! Form::input('email','alternate_email',isset($profile->alternate_email) ? $profile->alternate_email : '',['class'=>'form-control','placeholder'=>'Ingrese correo electrónico alternativa'])!!}
								</div>
								<div class="form-group">
								    {!! Form::label('address',trans('Dirección'),[])!!}
								    {!! Form::textarea('address',isset($profile->address) ? $profile->address : '',['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Introducir dirección'])!!}
								</div>
							</div>
							<div class="col-sm-6">
							  <div class="form-group">
							    {!! Form::label('timezone_id',trans('Zona horaria'),[])!!}
								{!! Form::select('timezone_id', [null=>'Por favor seleccione'] + config('timezone'),($profile->timezone_id) ? : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Seleccione Zona horaria'])!!}
							  </div>
		    				  	<div class="form-group">
									<input type="file" name="photo" id="photo" class="btn btn-default" title="Seleccionar foto de perfil">
									@if($profile->photo != null)
										<div class="checkbox">
											<label>
											  {!! Form::checkbox('remove_photo', 1) !!} {!! trans('Sacar fotos') !!}
											</label>
										</div>
									@endif
								</div>
							{{ App\Classes\Helper::getCustomFields('user-form',$custom_field_values) }}
							{!! Form::submit(isset($buttonText) ? $buttonText : trans('Guardar'),['class' => 'btn btn-primary']) !!}
							</div>
						{!! Form::close() !!}
						
				</div><!-- End div .box-info -->
			</div>
		</div>
				
	@stop