@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-9">
				<div class="box-info">
					<h2><strong>{!! trans('listar todos los') !!}</strong> {!! trans('Campos personalizados') !!}
					</h2>
					@include('common.datatable',['col_heads' => $col_heads])
				</div>
			</div>
			<div class="col-sm-3">
				<div class="box-info">
				<h2><strong>{!! trans('Agregar nuevo') !!}</strong> {!! trans('Campos personalizados') !!}
					</h2>
					{!! Form::open(['route' => 'custom_field.store','role' => 'form', 'class'=>'designation-form']) !!}
					
					  <div class="form-group">
					    {!! Form::label('form',trans('formulario'),[])!!}
						{!! Form::select('form', [
							''=>'',
							'user-form' => 'Regitrar formulario'
							],'',['class'=>'form-control input-xlarge select2me','placeholder'=>'Seleccione formulario'])!!}
					  </div>
					  <div class="form-group">
					    {!! Form::label('field_type',trans('Tipo de campo'),[])!!}
						{!! Form::select('field_type', [
							''=>'',
							'text' => 'Text Box',
							'number' => 'Number',
							'email' => 'Email',
							'url' => 'URL',
							'select' => 'Select Box',
							'radio' => 'Radio Button',
							'checkbox' => 'Check Box',
							'textarea' => 'Textarea'
							],'',['id' => 'field_type', 'class'=>'form-control input-xlarge select2me','placeholder'=>'Seleccione tipo de campo'])!!}
					  </div>
					  <div class="showhide-textarea">
						<div class="form-group">
						    {!! Form::label('field_value',trans('messages.Options'),[])!!}
						    {!! Form::textarea('field_value','',['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Enter Options'])!!}
							<div class="help-block">Enter values separated by comma(,).</div>
						</div>
					  </div>
					  <div class="form-group">
					    {!! Form::label('field_title',trans('Titulo campo'),[])!!}
						{!! Form::input('text','field_title','',['class'=>'form-control','placeholder'=>'Ingrese titulo campo'])!!}
					  </div>
					  <div class="form-group">
					   <div class="checkbox">
							<label>
							  <input type="checkbox" name="field_required" value="1"> requerido
							</label>
						</div>
					  </div>
					  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('Agregar'),['class' => 'btn btn-primary pull-right']) !!}
	
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	@stop