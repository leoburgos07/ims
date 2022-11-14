@extends('layouts.full')

    @section('content')
    <img class="logoResponsive"src="{{asset('assets/img/newResources/Logo-vivo-02.png')}}" alt="">
        <div class="full-content-center animated fadeInDownBig prueba">
        
            <div class="login-wrap">
                <div class="box-info fsdhf">
                <h2 class="text-center"><strong>{!! trans('INICIAR SESIÓN') !!}</strong></h2>
                    
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

                        @include('auth.login_form')

                        @if(! App\Classes\Helper::getMode())
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Rol</th>
                                        <th>Nombre de usuario</th>
                                        <th>Contraseña</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td>Admin</td>
                                            <td>admin</td>
                                            <td>admin</td>
                                        </tr>
                                        <tr>
                                            <td>User</td>
                                            <td>user</td>
                                            <td>user</td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                        @endif
                </div>
            </div>
        </div>
    @stop