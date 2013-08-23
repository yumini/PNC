// JavaScript Document
var jAjax=function(){
    
};
jAjax.prototype={
    Load:function(url,contentId,method,params,js){
        $("#"+contentId).on({
            ajaxStart: function() { 
                console.log("ajaxstart");
                //console.log( $(this));
                $("#"+contentId).addClass("loading"); 
            },
            ajaxStop: function() {
                console.log("ajaxStop"); 
                $("#"+contentId).removeClass("loading"); 
            }    
        });
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
 
