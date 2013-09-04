var myWindow=null;

var OptionButton=function(){
    this.routeList='_admin_usuario';
    this.routeActive='_admin_usuario_active';
    this.routeDelete='_admin_usuario_delete';
}
OptionButton.prototype={
    Active:function(id){
        this.IdEntity=id;
        if(confirm("Desea Valdiar el Registro del usuario?")){
             var url=Routing.generate(this.routeActive,{id:this.IdEntity});
             $.ajax({
                    type:'PUT',
                    url:url,
                    dataType:"html",
                    success:function(request){
                            var obj = jQuery.parseJSON(request);
                            console.log(obj)
                            alert(obj.message)
                            new OptionButton().Refresh();
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            }); 
        }
    },
    Delete:function(id){
        this.IdEntity=id;
        if(confirm("Desea eliminar el usuario seleccionado?")){
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
    }
}

$(document).ready(function() {

  $(".row-edit").click(function(){
      var id=$(this).attr("data-id"); 
      new OptionButton().Active(id);  
  });

});