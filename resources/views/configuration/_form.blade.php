			<div class="col-sm-6">
			  <div class="form-group">
			    {!! Form::label('company_name',trans('Empresa'),[])!!}
				{!! Form::input('text','company_name',(config('config.company_name')) ? : '',['class'=>'form-control','placeholder'=>'nombre de empresa'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('contact_person',trans('Persona de contacto'),[])!!}
				{!! Form::input('text','contact_person',(config('config.contact_person')) ? : '',['class'=>'form-control','placeholder'=>'persona de contacto'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('email',trans('messages.Email'),[])!!}
				{!! Form::input('email','email',(config('config.email')) ? : '',['class'=>'form-control','placeholder'=>'Ingrese Email'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('phone',trans('Telefono'),[])!!}
				{!! Form::input('number','phone',(config('config.phone')) ? : '',['class'=>'form-control','placeholder'=>'Ingrese telefono'])!!}
			  </div>
			</div>
			<div class="col-sm-6">
			  <div class="form-group">
			    {!! Form::label('city',trans('Ciudad'),[])!!}
				{!! Form::input('text','city',(config('config.city')) ? : '',['class'=>'form-control','placeholder'=>'ingrese ciudad'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('state',trans('Departamento'),[])!!}
				{!! Form::input('text','state',(config('config.state')) ? : '',['class'=>'form-control','placeholder'=>'Departamento'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('zipcode',trans('Código postal'),[])!!}
				{!! Form::input('text','zipcode',(config('config.zipcode')) ? : '',['class'=>'form-control','placeholder'=>'Ingrese Código postal'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('country_id',trans('Pais'),[])!!}
				{!! Form::select('country_id', [null=>'Seleccione'] + $countries,(config('config.country_id')) ? : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Company'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('address',trans('Direccion'),[])!!}
			    {!! Form::textarea('address',(config('config.address')) ? : '',['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Ingrese Direccion'])!!}
			  </div>
			  	{!! Form::hidden('config_type','general')!!}
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('Guardar'),['class' => 'btn btn-primary']) !!}
			</div>
			<div class="clear"></div>