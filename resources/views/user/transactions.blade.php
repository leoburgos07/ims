@extends('layouts.default')

@section('content')



<div class="row">
    <div class="col-sm-12">
        <div class="box-info">
            <h2><strong>{!! trans('Historial de transacciones') !!}</h2>
            @include('common.datatable',['col_heads' => $col_heads])
        </div>
    </div>
</div>

@endsection