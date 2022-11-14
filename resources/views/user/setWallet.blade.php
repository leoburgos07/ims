@extends('layouts.default')

@section('content')


<div class="row">
    <div class="col-sm-12">
        <div class="box-info">
            <h2><strong>{!! trans('Actualizar Dirección de Cartera') !!}</h2>
            <form action="/setDirWallet" method="POST">
            {!! csrf_field() !!}
                <div class="form-group col-sm-4">
                    <label for="wallet">Direccion de cartera actual</label>
                    <input type="text" class="form-control" name="wallet" value="{{Auth::user()->dirWallet}}">

                    @if(Auth::user()->dirWallet)
                    <button type="submit" class="btn btn-success" style="margin-top:12px ;">Actualizar</button>
                    @else
                    <button type="submit" class="btn btn-primary" style="margin-top:12px ;">Agregar</button>
                    @endif
                    
                </div>
                
            </form>
        </div>
    </div>
</div>




@endsection