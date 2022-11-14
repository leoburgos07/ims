@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-12">
				<div class="box-info">
					<h2><strong>{!! trans('Editar') !!}</strong> {!! trans('Evento') !!}
					<div class="additional-btn">
					{!! delete_form(['todo.destroy',$todo->id]) !!}
					</div>
					</h2>
					{!! showMessage() !!}
					{!! Form::model($todo,['method' => 'PATCH','route' => ['todo.update',$todo->id] ,'class' => 'todo-form']) !!}
						@include('todo._form', ['buttonText' => 'Guardar'])
					{!! Form::close() !!}
				</div>
			</div>
		</div>
		<div class="clear"></div>
	@stop
