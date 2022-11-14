@extends('layouts.full')

    @section('content')
        <div class="full-content-center animated fadeInDownBig">
            <div class="login-wrap">
                <div class="box-info">
                <h2 class="text-center"><strong>{!! trans('Crear') !!}</strong> {!! trans('cuenta') !!}</h2>
                    
                    @if ($errors->has())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {!! $error !!}<br>        
                        @endforeach
                    </div>
                    @endif
                    @if (session('success'))
                      <div class="alert alert-success">
                             {!! session('success') !!}
                      </div>
                    @endif
                    

                    <form role="form" action="{!! URL::to('/user/register') !!}" method="post" class="register-form">
                        {!! csrf_field() !!}

                       
                        <div class="form-group login-input">
                        <i class="fa fa-user overlay"></i>
                        <input type="text" name="name_invited" id="name_invited" class="form-control text-input" placeholder="Username de telegram de quien te invito">
                        </div>
                        <div class="form-group login-input">
                        <i class="fa fa-user overlay"></i>
                        <input type="text" name="name" id="name" class="form-control text-input" placeholder="Nombre">
                        </div>
                        <div class="form-group login-input">
                        <i class="fa fa-sign-in overlay"></i>
                        <input type="text" name="username" id="username" class="form-control text-input" placeholder="Username de telegram">
                        </div>
                        <div class="form-group login-input">
                        <i class="fa fa-envelope overlay"></i>
                        <input type="email" name="email" id="email" class="form-control text-input" placeholder="Email">
                        </div>
                        <div class="form-group login-input">
                        <i class="fa fa-key overlay"></i>
                        <input type="password" name="password" id="password" class="form-control text-input" placeholder="Contraseña">
                        </div>
                        <div class="form-group login-input">
                        <i class="fa fa-eye overlay"></i>
                        <input type="password" name="password_confirmation" class="form-control text-input" placeholder="Confirmar Contraseña">
                        </div>
                        <div class="form-group login-input">
                        <i class="glyphicon glyphicon-earphone overlay"></i>
                        <input type="text" name="telefono" id="telefono" class="form-control text-input" placeholder="telefono">
                        </div>
                       

                        {{ App\Classes\Helper::getCustomFields('user-form',$custom_field_values) }}

                        <div class="row">
                            <div class="col-sm-12">
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-unlock"></i> {!! trans('Registrar') !!}</button>
                            </div>
                        </div>
                    </form>
                    <p class="text-center"><a href="{!! URL::to('/') !!}"><i class="fa fa-lock"></i> {!! trans('Atrás para iniciar sesión') !!}</a></p>
                </div>
            </div>
        </div>
    @stop