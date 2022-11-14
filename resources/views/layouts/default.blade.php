@include('layouts.head')


	<!-- BODY -->
	<body class="tooltips k-rtl">
	
	<!-- BEGIN PAGE -->
	<div class="container">
		<!-- Your logo goes here -->
		<div class="logo-brand header sidebar rows">
			<div class="logo">
                <img src="{{asset('assets/img/newResources/Mascara3.png')}}" class="mask3" alt="">
                <img src="{{asset('assets/img/newResources/Logo-vivo-02.png')}}" class="logoHeader" alt="">
				<!-- <h1><a href="{!! URL::to('/') !!}"><i class="fa fa-sign-in fa-2x logo-icon"></i>  {!! config('config.application_name').' '.config('constants.VERSION') !!}</a></h1> -->
				
			</div>
		</div><!-- End div .header .sidebar .rows -->

		@include('layouts.sidebar')
		
		<!-- BEGIN CONTENT -->
        <div class="right content-page">

			@include('layouts.header')	
			
			<!-- ============================================================== -->
			<!-- START YOUR CONTENT HERE -->
			<!-- ============================================================== -->
            <div class="body content rows scroll-y">
				
				@yield('content')
			
				@include('layouts.footer')	
            </div>
			<!-- ============================================================== -->
			<!-- END YOUR CONTENT HERE -->
			<!-- ============================================================== -->
			
			
        </div>
		<!-- END CONTENT -->
		
	</div><!-- End div .container -->
	<!-- END PAGE -->

	<div class="modal fade" id="myTodoModal" role="basic" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			</div>
		</div>
	</div>
	
	@include('layouts.foot')	

		
	
	
	