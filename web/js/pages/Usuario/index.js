var myWindow=null;

var OptionButton=function(){
    this.routeList='_admin_usuario';
    this.routeNew='_admin_usuario_new';
    this.routeSave='_admin_usuario_save';
    this.routeEdit='_admin_usuario_edit';
    this.routeUpdate='_admin_usuario_update';
    this.routeActive='_admin_usuario_active';
    this.routeDelete='_admin_usuario_delete';
    this.Window=null;
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
               $('#btn-usuario-save').attr('disabled',true);
               $('#btn-usuario-cancel').attr('disabled',true);
               parent.Save();               
                
            }
        });
    },
    Save:function(){
            myWindow=this.Window;
            var parent=this;
            var url=Routing.generate(this.routeSave);
            params = $('#myForm').serializeObject();
            
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"html",
                    success:function(request){
                           $('#btn-usuario-save').attr('disabled',false);
                            $('#btn-usuario-cancel').attr('disabled',false);
                            var obj = jQuery.parseJSON(request);
                            tipo=(obj.success=='false')?'warning':'success';
                            if(obj.success=='true'){
                                     parent.Window.Hide();
                            }
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
                                if(obj.success=='true')
                                    new OptionButton().Refresh();
                            }, 5000);
                            
                            
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });
        
    },
    Edit:function(id){
        this.IdEntity=id;
        this.Window=new BootstrapWindow({id:"winForm",title:"Editar Usuario"});
        this.Window.setWidth(800);
        this.Window.setHeight(450);
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
                $('#btn-usuario-save').attr('disabled',true);
                $('#btn-usuario-cancel').attr('disabled',true);
                parent.Update();               
                
            }
        });
    },
    Update:function(){
            //console.log("actualizando perfil con id:"+this.IdEntity);
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
                    success:function(request){
                            time=5000;
                            $('#btn-usuario-save').attr('disabled',false);
                            $('#btn-usuario-cancel').attr('disabled',false);
                            var obj = jQuery.parseJSON(request);
                            tipo=(obj.success=='false')?'warning':'success';
                            if(obj.success=='true'){
                                     parent.Window.Hide();
                                     time=3000;
                            }
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
                                if(obj.success=='true')
                                    new OptionButton().Refresh();
                            }, time);
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });           
    },
    Active:function(id){
        this.IdEntity=id;
        var parent=this;
        var n=noty({
          text: 'Desea validar el registro del usuario?',
          layout: 'center',
          theme: 'defaultTheme',
          modal:true,
          buttons: [
            {addClass: 'btn btn-success', text: 'Si', onClick: function($noty) {

                var url=Routing.generate(parent.routeActive,{id:parent.IdEntity});
                 $.ajax({
                        type:'PUT',
                        url:url,
                        dataType:"html",
                        success:function(request){
                                var obj = jQuery.parseJSON(request);
                                var n = noty({
                                    text: obj.message,
                                    type: 'success',
                                    dismissQueue: true,
                                    layout: 'bottomRight',
                                    theme: 'defaultTheme'
                                });
                                new OptionButton().Refresh();
                        },
                        error:function(objeto, quepaso, otroobj){

                        }
                }); 
                $noty.close();

              }
            },
            {addClass: 'btn btn-danger', text: 'No', onClick: function($noty) {
                $noty.close();
                
            }
            }
          ]
        });


    },
    Delete:function(id){
        this.IdEntity=id;
        var parent=this;
        var n=noty({
          text: 'Desea habilitar/deshabilitar el registro seleccionado?',
          layout: 'center',
          theme: 'defaultTheme',
          modal:true,
          buttons: [
            {addClass: 'btn btn-success', text: 'Si', onClick: function($noty) {

                var url=Routing.generate(parent.routeDelete,{id:parent.IdEntity});
                 $.ajax({
                        type:'DELETE',
                        url:url,
                        dataType:"html",
                        success:function(request){
                                //var obj = jQuery.parseJSON(request);
                                var n = noty({
                                    text: "Se realizó la operación satisfactoriamente",
                                    type: 'success',
                                    dismissQueue: true,
                                    layout: 'bottomRight',
                                    theme: 'defaultTheme',
                                    timeout:5000
                                });
                                new OptionButton().Refresh();
                        },
                        error:function(objeto, quepaso, otroobj){

                        }
                }); 
                $noty.close();

              }
            },
            {addClass: 'btn btn-danger', text: 'No', onClick: function($noty) {
                $noty.close();
                
            }
            }
          ]
        });

       
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