var myWindow=null;


var OptionButton=function(){
    this.routeList='_admin_etapa';
    this.routeNew='_admin_etapa_new';
    this.routeSave='_admin_etapa_save';
    this.routeEdit='_admin_etapa_edit';
    this.routeUpdate='_admin_etapa_update';
    this.routeDelete='_admin_etapa_delete';
    this.routeCriterios="_admin_etapa_criterio";
    
}
OptionButton.prototype={
    New:function(){

        this.Window=new BootstrapWindow({id:"winForm",title:"Nueva Etapa"});
        this.Window.setWidth(500);
        this.Window.setHeight(250);
        var url=Routing.generate(this.routeNew);
        this.Window.Load(url,"");
        this.Window.Show();
         var parent=this;
        this.Window.AddButton('btn-etapa-cancel',{
            label:'Cancelar',
            'class':'btn-default',
            fn:function(){
                parent.Window.Hide();
            }
            
        })
       
        this.Window.AddButton('btn-etapa-save',{
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
                            new OptionButton().Refresh();
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });
        
    },
    Edit:function(id){
        this.IdEntity=id;
        this.Window=new BootstrapWindow({id:"winForm",title:"Editar Concurso"});
        this.Window.setWidth(1000);
        this.Window.setHeight(300);
        var url=Routing.generate(this.routeEdit,{id:id});
        this.Window.Load(url,"");
        this.Window.Show();
        var parent=this;
        this.Window.AddButton('btn-etapa-cancel',{
            label:'Cancelar',
            'class':'btn-default',
            fn:function(){
                parent.Window.Hide();
            }
            
        })
       
        this.Window.AddButton('btn-etapa-save',{
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
                            
                            new OptionButton().Refresh();
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });           
    },
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
  
  
  $("#btnNew").click(function(){
    console.log("nuevo etapa");
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
    $(".row-criterios").click(function(){
      var id=$(this).attr("data-id"); 
      new OptionButton().Criterios(id);  
    });
});