@extends('layouts.default')

	@section('content')
		<div class="box-info box-messages">
			<div class="row">
				<div class="col-md-2">
					<a href="http://plataforma.virtualsystem.co/um2/um2/public/message/compose" class="btn btn-warning btn-block md-trigger"><i class="fa fa-edit"></i> Componer</a>
					<div class="list-group menu-message">
					  <a href="http://plataforma.virtualsystem.co/um2/um2/public/message" class="list-group-item active">
						Bandeja de entrada <strong>({!! $count_inbox !!})</strong>
					  </a>
					  <a href="http://plataforma.virtualsystem.co/um2/um2/public/message/sent" class="list-group-item">Expedido <strong>({!! $count_sent !!})</strong></a>
					</div>
				</div>
				
				
				<div class="col-md-10">
				{!! showMessage() !!}
					
					<!-- Message table -->
					{!! Form::open(['files'=>'true','route' => 'message.store','role' => 'form', 'class'=>'compose-form']) !!}
						<div class="form-group">
							{!! Form::select('to_user_id', [null=>'Por favor Seleccione'] + $user_list, '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Staff'])!!}
						</div>
						<div class="form-group">
							{!! Form::input('text','subject','',['class'=>'form-control','placeholder'=>'Asunto del mensaje'])!!}
						</div>
						<div class="form-group">
							{!! Form::textarea('content','',['class' => 'form-control summernote-small', 'placeholder' => 'Enter Description'])!!}
						</div>
						<div class="form-group">
							<input type="file" name="file" id="file" class="btn btn-default" title="Seleccionar archivos adjuntos">
						</div>
						<div class="row">
							<div class="col-xs-8">
								<button type="submit" class="btn btn-success btn-sm">Enviar</button>
								<a href="/message/create" class="btn btn-danger btn-sm">Descartar</a>
							</div>
						</div>	

					{!! Form::close() !!}
					<!-- End message table -->
					
				</div><!-- End div .col-md-10 -->
			</div><!-- End div .row -->
		</div><!-- End div .box-info -->
		<!-- End inbox -->




	@stop