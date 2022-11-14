@extends('layouts.default')

@section('content')
<?php  
    $total = $user->comision + $user->renta_fija;

    $totalComissions = DB::table('transactions')
    ->select(DB::raw('sum(monto) as total'))
    ->where('state',1)
    ->where('users_id', Auth::user()->id)
    ->where('transactions_types_id',"!=",1)
    ->first();
?>


<div class=" boxes">
<!--  <p class="responsiveTitleCard">COMISIONES MENSUALES</p>
    <div class="container rower">
        <img src="{{asset('assets/img/newResources/Mascara3.png')}}" class="topLeftMask" width="50" height="50" alt="">
        <img src="{{asset('assets/img/newResources/Mascara3.png')}}" class="bottomRightMask" width="50" height="50" alt="">
        <div class="descriptionBox">
            <img src="{{asset('assets/img/comission/Grupo 3595.png')}}"  width="75" height="50" alt="">
            <div class="textDescriptionBox">
            <p class="titleCard">COMISIONES MENSUALES</p>
            <p class="descriptionCard">USD</p>
            </div>
            <div class="priceComission">
                <p class="descriptionCard">TOTAL</p>
                <p>{{$total}} USD</p>
            </div>
            
        </div>
        
    </div> -->
    <p class="responsiveTitleCard">comisiones diarias</p>
    <div class="container rower">
    
        <div class="descriptionBox">
            <img src="{{asset('assets/img/comission/Grupo 3625.png')}}"  width="50" height="50" alt="">
            <div class="textDescriptionBox">
            <p class="titleCard">comisiones diarias</p>
            <p class="descriptionCard" style="text-transform:uppercase ;">diariamente recibe una comisión del 1.5% de la suma total capital invertido y reinversiones</p>
            </div>
            <div class="priceComission bigPrice">
                
                <p>{{$totalComissions->total * 0.015}} USD</p>
            </div>
            
        </div>
    </div>
    
    <p class="responsiveTitleCard">renta obtenida por tus referidos</p>
    <div class="container rower">
    <div class="descriptionBox">
            <img src="{{asset('assets/img/comission/Grupo 3657.png')}}"  width="50" height="50" alt="">
            <div class="textDescriptionBox">
            <p class="titleCard">renta obtenida por tus referidos</p>
            <p class="descriptionCard" style="text-transform:uppercase ;">OBTÉN UN PORCENTAJE DE LA INVERSIÓN DE TUS REFERIDOS HASTA EL TERCER NIVEL,  UNA UNICA VEZ.</p>
            </div>
            <div class="priceComission bigPrice">
                
                <p>{{$user->comision}} USD</p>
            </div>
            
        </div>
    </div>

   <!-- <div class="cajasC">
        <img src="{{asset('assets/img/newResources/Rectángulo873.png')}}" class="imgTitleComission" alt="">
        <div class="textBox"><p class="subtitleComission">COMISIONES POR REFERIDOS </p></div>
        <div><p class="text-description">Esta renta es el 6% mensual del plan escogido</p><p class="userTextData">{{$user->renta_fija}} USD</p></div>
        
    </div>  
    <div class="cajasC">
    <img src="{{asset('assets/img/newResources/Rectángulo873.png')}}" class="imgTitleComission" alt="">
    <div class="textBox"><p class="subtitleComission">Renta Temporal</p></div>
    <div><p class="text-description">Por los dos primeros referidos recibe un unico pago de 50 USD</p><p class="userTextData">{{$user->renta_temporal}} USD</p></div>
    </div>
    <div class="cajasC">
    <img src="{{asset('assets/img/newResources/Rectángulo873.png')}}" class="imgTitleComission" alt="">
    <div class="textBox"><p class="subtitleComission">Renta Residual </p></div>
    <div><p class="text-description">Esta renta es permanente y consiste en recibir mensualmente el 2% del plan que escoja tu referido a partir del tercero</p><p class="userTextData">{{$user->comision}} USD</p></div>
    </div> -->


</div>

    
@endsection