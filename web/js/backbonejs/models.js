var Models={
	Conversacion: Backbone.Model.extend({
    	urlRoot : Routing.generate("_admin_conversacion")
    }),
    Mensaje: Backbone.Model.extend({}),
    
    Nota: Backbone.Model.extend({}),

    Usuario: Backbone.Model.extend({}),

	GrupoEvaluacionPostulante: Backbone.Model.extend({
    	urlRoot : Routing.generate("_admin_json_grupoevaluacionpostulante")
    }),
    Criterio: Backbone.Model.extend({
    	urlRoot : Routing.generate("_admin_json_concurso_criterio")
    }),
    AspectoClave: Backbone.Model.extend({
        urlRoot : Routing.generate("_admin_json_aspectoclave")
    }),
    RespuestaCriterio: Backbone.Model.extend({
        urlRoot : Routing.generate("_admin_json_respuesta")
    })
};
