/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var Etapa=function(){
    
}
Etapa.prototype={
    Activar:function(){
        
    }
}

$(document).ready(function() {
 $("input[name=active]:radio").change(function(){
        console.log("change active");
        var valor;
        var id=$(this).attr("data-id");
        console.log(this.id);
        if(this.id=='optActive')
            valor=false;
        else
            valor=true;
        $("#fechaInicioEtapa-"+id).attr("disabled",valor);
        $("#fechaFinEtapa-"+id).attr("disabled",valor);
        $("#fechaExtensionEtapa-"+id).attr("disabled",valor);
        $("#chkExtendido-"+id).attr("disabled",valor);
    });
    
});