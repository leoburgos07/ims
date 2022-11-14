		<!-- BEGIN SIDEBAR -->
		<div class="left side-menu">
			
			
            <div class="body rows scroll-y">
				
				<!-- Scrolling sidebar -->
                <div class="sidebar-inner slimscroller" style="background:white">
                    
				
				<!-- @include('auth.user_detail',['user' => Auth::user(),'edit_profile' => 1, 'role' => 1,'welcome' => '1', 'logout' => '1', 'last_login' => '0']) -->

				@if(config('constants.MODE') == 0)
					<center><a href="http://codecanyon.net/item/x/13760351?ref=wmlabs" class="btn btn-success btn-md" role="button">Buy Now</a></center>
				@endif
					<!-- Sidebar menu -->				
					<div id="sidebar-menu">
						
						<ul>
						<!--	<li ><a href="{!! URL::to('./dashboard') !!}" class="buttonSidebar"> <img src="{{asset('assets/img/newResources/Icon material-home.png')}}" class="imgAzul" alt="" width="30" height="30"> <span class="textButtonSidebar">{!! trans('Tablero de Instrumentos') !!} <img src="{{asset('assets/img/newResources/Icon material-home8.png')}}" class="imgWhite" width="30" height="30"></span></a></li> -->
							<li><a href="{!! URL::to('/arbol') !!}" class="buttonSidebar"><img src="{{asset('assets/img/newResources/Icon awesome-seedling.png')}}" class="imgAzul" alt="" width="30" height="30"><span class="textButtonSidebar">{!! trans('Consultar mi Arbol') !!} <img src="{{asset('assets/img/newResources/Icon awesome-seedling8.png')}}" class="imgWhite" width="30" height="30"></span></a></li>
						<!--	<li><a href="" class="buttonSidebar"><img src="{{asset('assets/img/newResources/Icon awesome-user-tie.png')}}" class="imgAzul" alt="" width="30" height="30"><span class="textButtonSidebar">{!! trans('Clientes') !!} <img src="{{asset('assets/img/newResources/Icon awesome-user-tiet.png')}}" class="imgWhite" width="30" height="30"></span></a>
							<ul>
							<li><a href="{!! URL::to('/cliente') !!}" class=""><img src="{{asset('assets/img/newResources/add clientes.png')}}" class="imgAzul" alt="" width="30" height="30"> {!! trans('Crear clientes') !!}</a></li>
							<li><a href="{!! URL::to('/ventaC') !!}" class=""><img src="{{asset('assets/img/newResources/lista cliente.png')}}" class="imgAzul" alt="" width="30" height="30"> {!! trans('Listar clientes') !!}</a></li>
                            
							</ul> -->
                            <li><a href="{!! URL::to('/comisiones') !!}" class="buttonSidebar"><img src="{{asset('assets/img/newResources/moneda color.png')}}" class="imgAzul" alt="" width="30" height="30"><span class="textButtonSidebar"> {!! trans('Comisiones') !!} <img src="{{asset('assets/img/newResources/Grupo 3490.png')}}" class="imgWhite" width="30" height="30"></span></a></li>
							<li><a href="{!! URL::to('/transacciones') !!}" class="buttonSidebar"><img src="{{asset('assets/img/newResources/icono-moneypaper-blue.svg')}}" class="imgAzul" alt="" width="30" height="30"><span class="textButtonSidebar"> {!! trans('Transacciones') !!} <img src="{{asset('assets/img/newResources/icono-moneypaper-white.svg')}}" class="imgWhite" width="30" height="30" style="color:red ;"></span></a></li>
							@if(Entrust::can('manage_user'))
								<li><a href="" class="buttonSidebar"><img src="{{asset('assets/img/newResources/Icon awesome-users.png')}}" class="imgAzul" alt="" width="30" height="30"> <span class="textButtonSidebar">{!! trans('Usuarios') !!} <img src="{{asset('assets/img/newResources/Icon awesome-usersee.png')}}" class="imgWhite" width="30" height="30"></span></a>
							
								<ul>

									<li><a href="{!! URL::to('/user') !!}"><img src="{{asset('assets/img/newResources/lista cliente.png')}}" class="imgAzul" alt="" width="30" height="30"> {!! trans('Listar Usuarios') !!}</a></li>
									<!--
									@if(Entrust::can('create_user'))
									<li><a href="{!! URL::to('/user/create') !!}"><i class="fa fa-angle-right"></i> {!! trans('Agregar nuevo') !!} </a></li>
									@endif
									<li><a href="http://plataforma.virtualsystem.co/um2/um2/public/user"><i class="fa fa-angle-right"></i> {!! trans('messages.List All Users') !!}</a></li>
									@foreach(\App\Role::get() as $role)
									<li><a href="{!! URL::to('./user/list/'.$role->name) !!}"><i class="fa fa-angle-right"></i> List {!! $role->display_name !!} </a></li>
									@endforeach
									-->
								</ul>
							</li>
							
							@endif
							@if(Entrust::hasRole('admin'))
								<li><a href="{!! URL::to('./configuration') !!}" class="buttonSidebar"><img src="{{asset('assets/img/newResources/Icon ionic-ios-settings.png')}}" class="imgAzul" alt="" width="30" height="30"> <span class="textButtonSidebar">{!! trans('Configuración') !!} <img src="{{asset('assets/img/newResources/Icon ionic-ios-settings8.png')}}" class="imgWhite" width="30" height="30"></span></a></li>
								<li><a href="{!! URL::to('./custom_field') !!}" class="buttonSidebar"><img src="{{asset('assets/img/newResources/Icon material-edit.png')}}" class="imgAzul" alt="" width="30" height="30"> <span class="textButtonSidebar">{!! trans('Campos personalizados') !!} <img src="{{asset('assets/img/newResources/Icon material-editd.png')}}" class="imgWhite" width="30" height="30"></span></a></li>
								<li><a href="{!! URL::to('./template') !!}" class="buttonSidebar"><img src="{{asset('assets/img/newResources/Icon material-email.png')}}" class="imgAzul" alt="" width="30" height="30"> <span class="textButtonSidebar">{!! trans('Plantillas de correo') !!} <img src="{{asset('assets/img/newResources/Icon material-email-1.png')}}" class="imgWhite" width="30" height="30"></span></a></li>
							<!--	<li><a href="{!! URL::to('./sms_template') !!}" class="buttonSidebar"><img src="{{asset('assets/img/newResources/Icon material-phone-iphone.png')}}" class="imgAzul" alt="" width="30" height="30"> <span class="textButtonSidebar">{!! trans('Plantillas de SMS') !!} <img src="{{asset('assets/img/newResources/Icon material-phone-iphone-1.png')}}" class="imgWhite" width="30" height="30"></span></a></li> -->
							@else
							@if(Auth::user()->dirWallet)
							<li><a href="{!! URL::to('./addWallet') !!}" class="buttonSidebar"><img src="{{asset('assets/img/newResources/wallet-solid colores-azul.svg')}}" class="imgAzul" alt="" width="30" height="30"> <span class="textButtonSidebar">{!! trans('Consultar Dir de Wallet') !!} <img src="{{asset('assets/img/newResources/wallet-solid colores-blanco.svg')}}" class="imgWhite" width="30" height="30"></span></a></li>
							<li><a href="https://t.me/IMSeeds_bot" class="buttonSidebar" target="blank"><img src="{{asset('assets/img/newResources/deposito-blanco.svg')}}" class="imgAzul" alt="" width="40" height="40"> <span class="textButtonSidebar">{!! trans('Depositar dinero') !!} <img src="{{asset('assets/img/newResources/deposito-azul.svg')}}" class="imgWhite" width="40" height="40"></span></a></li>
							<li><a href="https://t.me/IMSeeds_bot" class="buttonSidebar" target="blank"><img src="{{asset('assets/img/newResources/retiro azul.svg')}}" class="imgAzul" alt="" width="40" height="40"> <span class="textButtonSidebar">{!! trans('Retirar dinero') !!} <img src="{{asset('assets/img/newResources/retiro-blanco.svg')}}" class="imgWhite" width="40" height="40"></span></a></li>
							@else
							<li><a href="{!! URL::to('./addWallet') !!}" class="buttonSidebar" id="buttonDanger"><img src="{{asset('assets/img/newResources/wallet-solid colores-rojo.svg')}}" class="imgAzul" alt="" width="30" height="30"> <span class="textButtonSidebar">{!! trans('Agregar Dirección de Wallet') !!} <img src="{{asset('assets/img/newResources/wallet-solid colores-blanco.svg')}}" class="imgWhite" width="30" height="30"></span></a></li>
							@endif
							@endif
								
							
							
						</ul>
						<div class="clear"></div>
					</div><!-- End div #sidebar-menu -->
				</div><!-- End div .sidebar-inner .slimscroller -->
            </div><!-- End div .body .rows .scroll-y -->
			
			<!-- Sidebar footer -->
            <div class="footer rows animated fadeInUpBig">
				<div class="logo-brand header sidebar rows">
					<div class="boxBottomLogout">
                    <a href="{!! URL::to('/logout') !!}" class="bottomLogout"> CERRAR SESIÓN <img src="{{asset('assets/img/newResources/Icon feather-log-out.png')}}" width="25" height="25" alt=""> </a>
						
					</div>
				</div>
            </div><!-- End div .footer .rows -->
        </div>
		<!-- END SIDEBAR -->

		<script>
			$(document).ready(function(){
				$(".buttonSidebar").click(function(){
					alert("si");
					$(".imgAzul").css("display", "none");
					}
				);
			});
		</script>