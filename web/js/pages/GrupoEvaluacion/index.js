var OptionButton = OptionButton || {GrupoEvaluacion: {}, Evaluador: {},Postulante:{}};
var myWindow=null;


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
                            parent.Refresh();
                    },
                    error:function(objeto, quepaso, otroobj){

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
                parent.Window.Hide();
            }
        });
    },
    Update:function(){
           
            var parent=this;
            var url=Routing.generate(this.routeUpdate,{id:this.IdEntity});
            params = $('#myform').serializeObject();
                    
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"html",
                    success:function(datos){
                            
                            new OptionButton.GrupoEvaluacion().Refresh();
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });           
    },
    Delete:function(id){
        this.IdEntity=id;
        if(confirm("Desea eliminar el Grupo de Evaluación seleccionado?")){
             var url=Routing.generate(this.routeDelete,{id:this.IdEntity});
             $.ajax({
                    type:'POST',
                    url:url,
                    dataType:"html",
                    success:function(datos){
                            
                            new OptionButton.GrupoEvaluacion().Refresh();
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
	Select:function(obj,id){
		$(".list-group-item").removeClass("active")
        $(obj).addClass("active");
 		$.ajax({type:'GET',
			data:{grupo_id:id},
	        url:Routing.generate('_admin_grupoevaluacion_postulantes_list'),
	        dataType:"html",
	        success:function (data) {
	            $("#container-postulantes").html(data);
            }
        });

        $.ajax({
				type:'GET',
				data:{grupo_id:id},
	            url:Routing.generate('_admin_grupoevaluacion_evaluadores_list'),
	            dataType:"html",
	            success:function (data) {
	                $("#container-evaluadores").html(data);
	            }
        });
            
	}
}
//al leer el documento
$(document).ready(function() {
  
  $(".list-group-item").click(function(){
  	var id=$(this).attr('data-id');
    console.log("select grupo");
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

});

