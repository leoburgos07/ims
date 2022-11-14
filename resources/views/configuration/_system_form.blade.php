			<div class="col-sm-6">
			  <div class="form-group">
			    {!! Form::label('application_name','Nombre aplicacion',[])!!}
				{!! Form::input('text','application_name',(config('config.application_name')) ? : '',['class'=>'form-control','placeholder'=>'Ingrese nombre de aplicacion'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('application_title','Titulo de aplicacion',[])!!}
				{!! Form::input('text','application_title',(config('config.application_title')) ? : '',['class'=>'form-control','placeholder'=>'Ingrese titulo aplicacion'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('facebook_page_link','Pagina de Facebook enlace',[])!!}
				{!! Form::input('text','facebook_page_link',(config('config.facebook_page_link')) ? : '',['class'=>'form-control','placeholder'=>'Ingrese enlace de facebook'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('twitter_page_link','Pagina Twitter enlace',[])!!}
				{!! Form::input('text','twitter_page_link',(config('config.twitter_page_link')) ? : '',['class'=>'form-control','placeholder'=>'Ingrese enlace de Twitter'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('credit',trans('Credito'),[])!!}
			    {!! Form::textarea('credit',(config('config.credit')) ? : '',['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Credito Contenido'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('enable_registration','Habilitar Registro',['class' => 'col-sm-6 control-label'])!!}
				  <div class="col-sm-6">
					    <div class="radio">
							<label>
								{!! Form::radio('enable_registration', 1, (config('config.enable_registration')) ? 'checked' : '') !!} si
							</label>
							<label>
								{!! Form::radio('enable_registration', 0, (!config('config.enable_registration')) ? 'checked' : '') !!} No
							</label>
						</div>
				  </div>
			  </div>
			  <div class="form-group">
			    {!! Form::label('email_activation','Activación Obligatorio',['class' => 'col-sm-6 control-label'])!!}
				  <div class="col-sm-6">
					    <div class="radio">
							<label>
								{!! Form::radio('email_activation', 1, (config('config.email_activation')) ? 'checked' : '') !!} si
							</label>
							<label>
								{!! Form::radio('email_activation', 0, (!config('config.email_activation')) ? 'checked' : '') !!} No
							</label>
						</div>
				  </div>
			  </div>
			  <div class="form-group">
			    {!! Form::label('show_terms_and_conditions','Mostrar T&C',['class' => 'col-sm-6 control-label'])!!}
				  <div class="col-sm-6">
					    <div class="radio">
							<label>
								{!! Form::radio('show_terms_and_conditions', 1, (config('config.show_terms_and_conditions')) ? 'checked' : '') !!} si
							</label>
							<label>
								{!! Form::radio('show_terms_and_conditions', 0, (!config('config.show_terms_and_conditions')) ? 'checked' : '') !!} No
							</label>
						</div>
				  </div>
			  </div>
			  <div class="form-group">
			    {!! Form::label('show_datetime_in_footer','Mostrar Fecha Hora de pie de página',['class' => 'col-sm-6 control-label'])!!}
				  <div class="col-sm-6">
					    <div class="radio">
							<label>
								{!! Form::radio('show_datetime_in_footer', 1, (config('config.show_datetime_in_footer')) ? 'checked' : '') !!} si
							</label>
							<label>
								{!! Form::radio('show_datetime_in_footer', 0, (!config('config.show_datetime_in_footer')) ? 'checked' : '') !!} No
							</label>
						</div>
				  </div>
			  </div>
			  <div class="form-group">
			    {!! Form::label('show_timezone_in_footer','Mostrar Zona horaria en el pie',['class' => 'col-sm-6 control-label'])!!}
				  <div class="col-sm-6">
					    <div class="radio">
							<label>
								{!! Form::radio('show_timezone_in_footer', 1, (config('config.show_timezone_in_footer')) ? 'checked' : '') !!} si
							</label>
							<label>
								{!! Form::radio('show_timezone_in_footer', 0, (!config('config.show_timezone_in_footer')) ? 'checked' : '') !!} No
							</label>
						</div>
				  </div>
			  </div>
			</div>
			<div class="col-sm-6">
			  <div class="form-group">
			    {!! Form::label('error_display','Error de visualizacion',['class' => 'col-sm-4 control-label '])!!}
				<div class="col-sm-8">
					<div class="radio">
						<label>
							{!! Form::radio('error_display', true, (config('config.error_display')) ? 'checked' : '') !!} verdadero
						</label>
						<label>
							{!! Form::radio('error_display', false, (!config('config.error_display')) ? 'checked' : '') !!} falso
						</label>
					</div>
				</div>
			  </div>
			  <div class="form-group">
			    {!! Form::label('date_format','Formato de fecha',['class' => 'col-sm-4 control-label'])!!}
				<div class="col-sm-8">
					<div class="radio">
						<label>
							{!! Form::radio('date_format', 'dd mm YYYY', (config('config.date_format') == 'dd mm YYYY') ? 'checked' : '') !!} dd mm YYYY ({!! date('d m Y') !!})
						</label>
					</div>
					<div class="radio">
						<label>
							{!! Form::radio('date_format', 'mm dd YYYY', (config('config.date_format') == 'mm dd YYYY') ? 'checked' : '') !!} mm dd YYYY ({!! date('m d Y') !!})
						</label>
					</div>
					<div class="radio">
						<label>
							{!! Form::radio('date_format', 'dd MM YYYY', (config('config.date_format') == 'dd MM YYYY') ? 'checked' : '') !!} dd MM YYYY ({!! date('d M Y') !!})
						</label>
					</div>
					<div class="radio">
						<label>
							{!! Form::radio('date_format', 'MM dd YYYY', (config('config.date_format') == 'MM dd YYYY') ? 'checked' : '') !!} MM dd YYYY ({!! date('M d Y') !!})
						</label>
					</div>
				</div>
			  </div>
			  <div class="form-group">
			    {!! Form::label('time_format','formato de tiempo',['class' => 'col-sm-4 control-label'])!!}
				<div class="col-sm-8">
					<div class="radio">
						<label>
							{!! Form::radio('time_format', '24hrs', (config('config.time_format') == '24hrs') ? 'checked' : '') !!} 24 Horas
						</label>
						<label>
							{!! Form::radio('time_format', '12hrs', (config('config.time_format') == '12hrs') ? 'checked' : '') !!} 12 Horas
						</label>
					</div>
				</div>
			  </div>
			  <div class="form-group">
			    {!! Form::label('installation_path','Ruta de instalacion',['class' => 'col-sm-4 control-label'])!!}
				  <div class="col-sm-8">
					<div class="radio">
						<label>
							{!! Form::radio('installation_path', 1, (config('config.installation_path')) ? 'checked' : '') !!} Habilitar
						</label>
						<label>
							{!! Form::radio('installation_path', 0, (!config('config.installation_path')) ? 'checked' : '') !!} inhabilitar
						</label>
					</div>
				  </div>
			  </div>
			  <div class="form-group">
			    {!! Form::label('timezone_id',trans('Zona horaria'),[])!!}
				{!! Form::select('timezone_id', [null=>'Please Select'] + $timezones,(config('config.timezone_id')) ? : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Seleccione zona horaria'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('default_currency',trans('Por defecto moneda'),[])!!}
				{!! Form::input('text','default_currency',(config('config.default_currency')) ? : '',['class'=>'form-control','placeholder'=>'Igrese por defecto moneda'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('default_currency_symbol',trans('Por defecto Símbolo monetario'),[])!!}
				{!! Form::input('text','default_currency_symbol',(config('config.default_currency_symbol')) ? : '',['class'=>'form-control','placeholder'=>'Ingrese por defecto simbolo monetario'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('default_language',trans('Idioma predeterminado'),[])!!}
				{!! Form::select('default_language', [null=>'Please Select'] + $languages,(config('config.default_language')) ? : 'en',['class'=>'form-control input-xlarge select2me','placeholder'=>'Seleccione lenguaje'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('direction',trans('Direccion'),[])!!}
				{!! Form::select('direction', ['ltr'=>'De izquierda a derecha',
					'rtl' => 'De derecha a izquierda'],(config('config.direction')) ? : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Seleccione hora'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('allowed_upload_file',trans('Por defecto Tipo de carga de archivos'),[])!!}
				{!! Form::input('text','allowed_upload_file',(config('config.allowed_upload_file')) ? : '',['class'=>'form-control','placeholder'=>'Ingrese tipo de carga de archivos'])!!}
			  	<p class="help-box">{!! trans('Extensión de archivo separado por comas') !!}</p>
			  </div>
			  <div class="form-group">
			    {!! Form::label('allowed_upload_max_size',trans('Por defecto tamaño'),[])!!}
				{!! Form::input('text','allowed_upload_max_size',(config('config.allowed_upload_max_size')) ? : '',['class'=>'form-control','placeholder'=>'Ingrese por defecto tamaño '])!!}
			  </div>
			  	{!! Form::hidden('config_type','system')!!}
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('Guardar'),['class' => 'btn btn-primary']) !!}
			</div>
			<div class="clear"></div>