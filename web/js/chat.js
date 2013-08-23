var Views={
	ConversacionesApp: Backbone.View.extend({
		events: {
                    //"click .list-group-item": "MostrarConversacion",
                    "click .list-group-item": "ShowConversacion"
        },
		initialize: function(){
			_.bindAll(this);
			this.viewMensajes = new Views.MensajesApp();
			this.template = _.template($('#app-template').val());
			this.collection = new Collections.Conversacion();
			this.collection.on('reset', this.showConversaciones, this);
			this.performSearch();	

				
		},
		render: function(){
			console.log('ConversacionesApp: entrando render');
			this.$el.html(this.template());

			this.showConversaciones();
			console.log('ConversacionesApp: saliendo render');
			return this;
		},
		showConversaciones:function(){
			console.log("-+---entrando a recorrer conversaciones");
			this.$el.find('#list-conversaciones').empty();
			var v = null;
			console.log(this.collection.size());
                      
			this.collection.each(function(item,idx) {
				console.log(idx);
				v = new Views.Conversacion({model:item});
				
				this.$el.find('#list-conversaciones').append(v.render().el);
			},this);
                       
			return this;
		},
		performSearch:function(evdata){
                        
			evdata = evdata || {};
			console.log('ConversacionesApp: iniciando performSearch : ');
			this.collection.fetch({reset:true,data: {page: 3}});
                       
			console.log('ConversacionesApp: terminando performSearch');
                         console.log(this.collection);
                        // this.showConversaciones();
		},
		ShowConversacion:function(evt){
			
			var idConversacion=$(evt.currentTarget).attr('data-id');
			var model = this.collection.get(idConversacion);
			var indice=this.collection.indexOf(model);

            this.viewMensajes.SetConversacion(model);
			
			this.viewMensajes.LoadData();
			this.viewMensajes.setElement($('#container-mensajes')).render();
			$(".list-group-item").removeClass("active")
            $('#conv-'+model.id).addClass("active");
            
		},
		GetMensajes:function(model){
			var mensajesCollection = new Collections.Mensaje();
			for (var i = 0; i < model.get('mensajes').length; i++) {
				 mensajesCollection.add(model.get('mensajes')[i]);
			};
			return mensajesCollection;
		}

	}),
	Conversacion: Backbone.View.extend({
		className: 'list-group-item',
                tagName:"a",
		initialize: function() {
			this.template = _.template($('#template-conversacion').val());
			
		},
		render: function() {
			this.$el.attr('href', '#')
			this.$el.attr('id', 'conv-'+this.model.id);
			this.$el.attr('data-id',this.model.id);
			console.log('conversacion: entering render');
			this.$el.html(this.template({conversacion:this.model.toJSON()}));
			console.log('conversacion: leaving render');
			return this;
		},
        MostrarConversacion:function(evt){

                    $(".list-group-item").removeClass("active")
                    $('#conv-'+this.model.id).addClass("active");

                    var c=JSON.stringify(this.model.get('mensajes'));
                    var mensajesCollection = new Collections.Mensaje();
					for (var i = 0; i < this.model.get('mensajes').length; i++) {
						 mensajesCollection.add(this.model.get('mensajes')[i]);
					};

                    var vs = new Views.MensajesApp();
                   
                    vs.setCollection(mensajesCollection);
					vs.setElement($('#container-mensajes')).render();

        }
	}),
	MensajesApp: Backbone.View.extend({
		events: {
                    "click .btn": "AddMensaje",
                    'keyup #txtmensaje': 'KeyAddMensaje'
        },
		initialize: function(){

			_.bindAll(this);
			this.template = _.template($('#app-mensajes-template').val());

			this.collection = new Collections.Mensaje();
			this.collection.on('reset', this.showMensajes, this);
			//setInterval(this.LoadData,3000);
					
		},
		render: function(){
			console.log('renderizando mensajes');
			this.$el.html('');
			console.log("mensajes: "+this.collection.length);
			this.$el.html(this.template());
			this.showMensajes();
			return this;
		},
		LoadData:function(evdata){
			evdata = evdata || {};
			console.log('mensajesApp:  : cargando id:'+this.conversacion.get('id'));
			this.collection.fetch({reset:true,data: {conversacion_id: this.conversacion.get('id')}});
		},
		SetConversacion:function(conversacion){
			this.conversacion=conversacion;
		},
		setCollection:function(c){
			this.collection=c;
			console.log("mensajes: "+this.collection.length);
			return this;
		},
		showMensajes:function(){
			console.log("entrando a recorrer mensajes");
			
			this.$el.find('#list-mensajes').empty();
			var v = null;     
			this.collection.each(function(item) {
				
				v = new Views.Mensaje({model:item});
				this.$el.find('#list-mensajes').append(v.render().el);
			},this);
                       
			return this;
		},
		AddMensaje:function(){
			console.log("evento nuevo mensaje")
			var idConversacion=$("#container-conversaciones").find(".active").attr('data-id');
			var descripcionMensaje=this.$el.find('input[name=txtmensaje]').val();
			if(descripcionMensaje!=""){
				var mensaje=new Models.Mensaje({
					conversacion_id: idConversacion,
			        mensaje: descripcionMensaje,
			        id: Math.floor(Math.random() * 100) + 1
			     });
				console.log("agregando nuevo mensaje")
				this.collection.add(mensaje);
				this.Save(mensaje);
				this.render();
			}
			
			this.$el.find('input[name=txtmensaje]').focus();
			this.$el.find('#list-mensajes').animate({
                     scrollTop:this.$el.find('#list-mensajes').height()
                 },
                 100);
			
		},
		Save:function(mensaje){
			var url=Routing.generate('_admin_mensaje_conversacion_new')
			$.ajax({
				type:'PUT',
				data:mensaje.toJSON(),
	            url:url,
	            dataType:"json",
	            success:function (data) {
	                console.log("search success: " + data.length);
	                self.reset(data);
	            }
        	});
		},
		KeyAddMensaje:function(e){
			if(e.keyCode==13){
				this.AddMensaje();
			}
		}

	}),
	Mensaje: Backbone.View.extend({
		initialize: function() {
			this.template = _.template($('#app-mensaje-template').val());
		},
		render: function() {
			console.log('render mensaje');
			this.$el.html(this.template({mensaje:this.model.toJSON()}));
			return this;
		}
	})
	,
	NewMensaje: Backbone.View.extend({
		className:'input-group',
		
		initialize: function() {
			this.template = _.template($('#app-mensaje-new-template').val());
			this.mensaje=new Models.Mensaje();
		},
		setMensaje:function(m){
			this.mensaje=m;
		},
		render: function() {

			this.$el.html(this.template());
		}
		
	})

}
$(document).ready(function() {
	
	var vs = new Views.ConversacionesApp();
	vs.setElement($('#container-conversaciones')).render();


	
});

