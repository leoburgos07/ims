					<div class="media">
						<a class="pull-left" href="#fakelink">
							{!! \App\Classes\Helper::getAvatar($user->id) !!}
						</a>
						<div class="media-body" >
							@if(isset($welcome))
							{!! trans('Bienvenido!') !!},
							@endif
							@if(isset($name))
							<h4 class="media-heading"><strong>{!! ($user->name) ? ucwords($user->name) : ucwords($user->username) !!}</strong></h4>
							@endif
							@if(isset($role))
							<span>
								@foreach($user->roles as $role)
									<strong>{!! $role->display_name !!}</strong>
								@endforeach
							</span><br />
							@endif
							@if(isset($email))
							<span>{!! $user->email !!}</span><br />
							@endif
							@if(isset($edit_profile))
							<a class="md-trigger" href="{!! URL::to('/user/'.Auth::user()->id) !!}">Editar perfil</a> <br />
							@endif
							@if(isset($logout))
							<a class="md-trigger" href="{!! URL::to('/logout') !!}">Cerrar Sesion</a> <br />
							@endif
							@if(isset($last_login))
							<?php $total = $user->comision + $user->renta_fija ?>
							<a href="#">{!! trans('Comision: ') !!} <br />${!! $total !!} + ${!! $user->renta_temporal !!}</a>
							@endif
						</div>
					</div>