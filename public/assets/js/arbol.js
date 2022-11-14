// centrar arbol
$(function(){
	if(window.location.pathname=='/arbol'){
    	$ancho_arbol = $("li.main").width()
      	$ancho_contenedor = $(".tree>ul").width()
      	$pad = ($ancho_contenedor - $ancho_arbol) / 2;
      	$(".tree>ul").css("padding-left",$pad+"px")
    }
    })