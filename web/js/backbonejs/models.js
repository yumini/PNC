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
    GrupoEvaluacionEvaluador: Backbone.Model.extend({
        urlRoot : Routing.generate("_admin_json_grupoevaluacionevaluador")
    }),
    Criterio: Backbone.Model.extend({
    	urlRoot : Routing.generate("_admin_json_concurso_criterio")
    }),
    AspectoClave: Backbone.Model.extend({
        urlRoot : Routing.generate("_admin_json_aspectoclave")
    }),
    RespuestaCriterio: Backbone.Model.extend({
        urlRoot : Routing.generate("_admin_json_respuesta")
    }),
    CriterioVisita: Backbone.Model.extend({
        urlRoot : Routing.generate("_admin_json_criteriovisita")
    }),
    CriterioAspectoClave: Backbone.Model.extend({
        urlRoot : Routing.generate("_admin_json_criterioaspectoclave")
    }),

    DisponibilidadEvaluador: Backbone.Model.extend({
        urlRoot : Routing.generate("_admin_evaluadordisponibilidad")
    }),

    Puntaje: Backbone.Model.extend({
        urlRoot : Routing.generate("_admin_json_puntaje")
    })
};
