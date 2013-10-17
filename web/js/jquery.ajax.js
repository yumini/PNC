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
            },
            error:function(objeto, quepaso, otroobj){
                    $("#"+contentId).html("Ocurrio un error intentelo nuevamente.");
            }
        });
    }
		
}
 
