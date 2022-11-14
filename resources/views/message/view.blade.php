@extends('layouts.default')

	@section('content')
		<div class="box-info box-messages">
			<div class="row">
				<div class="col-md-2">
					<a href="http://plataforma.virtualsystem.co/um2/um2/public/message/compose" class="btn btn-warning btn-block md-trigger"><i class="fa fa-edit"></i> Componer</a>
					<div class="list-group menu-message">
					  <a href="http://plataforma.virtualsystem.co/um2/um2/public/message" class="list-group-item active">
						Bandeja de entrada<strong>({!! $count_inbox !!})</strong>
					  </a>
					  <a href="http://plataforma.virtualsystem.co/um2/um2/public/message/sent" class="list-group-item">Expedido<strong>({!! $count_sent !!})</strong></a>
					</div>
				</div>
				
				
				<div class="col-md-10">
					
					<p class="text-right"><strong>{!! date('d M Y, h:i A',strtotime($message->Creado en)) !!}</strong></p>
						<table class="table">
							<tbody>
								<tr>
									<td colspan="2">
										<a href="{!! URL::to('/message/'.$message->id.'/delete/'.$token) !!}" class="btn btn-danger btn-sm alert_delete"><i class="fa fa-trash-o"></i> Basura</a>
									</td>
								</tr>
								<tr>
									<td style="width: 100px;"><strong>{!! ($message_type == 'sent') ? 'To' : 'From' !!}</strong></td>
									<td>{!! $user->name !!}</td>
								</tr>
								<tr>
									<td><strong>Sujeto</strong></td>
									<td>{!! $message->subject !!}</td>
								</tr>
								<tr>
									<td colspan="2">
									<p style="text-align: justify">
									{!! $message->content!!}
									</p>
									</td>
								</tr>
								@if($message->attachment)
								<tr>
									<td><strong>Attachment</strong></td>
									<td><a href="{!! URL::to('/assets/attachments/'.$message->attachment) !!}"><strong>Descargar</strong></a></td>
								</tr>
								@endif
							
							</tbody>
						</table>

					
				</div><!-- End div .col-md-10 -->
			</div><!-- End div .row -->
		</div><!-- End div .box-info -->
		<!-- End inbox -->




	@stop