var OptionButton=function(){}
OptionButton.prototype={
	Perfil:function(id){
		var url=Routing.generate("_admin_postulante_perfil",{id:id});
		new jAjax().Load(url,"main-body","GET","","")
	}
}