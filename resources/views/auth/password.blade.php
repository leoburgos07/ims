@extends('layouts.full')

    @section('content')
        <div class="full-content-center animated fadeInDownBig">
            <div class="login-wrap">
                <div class="box-info">
                <h2 class="text-center"><strong>{!! trans('Olvidó') !!}</strong> {!! trans('Contraseña') !!}</h2>
                    
                    @if ($errors->has())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {!! $error !!}<br>        
                        @endforeach
                    </div>
                    @endif
                    @if (session('status'))
                      <div class="alert alert-success">
                             {!! session('status') !!}
                      </div>
                    @endif

                    <form role="form" action="{!! URL::to('/password/email') !!}" method="post" class="forgot-form">
                        {!! csrf_field() !!}
                        <div class="form-group login-input">
                        <i class="fa fa-sign-in overlay"></i>
                        <input type="text" name="email" id="email" class="form-control text-input" placeholder="Email">
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