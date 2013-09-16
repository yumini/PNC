var myWindow=null;


var OptionButton=function(){
    this.routeList='_admin_concurso_criterio';
    this.routeNew='_admin_concursocriterio_new';
    this.routeSave='_admin_concursocriterio_save';
    /*this.routeEdit='_admin_concurso_edit';
    this.routeUpdate='_admin_concurso_update';
    this.routeDelete='_admin_concurso_delete';
*/
    
}
OptionButton.prototype={
    New:function(){
    	var idConcurso=$("#idConcurso").val();
        this.Window=new BootstrapWindow({id:"winForm",title:"Nuevo Criterio"});
        this.Window.setWidth(700);
        this.Window.setHeight(300);
        var url=Routing.generate(this.routeNew,{id:idConcurso});
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
            var parent=this;
            var url=Routing.generate(this.routeSave);
            params = $('#myform').serializeObject();
            params.idConcurso=$("#idConcurso").val();  
            
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
       /* this.IdEntity=id;
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
                parent.Update();               
                parent.Window.Hide();
            }
        });
*/
    },
    Update:function(){
    	/*
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
            });     */      
    },
    Delete:function(id){
    	/*
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
        */
    },
    Refresh:function(){
    	
        var url=Routing.generate(this.routeList,{id:$("#idConcurso").val()});
        new jAjax().Load(url,'main-body','get','','');
        
    }
}



$(document).ready(function() {

	var fnOpciones=function(id){
		var options=""
		if (id){
	    	options+='<div style="width:100%">';
	    	options+='<a href="#" class="row-show" data-id="'+id+'" title="Ver Detalle"><i class="glyphicon glyphicon-search"> </i></a> ';
	        options+='<a href="#" class="row-edit" data-id="'+id+'" title="Editar"><i class="glyphicon glyphicon-pencil"> </i></a> ';
	        options+='<a href="#" class="row-add" data-id="'+id+'"><i class="glyphicon glyphicon-plus" title="Criterios"> </i></a> ';
	        options+='<a href="#" class="row-delete" data-id="'+id+'" title="Eliminar"><i class="glyphicon glyphicon-trash"> </i></a> ';
	        options+='</div>';
	        return options;
	    } else {
	        return '';
	    }
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
        {field:'id',title:'Opciones',width:60,formatter:fnOpciones,align:'center'}
    ]],
    onLoadSuccess:function(){
    	$("#grid").children('div').eq(0).css("width","100%");
    	$("#grid").children('div').eq(0).children('div').eq(0).css("width","100%");
    	$(".datagrid-btable").width("100%");
    	$(".datagrid-header-inner").width("100%");
    	$(".datagrid-htable").width("100%");
    }
	});

	$('#btnNewCriterio').click(function(){
		new OptionButton().New();
	});

});

