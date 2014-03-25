var myWindow=null;


var OptionButton=function(){
    this.routeList='_admin_concurso';
    this.routeNew='_admin_concurso_new';
    this.routeSave='_admin_concurso_save';
    this.routeEdit='_admin_concurso_edit';
    this.routeUpdate='_admin_concurso_update';
    this.routeDelete='_admin_concurso_delete';

}
OptionButton.prototype={
    New:function(){

        this.Window=new BootstrapWindow({id:"winForm",title:"Nuevo Concurso"});
        this.Window.setWidth(1000);
        this.Window.setHeight(300);
        var url=Routing.generate(this.routeNew);
        this.Window.Load(url,"");
        this.Window.Show();
         var parent=this;
        this.Window.AddButton('btn-concurso-cancel',{
            label:'Cancelar',
            'class':'btn-default',
            fn:function(){
               parent.Window.Hide();
            }
            
        })
       
        this.Window.AddButton('btn-concurso-save',{
            label:'Grabar',
            'class':'btn-success',
            fn:function(){
                $('#btn-concurso-save').attr('disabled',true);
                $('#btn-concurso-cancel').attr('disabled',true);
                parent.Save();               
                
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
                    success:function(request){
                            $('#btn-concurso-save').attr('disabled',false);
                            $('#btn-concurso-cancel').attr('disabled',false);
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
    Edit:function(id){
        this.IdEntity=id;
        this.Window=new BootstrapWindow({id:"winForm",title:"Editar Concurso"});
        this.Window.setWidth(1000);
        this.Window.setHeight(300);
        var url=Routing.generate(this.routeEdit,{id:id});
        this.Window.Load(url,"");
        this.Window.Show();
        var parent=this;
        this.Window.AddButton('btn-concurso-cancel',{
            label:'Cancelar',
            'class':'btn-default',
            fn:function(){
                parent.Window.Hide();
            }
            
        })
       
        this.Window.AddButton('btn-concurso-save',{
            label:'Grabar',
            'class':'btn-success',
            fn:function(){
                $('#btn-concurso-save').attr('disabled',true);
                $('#btn-concurso-cancel').attr('disabled',true);
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
                            $('#btn-concurso-save').attr('disabled',false);
                            $('#btn-concurso-cancel').attr('disabled',false);
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

});