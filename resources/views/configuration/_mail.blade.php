			<div class="col-sm-6">
			  <div class="form-group">
			    {!! Form::label('driver','Driver',[])!!}
				{!! Form::select('driver', [
					null=>'Please Select',
					'mail' => 'mail',
					'smtp' => 'smtp',
					'sendmail' => 'sendmail',
					'mailgun' => 'mailgun',
					'mandrill' => 'mandrill',
					'log' => 'log'
					],(config('mail.driver')) ? : 'mail',['id' => 'mail_driver', 'class'=>'form-control input-xlarge select2me','placeholder'=>'Seleccione Mail Driver'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('from_address','Desde Direccion Email',[])!!}
				{!! Form::input('email','from_address',(config('mail.from.address')) ? : 'support@wmlab.in',['class'=>'form-control','placeholder'=>'Introduzca direccion'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('from_name','Nombre remitente',[])!!}
				{!! Form::input('text','from_name',(config('mail.from.name')) ? : 'WM Lab',['class'=>'form-control','placeholder'=>'Inroduzca remitente'])!!}
			  </div>
			  {!! Form::hidden('config_type','mail')!!}
			{!! Form::submit(isset($buttonText) ? $buttonText : trans('Guardar'),['class' => 'btn btn-primary']) !!}
			</div>
			<div class="col-sm-6">
				<div id="mail_configuration" class="mail_config">
					<div class="the-notes info"><h4>{!! trans('Ayuda') !!}</h4>
					Puede no ser capaz de enviar correos, si usted está utilizando esta aplicación en el servidor local. Una vez subido a
					servidor web en vivo, usted será capaz de enviar correo por este controlador electrónico. Es uno de los controladores electrónicos más fácil de enviar mail con configuración cero .
					</div>
				</div>
				<div id="sendmail_configuration" class="mail_config">
					<div class="the-notes info"><h4>{!! trans('Ayuda') !!}</h4>
					Puede no ser capaz de enviar, si usted está utilizando esta aplicación en el servidor local. Una vez subido a
					servidor web en vivo, usted será capaz de enviar correo por este controlador electrónico. Es uno de los controladores electrónicos más fácil de enviar mail con configuración cero .
					</div>
				</div>
				<div id="log_configuration" class="mail_config">
					<div class="the-notes info"><h4>{!! trans('Ayuda') !!}</h4>
					You won't be able to send mail by using this driver, but all your sent mail will be logged into laravel log file.
					</div>
				</div>
				<div id="smtp_configuration" class="mail_config">
				  <div class="form-group">
				    {!! Form::label('host','SMTP Host',[])!!}
					{!! Form::input('text','host',(config('mail.host')) ? : '',['class'=>'form-control','placeholder'=>'Introduzca SMTP Host'])!!}
				  </div>
				  <div class="form-group">
				    {!! Form::label('port','SMTP puerto',[])!!}
					{!! Form::input('text','port',(config('mail.port')) ? : '',['class'=>'form-control','placeholder'=>'Introduzca SMTP puerto'])!!}
				  </div>
				  <div class="form-group">
				    {!! Form::label('username','SMTP Nombre de usuario',[])!!}
					{!! Form::input('text','username',(config('mail.username')) ? : '',['class'=>'form-control','placeholder'=>'Introduzca SMTP Nombre de usuario'])!!}
				  </div>
				  <div class="form-group">
				    {!! Form::label('password','SMTP Contraseña',[])!!}
					{!! Form::input('text','password',(config('mail.password')) ? : '',['class'=>'form-control','placeholder'=>'Introduzca SMTP Contraseña'])!!}
				  </div>
					<div class="the-notes info"><h4>{!! trans('Ayuda') !!}</h4>
					Usted puede enviar un correo electrónico desde el servidor local como servidor web en vivo mediante el uso de este controlador electrónico.
 					Si desea utilizar configuración gmail , entonces usted tiene que configurar algunas de las preferencias de su cuenta de Gmail .
					</div>
				</div>
				<div id="mandrill_configuration" class="mail_config">
				  <div class="form-group">
				    {!! Form::label('mandrill_secret','Llave secreta',[])!!}
					{!! Form::input('text','mandrill_secret',(config('services.mandrill.secret')) ? : '',['class'=>'form-control','placeholder'=>'Introduzca Mandrill Clave secreta'])!!}
				  </div>
					<div class="the-notes info"><h4>{!! trans('Ayuda') !!}</h4>
					Usted puede enviar un correo electrónico desde el servidor local como servidor web en vivo mediante el uso de este controlador electrónico.
					Debe tener una cuenta de mandril de trabajo para el uso de este controlador..
					</div>
				</div>
				<div id="mailgun_configuration" class="mail_config">
				  <div class="form-group">
				    {!! Form::label('mailgun_domain','Dominio',[])!!}
					{!! Form::input('text','mailgun_domain',(config('services.mailgun.domain')) ? : '',['class'=>'form-control','placeholder'=>'Introduzca Mailgun Dominio'])!!}
				  </div>
				  <div class="form-group">
				    {!! Form::label('mailgun_secret','llave secreta',[])!!}
					{!! Form::input('text','mailgun_secret',(config('services.mailgun.secret')) ? : '',['class'=>'form-control','placeholder'=>'Introduzca Mailgun llave secreta'])!!}
				  </div>
					<div class="the-notes info"><h4>{!! trans('Ayuda') !!}</h4>
					Usted puede enviar un correo electrónico desde el servidor local como servidor web en vivo mediante el uso de este controlador electrónico.
Usted debe tener una 			cuenta mailgun de trabajo para el uso de este controlador.
					</div>
				</div>
			</div>
			<div class="clear"></div>