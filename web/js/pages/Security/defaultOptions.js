var DefaultOptions=function(){
	
}
DefaultOptions.prototype={
	Home:function(){
		new jAjax().Load(Routing.generate('_admin_inicio_postulante'),'main-body','get','','');
		return false;
	}
}