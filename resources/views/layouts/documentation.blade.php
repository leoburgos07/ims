@include('layouts.head')

	<body class="tooltips">
	
	<div class="container">
		<div class="logo-brand header sidebar rows">
			<div class="logo">
				<h1><a href="{!! URL::to('/') !!}"><img src="{!! URL::to('/assets/img/logo-bw.png') !!}" alt="Logo"> Administrador de tareas</a></h1>
				<button class="sidebar-toggle">palanca</button>
			</div>
		</div>

		
		<div class="left side-menu sidebar" id="left-content">
			
			
            <div class="body rows scroll-y">
				
                <div class="sidebar-inner slimscroller">
				
					<div id="sidebar-menu">
						<ul>
							<li><a href="{!! URL::to('/dashboard') !!}"><i class="fa fa-home icon"></i> Tablero</a></li>
							<li><a href="{!! URL::to('/documentation') !!}"><i class="fa fa-question-circle icon"></i> Documentación</a></li>
							<li><a href="{!! URL::to('/') !!}"><i class="fa fa-key icon"></i> Iniciar sesión
</a></li>
						</ul>
						<div class="clear"></div>
					</div>
				</div>
            </div>
			
            <div class="footer rows animated fadeInUpBig">
				<div class="logo-brand header sidebar rows">
					<div class="logo">
						<h1><a href="{!! URL::to('/') !!}"><img src="{!! URL::to('/assets/img/logo-bw.png') !!}" alt="Logo"> Administrador de tareas</a></h1>
						<button class="sidebar-toggle">palanca</button>
					</div>
				</div>
            </div>
        </div>
		
        <div class="right content-page" id="right-content">

			
            <div class="body content rows scroll-y">
				
				@yield('content')
			
				@include('layouts.footer')	
            </div>
        </div>
	</div>

	@include('layouts.foot')	

		
	
	
	