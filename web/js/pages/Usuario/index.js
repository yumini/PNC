var myWindow=null;

var OptionButton=function(){
    this.routeList='_admin_usuario';
    this.routeNew='_admin_usuario_new';
    this.routeSave='_admin_usuario_save';
    this.routeEdit='_admin_usuario_edit';
    this.routeUpdate='_admin_usuario_update';
    this.routeActive='_admin_usuario_active';
    this.routeDelete='_admin_usuario_delete';
}
OptionButton.prototype={
     New:function(){

        this.Window=new BootstrapWindow({id:"winForm",title:"Nuevo Usuario"});
        this.Window.setWidth(800);
        this.Window.setHeight(450);
        var url=Routing.generate(this.routeNew);
        this.Window.Load(url,"");
        this.Window.Show();
         var parent=this;
        this.Window.AddButton('btn-usuario-cancel',{
            label:'Cancelar',
            'class':'btn-default',
            fn:function(){
                parent.Window.Hide();
            }
            
        })
       
        this.Window.AddButton('btn-usuario-save',{
            label:'Grabar',
            'class':'btn-success',
            fn:function(){
                parent.Save();               
                
            }
        });
    },
    Save:function(){
            var parent=this;
            var url=Routing.generate(this.routeSave);
            params = $('#myForm').serializeObject();
            console.log(params);
            
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"html",
                    success:function(request){
                        
                            var obj = jQuery.parseJSON(request);
                            if(obj.success=='false'){
                                tipo='warning';
                            }else{
                                tipo='success';
                                parent.Window.Hide();
                                new OptionButton().Refresh();
                            }
                            var n = noty({
                                    text: obj.message,
                                    type: tipo,
                                    dismissQueue: true,
                                    layout: 'bottomRight',
                                    theme: 'defaultTheme'
                                    
                                    
                            });
                            setTimeout(function() {
                                $.noty.close(n.options.id);
                            }, 5000);
                            
                            
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });
        
    },
    Edit:function(id){
        this.IdEntity=id;
        this.Window=new BootstrapWindow({id:"winForm",title:"Editar Usuario"});
        this.Window.setWidth(1000);
        //this.Window.setHeight(300);
        var url=Routing.generate(this.routeEdit,{id:id});
        this.Window.Load(url,"");
        this.Window.Show();
        var parent=this;
        this.Window.AddButton('btn-usuario-cancel',{
            label:'Cancelar',
            'class':'btn-default',
            fn:function(){
                parent.Window.Hide();
            }
            
        })
       
        this.Window.AddButton('btn-usuario-save',{
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
            params = $('#myForm').serializeObject();
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
                            
                            new OptionButton().Refresh();
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });           
    },
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
                            //console.log(obj)
                            //alert(obj.message)
                            bootbox.alert(obj.message, function() {
                                //console.log("Alert Callback");
                            });
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

  $("#btnNew").click(function(){
    console.log("nuevo concurso");
      new OptionButton().New();   
  });
  $(".row-active").click(function(){
      var id=$(this).attr("data-id"); 
      new OptionButton().Active(id);  
  });
  $(".row-edit").click(function(){
      var id=$(this).attr("data-id"); 
      new OptionButton().Edit(id);  
  });
   $(".row-delete").click(function(){
      var id=$(this).attr("data-id"); 
      new OptionButton().Delete(id);  
  });

});