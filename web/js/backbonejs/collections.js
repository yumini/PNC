var Collections={
	Conversacion: Backbone.Collection.extend({
		model: Models.Conversacion,
		url: Routing.generate("_admin_conversacion"),
		parse: function(response) {
                    return response.items;
        }
	}),
	Mensaje: Backbone.Collection.extend({
		model: Models.Mensaje ,
		url: Routing.generate("_admin_mensajes_conversacion"),
		initialize: function() {
        	this.bind('add', this.onModelAdded, this );
   		},
    	onModelAdded: function(model, collection, options) {
	        console.log('Added:');
    	},
    	parse: function(response) {
	              return response.items;
               }
	}),
	Nota: Backbone.Collection.extend({
		model: Models.Nota,
		url: Routing.generate("_admin_nota_list"),
		parse: function(response) {
                return response.items;
         }
	}),
	Usuario: Backbone.Collection.extend({
		model: Models.Usuario,
		url: Routing.generate("_admin_conversacion_users_chat"),
		parse: function(response) {
                return response.items;
        }
	}),
	GrupoEvaluacionPostulante: Backbone.Collection.extend({
		model: Models.GrupoEvaluacionPostulante,
		url: Routing.generate("_admin_json_grupoevaluacionpostulante"),
		parse: function(response) {
				
                return response;
        }
	}),
	GrupoEvaluacionEvaluador: Backbone.Collection.extend({
		model: Models.GrupoEvaluacionEvaluador,
		url: Routing.generate("_admin_json_grupoevaluacionevaluador"),
		parse: function(response) {
				
                return response;
        }
	}),
	Inscripcion: Backbone.Collection.extend({
		model: Models.GrupoEvaluacionPostulante,
		url: Routing.generate("_admin_json_inscripcion"),
		parse: function(response) {
				
                return response;
        }
	}),
	Criterio: Backbone.Collection.extend({
		model: Models.Criterio,
		url: Routing.generate("_admin_json_concurso_criterio"),
		parse: function(response) {
				
                return response;
        }
	}),
	AspectoClave: Backbone.Collection.extend({
		model: Models.AspectoClave,
		url: Routing.generate("_admin_json_aspectoclave"),
		parse: function(response) {
				
                return response;
        }
	}),
	RespuestaCriterio: Backbone.Collection.extend({
		model: Models.RespuestaCriterio,
		url: Routing.generate("_admin_json_respuesta"),
		parse: function(response) {
				
                return response;
        },
        fortalezas: function() {
		    filtered = this.filter(function(item) {
		      return (item.get("puntaje")== '++' || item.get("puntaje")== '+');
		     });
		    return new Collections.RespuestaCriterio(filtered);
		},
		areasmejora: function() {
		    filtered = this.filter(function(item) {
		      return (item.get("puntaje")== '--' || item.get("puntaje")== '-');
		     });
		    return new Collections.RespuestaCriterio(filtered);
		}
	}),
	CriterioVisita: Backbone.Collection.extend({
		model: Models.CriterioVisita,
		url: Routing.generate("_admin_json_criteriovisita")
	}),
	CriterioAspectoClave: Backbone.Collection.extend({
		model: Models.CriterioAspectoClave,
		url: Routing.generate("_admin_json_criterioaspectoclave"),
		parse: function(response) {
				
                return response;
        }
    }),
    DisponibilidadEvaluador: Backbone.Collection.extend({
		model: Models.DisponibilidadEvaluador,
		url: Routing.generate("_admin_evaluadordisponibilidad"),
		parse: function(response) {
				
                return response;
        }
    })
   
};