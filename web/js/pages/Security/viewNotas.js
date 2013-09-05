
var ViewsNotas={
	NotasContainer: Backbone.View.extend({
		events: {
 			"click .nota-delete": "Delete"
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
		Delete:function(id){
                        this.IdEntity=id;
                        alert("hola"+id);
			console.log("eliminando nota en BD");
			var url=Routing.generate('_admin_nota_delete',{id:this.IdEntity})
			$.ajax({
				type:'DELETE',
	            url:url,
	            dataType:"html",
	            success:function (data) {
	                parent.viewContainer.render();
	            }
        	});
		},

	}),
	NotaItem: Backbone.View.extend({
		className: 'list-group-item',
        tagName:"li",
		initialize: function() {
			this.template = _.template($('#template-notas-item').val());
			
		},
		render: function() {
			console.log(this.model)
			this.$el.attr('id', 'nota-'+this.model.id);
			this.$el.attr('data-id',this.model.id);
			this.$el.html(this.template({entity:this.model.toJSON()}));
			return this;
		},
	}),
	NotaNew: Backbone.View.extend({
		className: 'input-group',
		events: {
                    "click .btn": "AddNota",
                    'keyup #txtNota': 'KeyAddNota',
                    'click .nota-delete':'Delete',
        },
		initialize: function() {
			this.template = _.template($('#template-notas-item-new').val());
			
		},
		render: function() {
			console.log(this.model)
			//this.$el.attr('id', 'nota-'+this.model.id);
			//this.$el.attr('data-id',this.model.id);
			this.$el.html(this.template());
			return this;
		},
		AddNota:function(){
			console.log("evento nuevo nota")
			var descripcionNota=this.$el.find('input[name=txtNota]').val();
			if(descripcionNota!=""){
				var nota=new Models.Nota({
			        descripcion: descripcionNota,
			        id: Math.floor(Math.random() * 100) + 1
			     });
				console.log("agregando nuevo nota")
				this.viewContainer.collection.add(nota);
				this.Save(nota);
				this.render();
			}
			
			this.$el.find('input[name=txtNota]').focus();
			
			
		},
		SetViewContainer:function(v){
			this.viewContainer=v;
		},
		Save:function(nota){
			console.log("registrando nota en BD")
			var parent=this;
			var url=Routing.generate('_admin_nota_new')
			$.ajax({
				type:'PUT',
				data:nota.toJSON(),
	            url:url,
	            dataType:"html",
	            success:function (data) {
	                parent.viewContainer.render();
	            }
        	});
		},
		 Delete:function(id){
                        this.IdEntity=id;
                        alert("hola"+id);
			console.log("eliminando nota en BD");
			var url=Routing.generate('_admin_nota_delete',{id:this.IdEntity})
			$.ajax({
				type:'DELETE',
	            url:url,
	            dataType:"html",
	            success:function (data) {
	                parent.viewContainer.render();
	            }
        	});
		},
		KeyAddNota:function(e){
			if(e.keyCode==13){
				this.AddNota();
			}
		}
	})
}

$(document).ready(function() {
	
	var vs = new ViewsNotas.NotasContainer();
	vs.setElement($('#container-notas')).render();

	var viewNotaNew = new ViewsNotas.NotaNew();
	viewNotaNew.SetViewContainer(vs);
	viewNotaNew.setElement($('#container-nota-new')).render();
	
      $(".nota-delete").click(function(){
      var id=$(this).attr("data-id"); 
      new OptionButton().Delete(id);  
  });
});