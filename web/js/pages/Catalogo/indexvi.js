var myWindow=null;


var OptionButton=function(){
    this.routeList='_admin_tvi_list';
    this.routeNew='_admin_td_new';
    this.routeSave='_admin_td_save';
    this.routeEdit='_admin_td_edit';
    this.routeUpdate='_admin_td_update';
    this.routeDelete='_admin_td_delete';
    
}
OptionButton.prototype={
    New:function(){
        this.Window=new BootstrapWindow({id:"winForm",title:"Nuevo Tipo Conflicto de Interes"});
        var url=Routing.generate(this.routeNew,{codcat:"TVI"}); //:Tipo Conflicto de Interes
        this.Window.Load(url,"");
        this.Window.Show();
         var parent=this;
        this.Window.AddButton('btn-td-cancel',{
            label:'Cancelar',
            'class':'btn-default',
            fn:function(){
                parent.Window.Hide();
            }
            
        })
       
        this.Window.AddButton('btn-td-save',{
            label:'Grabar',
            'class':'btn-success',
            fn:function(){
                parent.Save();               
                parent.Window.Hide();
            }
        });
    },
    Save:function(){
            var url=Routing.generate(this.routeSave,{codcat:"TVI"});
            params = $('#myform').serializeObject();
        
            console.log(params);
            
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"html",
                    success:function(datos){
                            //parent.Window.AddHTML(datos);
                            new OptionButton().Refresh();
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });
        
    },
    Edit:function(id){
        this.IdEntity=id;
        this.Window=new BootstrapWindow({id:"winForm",title:"Tipo Conflicto de Interes"});
        var url=Routing.generate(this.routeEdit,{id:id});
        this.Window.Load(url,"");
        this.Window.Show();
        var parent=this;
        this.Window.AddButton('btn-td-cancel',{
            label:'Cancelar',
            'class':'btn-default',
            fn:function(){
                parent.Window.Hide();
            }
            
        })
       
        this.Window.AddButton('btn-td-save',{
            label:'Grabar',
            'class':'btn-success',
            fn:function(){
                parent.Update();               
                parent.Window.Hide();
            }
        });
    },
    Update:function(){
            console.log("actualizando  con id:"+this.IdEntity);
            var parent=this;
            var url=Routing.generate(this.routeUpdate,{id:this.IdEntity});
            params = $('#myform').serializeObject();
                     
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
    Delete:function(id){
        this.IdEntity=id;
        if(confirm("Desea eliminar el tipo conflicto de interes seleccionado?")){
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
        new jAjax().Load(url,'main-body','get','TVI','');
    }
}


//al leer el documento
$(document).ready(function() {
  
  
  $("#btnNew").click(function(){
      var id=$(this).attr("data-id"); 
      new OptionButton().New(id);   
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