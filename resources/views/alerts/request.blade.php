@if(count($errors) > 0)
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" arial-label="close"><span aria-hidden="true">&times;</span>
				</button>
				<ul>
					@foreach($errors->all() as $error)
					<li>{!!$error!!}</li>
					@endforeach
				</ul>
		@endif	
			</div>