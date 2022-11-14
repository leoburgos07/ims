@extends('layouts.default')

@section('content')


<div class="row">
    <div class="col-sm-12">
        <div class="box-info">
            <h2><strong>{!! trans('Retirar Dinero') !!}</h2>
            <form action="/withdrawalMoney" method="POST">
            {!! csrf_field() !!}
                <div class="form-group col-sm-2">
                    <label for="ammount">¿Cuánto USD retirarás?</label>
                    <input type="number" class="form-control" name="ammount" value="0">
                    <button type="submit" class="btn btn-success" style="margin-top:12px ;">Retirar</button>
                </div>
                
            </form>
        </div>
    </div>
</div>




@endsection