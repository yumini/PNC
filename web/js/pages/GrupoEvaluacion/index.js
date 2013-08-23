var Models={
	GrupoEvaluacion: Backbone.Model.extend({}),
	Evaluador: Backbone.Model.extend({}),
	Postulante: Backbone.Model.extend({})
}

var Collections={
	GrupoEvaluacion: Backbone.Collection.extend({
		model: Models.GrupoEvaluacion,
		url: Routing.generate("_admin_grupoevaluacion_list"),
		parse: function(response) {
                    console.log("devolviendo datos GrupoEvaluacion");
                    return response.items;
        }
	})
}

var Views={
	GrupoEvaluacionContainer: Backbone.View.extend({
		events: {
 			"click .list-group-item": "LoadItemDetaills"
        },
		initialize: function(){
			_.bindAll(this);
			this.template = _.template($('#template-gruposevaluacion').val());
			this.collection=new Collections.GrupoEvaluacion();
			this.collection.on('reset', this.LoadItems, this);
			this.LoadData();
		},
		render:function(){
			this.$el.html(this.template());
			this.LoadItems();
			return this;
		},
		LoadItems:function(){
			this.$el.find('#list-grupoevaluacion').empty();
			var v = null;
			this.collection.each(function(item,idx) {
				v = new Views.GrupoEvaluacionItem({model:item});		
				this.$el.find('#list-grupoevaluacion').append(v.render().el);
			},this);                     
			return this;
		},
		LoadData:function(evdata){
			evdata = evdata || {};			
			this.collection.fetch({reset:true});
			console.log('se cargo la collecion GrupoEvaluacion de BD');
		},
		LoadItemDetaills:function(evt){
			var id=$(evt.currentTarget).attr('data-id');
			var model = this.collection.get(id);
			var indice=this.collection.indexOf(model);
			console.log("el id es:"+id);
 			$(".list-group-item").removeClass("active")
            $('#geva-'+id).addClass("active");
 $.ajax({type:'GET',
			data:{grupo_id:id},
	                url:Routing.generate('_admin_grupoevaluacion_postulantes_list'),
	                dataType:"html",
	                success:function (data) {
	                $("#container-postulantes").html(data);
                        }
                        });
            
			$.ajax({
				type:'GET',
				data:{grupo_id:id},
	            url:Routing.generate('_admin_grupoevaluacion_evaluadores_list'),
	            dataType:"html",
	            success:function (data) {
	                $("#container-evaluadores").html(data);
	            }
        	});
		}

	}),
	GrupoEvaluacionItem: Backbone.View.extend({
		className: 'list-group-item',
        tagName:"a",
		initialize: function() {
			this.template = _.template($('#template-grupoevaluacion-item').val());
			
		},
		render: function() {
			this.$el.attr('href', 'javascript:return void(0);')
			this.$el.attr('id', 'geva-'+this.model.id);
			this.$el.attr('data-id',this.model.id);
			this.$el.html(this.template({entity:this.model.toJSON()}));
			return this;
		},
	})
}



//OPCIONES PARA EVALUADOR Y POSTULANTE
var OptionButton={Evaluador: {}, Postulante:{}};

OptionButton.Evaluador=function(){
	this.routeNew='gevaluacion_evaluador_new';
    this.routeList='_admin_perfil';
    this.routeSave='perfil_create';
}

OptionButton.Evaluador.prototype={
	New:function(){
		console.log("nuevo evaluador");
		//el new debe tener el codigo que carga la ventana popUp
		var parent=this;
		//var url=Routing.generate(this.routeNew);
		this.Window=new BootstrapWindow({id:"winForm",title:"Nuevo Evaluador"});
        //this.Window.Load(url,"");
        this.Window.Show();
        //agregando los botones
        this.Window.AddButton('btn-perfil-cancel',{
            label:'Cancelar',
            class:'btn-default',
            fn:function(){
                parent.Window.Hide();
            }
            
        })
       
        this.Window.AddButton('btn-perfil-save',{
            label:'Grabar',
            class:'btn-success',
            fn:function(){
                parent.Save();               
                parent.Window.Hide();
            }
        });
	},
	Save:function(){
		//aqui va el codigo que envia los parametros a la accion que graba
	},
	List:function(){
		//esta funcion realizara un refresh del listado de evaluadores
	}
}



$(document).ready(function() {
	
	var vs = new Views.GrupoEvaluacionContainer();
	vs.setElement($('#container-grupoevaluacion')).render();
	$("#btnNewEvaluador").click(function(event) {
		new OptionButton.Evaluador().New();
	});
	
});