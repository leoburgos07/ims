@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-12">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Edit') !!} </strong> {!! trans('Usuario') !!}</h2>
					{!! showMessage() !!}
					{!! Form::model($user,['method' => 'PATCH','route' => ['user.update',$user->id] ,'class' => 'user-form']) !!}
						  <div class="form-group">
						    <!--{!! Form::label('name_invited',trans('Me invito'),[])!!}-->
							{!! Form::input('hidden','name_invited',isset($user->name_invited) ? $user->name_invited : '',['class'=>'form-control','placeholder'=>''])!!}
						  </div>
						  <div class="form-group">
						    {!! Form::label('name',trans('Nombre'),[])!!}
							{!! Form::input('text','name',isset($user->name) ? $user->name : '',['class'=>'form-control','placeholder'=>'Ingrese su nombre'])!!}
						  </div>	
						  <div class="form-group">
						    {!! Form::label('role_id',trans('messages.Role'),[])!!}
							{!! Form::select('role_id', [''=>''] + $roles, isset($role_id) ? $role_id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Seleccione Rol'])!!}
						  </div>
						  <div class="form-group">
						    {!! Form::label('email',trans('messages.Email'),[])!!}
							{!! Form::input('text','email',isset($user->email) ? $user->email : '',['class'=>'form-control','placeholder'=>'Ingrese Email'])!!}
						  </div>
			  			  {{ App\Classes\Helper::getCustomFields('user-form',$custom_field_values) }}
						  <div class="col-sm-10">
						  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('Guardar'),['class' => 'btn btn-primary']) !!}
						  	{!! Form::close() !!}
						  </div>
						  <br />
						  <br />
						  <br />
						  <?php
						  	$planes = DB::select('select * from paquetes');
							
						  /*	if($user->confirm_pay_code == 0){
								
                              $url = URL::to("/user/generatepaycode/".$user->id);
						  		echo "<form action='$url' method='GET'>";
								
						  		echo "<div class='form-group '>";
						  		/*echo "<strong>Tipo de Invitado</strong> <br><br>";
						  		echo "<input type='radio' name='paquete' value='uno' checked> Calificado 1 (50 USD)<br><br>";
						  		echo "<input type='radio' name='paquete' value='cinco' > Calificado 2 (50 USD)<br><br>";
						  		echo "<input type='radio' name='paquete' value='diez' > Resitual (2%)<br><br>";
						  		echo "</div>";
								echo "<div class='form-group '>";
								if($user->id_paquete == null || $user->id_paquete == 5){
									echo "<strong>Paquetes</strong> <br><br>";
									foreach($planes as $plan){
										echo "<input type='radio' name='plan' value='$plan->id' checked> $plan->nombre ($plan->precio USD)<br><br>";
									}
									  echo "</div>";
								}

						  		echo "<div class='form-group'>";
						  		echo "<input type = 'submit' value = 'Generar Codigo de Activación' class='btn btn-danger'>";
						  		echo "</div>";
						  		echo "</form>";
						  	}*/
						  	
						  	?>
					
				</div>
			</div>
		</div>

	@stop