			<div class="box-info">
		  <h2><strong>Facebook</strong> login
			  <div class="additional-box">
				{!! Form::submit(trans('Guardar'),['class' => 'btn btn-primary btn-sm pull-right']) !!}
			  </div>
		  </h2>
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <div class="checkbox">
				<label>
				  {!! Form::checkbox('facebook', 1,(config('config.facebook_login')) ? 'checked' : '',['id' => 'facebook']) !!} Habilitar Facebook
				</label>
			  </div>
			</div>
		  </div>
		  <div class="form-group">
		    {!! Form::label('facebook_cliente_id','Cliente Id',['class' => 'col-sm-2 control-label'])!!}
		    <div class="col-sm-10">
				{!! Form::input('text','facebook_cliente_id',(\App\Classes\Helper::getMode()) ? config('services.facebook.client_id') : '',['class'=>'form-control','placeholder'=>'Introduzca Facebook Client Id'])!!}
			</div>
		  </div>
		  <div class="form-group">
		    {!! Form::label('facebook_cliente_secreto','Cliente Secreto',['class' => 'col-sm-2 control-label'])!!}
		    <div class="col-sm-10">
				{!! Form::input('text','facebook_cliente_secreto',(\App\Classes\Helper::getMode()) ? config('services.facebook.client_secret') : '',['class'=>'form-control','placeholder'=>'Introduzca Facebook Client Secreto'])!!}
			</div>
		  </div>
		  <div class="form-group">
		    {!! Form::label('facebook_redirect','Redirect Path',['class' => 'col-sm-2 control-label'])!!}
		    <div class="col-sm-10">
				{!! Form::input('text','facebook_redirecto',(\App\Classes\Helper::getMode()) ? config('services.facebook.redirect') : '',['class'=>'form-control','placeholder'=>'Introduzca Facebookk Redirect Path'])!!}
			</div>
		  </div>
		</div>

		<div class="box-info">
		  <h2><strong>Google Plus</strong> Login
			  <div class="additional-box">
				{!! Form::submit(trans('Guardar'),['class' => 'btn btn-primary btn-sm pull-right']) !!}
			  </div>
		  </h2>
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <div class="checkbox">
				<label>
				  {!! Form::checkbox('google', 1,(config('config.google_login')) ? 'checked' : '',['id' => 'google']) !!} Habilitar Google Plus Login
				</label>
			  </div>
			</div>
		  </div>
		  <div class="form-group">
		    {!! Form::label('google_cliente_id','Cliente Id',['class' => 'col-sm-2 control-label'])!!}
		    <div class="col-sm-10">
				{!! Form::input('text','google_cliente_id',(\App\Classes\Helper::getMode()) ? config('services.google.cliente_id') : '',['class'=>'form-control','placeholder'=>'Ingrese Google Cliente Id'])!!}
			</div>
		  </div>
		  <div class="form-group">
		    {!! Form::label('google_cliente_secreto','Cliente Secreto',['class' => 'col-sm-2 control-label'])!!}
		    <div class="col-sm-10">
				{!! Form::input('text','google_cliente_secreto',(\App\Classes\Helper::getMode()) ? config('services.google.client_secret') : '',['class'=>'form-control','placeholder'=>'Ingrese Google Cliente Secreto'])!!}
			</div>
		  </div>
		  <div class="form-group">
		    {!! Form::label('google_redirect','Redirect Path',['class' => 'col-sm-2 control-label'])!!}
		    <div class="col-sm-10">
				{!! Form::input('text','google_redirect',(\App\Classes\Helper::getMode()) ? config('services.google.redirect') : '',['class'=>'form-control','placeholder'=>'Ingrese Google Redirect Path'])!!}
			</div>
		  </div>
		</div>

		<div class="box-info">
		  <h2><strong>Twitter</strong> Login
			  <div class="additional-box">
				{!! Form::submit(trans('Guardar'),['class' => 'btn btn-primary btn-sm pull-right']) !!}
			  </div>
		  </h2>
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <div class="checkbox">
				<label>
				  {!! Form::checkbox('twitter', 1,(config('config.twitter_login')) ? 'checked' : '',['id' => 'twitter']) !!} Habilitar Twitter login
				</label>
			  </div>
			</div>
		  </div>
		  <div class="form-group">
		    {!! Form::label('twitter_client_id','Cliente Id',['class' => 'col-sm-2 control-label'])!!}
		    <div class="col-sm-10">
				{!! Form::input('text','twitter_cliente_id',(\App\Classes\Helper::getMode()) ? config('services.twitter.client_id') : '',['class'=>'form-control','placeholder'=>'Introduzca Twitter Client Id'])!!}
			</div>
		  </div>
		  <div class="form-group">
		    {!! Form::label('twitter_cliente_secreto','Cliente Secreto',['class' => 'col-sm-2 control-label'])!!}
		    <div class="col-sm-10">
				{!! Form::input('text','twitter_cliente_secreto',(\App\Classes\Helper::getMode()) ? config('services.twitter.client_secret') : '',['class'=>'form-control','placeholder'=>'Introduzca Twitter Client Secret'])!!}
			</div>
		  </div>
		  <div class="form-group">
		    {!! Form::label('twitter_redirect','Redirect Path',['class' => 'col-sm-2 control-label'])!!}
		    <div class="col-sm-10">
				{!! Form::input('text','twitter_redirect',(\App\Classes\Helper::getMode()) ? config('services.twitter.redirect') : '',['class'=>'form-control','placeholder'=>'Introduzca Twitter Redirect Path'])!!}
			</div>
		  </div>
		</div>

		<div class="box-info">
		  <h2><strong>Github</strong> Login
			  <div class="additional-box">
				{!! Form::submit(trans('Guardar'),['class' => 'btn btn-primary btn-sm pull-right']) !!}
			  </div>
		  </h2>
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <div class="checkbox">
				<label>
				  {!! Form::checkbox('github', 1,(config('config.github_login')) ? 'checked' : '',['id' => 'github']) !!} Habilitar Github Login
				</label>
			  </div>
			</div>
		  </div>
		  <div class="form-group">
		    {!! Form::label('github_client_id','Cliente Id',['class' => 'col-sm-2 control-label'])!!}
		    <div class="col-sm-10">
				{!! Form::input('text','github_cliente_id',(\App\Classes\Helper::getMode()) ? config('services.github.client_id') : '',['class'=>'form-control','placeholder'=>'Enter Github Client Id'])!!}
			</div>
		  </div>
		  <div class="form-group">
		    {!! Form::label('github_cliente_secreto','Cliente Secreto',['class' => 'col-sm-2 control-label'])!!}
		    <div class="col-sm-10">
				{!! Form::input('text','github_cliente_secreto',(\App\Classes\Helper::getMode()) ? config('services.github.client_secret') : '',['class'=>'form-control','placeholder'=>'Introduzca Github cliente Secreto'])!!}
			</div>
		  </div>
		  <div class="form-group">
		    {!! Form::label('github_redirect','Redirect Path',['class' => 'col-sm-2 control-label'])!!}
		    <div class="col-sm-10">
				{!! Form::input('text','github_redirect',(\App\Classes\Helper::getMode()) ? config('services.github.redirect') : '',['class'=>'form-control','placeholder'=>'Introduzca Github Redirect Path'])!!}
			</div>
		  </div>
		</div>