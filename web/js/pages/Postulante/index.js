var myWindow=null;


var OptionButton=function(){
    this.routeList='_admin_postulante';
    this.routeDelete='_admin_concurso_delete';

    
}
OptionButton.prototype={
    Delete:function(id){
        this.IdEntity=id;
        if(confirm("Desea eliminar el perfil seleccionado?")){
             var url=Routing.generate(this.routeDelete,{id:this.IdEntity});
             $.ajax({
                    type:'DELETE',
                    url:url,
                    dataType:"html",
                    success:function(datos){
                            
                            new OptionButton().Refresh();
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            }); 
        }
    },
    Refresh:function(){
        var url=Routing.generate(this.routeList);
        new jAjax().Load(url,'main-body','get','','');
    },
    Criterios:function(id){
         var url=Routing.generate(this.routeCriterios,{id:id});
         $.ajax({
                    type:'GET',
                    url:url,
                    dataType:"html",
                    success:function(datos){
                           $("#main-body").html(datos);
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            }); 
    }
}


//al leer el documento
$(document).ready(function() {
  
   
});