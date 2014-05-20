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
                                        theme: 'defaultTheme',
                                        timeout:5000                                  
                                });
                               $("a[data-type=save]").button('reset');
                            }
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });
    }
};

$(document).ready(function() {
    $("input:checkbox").change(function(){
        var extendido=$(this);
        var checked=extendido.is(':checked');
        var index=extendido.attr('data-index');
        var fechaExtension=$("#fechaExtensionEtapa-"+index);
        fechaExtension.attr("disabled",!checked);
        if(!checked)
            fechaExtension.val("");

    })
 $("input[data-type=active]:radio").change(function(){
        console.log("change active");
        var index=$(this).attr("data-index");
        var extendido=$("#chkExtendido-"+index);
        var fechaInicio=$("#fechaInicioEtapa-"+index);
        var fechaFin=$("#fechaFinEtapa-"+index);
        var fechaExtension=$("#fechaExtensionEtapa-"+index);
        var active=($(this).val()==='on')?true:false;
        
        fechaInicio.attr("disabled",!active);
        fechaFin.attr("disabled",!active);
        extendido.attr("disabled",!active);
        if(!active){
             extendido.attr("checked",false);
        }
        var checked=extendido.is(':checked');
        fechaExtension.attr("disabled",!checked);
        
        if(!active){
            fechaInicio.val("");
            fechaFin.val("");
            extendido.attr("checked",false);
            fechaExtension.val("");
        }

    });
    $("a[data-type=save]").click(function(){
        var index=$(this).attr("data-index");
        var idconcurso=$("#idConcurso").val();
        var extendido=$("#chkExtendido-"+index);
        var fechaInicio=$("#fechaInicioEtapa-"+index);
        var fechaFin=$("#fechaFinEtapa-"+index);
        var fechaExtension=$("#fechaExtensionEtapa-"+index);
        var etapaId=$('#etapaid-'+index).val();

        console.log(index);
        var obj;
        var active=$('input[name=active-'+index+']:checked').val();
        console.log(active);
        //obj.active=(tipo==undefined)?'':$('input[name=active-'+index+']').val();
       $(this).button('loading');
        obj={
            
            etapaId:etapaId,
            active:active,
            fechaInicio:fechaInicio.val(),
            fechaFin:fechaFin.val(),
            fechaExtension:fechaExtension.val(),
            extendido:extendido.is(":checked")
        };

        //obj.fechaFin=$("#fechaFinEtapa-"+index).val();
        //obj.fechaExtension=$("#fechaExtensionEtapa-"+index).val();
        //obj.extendido=$("#chkExtendido-"+index).val();
        new Etapa().Save(idconcurso,obj);
    });
});