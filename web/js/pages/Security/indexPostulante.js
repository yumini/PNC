var OptionButton=function(){}
OptionButton.prototype={
	Perfil:function(){
		var url=Routing.generate("_admin_postulante_perfil");
		new jAjax().Load(url,"main-body","GET","","")
	}
}