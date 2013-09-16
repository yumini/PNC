
var Views={
	CriterioContainer: Backbone.View.extend({
		events: {
 			"click .criterio-new": "New",
 			"click .criterio-edit": "Edit",
 			"click .criterio-delete": "Delete"
        },
		initialize: function(){
			_.bindAll(this);
			this.template = _.template($('#template-criterios').val());
			this.collection=new Collections.Criterio();
			this.collection.on('reset', this.LoadItems, this);
			this.LoadData();
		},
		render:function(){
			this.$el.html(this.template());
			this.LoadItems();
			return this;
		},
		LoadItems:function(){
			this.$el.find('#container-criterios').empty();
			var v = null;
			this.collection.each(function(item,idx) {
				v = new Views.CriterioItem({model:item});		
				this.$el.find('#list-criterios').append(v.render().el);
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
	CriterioItem: Backbone.View.extend({
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