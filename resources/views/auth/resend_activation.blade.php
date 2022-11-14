@extends('layouts.full')

    @section('content')
        <div class="full-content-center animated fadeInDownBig">
            <div class="login-wrap">
                <div class="box-info">
                <h2 class="text-center"><strong>{!! trans('Verifique') !!}</strong> {!! trans('su cuenta de correo') !!}</h2>
                    {!! showMessage() !!}
                    <p>Su cuenta aún no está activada. Por favor verifique la bandeja de entrada (Bandeja de Spam o Correo no deseado) de su correo. <br /> </p> 
                    <!--<form role="form" action="{!! URL::to('./resend_activation') !!}" method="post" class="forgot-form">
                        <input type="hidden" name="token" value="{!! $token !!}">
                        {!! csrf_field() !!}
                        <div class="form-group login-input">
                        <i class="fa fa-sign-in overlay"></i>
                        <input type="email" name="email" id="email" class="form-control text-input" placeholder="Email" value="{!! (Auth::check()) ? Auth::user()->email : '' !!}" {!! (Auth::check()) ? 'readonly' : '' !!}>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-unlock"></i> {!! trans('Correo activation Reenviar') !!}</button>
                            </div>
                        </div>
                    </form>-->
                </div>
            </div>
        </div>
    @stop