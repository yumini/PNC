var Views={
	ConversacionesApp: Backbone.View.extend({
		events: {
                    "click .delete-conversacion": "DeleteConversacion",
                    "click #list-conversaciones .list-group-item": "ShowConversacion",
                    "click #btnNewConversacion": "NewConversacion"
        },
		initialize: function(){
			_.bindAll(this);
			this.viewMensajes = new Views.MensajesApp();
			this.template = _.template($('#app-template').val());
			this.collection = new Collections.Conversacion();
			this.collection.on('reset', this.LoadConversations, this);
			this.performSearch();	
				
		},
		render: function(){
			this.$el.html(this.template());
			this.LoadConversations();
			//setInterval(this.performSearch,1000);
			return this;
		},
		LoadConversations:function(){
			this.$el.find('#list-conversaciones').empty();
			var v = null;
			                     
			this.collection.each(function(item,idx) {
				console.log(item);
				v = new Views.Conversacion({model:item});
				
				this.$el.find('#list-conversaciones').append(v.render().el);
			},this);
                       
			return this;
		},
		performSearch:function(evdata){
                        
			evdata = evdata || {};
			this.collection.fetch({reset:true});

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
            $('#tabHangout li:eq(1) a').tab('show') ;
            
		},
		DeleteConversacion:function(){
			//console.log("elminando conversación...");
		},
		NewConversacion:function(){
			console.log("usuarios seleccionados");
			var parent=this;
			var url=Routing.generate('_admin_conversacion_create');
			var usuarios=[];
			var descripcion="";
			$("#list-usuariosChat li input:checked").each(function(index,value){
				idusuario=$(this).parent().attr("data-id");
				nombres=$(this).attr("data-nombreCompleto");
				nombres=nombres.replace(/\r\n|\n/,"");
				
				descripcion+=nombres+',';
				usuario={id:idusuario,nombres:nombres};
				usuarios.push(usuario);
				
			});
			if(usuarios.length>0){
				descripcion = descripcion.replace(/\r\n|\n/, " ");
				var conversacion=new Models.Conversacion();
				conversacion.set('nombre',"Con:");
				conversacion.set('descripcion',descripcion);
				conversacion.set('usuarios',usuarios);
				conversacion.save({},{success:function(model, response, options){
					console.log("success");
					parent.performSearch();	
					$('#tabHangout li:eq(0) a').tab('show') ;


				}});
			}else{
				alert("Debe seleccionar al menos un usuario a la conversación");
			}
			
			
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
			//console.log('conversacion: entering render');
			this.$el.html(this.template({conversacion:this.model.toJSON()}));
			//console.log('conversacion: leaving render');
			return this;
		}
	}),
	MensajesApp: Backbone.View.extend({
		events: {
                    "click .btn": "AddMensaje",
                    'keyup #txtmensaje': 'KeyAddMensaje',
                    'click #btnNewMensaje': 'AddMensaje'
        },
		initialize: function(){

			_.bindAll(this);
			this.template = _.template($('#app-mensajes-template').val());

			this.collection = new Collections.Mensaje();
			this.collection.on('reset', this.showMensajes, this);
			

					
		},
		render: function(){
			//console.log('renderizando mensajes');
			this.$el.html('');
			//console.log("mensajes: "+this.collection.length);
			this.$el.html(this.template());
			this.showMensajes();
			//setInterval(this.LoadData,3000);
			return this;
		},
		LoadData:function(evdata){
			evdata = evdata || {};
			//console.log('mensajesApp:  : cargando id:'+this.conversacion.get('id'));
			this.collection.fetch({reset:true,data: {conversacion_id: this.conversacion.get('id')}});
		},
		SetConversacion:function(conversacion){
			this.conversacion=conversacion;
		},
		setCollection:function(c){
			this.collection=c;
			//console.log("mensajes: "+this.collection.length);
			return this;
		},
		showMensajes:function(){
			//console.log("entrando a recorrer mensajes");
			
			this.$el.find('#list-mensajes').empty();
			var v = null;     
			this.collection.each(function(item) {
				
				v = new Views.Mensaje({model:item});
				this.$el.find('#list-mensajes').append(v.render().el);
			},this);
            this.animateScroll();           
			return this;
		},
		AddMensaje:function(){
			//console.log("evento nuevo mensaje")
			var idConversacion=this.conversacion.get('id');
			var inputMsg=this.$el.find('input[name=txtmensaje]');

			var descripcionMensaje=inputMsg.val();
			var usuario=inputMsg.attr('data-user');
			if(descripcionMensaje!=""){
				var mensaje=new Models.Mensaje({
					conversacion_id: idConversacion,
			        mensaje: descripcionMensaje,
			        usuario: usuario,
			        id: Math.floor(Math.random() * 100) + 1
			     });
				//console.log("agregando nuevo mensaje")
				this.collection.add(mensaje);
				this.Save(mensaje);
				this.showMensajes();
				this.$el.find('input[name=txtmensaje]').val("");
			}
			
			this.$el.find('input[name=txtmensaje]').focus();
			this.animateScroll();
			
		},
		animateScroll:function()
		{
    		var container = $('#list-mensajes');
    		container.animate({"scrollTop": $('#list-mensajes')[0].scrollHeight}, "slow");
		},
		Save:function(mensaje){
			var parent=this;
			var url=Routing.generate('_admin_mensaje_conversacion_new');
			$.ajax({
				type:'PUT',
				data:mensaje.toJSON(),
	            url:url,
	            dataType:"json",
	            success:function (data) {
	                //console.log("search success: " + data.length);
	                parent.LoadData();
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
			//console.log('render mensaje');
			this.$el.html(this.template({mensaje:this.model.toJSON()}));
			return this;
		}
	}),
	
	UsuariosChat: Backbone.View.extend({
		
		initialize: function(){
			_.bindAll(this);
			this.template = _.template($('#template-usuariosChat').val());
			this.collection=new Collections.Usuario();
			this.collection.on('reset', this.LoadItems, this);
			this.LoadData();
			//console.log("inicializando hcta de usuarios");
		},
		render:function(){
			this.$el.html(this.template());
			this.LoadItems();
			return this;
		},
		LoadItems:function(){
			this.$el.find('#list-usuariosChat').empty();
			var v = null;
			this.collection.each(function(item,idx) {
				v = new Views.UsuarioChatItem({model:item});		
				this.$el.find('#list-usuariosChat').append(v.render().el);
			},this);                     
			return this;
		},
		LoadData:function(evdata){
			evdata = evdata || {};			
			this.collection.fetch({reset:true});
			//console.log('se cargo la collecion usuario chat de BD');
			
		},
	}),
	UsuarioChatItem: Backbone.View.extend({
		className: 'list-group-item',
        tagName:"li",
		initialize: function() {
			this.template = _.template($('#template-usuariosChat-item').val());
			
		},
		render: function() {
			//console.log(this.model)
			this.$el.attr('id', 'usuariochat-'+this.model.id);
			this.$el.attr('data-id',this.model.id);
			this.$el.html(this.template({entity:this.model.toJSON()}));
			return this;
		}
	})


}
$(document).ready(function() {
	
	var vs = new Views.ConversacionesApp();
	vs.setElement($('#Hangout')).render();

	var usuariosChat = new Views.UsuariosChat();
	usuariosChat.setElement($('#ini-tabHangout-3')).render();

	$('#HangoutButton').click(function() {
		$("#Hangout").toggle();
	    return false;
	 });

	
});