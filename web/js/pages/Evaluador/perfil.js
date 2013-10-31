var OptionButton = OptionButton || {Perfil: {}, Contactos: {}};
var myWindow=null;


OptionButton.Perfil=function(){
    this.routeList='_admin_evaluador_perfil';
   
    this.routeEdit='_admin_evaluador_edit';
    this.routeUpdate='_admin_evaluador_update';    
}
OptionButton.Perfil.prototype={
    Edit:function(id){
        this.IdEntity=id;
        this.Window=new BootstrapWindow({id:"winForm",title:"Editar Mi Perfil"});
        this.Window.setWidth(750);
        this.Window.setHeight(450);
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
        var id=$('#hdnEntity_id').val();
        var url=Routing.generate(this.routeList,{id:id});
        new jAjax().Load(url,'main-body','get','','');
    }

   

}

OptionButton.Conflictos=function(){
     this.routeList='_admin_conflictodeinteres';
     this.routeNew='_admin_conflictodeinteres_new';
     this.routeSave='_admin_conflictodeinteres_save';
     this.routeEdit='_admin_conflictodeinteres_edit';
     this.routeUpdate='_admin_conflictodeinteres_update';
     this.routeDelete='_admin_conflictodeinteres_delete';
};

OptionButton.Conflictos.prototype={
     Refresh:function(){
        var id=$("#hdnEntity_id").val();
        var url=Routing.generate(this.routeList,{id:id});
        new jAjax().Load(url,'containerConflicto','get','','');
    },
    New:function(){
        this.Window=new BootstrapWindow({id:"winForm",title:"Agregar Conflicto de Interes"});
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
            var id=$("#hdnEntity_id").val();
            var url=Routing.generate(this.routeSave,{id:id});
            params = $('#myform').serializeObject();
            console.log(params);
            
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"html",
                    success:function(datos){
                            //parent.Window.AddHTML(datos);
                           new OptionButton.Conflictos().Refresh(); 
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });
        
    },
    Edit:function(id){
        this.IdEntity=id;
        this.Window=new BootstrapWindow({id:"winForm",title:"Editar Conflicto de Interes"});
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
            console.log("actualizando conflicto de interes con id:"+this.IdEntity);
            var parent=this;
            var url=Routing.generate(this.routeUpdate,{id:this.IdEntity});
            params = $('#myform').serializeObject();
                   
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"html",
                    success:function(datos){
                            new OptionButton.Conflictos().Refresh(); 
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
                            
                            new OptionButton.Conflictos().Refresh(); 
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            }); 
        }
    }
};


OptionButton.Disponibilidad=function(){
     this.routeList='_admin_evaluadordisponibilidad';
     this.routeNew='_admin_evaluadordisponibilidad_new';
     this.routeSave='_admin_evaluadordisponibilidad_save';
     this.routeEdit='_admin_evaluadordisponibilidad_edit';
     this.routeUpdate='_admin_evaluadordisponibilidad_update';
     this.routeDelete='_admin_evaluadordisponibilidad_delete';
     this.routeDisponibilidadViaje="_admin_evaluadordisponibilidad_disponibilidadviaje"
};

OptionButton.Disponibilidad.prototype={
    Refresh:function(){
        var id=$("#hdnEntity_id").val();
        var url=Routing.generate(this.routeList,{id:id});
        new jAjax().Load(url,'containerDisponibildad','get','','');
    },
    New:function(){
        this.Window=new BootstrapWindow({id:"winForm",title:"Agregar Disponibilidad"});
        this.Window.setWidth(600);
        //this.Window.setHeight(360);
        var url=Routing.generate(this.routeNew);
        this.Window.Load(url,"");
        this.Window.Show();
        var parent=this;
        this.Window.AddButton('btn-disponibilidad-cancel',{
            label:'Cancelar',
            'class':'btn-default',
            fn:function(){
                parent.Window.Hide();
            }
            
        })
       
        this.Window.AddButton('btn-disponibilidad-save',{
            label:'Grabar',
            'class':'btn-success',
            fn:function(){
                parent.Save();               
                parent.Window.Hide();
            }
        });
    },
    Save:function(){
            var id=$('#hdnEntity_id').val();
            var parent=this;
            var url=Routing.generate(this.routeSave,{id:id});
            params = $('#myDisponibilidadform').serializeObject();
            console.log(params);
            
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"html",
                    success:function(datos){
                            //parent.Window.AddHTML(datos);
                           new OptionButton.Disponibilidad().Refresh(); 
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });
        
    },
    Edit:function(id){
        this.IdEntity=id;
        this.Window=new BootstrapWindow({id:"winForm",title:"Editar Conflicto de Interes"});
        this.Window.setWidth(600);
        //this.Window.setHeight(360);
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
            
            var parent=this;
            var url=Routing.generate(this.routeUpdate,{id:this.IdEntity});
            params = $('#myDisponibilidadform').serializeObject();
                   
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"html",
                    success:function(datos){
                            new OptionButton.Disponibilidad().Refresh(); 
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });           
    },
    Delete:function(id){
        this.IdEntity=id;
        if(confirm("Desea eliminar el dia seleccionado?")){
             var url=Routing.generate(this.routeDelete,{id:this.IdEntity});
             $.ajax({
                    type:'DELETE',
                    url:url,
                    dataType:"html",
                    success:function(datos){
                            
                            new OptionButton.Disponibilidad().Refresh(); 
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            }); 
        }
    },
    DisponibilidadViaje:function(id,value){
        this.IdEntity=id;
        var url=Routing.generate(this.routeDisponibilidadViaje,{id:this.IdEntity,estado:value});
         $.ajax({
                    type:'POST',
                    url:url,
                    dataType:"html",
                    success:function(datos){
                            
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
         }); 
    }
};
//al leer el documento
$(document).ready(function() {
  
    $("#btnEdit").click(function(){
      	var id=$(this).attr("data-id"); 
      	console.log("el id es:"+id);
        new OptionButton.Perfil().Edit(id);   
    });


    $("#btnConflictoNew").click(function(){
        var id=$(this).attr("data-id"); 
        console.log("el id es:"+id);
        new OptionButton.Conflictos().New(id);   
    });
     $("#btnDisponibilidadNew").click(function(){
        var id=$(this).attr("data-id"); 
        console.log("el id es:"+id);
        new OptionButton.Disponibilidad().New(id);   
    });
    
    $("input[name=disponibilidad]:radio").change(function(){
        var id=$(this).attr("data-id");
        console.log(id);
        new OptionButton.Disponibilidad().DisponibilidadViaje(id,$(this).val());   
    });
    $('#lnkCV').click(function(){
	        $('#fileCV').click();
    });
    new OptionButton.Conflictos().Refresh(); 
    new OptionButton.Disponibilidad().Refresh(); 
    
  
});

$('#fileCV').fileupload({

        url:Routing.generate("_admin_evaluador_cvupload"),
        singleFileUploads: true,
        add: function (e, data) {
            var jqXHR = data.submit();
        },
        progress: function(e, data){
            var progress = parseInt(data.loaded / data.total * 100, 10);
        },
        fail:function(e, data){
            //data.context.addClass('error');
        },
        done:function (e, data) {
        	var obj = jQuery.parseJSON(data.result);
                if(obj.status=="success"){
                    var path=$("#lnkCVDownload").attr('data-path');
                    $("#lnkCVDownload").attr("href",path+obj.name+"?r="+Math.random()); 
                }
                 bootbox.alert(obj.message, function() {
                                //console.log("Alert Callback");
                            });
        }
    });