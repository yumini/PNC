var OptionButton = OptionButton || {Perfil: {}, Contactos: {}, Categorias: {}};
var myWindow=null;


OptionButton.Perfil=function(){
    this.routeList='_admin_postulante_perfil';
   
    this.routeEdit='_admin_postulante_edit';
    this.routeUpdate='_admin_postulante_update';    
}
OptionButton.Perfil.prototype={
    Edit:function(id){
        this.IdEntity=id;
        this.Window=new BootstrapWindow({id:"winForm",title:"Editar Mi Perfil"});
        this.Window.setWidth(600);
        this.Window.setHeight(360);
        var url=Routing.generate(this.routeEdit,{id:id});
        this.Window.Load(url,"");
        this.Window.Show();
        var parent=this;
        this.Window.AddButton('btn-perfil-cancel',{
            label:'Cancelar',
            'class':'btn-default',
            fn:function(){
                parent.Window.Hide();
            }
            
        })
       
        this.Window.AddButton('btn-perfil-save',{
            label:'Grabar',
            'class':'btn-success',
            fn:function(){
                parent.Update();               
                
            }
        });
    },
    Update:function(){
            console.log("actualizando perfil con id:"+this.IdEntity);
            var parent=this;
            parent.Window.Buttons(0).disabled();
            parent.Window.Buttons(1).disabled();
            var url=Routing.generate(this.routeUpdate,{id:this.IdEntity});
            params = $('#myPerfilform').serializeObject();
           
                    
            $.ajax({
                    type:'PUT',
                    url:url,
                    data:params,
                    dataType:"json",
                    success:function(obj){
                            parent.Window.Buttons(0).enabled();
                            parent.Window.Buttons(1).enabled();
                            tipo=(obj.success)?'success':'warning';
                            var n = noty({
                                    text: obj.message,
                                    type: tipo,
                                    dismissQueue: true,
                                    layout: 'bottomRight',
                                    theme: 'defaultTheme',
                                    timeout:5000
                            });
                            if(obj.success){
                                parent.Window.Hide();
                                setTimeout(function() {
                                    new OptionButton.Perfil().Refresh();
                                }, 1000);
                            }
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });           
    },
   
    Refresh:function(){
        var id=$('#hdnEntity_id').val();
        var url=Routing.generate(this.routeList,{id:id});
        new jAjax().Load(url,'main-body','get','','');
    }

   

}

OptionButton.Contactos=function(){
     this.routeList='_admin_postulantecontacto';
     this.routeNew='_admin_postulantecontacto_new';
     this.routeSave='_admin_postulantecontacto_save';
     this.routeEdit='_admin_postulantecontacto_edit';
     this.routeUpdate='_admin_postulantecontacto_update';
     this.routeDelete='_admin_postulantecontacto_delete';
};

OptionButton.Contactos.prototype={
     Refresh:function(){
        var id=$("#hdnEntity_id").val();
        var url=Routing.generate(this.routeList,{id:id});
        new jAjax().Load(url,'containerContactos','get','','');
    },
    New:function(){
        this.Window=new BootstrapWindow({id:"winForm",title:"Agregar Contacto"});
        this.Window.setWidth(600);
        this.Window.setHeight(360);
        var url=Routing.generate(this.routeNew);
        this.Window.Load(url,"");
        this.Window.Show();
        var parent=this;
        this.Window.AddButton('btn-contactonew-cancel',{
            label:'Cancelar',
            'class':'btn-default',
            fn:function(){
                parent.Window.Hide();
            }
            
        })
       
        this.Window.AddButton('btn-contactonew-save',{
            label:'Grabar',
            'class':'btn-success',
            fn:function(){
                parent.Save();               
                //parent.Window.Hide();
            }
        });
    },
    Save:function(){
            var parent=this;
            parent.Window.Buttons(0).disabled();
            parent.Window.Buttons(1).disabled();
            
            var url=Routing.generate(this.routeSave,{id:$("#hdnEntity_id").val()});
            params = $('#myform').serializeObject();
            console.log(params);
            
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"json",
                    success:function(obj){
                            parent.Window.Buttons(0).enabled();
                            parent.Window.Buttons(1).enabled();
                            console.log(obj)
                            if(obj.success)
                                tipo='success';
                            else
                                tipo='warning';
                            var n = noty({
                                    text: obj.message,
                                    type: tipo,
                                    dismissQueue: true,
                                    layout: 'bottomRight',
                                    theme: 'defaultTheme',
                                    timeout:5000
                            });
                            if(obj.success){
                                parent.Window.Hide();
                                parent.Refresh(); 
                            }
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });
        
    },
    Edit:function(id){
        this.IdEntity=id;
        this.Window=new BootstrapWindow({id:"winForm",title:"Editar Contacto"});
        this.Window.setWidth(600);
        this.Window.setHeight(360);
        var url=Routing.generate(this.routeEdit,{id:id});
        this.Window.Load(url,"");
        this.Window.Show();
        var parent=this;
        this.Window.AddButton('btn-contacto-cancel',{
            label:'Cancelar',
            'class':'btn-default',
            fn:function(){
                parent.Window.Hide();
            }
            
        })
       
        this.Window.AddButton('btn-contacto-save',{
            label:'Grabar',
            'class':'btn-success',
            fn:function(){
                parent.Update();               
                
            }
        });
    },
    Update:function(){
            console.log("actualizando contacto con id:"+this.IdEntity);
            var parent=this;
            parent.Window.Buttons(0).disabled();
            parent.Window.Buttons(1).disabled();
            var url=Routing.generate(this.routeUpdate,{id:this.IdEntity});
            params = $('#myform').serializeObject();
                      
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"json",
                    success:function(obj){
                            parent.Window.Buttons(0).enabled();
                            parent.Window.Buttons(1).enabled();
                            console.log(obj)
                            if(obj.success)
                                tipo='success';
                            else
                                tipo='warning';
                            var n = noty({
                                    text: obj.message,
                                    type: tipo,
                                    dismissQueue: true,
                                    layout: 'bottomRight',
                                    theme: 'defaultTheme',
                                    timeout:5000
                            });
                            if(obj.success){
                                parent.Window.Hide();
                                new OptionButton.Contactos().Refresh(); 
                            }
                            
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });           
    },
    Delete:function(id){
        this.IdEntity=id;
        if(confirm("Desea eliminar el contacto seleccionado?")){
             var url=Routing.generate(this.routeDelete,{id:this.IdEntity});
             $.ajax({
                    type:'DELETE',
                    url:url,
                    dataType:"html",
                    success:function(datos){
                            
                            new OptionButton.Contactos().Refresh(); 
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            }); 
        }
    }
};

OptionButton.Categoria=function(){
    this.routeList='_admin_postulante_perfil';
    this.routeNew='_admin_postulantecategoria_new';
    this.routeSave='_admin_postulantecategoria_save';
    this.routeDelete='_admin_postulantecategoria_delete';
     
}
OptionButton.Categoria.prototype={
    Refresh:function(){
       var id=$('#hdnEntity_id').val();
       var url=Routing.generate(this.routeList,{id:id});
        new jAjax().Load(url,'main-body','get','','');
    },
    New:function(){
        this.Window=new BootstrapWindow({id:"winForm",title:"Agregar Categoria"});
        this.Window.setWidth(600);
        //this.Window.setHeight(360);
        var url=Routing.generate(this.routeNew);
        this.Window.Load(url,"");
        this.Window.Show();
        var parent=this;
        this.Window.AddButton('btn-contactonew-cancel',{
            label:'Cancelar',
            'class':'btn-default',
            fn:function(){
                parent.Window.Hide();
            }
            
        })
       
        this.Window.AddButton('btn-contactonew-save',{
            label:'Grabar',
            'class':'btn-success',
            fn:function(){
                parent.Save();               
                parent.Window.Hide();
            }
        });
    },
    Save:function(){
            var parent=this;
            var id=$('#hdnEntity_id').val();
            var url=Routing.generate(this.routeSave,{id:id});
            params = $('#myform').serializeObject();
            console.log(params);
            
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"html",
                    success:function(request){
                        var obj = jQuery.parseJSON(request);
                        if(obj.success=="true"){
                            new OptionButton.Categoria().Refresh();
                            var n = noty({
                                    text: obj.msg,
                                    type: 'success',
                                    dismissQueue: true,
                                    layout: 'bottomRight',
                                    theme: 'defaultTheme',
                                    timeout:5000
                            });
                           
                        }else{
                           
                            var n = noty({
                                    text: obj.msg,
                                    type: 'warning',
                                    dismissQueue: true,
                                    layout: 'bottomRight',
                                    theme: 'defaultTheme',
                                    timeout:5000

                            });
                        }
                         
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });
        
    },
   
    Delete:function(id){
        this.IdEntity=id;
         var idPostulante=$('#hdnEntity_id').val();
        if(confirm("Desea eliminar la categoria seleccionada?")){
             var url=Routing.generate(this.routeDelete,{id:idPostulante,idCategoria:id});
             $.ajax({
                    type:'POST',
                    url:url,
                   
                    dataType:"html",
                    success:function(datos){
                            var n = noty({
                                    text: "Categoria eliminada satisfactoriamente",
                                    type: 'warning',
                                    dismissQueue: true,
                                    layout: 'bottomRight',
                                    theme: 'defaultTheme',
                                    timeout:5000
                            });
                            
                            new OptionButton.Categoria().Refresh(); 
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            }); 
        }
    }
};
//al leer el documento
$(document).ready(function() {
  
    $("#btnEdit").click(function(){
      	var id=$(this).attr("data-id"); 
      	console.log("el id es:"+id);
        new OptionButton.Perfil().Edit(id);   
    });


    $("#btnContactoNew").click(function(){
        var id=$(this).attr("data-id"); 
        console.log("el id es:"+id);
        new OptionButton.Contactos().New(id);   
    });
    
    $("#btnCategoriaNew").click(function(){
        var id=$(this).attr("data-id"); 
        console.log("el id es:"+id);
        new OptionButton.Categoria().New(id);   
    });
    $("a[data-type='categoria-delete']").click(function(event) {
      var id=$(this).attr("data-id");
       new OptionButton.Categoria().Delete(id);   
    });
    new OptionButton.Contactos().Refresh(); 

  
  
});