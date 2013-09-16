var Collections={
	Criterio: Backbone.Collection.extend({
		model: Models.Criterio,
		url: Routing.generate("_admin_concurso_criterio"),
		parse: function(response) {
        	return response.items;
        }
	})
	
};