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
                parent.Window.Hide();
            }
        });
    },
    Save:function(){
            var idConcurso=$("#idConcurso").val();
            var parent=this;
            var url=Routing.generate(this.routeSave,{id:idConcurso});
            params = $('#myform').serializeObject();
           
            params.idPadre=this.idPadre;
            
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
                            
                            new OptionButton().Refresh();
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });          
    },
    Delete:function(id){
        this.IdEntity=id;
        if(confirm("Desea eliminar el elemento seleccionado?")){
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
    	
        var url=Routing.generate(this.routeList,{id:$("#idConcurso").val()});
        new jAjax().Load(url,'main-body','get','','');
        
    }
}



$(document).ready(function() {

	var fnOpciones=function(value){
        var n=value.split("-");
        var id=n[0];
        var tipo=parseInt(n[1]);
		var options=""
        options+='<div style="width:100%">';
            options+='<a href="javascript:void(0);" class="row-show black" data-id="'+id+'" data-tipo="'+tipo+'" title="Ver Detalle"><i class="glyphicon glyphicon-search"> </i></a> ';           
            options+='<a href="javascript:void(0);" class="row-edit" data-id="'+id+'" data-tipo="'+tipo+'" title="Editar"><i class="glyphicon glyphicon-pencil"> </i></a> ';
            options+='<a href="javascript:void(0);" class="row-delete red" data-id="'+id+'" title="Eliminar" data-tipo="'+tipo+'"><i class="glyphicon glyphicon-remove"> </i></a> ';
		if (tipo!=4)
	    	options+='<a href="javascript:void(0);" class="row-add green" data-id="'+id+'" data-tipo="'+tipo+'"><i class="glyphicon glyphicon-plus" title="Nuevo"> </i></a> ';
        else
            options+='<a href="javascript:void(0);"><i>&nbsp;</i></a> ';
        options+='</div>';
        return options;
	}
	
	$('#gridCriterios').treegrid({
	
    url:Routing.generate("_admin_concurso_criterio_json",{id:$("#idConcurso").val()}),
    idField:'id',
    treeField:'descripcion',
    method: 'get',
    columns:[[
        {title:'Código',field:'codigo',width:40},
        {field:'descripcion',title:'Descripción',align:'left'},
        {field:'tipoArbol',title:'Tipo',width:100},
        {field:'puntaje',title:'Puntaje',width:80},
        {field:'tipoOpciones',title:'Opciones',width:60,formatter:fnOpciones,align:'center'}
    ]],
    onLoadSuccess:function(){
    	$("#grid").children('div').eq(0).css("width","100%");
    	$("#grid").children('div').eq(0).children('div').eq(0).css("width","100%");
    	$(".datagrid-btable").width("100%");
    	$(".datagrid-header-inner").width("100%");
    	$(".datagrid-htable").width("100%");
        $(".row-add").click(function(){
            var id=$(this).attr("data-id");
            var tipo=parseInt($(this).attr("data-tipo"))+1;
            new OptionButton().New(id,tipo);
        });
        $(".row-edit").click(function(){
            var id=$(this).attr("data-id"); 
            var tipo=parseInt($(this).attr("data-tipo"));          
            new OptionButton().Edit(id,tipo);
        });
        $(".row-delete").click(function(){
            var id=$(this).attr("data-id"); 
            var tipo=parseInt($(this).attr("data-tipo"));          
            new OptionButton().Delete(id);
        });
        
    }
	});

	$('#btnNewCriterio').click(function(){
		new OptionButton().New(0,1);
	});

});

