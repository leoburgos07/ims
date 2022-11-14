@extends('layouts.full')

	@section('content')
		<div class="full-content-center animated fadeInDownBig">
            <div class="login-wrap">
                <div class="box-info">
					<h2 class="text-center"><strong>{!! trans('messages.Change') !!} </strong> {!! trans('messages.Clave') !!}</h2>
					{!! showMessage() !!}

					@if(isset(Auth::user()->username))
					{!! Form::open(['route' => 'change_password','role' => 'form', 'class' => 'change-password-form']) !!}
						
                        <div class="form-group login-input">
                        	<i class="fa fa-key overlay"></i>
                        	<input type="password" name="old_password" class="form-control text-input" placeholder="Introducir la contraseña actual">
                        </div>
                        <div class="form-group login-input">
	                        <i class="fa fa-key overlay"></i>
	                        <input type="password" name="new_password" id="new_password" class="form-control text-input" placeholder="Introduzca nueva contraseña">
                        </div>
                        <div class="form-group login-input">
	                        <i class="fa fa-key overlay"></i>
	                        <input type="password" name="new_password_confirmation" class="form-control text-input" placeholder="Introduzca Confirmar nueva contraseña">
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-unlock"></i> {!! trans('messages.Guardar') !!}</button>
                            </div>
                        </div>
                        
					{!! Form::close() !!}
					@else
						<div class="alert alert-danger">Usted todavía no ha configurado nombre de usuario. No se puede cambiar la contraseña</div>
					@endif
				</div>
			</div>
		</div>

	@stop