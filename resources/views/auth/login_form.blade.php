  <div class="">

  
  <form role="form" action="{!! URL::to('/login') !!}" method="post" class="login-form">
            {!! csrf_field() !!}
            <div class="form-group login-input">
            <img class="userIcon" src="{{asset('assets/img/newResources/Icon-awesome-user-lock.svg')}}" alt="">
                <input type="text" name="username" id="username" class="form-control text-input" placeholder="Nombre de usuario">
            </div>
            <div class="form-group login-input">
            <img class="lockIcon" src="{{asset('assets/img/newResources/Icon-ionic-ios-lock.svg')}}" alt="">
                <input type="password" name="password" id="password" class="form-control text-input" placeholder="Clave">
            </div>
            <p class="text-center text-muted text-decoration-none"><a href="{!! URL::to('/password/email') !!}">{!! trans('¿Olvidaste tu contraseña?') !!}</a></p>
           <!-- <div class="checkbox">
                <label>
                    <input type="checkbox"> {!! trans('Recordar') !!}
                </label>
            </div> -->

            <div class="row">
            @if(config('config.enable_registration'))
                <div class="col-sm-12 text-center registerBox">
                    <a href="./register" class="text-center"> {!! trans('¿No tienes cuenta?') !!} <b>{!! trans(' Registrate aquí') !!}</b></a>
                </div>
                @endif
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn loginButton"> {!! trans('Iniciar sesión') !!}</button>
                </div>
            </div>
        </form>


        @if(config('config.facebook_login'))
        <a href="{!! route('social.login', ['facebook']) !!}" class="btn btn-primary btn-block btn-facebook"><i class="fa fa-facebook"></i> Acceda con su cuenta Facebook</a>
        @endif
        @if(config('config.twitter_login'))
        <a href="{!! route('social.login', ['twitter']) !!}" class="btn btn-primary btn-block btn-twitter"><i class="fa fa-twitter"></i> Acceda con su cuenta de Twitter</a>
        @endif
        @if(config('config.google_login'))
        <a href="{!! route('social.login', ['google']) !!}" class="btn btn-primary btn-block btn-google-plus"><i class="fa fa-google-plus"></i> Acceda con su cuenta Google</a>
        @endif
        @if(config('config.github_login'))
        <a href="{!! route('social.login', ['github']) !!}" class="btn btn-primary btn-block btn-github"><i class="fa fa-github"></i> Acceda con su cuenta de Github</a>
        @endif

        

        </div>