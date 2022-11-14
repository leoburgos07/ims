			<!-- BEGIN CONTENT HEADER -->
            <div class="header content rows-content-header">
			
				<!-- Button mobile view to collapse sidebar menu -->
				<button class="button-menu-mobile show-sidebar">
					<i class="fa fa-bars"></i>
				</button>
                
				
				<!-- BEGIN NAVBAR CONTENT-->				
				<div class="navbar navbar-default flip" role="navigation">
					<div class="">
						<!-- Navbar header -->

                            <?php 
                                $comision = Auth::user()->comision + Auth::user()->renta_fija;
								$totalComissions = DB::table('transactions')
									->select(DB::raw('sum(monto) as total'))
									->where('state',1)
									->where('users_id', Auth::user()->id)
									->where('transactions_types_id',"!=",1)
									->first();
								
                            ?>
							
							<div class="col-md-10 dataBox">
							
								@if (Auth::user()->dirWallet)
								<p class="texto-azul">BIENVENIDO <b>{!! Auth::user()->name !!}</b>  <br> <b>WALLET:</b>  {!! Auth::user()->wallet !!} USD<img src="{{asset('assets/img/newResources/moneda.png')}}" width="35" height="35" alt=""></p>
								@else
                                <p class="texto-azul">BIENVENIDO <b>{!! Auth::user()->name !!}</b> <br> <b>WALLET:</b>  {!! Auth::user()->wallet !!} USD<img src="{{asset('assets/img/newResources/moneda.png')}}" width="35" height="35" alt=""> @if(!Entrust::hasRole('admin')) <a href="/addWallet" class="btn btn-danger">Agregar Dir. de Cartera</a> @endif</p>
								<!-- <img src="http://plataforma.virtualsystem.co/um2/um2/public/assets\images\logovapp.png" class="img-rounded" style="alt:70px; width:125px; margin-left:63px;"> -->
								@endif
							
							</div>
                           <a href="{!! URL::to('./dashboard') !!}"><img src="{{asset('assets/img/newResources/Logo-vivo-02.png')}}" width="95" height="95" class="logoTopResponsive" alt=""></a> 
                            
						
						<!--	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<i class="fa fa-angle-double-down"></i>
							</button> -->
							<!--@if (in_array('hide_sidebar',$assets))
							<a href="/" class="navbar-brand" style="margin-left:5px;"><i class="fa fa-sign-in fa-2x logo-icon"></i> <strong>{!! config('config.application_name') !!}</strong></a>
							@endif-->
                            @if (in_array('hide_sidebar',$assets))

								@if(Auth::check() && !Entrust::hasRole('user'))
								<a href="/dashboard">Tablero</a>
								@endif
							
							@endif
                            <div class="rightAvatar">
                            @if (Auth::check())
								@if(!Entrust::hasRole('user'))
                                
								
                           <!--     <div class="eventResponsive">
                                <a href="./todo" data-toggle='modal' data-target='#myTodoModal' ><img src="{{asset('assets/img/newResources/Icon material-event.png')}}" width="35px" height="35px" alt=""></a></a>
                                </div> 
                                <div class="boxCreateEvent">
                                    
                                    <a href="./todo" data-toggle='modal' data-target='#myTodoModal'  >
                                        <img src="{{asset('assets/img/newResources/Rectangulo 852.png')}}" width="200" height="60px" alt="">
                                        <span class="text-event">
                                        AÑADIR EVENTO 
                                         <img src="{{asset('assets/img/newResources/Icon material-event.png')}}" width="35px" height="35px" alt=""></a>
                                        </span> 
                                </div> -->
								@endif


								<!-- Dropdown User session -->
                                
                                <div class="dropdown">
                                <a class="pull-left topAvatar" href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    {!! \App\Classes\Helper::getAvatar(Auth::user()->id) !!}
                                </a>
									<!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">Bienvenido, <strong>{!! Auth::user()->name !!}</strong> <i class="fa fa-chevron-down i-xs"></i></a>-->
									<ul class="dropdown-menu animated half flipInX">
										@if(isset(Auth::user()->username))
											<li><a href="{!! URL::to('/change_password') !!}">Cambiar la contraseña</a></li>
										@endif
										<li><a href="{!! URL::to('/logout') !!}">Cerrar sesión</a></li>
									</ul>
                                
                                </div>
								
							@endif
                            </div>
	
						
						
					</div><!-- End div .container -->
				</div>
				<!-- END NAVBAR CONTENT-->
            </div>
			<!-- END CONTENT HEADER -->
				