var Workspace = Backbone.Router.extend({
  routes: {
    "home/:user":"home",
    "evaluador/:id/perfil": "perfilevaluador",    // #help
  },

  perfilevaluador: function(id) {
    var url=Routing.generate("_admin_evaluador_perfil",{id:id});
    new jAjax().Load(url,"main-body","GET","","");
  },
  home:function(user){
    user=(user=='admin')?'':'_'+user;
    url=Routing.generate('_admin_inicio'+user);
    new jAjax().Load(url,"main-body","GET","","");
  }
 

});

var appRouter = new Workspace();
Backbone.history.start(); 