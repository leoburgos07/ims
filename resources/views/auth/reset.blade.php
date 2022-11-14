@extends('layouts.full')

    @section('content')
        <div class="full-content-center animated fadeInDownBig">
            <div class="login-wrap">
                <div class="box-info">
                <h2 class="text-center"><strong>{!! trans('Reiniciar') !!}</strong> {!! trans('Contarseña') !!}</h2>
                    
                    @if ($errors->has())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {!! $error !!}<br>        
                        @endforeach
                    </div>
                    @endif
                    @if(Session::has('message'))
                        <div class="alert alert-info">
                          {!!Session::get('message')!!}
                        </div>
                    @endif

                    <form role="form" action="{!! URL::to('/password/reset') !!}" method="post" class="reset-password-form">
                        <input type="hidden" name="token" value="{!! $token !!}">
                        {!! csrf_field() !!}
                        <div class="form-group login-input">
                        <i class="fa fa-sign-in overlay"></i>
                        <input type="text" name="email" id="email" class="form-control text-input" placeholder="Email">
                        </div>
                        <div class="form-group login-input">
                        <i class="fa fa-key overlay"></i>
                        <input type="password" name="password" i="password" class="form-control text-input" placeholder="Nueva contraseña">
                        </div>
                        <div class="form-group login-input">
                        <i class="fa fa-key overlay"></i>
                        <input type="password" name="password_confirmation" i="password_confirmation" class="form-control text-input" placeholder="Confirmar nueva contraseña">
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-unlock"></i> {!! trans('Restablecer la contraseña') !!}</button>
                            </div>
                        </div>
                    </form>
                    <p class="text-center"><a href="{!! URL::to('/') !!}"><i class="fa fa-lock"></i> {!! trans('Atrás para iniciar sesión') !!}</a></p>
                </div>
            </div>
        </div>
    @stop