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
	})
};