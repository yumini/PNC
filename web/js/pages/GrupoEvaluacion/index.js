var OptionButton = OptionButton || {GrupoEvaluacion: {}, Evaluador: {},Postulante:{}};
var myWindow=null;
var grupoId=-1;

OptionButton.GrupoEvaluacion=function(){
    this.routeList='_admin_grupoevaluacion';
    this.routeNew='_admin_grupoevaluacion_new';
    this.routeSave='_admin_grupoevaluacion_save';
    this.routeEdit='_admin_grupoevaluacion_edit';
    this.routeUpdate='_admin_grupoevaluacion_update';  
    this.routeDelete='_admin_grupoevaluacion_delete';  
}
OptionButton.GrupoEvaluacion.prototype={
	New:function(){
    	 console.log(this.routeNewGrupo);
        this.Window=new BootstrapWindow({id:"winForm",title:"Nuevo Grupo de Evaluación"});
        var url=Routing.generate(this.routeNew);
       
        console.log(url)
        this.Window.Load(url,"");
        this.Window.Show();
         var parent=this;
        this.Window.AddButton('btn-grupo-cancel',{
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
                parent.Save();               
            }
        });
    },
	Save:function(){
		var parent=this;
        parent.Window.Buttons(0).disabled();
        parent.Window.Buttons(1).disabled();
        var url=Routing.generate(this.routeSave);
        params = $('#myform').serializeObject();
        //console.log(params);
            
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"json",
                    success:function(data){
                            parent.Window.Buttons(0).enabled();
                            parent.Window.Buttons(1).enabled();

                            tipo=(data.success)?'success':'warning';
                            var n = noty({
                                    text: data.message,
                                    type: tipo,
                                    modal:false,
                                    timeout:5000,
                                    layout: 'bottomRight',
                                    theme: 'defaultTheme',
                                    timeout:5000                                  
                            });
                            if(data.success){
                                parent.Window.Hide();
                                setTimeout(function() {
                                        parent.Refresh();
                                }, 1000);
                            }
                    }
            });
	},
    Edit:function(id){
        this.IdEntity=id;
        this.Window=new BootstrapWindow({id:"winForm",title:"Editar Grupo de Evaluación"});
        
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
                parent.Update();               
            }
        });
    },
    Update:function(){
           
            var parent=this;

            parent.Window.Buttons(0).disabled();
            parent.Window.Buttons(1).disabled();
            var url=Routing.generate(this.routeUpdate,{id:this.IdEntity});
            params = $('#myform').serializeObject();
                    
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"json",
                    success:function(data){
                        parent.Window.Buttons(0).enabled();
                        parent.Window.Buttons(1).enabled();

                            tipo=(data.success)?'success':'warning';
                            var n = noty({
                                    text: data.message,
                                    type: tipo,
                                    modal:false,
                                    timeout:5000,
                                    layout: 'bottomRight',
                                    theme: 'defaultTheme',
                                    timeout:5000                                  
                            });
                            if(data.success){
                                parent.Window.Hide();
                                setTimeout(function() {
                                        parent.Refresh();
                                }, 1000);
                            }
                    },
                    error:function(objeto, quepaso, otroobj){

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
                            dataType:"html",
                            success:function(datos){
                                   var n = noty({
                                        text: "Registro eliminado satisfactoriamente",
                                        type: "success",
                                        dismissQueue: true,
                                        layout: 'bottomRight',
                                        theme: 'defaultTheme',
                                        timeout:5000
                                    }); 
                                    parent.Refresh(grupoId);
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
    },
    Select:function(obj,id){
         $("#btnNewPostulante").attr('disabled',false);
          $("#btnNewEvaluador").attr('disabled',false);
        grupoId=id;
	$(".list-group-item").removeClass("active")
        $(obj).addClass("active");
            new OptionButton.Evaluador().Refresh(id);
            new OptionButton.Postulante().Refresh(id);
    }
}

OptionButton.Evaluador=function(){
    this.routeNew="_admin_grupoevaluacionevaluador_new";
    this.routeSave="_admin_grupoevaluacionevaluador_save";
    this.routeDelete="_admin_grupoevaluacionevaluador_delete";
    this.routeActive="_admin_grupoevaluacionevaluador_activelider";
}
OptionButton.Evaluador.prototype={
    Refresh:function(id){
        var url=Routing.generate('_admin_grupoevaluacionevaluador',{id:id});
        new jAjax().Load(url,"container-evaluadores","GET","","")
        
    },
    New:function(id){
        this.GrupoId=id;
    	 console.log(this.routeNewGrupo);
        this.Window=new BootstrapWindow({id:"winForm",title:"Nuevo Evaluador"});
        var url=Routing.generate(this.routeNew,{id:id});

        this.Window.Load(url,"");
        this.Window.Show();
        var parent=this;
        this.Window.AddButton('btn-evaluador-cancel',{
            label:'Cancelar',
            'class':'btn-default',
            fn:function(){
                parent.Window.Hide();
            }
            
        })
       
        this.Window.AddButton('btn-evaluador-save',{
            label:'Grabar',
            'class':'btn-success',
            fn:function(){
                parent.Save();               
            }
        });
    },
    Save:function(){
	   var parent=this;
        parent.Window.Buttons(0).disabled();
        parent.Window.Buttons(1).disabled();   
        var url=Routing.generate(this.routeSave,{id:this.GrupoId});
        params = $('#myform').serializeObject();
                 
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"json",
                    success:function(request){
                            parent.Window.Buttons(0).enabled();
                            parent.Window.Buttons(1).enabled();   
                            var obj = request;
                            var tipo=(obj.success)?'success':'warning';
                            var n = noty({
                                    text: obj.message,
                                    type: tipo,
                                    dismissQueue: true,
                                    layout: 'bottomRight',
                                    theme: 'defaultTheme',
                                    timeout:5000
                            });
                            if(obj.success){
                                parent.Window.Hide();
                                setTimeout(function() {
                                    parent.Refresh(parent.GrupoId);
                                }, 1000);
                            }
                            
                    },
                    error:function(objeto, quepaso, otroobj){

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
                            dataType:"html",
                            success:function(datos){
                                   var n = noty({
                                        text: "Registro eliminado satisfactoriamente",
                                        type: "success",
                                        dismissQueue: true,
                                        layout: 'bottomRight',
                                        theme: 'defaultTheme',
                                        timeout:5000
                                    }); 
                                    parent.Refresh(grupoId);
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
        ActiveLider:function(id){
            this.IdEntity=id;
            if(confirm("Desea seleccionar al evluador lider?")){
                var url=Routing.generate(this.routeActive,{id:this.IdEntity});
                $.ajax({
                        type:'POST',
                        url:url,
                        dataType:"html",
                        success:function(datos){

                                new OptionButton.Evaluador().Refresh(grupoId);
                        },
                        error:function(objeto, quepaso, otroobj){

                        }
                }); 
            }
        }
    
}

OptionButton.Postulante=function(){
    this.routeList="_admin_grupoevaluacionpostulante";
    this.routeNew="_admin_grupoevaluacionpostulante_new";
    this.routeSave="_admin_grupoevaluacionpostulante_save";
    this.routeDelete="_admin_grupoevaluacionpostulante_delete";
   
}
OptionButton.Postulante.prototype={
    Refresh:function(id){
        var url=Routing.generate(this.routeList,{id:id});
        new jAjax().Load(url,"container-postulantes","GET","","")
        
    },
    New:function(id){
        this.GrupoId=id;
    	 console.log(this.routeNewGrupo);
        this.Window=new BootstrapWindow({id:"winForm",title:"Nuevo Postulante"});
        var url=Routing.generate(this.routeNew,{id:id});

        this.Window.Load(url,"");
        this.Window.Show();
        var parent=this;
        this.Window.AddButton('btn-postulante-cancel',{
            label:'Cancelar',
            'class':'btn-default',
            fn:function(){
                parent.Window.Hide();
            }
            
        })
       
        this.Window.AddButton('btn-postulante-save',{
            label:'Grabar',
            'class':'btn-success',
            fn:function(){
                parent.Save();               
               
            }
        });
    },
    Save:function(){
	var parent=this;
    parent.Window.Buttons(0).disabled();
    parent.Window.Buttons(1).disabled();
        var url=Routing.generate(this.routeSave,{id:this.GrupoId});
        params = $('#myform').serializeObject();
                 
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"json",
                    success:function(request){
                            parent.Window.Buttons(0).enabled();
                            parent.Window.Buttons(1).enabled();   
                            var obj = request;
                            var tipo=(obj.success)?'success':'warning';
                            var n = noty({
                                    text: obj.message,
                                    type: tipo,
                                    dismissQueue: true,
                                    layout: 'bottomRight',
                                    theme: 'defaultTheme',
                                    timeout:5000
                            });
                            if(obj.success){
                                parent.Window.Hide();
                                setTimeout(function() {
                                    parent.Refresh(parent.GrupoId);
                                }, 1000);
                            }

                            
                           // parent.Refresh(parent.GrupoId);
                    },
                    error:function(objeto, quepaso, otroobj){

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
                            dataType:"html",
                            success:function(datos){
                                   var n = noty({
                                        text: "Registro eliminado satisfactoriamente",
                                        type: "success",
                                        dismissQueue: true,
                                        layout: 'bottomRight',
                                        theme: 'defaultTheme',
                                        timeout:5000
                                    }); 
                                    parent.Refresh(grupoId);
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
        }
    
}

//al leer el documento
$(document).ready(function() {
  
  $(".list-group-item").click(function(){
  	var id=$(this).attr('data-id');
    console.log("select grupo:"+id);
      new OptionButton.GrupoEvaluacion().Select(this,id);   
  });
  $("#btnNewGrupo").click(function(){
      new OptionButton.GrupoEvaluacion().New();   
  });
  $("button[data-type='edit']").click(function(event) {
      var id=$(this).attr("data-id");
      new OptionButton.GrupoEvaluacion().Edit(id);
  });
  $("button[data-type='delete']").click(function(event) {
      var id=$(this).attr("data-id");
      new OptionButton.GrupoEvaluacion().Delete(id);
  });

    $("#btnNewEvaluador").click(function(event) {
      //var id=$(this).attr("data-id");
      new OptionButton.Evaluador().New(grupoId);
    });
    $("#btnNewPostulante").click(function(event) {
      //var id=$(this).attr("data-id");
      new OptionButton.Postulante().New(grupoId);
    });
});

