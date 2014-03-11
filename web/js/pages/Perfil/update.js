$('#tree').tree({
	checkbox:true,
    url: Routing.generate("_admin_perfil_tree"),
    onLoadSuccess:function(){
    	var id= $("#perfil_id").val();
    	var url= Routing.generate("_admin_perfil_accesos",{id:id});
    	
    	 $.ajax({
                    type:'GET',
                    url:url,
                    dataType:"html",
                    success:function(datos){
                            if(datos!=""){
                                var ids = datos.split(",");
    							for (i = 0; i<ids.length;i++) {
    								var node = $('#tree').tree('find', ids[i]);
    								$('#tree').tree('check', node.target);
    							}
                            }
  
                    }
        });
    }
});

