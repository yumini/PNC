// JavaScript Document
var jAjax=function(){
    
};
jAjax.prototype={
    Load:function(url,contentId,method,params,js){
        
        $("#"+contentId).html("<div class='home-loading'>Cargando...</div>") ;
        $.ajax({
            type:method,
            url:url,
            data:params,
            dataType:"html",

            success:function(datos){
                    $("#"+contentId).empty();
                    $("#"+contentId).append(datos);
                    if(js!='')
                            $.getScript(js);
                    $.getScript('../js/pages/apply-modernizer.js?r='+Math.random());
            },
            error:function(objeto, quepaso, otroobj){
                    $("#"+contentId).html("Ocurrio un error intentelo nuevamente.");
            }
        });
    },
    LoadWithFnSuccess:function(url,contentId,method,params,fnSuccess){
        
        $("#"+contentId).html("<div class='home-loading'>Cargando...</div>") ;
        $.ajax({
            type:method,
            url:url,
            data:params,
            dataType:"html",

            success:function(datos){
                    $("#"+contentId).empty();
                    $("#"+contentId).append(datos);
                    setTimeout(fnSuccess(),2000);
            },
            error:function(objeto, quepaso, otroobj){
                    $("#"+contentId).html("Ocurrio un error intentelo nuevamente.");
            }
        });
    }
		
}
 
