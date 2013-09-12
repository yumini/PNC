var OptionButton = OptionButton || {Perfil: {}, Contactos: {}};
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
                parent.Window.Hide();
            }
        });
    },
    Update:function(){
            console.log("actualizando perfil con id:"+this.IdEntity);
            var parent=this;
            var url=Routing.generate(this.routeUpdate,{id:this.IdEntity});
            params = $('#myPerfilform').serializeObject();
            var nodes = $('#tree').tree('getChecked');
            var s = '';
                    
            $.ajax({
                    type:'PUT',
                    url:url,
                    data:params,
                    dataType:"html",
                    success:function(datos){
                            
                            new OptionButton.Perfil().Refresh();
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });           
    },
   
    Refresh:function(){
        var url=Routing.generate(this.routeList);
        new jAjax().Load(url,'main-body','get','','');
    },

   

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
                parent.Window.Hide();
            }
        });
    },
    Save:function(){
            var parent=this;
            var url=Routing.generate(this.routeSave);
            params = $('#myform').serializeObject();
            console.log(params);
            
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"html",
                    success:function(datos){
                            //parent.Window.AddHTML(datos);
                           new OptionButton.Contactos().Refresh(); 
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
                parent.Window.Hide();
            }
        });
    },
    Update:function(){
            console.log("actualizando contacto con id:"+this.IdEntity);
            var parent=this;
            var url=Routing.generate(this.routeUpdate,{id:this.IdEntity});
            params = $('#myform').serializeObject();
            var nodes = $('#tree').tree('getChecked');
            var s = '';
            for(var i=0; i<nodes.length; i++){
                if (s != '') s += ',';
                s += nodes[i].id;
            }
            params.perfil=s;           
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"html",
                    success:function(datos){
                            new OptionButton.Contactos().Refresh(); 
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
    
    new OptionButton.Contactos().Refresh(); 

  
  
});