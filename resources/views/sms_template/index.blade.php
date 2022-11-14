@extends('layouts.default')

	@section('content')
		<div class="row">
        <div class="col-md-12">
            <div class="box box-solid box-primary">
				<div class="box-body">

					<div class="row">
						<div class="col-md-5">
							<ul class="ver-inline-menu tabbable margin-bottom-10">
								@foreach($sms_templates as $key => $template)
								<li class="@if(head($sms_templates) == $template) active @endif">
									<a data-toggle="tab" href="#tab_{!! $key !!}">
									<i class="fa fa-check"></i> {!! \App\Classes\Helper::toWord($key) !!} </a>
								</li>
								@endforeach
							</ul>
						</div>
						<div class="col-md-7">
							<div class="tab-content">
								@foreach($sms_templates as $key => $template)
								<div id="tab_{!! $key !!}" class="tab-pane @if(head($sms_templates) == $template) active @endif">
									<div id="accordion1" class="panel-group">
										<div class="panel panel-primary">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1">
												Actualizar "{!! \App\Classes\Helper::toWord($key) !!}" Plantilla</a>
												</h4>
											</div>
											<div id="accordion1_1" class="panel-collapse collapse in">
												<div class="panel-body">
													{!! Form::model($template,['method' => 'PATCH','route' => ['sms_template.update',$key] ,'class' => 'template-form']) !!}
														
													  <div class="form-group">
													    {!! Form::label('template_description','SMS Content',[])!!}
													    {!! Form::textarea('template_description',(array_key_exists($key,$template_content)) ? $template_content[$key] : '',['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Introduzca Descripcion'])!!}
													    <div class="help-block"><strong>los campos Disponibles</strong> : {!! config('sms_template.'.$key.'.fields') !!} <br /> Utilice todo dentro [ ]. Los campos son mayúsculas y minúsculas.</div>
													  </div>
													  	{!! Form::submit(isset($buttonText) ? $buttonText : 'Guardar',['class' => 'btn btn-primary']) !!}

													{!! Form::close() !!}
												</div>
											</div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>

	@stop