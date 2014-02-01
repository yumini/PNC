var ViewsNotas={
	NotasContainer: Backbone.View.extend({
		events: {
 			"click .nota-delete": "Delete",
 			"keyup #txtNota"	: "NewNota",
 			"click .btn"		: "New",
 			"change .note-state": "UpdateState"
        },
		initialize: function(){
			_.bindAll(this);
			this.template = _.template($('#template-notas').val());
			this.collection=new Collections.Nota();
			this.collection.on('reset', this.LoadItems, this);
			this.LoadData();
		},
		render:function(){
			this.$el.html(this.template());
			this.LoadItems();
			return this;
		},
		LoadItems:function(){
			this.$el.find('#list-notas').empty();
			var v = null;
			this.collection.each(function(item,idx) {
				v = new ViewsNotas.NotaItem({model:item});		
				this.$el.find('#list-notas').append(v.render().el);
			},this);                     
			return this;
		},
		LoadData:function(evdata){
			evdata = evdata || {};			
			this.collection.fetch({reset:true});
			console.log('se cargo la collecion notas de BD');
			
		},
		Delete:function(evt){
			console.log("eliminando nota en BD");
			var parent=this;
			var idNota=$(evt.currentTarget).attr('data-id');
			console.log(idNota);
			var nota=this.collection.get(idNota);
			var url=Routing.generate('_admin_nota_delete',{id:idNota});
			
			$.ajax({
				type:'DELETE',
	            url:url,
	            dataType:"html",
	            success:function (data) {
	                parent.render();
	            }
        	});
        	this.collection.remove(nota);
		},
		NewNota:function(evt){
			if(evt.keyCode==13){
				this.New();
			}
		},
		New:function(){
			
				var descripcionNota=this.$el.find('input[name=txtNota]').val();
				console.log("evento nuevo nota: "+descripcionNota);

				var nota=new Models.Nota({
			        descripcion: descripcionNota,
			        id: Math.floor(Math.random() * 100) + 1
			    });
				
				this.collection.add(nota);
				this.Save(nota);
				this.render();	
		},
		Save:function(nota){
			console.log("registrando nota en BD");
			var parent=this;
			var url=Routing.generate('_admin_nota_new');
			$.ajax({
				type:'PUT',
				data:nota.toJSON(),
	            url:url,
	            dataType:"html",
	            success:function (data) {
	                parent.render();
	            }
        	});
        	this.$el.find('input[name=txtNota]').focus();
		},
		UpdateState:function(evt){
			console.log($(evt.currentTarget).val())
		}

	}),

	NotaItem: Backbone.View.extend({
		className: 'list-group-item',
        tagName:"li",
		initialize: function() {
			this.template = _.template($('#template-notas-item').val());
			
		},
		render: function() {
			
			this.$el.attr('id', 'nota-'+this.model.id);
			this.$el.attr('data-id',this.model.id);
			this.$el.html(this.template({entity:this.model.toJSON()}));
			return this;
		}
	})

};

$(document).ready(function() {
	
	var vs = new ViewsNotas.NotasContainer();
	vs.setElement($('#container-notas')).render();

});