/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var Etapa=function(){
    this.routeSave="admin_etapaconcurso_save";
};
Etapa.prototype={
    Save:function(idconcurso,obj){
         
          var url=Routing.generate(this.routeSave,{id:idconcurso});
         $.ajax({
                    type:'POST',
                    url:url,
                    data:obj,
                    dataType:"html",
                    success:function(request){
                            var obj = jQuery.parseJSON(request);
                            tipo=(obj.success=='false')?'warning':'success';
                           
                            if(obj.message!=''){
                                var n = noty({
                                        text: obj.message,
                                        type: tipo,
                                        modal:false,
                                        timeout:5000,
                                        layout: 'bottomRight',
                                        theme: 'defaultTheme'                                  
                                });
                                setTimeout(function() {
                                    n.close();
                                    
                                }, 5000);
                            }
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });
    }
};

$(document).ready(function() {
 $("input[data-type=active]:radio").change(function(){
        console.log("change active");
        var valor;
        var index=$(this).attr("data-index");
        console.log(this.id);
        if(this.id=='optActive-'+index)
            valor=false;
        else
            valor=true;
        $("#fechaInicioEtapa-"+index).attr("disabled",valor);
        $("#fechaFinEtapa-"+index).attr("disabled",valor);
        $("#fechaExtensionEtapa-"+index).attr("disabled",valor);
        $("#chkExtendido-"+index).attr("disabled",valor);
    });
    $("a[data-type=save]").click(function(){
        var index=$(this).attr("data-index");
        var idconcurso=$("#idConcurso").val();
        console.log(index);
        var obj;
        var active=$('input[name=active-'+index+']:checked').val();
        console.log(active);
        //obj.active=(tipo==undefined)?'':$('input[name=active-'+index+']').val();
       
        obj={
            
            etapaId:$('#etapaid-'+index).val(),
            active:active,
            fechaInicio:$("#fechaInicioEtapa-"+index).val(),
            fechaFin: $("#fechaFinEtapa-"+index).val(),
            fechaExtension:$("#fechaExtensionEtapa-"+index).val(),
            extendido:$("#chkExtendido-"+index).val()
        };
        //obj.fechaFin=$("#fechaFinEtapa-"+index).val();
        //obj.fechaExtension=$("#fechaExtensionEtapa-"+index).val();
        //obj.extendido=$("#chkExtendido-"+index).val();
        new Etapa().Save(idconcurso,obj);
    });
});