var Workspace = Backbone.Router.extend({
  routes: {
    "/":'initial',
    "home/:user":"home",
    "evaluador/:id/perfil": "perfilevaluador",    // #help
    "menu/:urlRoute(/:id)(/:id2)": "menu",    // #help
  },
  initial:function(){

  },
  menu:function(urlRoute,id,id2){
    var id=0||id;
    var id2=0||id2;
    try{
      if(urlRoute!='#'){
        if(id!=0)
          if(id2!=0)
            var url=Routing.generate(urlRoute,{id:id,id2:id2});
          else
            var url=Routing.generate(urlRoute,{id:id});
        else
          var url=Routing.generate(urlRoute);
        new jAjax().Load(url,"main-body","GET","","");
      }
    }catch(e){
      alert("No se encontro la direccion solicitada");
    }
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