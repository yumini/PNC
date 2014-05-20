var myWindow=null;


var OptionButton=function(){
    this.routeList='_admin_encuesta';
    this.routeNew='_admin_encuesta_new';
    this.routeSave='_admin_encuesta_save';
    this.routeEdit='_admin_encuesta_edit';
    this.routeUpdate='_admin_encuesta_update';
    this.routeDelete='_admin_encuesta_delete';
    var self=this;
    this.Window=null;
}
OptionButton.prototype={
    New:function() {
      var self=this;
      var url=Routing.generate(this.routeNew);
      this.Window=new BootstrapWindow({id:"winForm",title:"Nueva Encuesta"});
      this.Window.setWidth(700);
      this.Window.Load(url,"");
      this.Window.Show();
      this.Window.AddButton('btn-encuesta-cancel',{
        label:'Cancelar',
        class:'btn-default',
        fn:function(){
          self.Cancel();
        }   
      })
       
      this.Window.AddButton('btn-encuesta-save',{
        label:'Grabar',
        class:'btn-success',
        fn:function(){
          self.Save();
        }
      });

      
    },
    Edit:function(id){
        this.IdEntity=id;
        var self=this;
        var url=Routing.generate(this.routeEdit,{id:id});
        this.Window=new BootstrapWindow({id:"winForm",title:"Editar Encuesta"});
        this.Window.setWidth(700);
        this.Window.Load(url,"");
        this.Window.Show();
        this.Window.AddButton('btn-encuesta-cancel',{
          label:'Cancelar',
          class:'btn-default',
          fn:function(){
            self.Cancel();
          }   
        })
         
        this.Window.AddButton('btn-encuesta-save',{
          label:'Grabar',
          class:'btn-success',
          fn:function(){
            self.Update();
          }
        });
    },
    Cancel:function(){
      this.Window.Hide();
    },
    Save:function(){
      this.Window.Buttons(0).disabled();
      this.Window.Buttons(1).disabled();

      var self=this;
      var url=Routing.generate(this.routeSave);
      var params = $('#myform').serializeObject();

      $.ajax({
        type:'POST',
        url:url,
        data:params,
        dataType:"json",
        success:function(data){
             self.Window.Buttons(0).enabled();
             self.Window.Buttons(1).enabled();
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
                 self.Window.Hide();
                 setTimeout(function() { new OptionButton().Refresh(); }, 1000);
             }
        }
      });
    },
    Update:function(){
      this.Window.Buttons(0).disabled();
      this.Window.Buttons(1).disabled();

      var self=this;
      var url=Routing.generate(this.routeUpdate,{id:this.IdEntity});
      var params = $('#myform').serializeObject();

      $.ajax({
        type:'PUT',
        url:url,
        data:params,
        dataType:"json",
        success:function(data){
             self.Window.Buttons(0).enabled();
             self.Window.Buttons(1).enabled();
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
                 self.Window.Hide();
                 setTimeout(function() { new OptionButton().Refresh(); }, 1000);
             }
        }
      });
    },
    Delete:function(id){
         this.IdEntity=id;
        var parent=this;
        var n=noty({
          text: 'Desea eliminar el registro seleccionado?',
          layout: 'center',
          theme: 'defaultTheme',
          modal:true,
          buttons: [
            {addClass: 'btn btn-success', text: 'Si', onClick: function($noty) {

                var url=Routing.generate(parent.routeDelete,{id:parent.IdEntity});
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
                                    timout:5000
                                }); 
                                if(data.success)
                                  new OptionButton().Refresh();
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


//al leer el documento
$(document).ready(function() {
  
  
  $("#btnNew").click(function(){
    console.log("nuevo concurso");
      new OptionButton().New();   
  });

 $(".row-edit").click(function(){
      var id=$(this).attr("data-id"); 
      new OptionButton().Edit(id);  
  });
  $(".row-delete").click(function(){
      var id=$(this).attr("data-id"); 
      new OptionButton().Delete(id);  
  });
  $(".row-show").click(function(){
      var id=$(this).attr("data-id"); 
      new OptionButton().show(id);  
  });
   
});