var myWindow=null;


var OptionButton=function(){
    this.routeList='_admin_perfil';
    this.routeNew='_admin_perfil_new';
    this.routeSave='_admin_perfil_save';
    this.routeEdit='_admin_perfil_edit';
    this.routeUpdate='_admin_perfil_update';
    this.routeDelete='_admin_perfil_delete';
    
}
OptionButton.prototype={
    New:function(){
        this.Window=new BootstrapWindow({id:"winForm",title:"Nuevo Perfil"});
        var url=Routing.generate(this.routeNew);
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
                $('#btn-perfil-save').attr('disabled',true);
                $('#btn-perfil-cancel').attr('disabled',true);
                parent.Save();               
                //parent.Window.Hide();
            }
        });
    },
    Save:function(){
       
            var parent=this;
            var url=Routing.generate(this.routeSave);
            params = $('#myform').serializeObject();
            var nodes = $('#tree').tree('getChecked');
            var s = '';
            for(var i=0; i<nodes.length; i++){
                if (s != '') s += ',';
                s += nodes[i].id;
            }
            params.perfil=s;
            console.log(s);
            console.log(params);
            
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"html",
                    success:function(request){
                            $('#btn-perfil-save').attr('disabled',false);
                            $('#btn-perfil-cancel').attr('disabled',false);

                            var obj = jQuery.parseJSON(request);
                            if(obj.success=='false'){
                                tipo='warning';
                            }else{
                                tipo='success';
                                parent.Window.Hide();
                                
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
        this.Window=new BootstrapWindow({id:"winForm",title:"Editar Perfil"});
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
                $('#btn-perfil-save').attr('disabled',true);
                $('#btn-perfil-cancel').attr('disabled',true);
                parent.Update();               
               
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
                    success:function(request){
                            $('#btn-perfil-save').attr('disabled',false);
                            $('#btn-perfil-cancel').attr('disabled',false);
                            time=5000;        
                            var obj = jQuery.parseJSON(request);
                            if(obj.success=='false'){
                                tipo='warning';
                            }else{
                                tipo='success';
                                parent.Window.Hide();
                                time=3000;
                                
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
                                if(obj.success=='true')
                                    new OptionButton().Refresh();
                            }, time);
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
    }
}


//al leer el documento
$(document).ready(function() {
  
  
  $("#btnNew").click(function(){
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
});