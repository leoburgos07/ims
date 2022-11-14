			<div class="col-sm-6">
			  <div class="form-group">
			    {!! Form::label('sid','SID',[])!!}
				{!! Form::input('text','sid',(config('twilio.sid')) ? : '',['class'=>'form-control','placeholder'=>'Introduzca Twilio SID'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('token','Token',[])!!}
				{!! Form::input('text','token',(config('twilio.token')) ? : '',['class'=>'form-control','placeholder'=>'Introduzca Twilio Token'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('from','Id del remitente',[])!!}
				{!! Form::input('text','from',(config('twilio.from')) ? : '',['class'=>'form-control','placeholder'=>'Introduzca id Remitente'])!!}
			  </div>
			  {!! Form::hidden('config_type','sms')!!}
			{!! Form::submit(isset($buttonText) ? $buttonText : trans('Guardar'),['class' => 'btn btn-primary']) !!}
			</div>
			<div class="col-sm-6">
			</div>
			<div class="clear"></div>
