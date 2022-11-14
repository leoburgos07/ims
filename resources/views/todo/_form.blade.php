			  <div class="form-group">
			    {!! Form::label('date',trans('Fecha'),[])!!}
				{!! Form::input('text','date',isset($todo->date) ? $todo->date : '',['class'=>'form-control datepicker-input','placeholder'=>'Introduzca Fecha','readonly' => 'true'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('todo_title',trans('Titulo'),[])!!}
				{!! Form::input('text','todo_title',isset($todo->todo_title) ? $todo->todo_title : '',['class'=>'form-control','placeholder'=>'Introduzca titulo'])!!}
			  </div>
				<div class="form-group">
				    {!! Form::label('todo_description',trans('Descripcion'),[])!!}
				    {!! Form::textarea('todo_description',isset($todo->todo_description) ? $todo->todo_description : '',['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Introduzca Descripción'])!!}
				</div>
				<div class="form-group">
				  {!! Form::label('visibility',trans('Visibilidad'),['class' => 'col-sm-2'])!!}
					<div class="col-sm-10">
						<label class="checkbox-inline">
							<input type="radio" name="visibility" id="visibility" value="private" checked> Privado
						</label>
						<label class="checkbox-inline">
							<input type="radio" name="visibility" id="visibility" value="public"> Público
						</label>
					</div>
					<div class="clear"></div>
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('Agregar'),['class' => 'btn btn-primary pull-right']) !!}
			  	<br />
			  	
