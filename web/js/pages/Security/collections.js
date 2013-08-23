var Collections={
	Conversacion: Backbone.Collection.extend({
		model: Models.Conversacion,
		url: Routing.generate("_admin_conversacion_format"),
		parse: function(response) {
                    console.log("devolviendo datos conversacion");
                    console.log(response.items);
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
	        console.log(model);
	        console.log(collection);
	        console.log(options);
    	},
    	parse: function(response) {
                    console.log("devolviendo datos conversacion");
                    console.log(response.items);
                    return response.items;
                }
	}),
	Nota: Backbone.Collection.extend({
		model: Models.Nota,
		url: Routing.generate("_admin_nota_list"),
		parse: function(response) {
                    console.log("devolviendo notas");
                    console.log(response.items);
                    return response.items;
         }
	})
};