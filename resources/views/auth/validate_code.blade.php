<?php
                    
	$user = Auth::user();
	if($user->confirm_pay_code == 1){
	header("Location: ./dashboard");
	}
	else{
?>
@extends('layouts.full')

    @section('content')
    
        <div class="full-content-center animated fadeInDownBig">
            <div class="login-wrap">
                <div class="box-info">
                <h2 class="text-center"><strong>{!! trans('Validar') !!}</strong> {!! trans('codigo de pago') !!}</h2>
                    
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
                    
                    

                    <form role="form" action="{!! URL::to('./savecode/'.$user->id) !!}" method="GET" class="register-form">
                        {!! csrf_field() !!}

                        El administrador del sitio se contactara con usted para realizar el proceso de pago.
                        <div class="form-group login-input">
                        <i class="fa fa-user overlay"></i>
                        <input type="text" name="codigo" id="codigo" class="form-control text-input" placeholder="Codigo de pago">
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-unlock"></i> {!! trans('Validar') !!}</button>
                            </div>
                        </div>
                    </form>
                   
                </div>
            </div>
        </div>
    @stop
    <?}?>