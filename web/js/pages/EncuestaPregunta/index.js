var myWindow=null;
var Entity=Entity|| {};

Entity.Pregunta = (function() {
    
    var routeList='_admin_encuestapregunta';
    var routeNew='_admin_encuestapregunta_new';
    var routeSave='_admin_encuestapregunta_save';
    var routeEdit='_admin_encuestapregunta_edit';
    var routeUpdate='_admin_encuestapregunta_update';
    var routeDelete='_admin_encuestapregunta_delete';
    var IdEncuesta=$('#idEncuesta').val();   
    var containerId='main-body';
    var IdPregunta=-1;
    var Window=null;
    return {
        Window:Window,
        New: function(){
            var url=Routing.generate(routeNew);
            Window=new BootstrapWindow({id:"winForm",title:"Nueva Pregunta"});
            Window.setWidth(700);
            Window.Load(url,"");
            Window.Show();
            Window.AddButton('btn-encuesta-cancel',{
              label:'Cancelar',
              class:'btn-default',
              fn:function(){
                Entity.Pregunta.Cancel();
              }   
            })
             
            Window.AddButton('btn-encuesta-save',{
              label:'Grabar',
              class:'btn-success',
              fn:function(){
                Entity.Pregunta.Save();
              }
            });
        },
        Save:function(){
            Window.DisabledButtons();
            var url=Routing.generate(routeSave);
            var params = $('#myform').serializeObject();
            params.encuesta_id=IdEncuesta;
            $.ajax({
              type:'POST',
              url:url,
              data:params,
              dataType:"json",
              success:function(data){
                   Window.EnabledButtons();
                   tipo=(data.success)?'success':'warning';
                   var n = noty({
                           text: data.message,
                           type: tipo,
                           dismissQueue: true,
                           layout: 'bottomRight',
                           theme: 'defaultTheme',
                           timeout:5000
                   });
                   if(data.success){
                       Window.Hide();
                       setTimeout(Entity.Pregunta.Refresh, 1000);
                   }
              }
            });
        },
        Edit: function(id){
            IdEntity=id;
            var url=Routing.generate(routeEdit,{id:id});
            Window=new BootstrapWindow({id:"winForm",title:"Editar Pregunta"});
            Window.setWidth(700);
            Window.Load(url,"");
            Window.Show();
            Window.AddButton('btn-pregunta-cancel',{
              label:'Cancelar',
              class:'btn-default',
              fn:function(){
                Entity.Pregunta.Cancel();
              }   
            })
             
            Window.AddButton('btn-pregunta-save',{
              label:'Grabar',
              class:'btn-success',
              fn:function(){
                Entity.Pregunta.Update();
              }
            });
        },
        Update:function(){
            Window.DisabledButtons();
            var url=Routing.generate(routeUpdate,{id:IdEntity});
            var params = $('#myform').serializeObject();
            params.encuesta_id=IdEncuesta;
            $.ajax({
              type:'PUT',
              url:url,
              data:params,
              dataType:"json",
              success:function(data){
                   Window.EnabledButtons();
                   tipo=(data.success)?'success':'warning';
                   var n = noty({
                           text: data.message,
                           type: tipo,
                           dismissQueue: true,
                           layout: 'bottomRight',
                           theme: 'defaultTheme',
                           timeout:5000
                   });
                   if(data.success){
                       Window.Hide();
                       setTimeout(Entity.Pregunta.Refresh, 1000);
                   }
              }
            });
        },
        Delete:function(id){
            IdEntity=id;
            var n=noty({
              text: 'Desea eliminar el registro seleccionado?',
              layout: 'center',
              theme: 'defaultTheme',
              modal:true,
              buttons: [
                {addClass: 'btn btn-success', text: 'Si', onClick: function($noty) {

                    var url=Routing.generate(routeDelete,{id:IdEntity});
                     $.ajax({
                            type:'DELETE',
                            url:url,
                            dataType:"json",
                            success:function(data){
                                   var type=(data.success)?'success':'warning';
                                   var n = noty({
                                        text: data.message,
                                        type: type,
                                        dismissQueue: true,
                                        layout: 'bottomRight',
                                        theme: 'defaultTheme',
                                        timeout:5000
                                    }); 
                                    if(data.success)
                                      Entity.Pregunta.Refresh();
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
        Cancel:function(){
            Window.Hide()
        },
        Refresh:function(){
            var url=Routing.generate(routeList,{id:IdEncuesta});
            new jAjax().Load(url,containerId,'get','','');
        }
    };
})();


Entity.Opcion = (function() {
    
    var routeList='_admin_encuestapreguntaopcion';
    var routeNew='_admin_encuestapreguntaopcion_new';
    var routeSave='_admin_encuestapreguntaopcion_save';
    var routeEdit='_admin_encuestapreguntaopcion_edit';
    var routeUpdate='_admin_encuestapreguntaopcion_update';
    var routeDelete='_admin_encuestapreguntaopcion_delete';
    var IdEncuesta=$('#idEncuesta').val();   
    var containerId='main-body';
    var IdPregunta=-1;
    var Window=null;
    return {
      Window:Window,
      New:function(id){
            IdPregunta=id;
            var url=Routing.generate(routeNew);
            Window=new BootstrapWindow({id:"winForm",title:"Nueva Opción"});
            Window.setWidth(700);
            Window.Load(url,"");
            Window.Show();
            Window.AddButton('btn-opcion-cancel',{
              label:'Cancelar',
              class:'btn-default',
              fn:function(){
                Entity.Opcion.Cancel();
              }   
            })
             
            Window.AddButton('btn-opcion-save',{
              label:'Grabar',
              class:'btn-success',
              fn:function(){
                Entity.Opcion.Save();
              }
            });
      },
      Cancel:function(){
          Window.Hide();
      },
      Save:function(){
            Window.DisabledButtons();
            var url=Routing.generate(routeSave);
            var params = $('#myform').serializeObject();
            params.pregunta_id=IdPregunta;
            $.ajax({
              type:'POST',
              url:url,
              data:params,
              dataType:"json",
              success:function(data){
                   Window.EnabledButtons();
                   tipo=(data.success)?'success':'warning';
                   var n = noty({
                           text: data.message,
                           type: tipo,
                           dismissQueue: true,
                           layout: 'bottomRight',
                           theme: 'defaultTheme',
                           timeout:5000
                   });
                   if(data.success){
                       Window.Hide();
                       setTimeout(Entity.Pregunta.Refresh, 1000);
                   }
              }
            });
      },
      Edit:function(id){
            IdEntity=id;
            var url=Routing.generate(routeEdit,{id:id});
            Window=new BootstrapWindow({id:"winForm",title:"Editar Opción"});
            Window.setWidth(700);
            Window.Load(url,"");
            Window.Show();
            Window.AddButton('btn-pregunta-cancel',{
              label:'Cancelar',
              class:'btn-default',
              fn:function(){
                Entity.Opcion.Cancel();
              }   
            })
             
            Window.AddButton('btn-pregunta-save',{
              label:'Grabar',
              class:'btn-success',
              fn:function(){
                Entity.Opcion.Update();
              }
            });
      },
      Update:function(){
            Window.DisabledButtons();
            var url=Routing.generate(routeUpdate,{id:IdEntity});
            var params = $('#myform').serializeObject();
            
            $.ajax({
              type:'PUT',
              url:url,
              data:params,
              dataType:"json",
              success:function(data){
                   Window.EnabledButtons();
                   tipo=(data.success)?'success':'warning';
                   var n = noty({
                           text: data.message,
                           type: tipo,
                           dismissQueue: true,
                           layout: 'bottomRight',
                           theme: 'defaultTheme',
                           timeout:5000
                   });
                   if(data.success){
                       Window.Hide();
                       setTimeout(Entity.Pregunta.Refresh, 1000);
                   }
              }
            });
      },
      Delete:function(id){
            IdEntity=id;
            var n=noty({
              text: 'Desea eliminar el registro seleccionado?',
              layout: 'center',
              theme: 'defaultTheme',
              modal:true,
              buttons: [
                {addClass: 'btn btn-success', text: 'Si', onClick: function($noty) {

                    var url=Routing.generate(routeDelete,{id:IdEntity});
                     $.ajax({
                            type:'DELETE',
                            url:url,
                            dataType:"json",
                            success:function(data){
                                   var type=(data.success)?'success':'warning';
                                   var n = noty({
                                        text: data.message,
                                        type: type,
                                        dismissQueue: true,
                                        layout: 'bottomRight',
                                        theme: 'defaultTheme',
                                        timeout:5000
                                    }); 
                                    if(data.success)
                                      Entity.Pregunta.Refresh();
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
        }
    }
})();
//al leer el documento
$(document).ready(function() {
  
  
  $("#btn-new-pregunta").click(function(){
      Entity.Pregunta.New();   
  });
  $(".row-toggle").click(function(){
      var self=this;
      var id=$(this).attr('data-id');
      var table=$("#opciones-"+id);
      var show=(table.attr('data-show')=='true')?true:false;
      show=!show;
    
      table.attr('data-show',show);
      if(show)
        $(this).html('<span class="glyphicon glyphicon-minus"> </span>');     
      else
        $(this).html('<span class="glyphicon glyphicon-plus"> </span>');    
      table.toggle("linear");

      
  });
 $(".row-edit-pregunta").click(function(){
      var id=$(this).attr("data-id"); 
      Entity.Pregunta.Edit(id);   
  });
  $(".row-delete-pregunta").click(function(){
      var id=$(this).attr("data-id"); 
      Entity.Pregunta.Delete(id); 
  });

  $(".btn-new-opcion").click(function(){
      var id=$(this).attr("data-id"); 
      Entity.Opcion.New(id);   
  });
  $(".btn-edit-opcion").click(function(){
      var id=$(this).attr("data-id"); 
      Entity.Opcion.Edit(id);   
  });
  $(".btn-delete-opcion").click(function(){
      var id=$(this).attr("data-id"); 
      Entity.Opcion.Delete(id);   
  });
   
});