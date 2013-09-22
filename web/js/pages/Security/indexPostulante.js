var OptionButton=function(){}
OptionButton.prototype={
	Perfil:function(){
		var url=Routing.generate("_admin_postulante_perfil");
		new jAjax().Load(url,"main-body","GET","","")
	},
	
}
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