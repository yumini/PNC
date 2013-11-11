
var Concurso=function(){}
Concurso.prototype={
	List:function(){
		var url=Routing.generate("_admin_concursos_activos");
		new jAjax().Load(url,"container-concursos","GET","","")
	},
	Detail:function(id){
		var url=Routing.generate("_admin_concurso_showInscripcion",{id:id});
		new jAjax().Load(url,"main-body","GET","","")
	}
}
new Concurso().List();
 $('#filePerfil').fileupload({

        url:Routing.generate("_admin_postulante_upload"),
        singleFileUploads: true,
        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {
            // Automatically upload the file once it is added to the queue
            var jqXHR = data.submit();
            var path=$("#imgPerfil").attr('data-path')+'../iconos/loadin1.png';
            $("#imgPerfil").attr("src",path);
        },

        progress: function(e, data){

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

        },

        fail:function(e, data){
            // Something has gone wrong!
            data.context.addClass('error');
        },
        done:function (e, data) {
        	var obj = jQuery.parseJSON(data.result);
        	console.log(data.result);
        		var path=$("#imgPerfil").attr('data-path');
                $("#imgPerfil").attr("src",path+obj.name+"?r="+Math.random());

            
        }
    });


$(document).ready(function() {
  
	$('#btnFotoPerfil').click(function(){
	        $('#filePerfil').click();
	});
	$('#lnkFotoPerfil').click(function(){
	        $('#filePerfil').click();
	});
	$('#btnPerfil').click(function(){
            var id=$(this).attr("data-id");
            var url=Routing.generate("_admin_postulante_perfil",{id:id});
	    new jAjax().Load(url,"main-body","GET","","");
	});
        $('#btnUpdPerfil').click(function(){
            var id=$(this).attr("data-id");
            var url=Routing.generate("_admin_postulante_perfil",{id:id});
	    new jAjax().Load(url,"main-body","GET","","");
	});

	

});