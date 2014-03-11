var ViewsEvalIndividual={
	App: Backbone.View.extend({
		events: {
                    "change #cmbGrupo": "LoadConcursantes",
                    "change #cmbPostulante": "LoadProyectos",
                    "change #cmbProyecto": "SelectProyecto",
                    "click #btnNew":"Nuevo"
        },
		initialize: function(){
				_.bindAll(this);
				console.log("inicializando...");
				this.ConcursosCollection=new Collections.GrupoEvaluacionPostulante();
				this.ConcursosCollection.on('reset', this.RenderConcursantes, this);

				this.ProyectosCollection=new Collections.Inscripcion();
				this.ProyectosCollection.on('reset', this.RenderProyectos, this);

				

				this.LoadConcursantes();
				this.grupo=-1;
				this.concurso=-1;
				this.proyecto=-1;
				this.$el.find('#btnNew').attr('disabled',true);
		},
		LoadConcursantes: function(evt){
			this.grupo=$("#cmbGrupo").val();
			var params={ grupo_id:this.grupo};
			this.ConcursosCollection.fetch({reset:true,data:params});
		},
		RenderConcursantes:function(){
			console.log("render...")
			this.$el.find('#cmbPostulante').empty();
			var v = null;
			                     
			this.ConcursosCollection.each(function(item,idx) {
				v = new ViewsEvalIndividual.ItemConcursante({model:item.toJSON()});
				this.$el.find('#cmbPostulante').append(v.render().el);
			},this);
            this.LoadProyectos();           
			return this;
		},
		LoadProyectos:function(){
			var value=$("#cmbPostulante").val();
			var item=this.ConcursosCollection.get(value);
			var objJSON=item.toJSON();
			this.concurso=objJSON.grupo.concurso;
			console.log(objJSON);
			var params={ concurso_id:objJSON.grupo.concurso.id,postulante_id:objJSON.postulante.id};
			this.ProyectosCollection.fetch({reset:true,data:params});
			this.LoadCriterios();
			
			
		},
		RenderProyectos:function(){
			this.$el.find('#cmbProyecto').empty();
			var v = null;
			                     
			this.ProyectosCollection.each(function(item,idx) {
				v = new ViewsEvalIndividual.ItemProyecto({model:item.toJSON()});
				this.$el.find('#cmbProyecto').append(v.render().el);
			},this);    
			this.SelectProyecto();   
			return this;
		},
		SelectProyecto:function(){
			var value=$("#cmbProyecto").val();
			var item=this.ProyectosCollection.get(value);
			this.proyecto=item.toJSON();
			console.log(this.proyecto);
		},
		LoadCriterios:function(){
			var parent=this;
			$('#treeCriterios').tree({
				method:"GET",
				checkbox:false,
		    	url:Routing.generate("_admin_concurso_criterio_json",{id:this.concurso.id})+'?nivel=1',
		    	onClick: function(node){
					parent.SelectCriterio(node)
				}
			});
			
		},
		
		SelectCriterio:function(node){
			this.isCriterio=false;
			this.isAspectoClave=false;
			this.$el.find('#btnNew').attr('disabled',false);
			console.log("node..")
			console.log(node);
			this.nodeSelected=node;
			this.$el.find('#titleCriterio').html(node.text);
			console.log(node.tipoArbol_id);
			switch(node.tipoArbol_id){
				case "1":
					this.ParentNode=node;
					console.log("tipoCriterio_id:"+node.tipoCriterio_id);
					switch(node.tipoCriterio_id){
						case "1"://criterio
							console.log("criterio");
							this.LoadRespuestas(node.id,false);
							this.isCriterio=true;
							break;
						case "2"://aspecto clave
							console.log("factor clave");
							this.LoadAspectosClaves(node.id,true);
							this.isAspectoClave=true;
							break;
					}
					break;
				case "2":
					this.ParentNode=$('#treeCriterios').tree('getParent', node.target);
					switch(this.ParentNode.tipoCriterio_id){
						case "1"://subcriterio de criterio
							console.log("subcriterio de criterio");
							this.LoadRespuestas(node.id,true);
							this.isCriterio=true;
							break;
						case "2"://subcriterio de aspecto clave
							console.log("subcriterio de factor clave");
							this.LoadAspectosClaves(node.id,false);
							this.isAspectoClave=true;
							break;
					}
					break;	

			}
		},
		LoadAspectosClaves:function(idCriterio,isParent){
			console.log(idCriterio);
			console.log(isParent);
			var v=new ViewsEvalIndividual.AspectosClaves({
				el:$("#body-etapa") ,
				attributes:{
					idCriterio:idCriterio,
					isParent:isParent
				}
			}).render();
		},
		LoadRespuestas:function(idCriterio,isParent){
			var v=new ViewsEvalIndividual.AppRespuestas({
				el:$("#body-etapa") ,
				attributes:{
					idCriterio:idCriterio,
					isParent:isParent
				}
			}).render();
		},
		Nuevo:function(){
			if(this.isCriterio){
				this.NuevaRespuesta();
			}
			if(this.isAspectoClave){
				this.NuevoAspectoClave();
			}
			
		},
		NuevoAspectoClave:function(){
			var parent=this;
			this.Window=new BootstrapWindow({id:"winForm",title:"Nuevo Aspecto Clave"});
	        this.Window.setWidth(600);
	        this.Window.setHeight(200);

	        var url=Routing.generate('_admin_aspectoclave_new');
	        this.Window.LoadWithFnSuccess(url,this.InitFormAspectosClaves);
	        this.Window.Show();
	        
	        this.Window.AddButton('btn-concurso-cancel',{
	            label:'Cancelar',
	            'class':'btn-default',
	            fn:function(){
	               parent.Window.Hide();
	            }
	            
	        })
	       
	        this.Window.AddButton('btn-concurso-save',{
	            label:'Grabar',
	            'class':'btn-success',
	            fn:function(){
	                $('#btn-concurso-save').attr('disabled',true);
	                $('#btn-concurso-cancel').attr('disabled',true);
	                parent.SaveAspectoClave();               
	                
	            }
	        });
		},
		SaveAspectoClave:function(){
			var parent=this;
			var obj=new Models.AspectoClave({
				criterio_id:$('#cmbAspectoCLave').val(),
				descripcion:$('#txtDescripcionAspectoClave').val()
			});
			
			obj.save({},{
				success:function(){
					parent.Window.Hide();
					parent.SelectCriterio(parent.nodeSelected);
				}
			});
		},
		InitFormAspectosClaves:function(){
			var collection = new Backbone.Collection(this.ParentNode.children);
        	$('#cmbAspectoCLave').empty();
        	collection.each(function(item,idx) {
				v = new ViewsEvalIndividual.ItemCriterio({model:item.toJSON()});
				$('#cmbAspectoCLave').append(v.render().el);
			},this); 
			$('#cmbAspectoCLave option[value='+this.nodeSelected.id+']').attr('selected','selected');
		},
		NuevaRespuesta:function(){
			var parent=this;
			this.Window=new BootstrapWindow({id:"winForm",title:"Nueva Respuesta"});
	        this.Window.setWidth(600);
	        //this.Window.setHeight(260);
	        switch(this.nodeSelected.tipoArbol_id){
	        	case "1":
	        		var url=Routing.generate('_admin_respuesta_new');
	        		this.Window.LoadWithFnSuccess(url,this.InitFormRespuestaCriterio);
	        		break;
	        	case "2":
	        		var url=Routing.generate('_admin_respuesta_new2');
	        		this.Window.LoadWithFnSuccess(url,this.InitFormRespuestaSubcriterio);
	        		break;
	        }
	        this.Window.Show();
	        
	        this.Window.AddButton('btn-concurso-cancel',{
	            label:'Cancelar',
	            'class':'btn-default',
	            fn:function(){
	               parent.Window.Hide();
	            }
	            
	        })
	       
	        this.Window.AddButton('btn-concurso-save',{
	            label:'Grabar',
	            'class':'btn-success',
	            fn:function(){
	                $('#btn-concurso-save').attr('disabled',true);
	                $('#btn-concurso-cancel').attr('disabled',true);
	                parent.SaveRespuesta();               
	                
	            }
	        });
		},
		SaveRespuesta:function(){
			var parent=this;
			switch(this.nodeSelected.tipoArbol_id){
	        	case "1":
	        		var obj=new Models.RespuestaCriterio({
						criterio_id:this.nodeSelected.id,
						puntaje:$('#cmbPuntaje').val(),
						respuesta:$('#txtRespuesta').val()
					});
	        		break;
	        	case "2":
	        		var obj=new Models.RespuestaCriterio({
						criterio_id:$("#cmbPregunta").val(),
						puntaje:$('#cmbPuntaje').val(),
						respuesta:$('#txtRespuesta').val()
					});
	        		break;
	        }
			
			
			obj.save({},{
				success:function(){
					parent.Window.Hide();
					parent.SelectCriterio(parent.nodeSelected);
				}
			});
		},
		InitFormRespuestaCriterio:function(){
			
		},
		InitFormRespuestaSubcriterio:function(){
			$('#cmbAreaAnalisis').change(this.LoadPreguntas);
			this.LoadAreaAnalisis();
		},
		LoadAreaAnalisis:function(){
			this.Subcriterio=new Models.Criterio({id:this.nodeSelected.id});
			this.Subcriterio.bind("sync", this.renderAreaAnalisis)
			this.Subcriterio.fetch();
			console.log(this.Subcriterio);
		},
		renderAreaAnalisis:function(){
			console.log('render area analisis,...');
			var collection = new Backbone.Collection(this.Subcriterio.toJSON().children);
			$('#cmbAreaAnalisis').empty();
			collection.each(function(item,idx) {
				console.log(item.toJSON());
				v = new ViewsEvalIndividual.ItemCriterio({model:item.toJSON()});
				$('#cmbAreaAnalisis').append(v.render().el);
			},this);  
			this.LoadPreguntas();  
		},
		LoadPreguntas:function(){
			var id=$('#cmbAreaAnalisis').val();
			this.AreaAnalisis=new Models.Criterio({id:id});
			this.AreaAnalisis.bind("sync", this.renderPreguntas)
			this.AreaAnalisis.fetch();

		},
		renderPreguntas:function(){
			console.log('render preguntas,...');
			var collection = new Backbone.Collection(this.AreaAnalisis.toJSON().children);
			$('#cmbPregunta').empty();
			collection.each(function(item,idx) {
				console.log(item.toJSON());
				v = new ViewsEvalIndividual.ItemCriterio({model:item.toJSON()});
				$('#cmbPregunta').append(v.render().el);
			},this); 
		}
	}),
	ItemConcursante: Backbone.View.extend({
        tagName:"option",
		initialize: function() {
			this.template = _.template($('#itemOption_template').html());
			
		},
		render: function() {
			console.log(this.model)
			//console.log(JSON.stringify(this.model));
			console.log(this.model);
			var text=this.model.postulante.razonsocial+' - '+this.model.grupo.concurso.nombre;
			this.$el.attr('value',this.model.id);
			this.$el.html(text);
			return this;
		}
	}),
	ItemCriterio: Backbone.View.extend({
        tagName:"option",
		initialize: function() {
			this.template = _.template($('#itemOption_template').html());
			
		},
		render: function() {
			var text=this.model.descripcion;
			this.$el.attr('value',this.model.id);
			this.$el.html(text);
			return this;
		}
	}),
	ItemProyecto: Backbone.View.extend({
        tagName:"option",
		initialize: function() {
			this.template = _.template($('#itemOption_template').html());
			
		},
		render: function() {
			var text=this.model.nombreproyecto;
			this.$el.attr('value',this.model.id);
			this.$el.html(text);
			return this;
		}
	}),
	AppRespuestas: Backbone.View.extend({
        tagName:"div",
        attributes :{
        	isParent:false,
        	idCriterio:0

        },
		initialize: function() {
			_.bindAll(this);
			this.template = _.template($('#respuestas_template').html());
			console.log("init respuestass...");
			this.RespuestasCollection=new Collections.RespuestaCriterio();
			this.FortalezasCollection=new Collections.RespuestaCriterio();
			this.AreasMejoraCollection=new Collections.RespuestaCriterio();
			this.RespuestasCollection.on('reset', this.renderRespuestas, this);
			this.load();
		},
		render: function() {
			this.$el.html(this.template());
			if(this.attributes.isParent){
				this.$el.find("#RespuestaAspectosClave").show();
				this.$el.find("#lnkVisita").show();
			}else{
				this.$el.find("#RespuestaAspectosClave").hide();
				this.$el.find("#lnkVisita").hide();
			}
			return this;
		},
		load:function(){
			
			var params={ isparent:this.attributes.isParent,idcriterio:this.attributes.idCriterio};
			this.RespuestasCollection.fetch({reset:true,data:params});
			return this;
		},
		renderRespuestas:function(){
			console.log("render respuestas...")
			this.FortalezasCollection=this.RespuestasCollection.fortalezas();
			this.AreasMejoraCollection=this.RespuestasCollection.areasmejora();
			this.$el.find('#gridFortalezas tbody').empty();
			var v = null;			                     
			this.FortalezasCollection.each(function(item,idx) {
				console.log(item.toJSON())
				v = new ViewsEvalIndividual.ItemRespuesta({model:item.toJSON()});
				this.$el.find('#gridFortalezas tbody').append(v.render().el);
			},this); 

			this.AreasMejoraCollection.each(function(item,idx) {
				console.log(item.toJSON())
				v = new ViewsEvalIndividual.ItemRespuesta({model:item.toJSON()});
				this.$el.find('#gridAreasMejora tbody').append(v.render().el);
			},this);  
			return this;
		}
	}),
	ItemRespuesta: Backbone.View.extend({
        tagName:"tr",
		initialize: function() {
			this.template = _.template($('#itemRespuesta_template').html());
			
		},
		render: function() {
			console.log(this.model)
			this.$el.html(this.template({model:this.model}));
			return this;
		}
	}),
	AspectosClaves: Backbone.View.extend({
        tagName:"div",
        attributes :{
        	isParent:false,
        	idCriterio:0

        },
		initialize: function() {
			_.bindAll(this);
			this.template = _.template($('#FactoresClave_template').html());
			console.log("se cargaron aspectos claves...");
			this.AspectosClaveCollection=new Collections.AspectoClave();
			this.AspectosClaveCollection.on('reset', this.renderAspectosClave, this);
			this.loadAspectosClave();
		},
		render: function() {
			this.$el.html(this.template());
			return this;
		},
		loadAspectosClave:function(){
			
			var params={ isparent:this.attributes.isParent,idcriterio:this.attributes.idCriterio};
			this.AspectosClaveCollection.fetch({reset:true,data:params});
		},
		renderAspectosClave:function(){
			console.log("render...")
			this.$el.find('#gridFactoresClave tbody').empty();
			var v = null;
			                     
			this.AspectosClaveCollection.each(function(item,idx) {
				v = new ViewsEvalIndividual.ItemAspectoClave({model:item.toJSON()});
				this.$el.find('#gridFactoresClave tbody').append(v.render().el);
			},this);
                      
			return this;
		}
	}),
	ItemAspectoClave: Backbone.View.extend({
        tagName:"tr",
		initialize: function() {
			this.template = _.template($('#itemFactoresClave_template').html());
			
		},
		render: function() {
			console.log(this.model)
			this.$el.html(this.template({model:this.model}));
			return this;
		}
	})

};

$(document).ready(function() {
	var v=new ViewsEvalIndividual.App({ el: $("#containerEtapaIndividual") });
});

