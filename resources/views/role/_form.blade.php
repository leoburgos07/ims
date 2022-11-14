			@if(!isset($role))
			  <div class="form-group">
			    {!! Form::label('name','Rol',[])!!}
				{!! Form::input('text','name',isset($role->name) ? $role->name : '',['class'=>'form-control','placeholder'=>'Ingrese el rol'])!!}
			  </div>
			@endif
			  <div class="form-group">
			    {!! Form::label('display_name','Nombre de Rol',[])!!}
				{!! Form::input('text','display_name',isset($role->display_name) ? $role->display_name : '',['class'=>'form-control','placeholder'=>'Ingrese el nombre de rol'])!!}
			  </div>
			  	{!! Form::submit(isset($buttonText) ? $buttonText : 'Guardar rol',['class' => 'btn btn-primary']) !!}
