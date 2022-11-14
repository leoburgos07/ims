@include('layouts.head')


	<!-- BODY -->
	<body class="tooltips k-rtl">
	
	<!-- BEGIN PAGE -->

	
		<!-- BEGIN CONTENT -->
        <div class="right-full content-page">

        <div class="imgContent">
                <img class="imgMask bottomImg" src="{{asset('assets/img/newResources/IMS-Bg-decoration-1.png')}}" alt="">
                <img class="imgMask topLogo"src="{{asset('assets/img/newResources/Logo-vivo-02.png')}}" alt="">
                <img class="imgMask topImg" src="{{asset('assets/img/newResources/IMS-Bg-decoration-2.png')}}" alt="">
                <img class="imgMask rightBottomImg" src="{{asset('assets/img/newResources/Mascara3.png')}}" alt="">
            </div>
			<!-- ============================================================== -->
			<!-- START YOUR CONTENT HERE -->
			<!-- ============================================================== -->
            <div class="body content rows scroll-y contentSmall">
				<!-- Agregar el  yield('content') -->
				
                    @yield('content')
                <!-- Aqui se incluia layouts.footer -->
			
					
            </div>
			<!-- ============================================================== -->
			<!-- END YOUR CONTENT HERE -->
			<!-- ============================================================== -->
			
			
        </div>
		<!-- END CONTENT -->
		

	<!-- END PAGE -->

	<div class="modal fade" id="myTodoModal" role="basic" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			</div>
		</div>
	</div>
	
	@include('layouts.foot')	

		
	
	
	