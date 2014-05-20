var myWindow=null;


var OptionButton=function(){
    this.routeList='_admin_concurso_criterio';
    this.routeNew='_admin_concursocriterio_new';
    this.routeSave='_admin_concursocriterio_save';
    this.routeEdit='_admin_concursocriterio_edit';
    this.routeUpdate='_admin_concursocriterio_update';
    this.routeDelete='_admin_concursocriterio_delete';
    this.idPadre=0;
    
}
OptionButton.prototype={
    getTitulo:function(tipo,opcion){
        var titulo;
        switch(tipo){
            case 1:
                tituloOpcion=(opcion==1)?"Nuevo ":"Editar ";
                titulo=tituloOpcion+"Criterio";
                break;
            case 2:
                tituloOpcion=(opcion==1)?"Nuevo ":"Editar "
                titulo=tituloOpcion+"Subcriterio";
                break;
            case 3:
                tituloOpcion=(opcion==1)?"Nueva ":"Editar "
                titulo=tituloOpcion+"Area de Analisis";
                break;
            case 4:
                tituloOpcion=(opcion==1)?"Nueva ":"Editar "
                titulo=tituloOpcion+"Pregunta";
                break;
        }
        return titulo;
    },
    New:function(idpadre,tipo){
    	var idConcurso=$("#idConcurso").val();
        this.Window=new BootstrapWindow({id:"winForm",title:this.getTitulo(tipo,1)});
        this.Window.setWidth(700);
        //this.Window.setHeight(300);
        this.idPadre=idpadre;
        var url=Routing.generate(this.routeNew,{id:idConcurso,idPadre:this.idPadre});
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
                parent.Save();               
               
            }
        });
    },
    Save:function(){
            var idConcurso=$("#idConcurso").val();
            var parent=this;
            parent.Window.Buttons(0).disabled();
            parent.Window.Buttons(1).disabled();
            var url=Routing.generate(this.routeSave,{id:idConcurso});
            params = $('#myform').serializeObject();
           
            params.idPadre=this.idPadre;
            
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"html",
                    success:function(request){
                            parent.Window.Buttons(0).enabled();
                            parent.Window.Buttons(1).enabled();
                            var obj = jQuery.parseJSON(request);
                            tipo=(obj.success)?'success':'warning';
                            
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
                                setTimeout(function(){
                                    new OptionButton().Refresh();
                                },1000)
                                
                            }
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });
        
    },
    Edit:function(id,tipo){
        this.IdEntity=id;
        this.Window=new BootstrapWindow({id:"winForm",title:this.getTitulo(tipo,2)});
        this.Window.setWidth(700);
       
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
                    dataType:"html",
                    success:function(request){
                            parent.Window.Buttons(0).enabled();
                            parent.Window.Buttons(1).enabled();
                            var obj = jQuery.parseJSON(request);
                            tipo=(obj.success)?'success':'warning';
                            
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
                                setTimeout(function(){
                                    new OptionButton().Refresh();
                                },1000)
                                
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
                                        modal:false,
                                        timeout:5000,
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
    Refresh:function(){
    	
        var url=Routing.generate(this.routeList,{id:$("#idConcurso").val()});
        new jAjax().Load(url,'main-body','get','','');
        
    }
}



$(document).ready(function() {
    $('#treeGrid').treegrid({
                    expanderExpandedClass: 'glyphicon glyphicon-minus',
                    expanderCollapsedClass: 'glyphicon glyphicon-plus',
                    initialState:'collapse'
                });


	$('#btnNewCriterio').click(function(){
		new OptionButton().New(0,1);
	});

     $(".row-add").click(function(){
            var id=$(this).attr("data-id");
            var type=parseInt($(this).attr("data-type"))+1;
            new OptionButton().New(id,type);
    });
    $(".row-edit").click(function(){
        var id=$(this).attr("data-id"); 
        var type=parseInt($(this).attr("data-type"));          
        new OptionButton().Edit(id,type);
    });
    $(".row-delete").click(function(){
        var id=$(this).attr("data-id"); 
        var type=parseInt($(this).attr("data-type"));          
        new OptionButton().Delete(id);
    });

});

