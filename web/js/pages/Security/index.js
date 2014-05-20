
var ValidateSession=function(){
	var url=Routing.generate('_usuario_gettimesession');
	new jAjax().Execute(url,'GET','',function(data){
		console.log(data);
		if(!data.insession){
			var n=noty({
	          text: 'Su session ha expirado!',
	          layout: 'center',
	          theme: 'defaultTheme',
	          modal:true,
	          buttons: [
	            {addClass: 'btn btn-xs btn-success', text: 'Iniciar Sesión', onClick: function($noty) {
	            	var url=Routing.generate('_index')+'login';
	               	window.location.href=url;
	                $noty.close();

	              }
	            
	            },
	            {addClass: 'btn btn-xs btn-danger', text: 'Salir', onClick: function($noty) {
	            	var url=Routing.generate('_index');
	               	window.location.href=url;
	                $noty.close();

	              }
	            
	            }
	          ]
	        });
		}else{
			setTimeout(ValidateSession,500);
		}

	});
}
setTimeout(ValidateSession,500);
