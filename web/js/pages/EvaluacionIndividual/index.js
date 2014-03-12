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
				//console.log("inicializando...");
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
			//console.log("render...")
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
			//console.log(objJSON);
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
			//console.log(this.proyecto);
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
			//console.log("node..")
			console.log(node);
			this.nodeSelected=node;
			this.$el.find('#titleCriterio').html(node.text);
			//console.log(node.tipoArbol_id);
			switch(node.tipoArbol_id){
				case "1":
					this.ParentNode=node;
					//console.log("tipoCriterio_id:"+node.tipoCriterio_id);
					switch(node.tipoCriterio_id){
						case "1"://criterio
							//console.log("criterio");
							this.LoadRespuestas(node.id,false);
							this.isCriterio=true;
							break;
						case "2"://aspecto clave
							//console.log("factor clave");
							this.LoadAspectosClaves(node.id,true);
							this.isAspectoClave=true;
							break;
					}
					break;
				case "2":
					this.ParentNode=$('#treeCriterios').tree('getParent', node.target);
					switch(this.ParentNode.tipoCriterio_id){
						case "1"://subcriterio de criterio
							//console.log("subcriterio de criterio");
							this.LoadRespuestas(node.id,true);
							this.isCriterio=true;
							break;
						case "2"://subcriterio de aspecto clave
							//console.log("subcriterio de factor clave");
							this.LoadAspectosClaves(node.id,false);
							this.isAspectoClave=true;
							break;
					}
					break;	

			}
		},
		LoadAspectosClaves:function(idCriterio,isParent){
			//console.log(idCriterio);
			//console.log(isParent);
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
					app:this,
					idConcurso:this.nodeSelected.concurso_id,
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
			//console.log(this.Subcriterio);
		},
		renderAreaAnalisis:function(){
			//console.log('render area analisis,...');
			var collection = new Backbone.Collection(this.Subcriterio.toJSON().children);
			$('#cmbAreaAnalisis').empty();
			collection.each(function(item,idx) {
				//console.log(item.toJSON());
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
			//console.log('render preguntas,...');
			var collection = new Backbone.Collection(this.AreaAnalisis.toJSON().children);
			$('#cmbPregunta').empty();
			collection.each(function(item,idx) {
				//console.log(item.toJSON());
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
			//console.log(this.model)
			////console.log(JSON.stringify(this.model));
			//console.log(this.model);
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
        	idConcurso:0,
        	isParent:false,
        	idCriterio:0,
        	app:null

        },
		initialize: function() {
			_.bindAll(this);
			this.template = _.template($('#respuestas_template').html());
			//console.log("init respuestass...");
			this.RespuestasCollection=new Collections.RespuestaCriterio();
			this.FortalezasCollection=new Collections.RespuestaCriterio();
			this.AreasMejoraCollection=new Collections.RespuestaCriterio();
			this.RespuestasCollection.on('reset', this.renderRespuestas, this);

			this.VisitasCollection=new Collections.CriterioVisita();
			this.VisitasCollection.on("reset", this.renderVisita,this);
			this.Visita=new Models.CriterioVisita({id:0});

			this.AspectosClavesCollection=new Collections.CriterioAspectoClave();
			this.AspectosClavesCollection.on("reset", this.renderAspectosClave,this);
			
			this.load();
		},
		LoadVisita:function(){
			console.log("LOAD VISITAS.....");
			var params={concursocriterio_id:this.attributes.idCriterio};
			this.VisitasCollection.fetch({reset:true,data:params});
		},
		LoadAspectosClaves:function(){

			console.log("LOAD ASPECTOS CLAVE DE CRITERIOS.....");
			var params={idcriterio:this.attributes.idCriterio};
			this.AspectosClavesCollection.fetch({reset:true,data:params});
		},
		renderAspectosClave:function(){
			console.log("RENDER ASPECTOS CLAVE DE CRITERIOS.....")
			$('#gridCriterioAspectosClaves tbody').empty();
			this.AspectosClavesCollection.each(function(item,idx) {
				console.log(item.toJSON());
				v = new ViewsEvalIndividual.ItemAspectoClave({
					model:item.toJSON(),
					attributes:{type:3}
				});
				$('#gridCriterioAspectosClaves tbody').append(v.render().el);
			},this); 
		},
		render: function() {
			this.$el.html(this.template({isParent:this.attributes.isParent}));
			if(this.attributes.isParent){
				this.$el.find("#RespuestaAspectosClave").show();
				this.$el.find("#lnkVisita").show();
				$('#btnSaveVisita').click(this.SaveVisita);
				$('#btnNewAspectoClave').click(this.NewAspectoClave);
				this.LoadVisita();
				this.LoadAspectosClaves();
				
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
		renderVisita:function(){
			console.log("render visita...");
			console.log(this.VisitasCollection.size());
			this.Visita=new Models.CriterioVisita({id:0});
			if(this.VisitasCollection.size()>0){

				this.Visita=this.VisitasCollection.at(0).toJSON();
				//console.log(this.Visita)
				$("#txtVisita").text(this.Visita.descripcion);
			}
			
			//this.$el.find("#txtVisita").val(this.Visita.toJSON().descripcion);
		},
		renderRespuestas:function(){
			//console.log("render respuestas...")
			this.FortalezasCollection=this.RespuestasCollection.fortalezas();
			this.AreasMejoraCollection=this.RespuestasCollection.areasmejora();
			this.$el.find('#gridFortalezas tbody').empty();
			var v = null;		
			var parent=this;	                     
			this.FortalezasCollection.each(function(item,idx) {
				obj=item.toJSON();
				obj.isParent=this.attributes.isParent;
				v = new ViewsEvalIndividual.ItemRespuesta({model:obj});
				this.$el.find('#gridFortalezas tbody').append(v.render().el);
			},this); 

			this.AreasMejoraCollection.each(function(item,idx) {
				////console.log(item.toJSON())
				obj=item.toJSON();
				obj.isParent=this.attributes.isParent;
				v = new ViewsEvalIndividual.ItemRespuesta({model:obj});
				this.$el.find('#gridAreasMejora tbody').append(v.render().el);
			},this);  
			return this;
		},
		SaveVisita:function(){
			//console.log("grabando visita");
			if(this.Visita.id==0){
				var item=new Models.CriterioVisita({
					concursocriterio_id:this.attributes.idCriterio,
					descripcion:$("#txtVisita").val()
				});
			}else{
				var item=new Models.CriterioVisita({
					id:this.Visita.id,
					concursocriterio_id:this.attributes.idCriterio,
					descripcion:$("#txtVisita").val()
				});
			}

			//this.Visita.set({})
			item.save();
		},
		NewAspectoClave:function(){
			var url=Routing.generate('_admin_criterioaspectoclave_new');
			
			var parent=this;
			this.Window=new BootstrapWindow({id:"winForm",title:"Aspectos Claves"});
	        this.Window.setWidth(1000);
	        this.Window.LoadWithFnSuccess(url,this.InitFormAspectosClaves);
	        this.Window.Show();
	        
	        this.Window.AddButton('btn-aspectoclave-cancel',{
	            label:'Cancelar',
	            'class':'btn-default',
	            fn:function(){
	               parent.Window.Hide();
	            }
	            
	        })
	       
	        this.Window.AddButton('btn-aspectoclave-save',{
	            label:'Agregar',
	            'class':'btn-success',
	            fn:function(){
	                $('#btn-aspectoclave-save').attr('disabled',true);
	                $('#btn-aspectoclave-cancel').attr('disabled',true);
	                parent.AddAspectosClave();  
					parent.Window.Hide();
	                
	            }
	        });
		},
		InitFormAspectosClaves:function(){
			this.AddAspectosClavesCollection=new Collections.AspectoClave();
			this.AddAspectosClavesCollection.bind("reset", this.renderAddAspectosClave);
			this.loadAddAspectosClave();
		},
		loadAddAspectosClave:function(){
			var params={idconcurso:this.attributes.idConcurso};
			this.AddAspectosClavesCollection.fetch({reset:true,data:params})
		},
		renderAddAspectosClave:function(){
			$('#gridAddAspectosClave tbody').empty();
			this.AddAspectosClavesCollection.each(function(item,idx) {
				console.log(item.toJSON());
				v = new ViewsEvalIndividual.ItemAspectoClave({
					model:item.toJSON(),
					attributes:{type:2}
				});
				$('#gridAddAspectosClave tbody').append(v.render().el);
			},this); 
		},
		AddAspectosClave:function(){
			var parent=this;
			$('#gridAddAspectosClave tbody input:checked').each(function() {
				var model=new Models.CriterioAspectoClave({
					criterio_id:parent.attributes.idCriterio,
					aspectoclave_id:$(this).attr('data-id')
				})
			    model.save({},{success:function(){
			    	parent.attributes.app.SelectCriterio(parent.attributes.app.nodeSelected);
			    }});
			});
			
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
			//console.log("se cargaron aspectos claves...");
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
			//console.log("render...")
			this.$el.find('#gridFactoresClave tbody').empty();
			var v = null;
			                     
			this.AspectosClaveCollection.each(function(item,idx) {
				v = new ViewsEvalIndividual.ItemAspectoClave({
					model:item.toJSON(),
					attributes:{type:1}
				});
				this.$el.find('#gridFactoresClave tbody').append(v.render().el);
			},this);
                      
			return this;
		}
	}),
	ItemAspectoClave: Backbone.View.extend({
        tagName:"tr",
		initialize: function() {
			switch(this.attributes.type){
				case 1:
				this.template = _.template($('#itemFactoresClave1_template').html());
				break;
				case 2:
				this.template = _.template($('#itemFactoresClave2_template').html());
				break;
				case 3:
				this.template = _.template($('#itemFactoresClave3_template').html());
				break;
			}
			
			
		},
		render: function() {
			//console.log(this.model)
			this.$el.html(this.template({model:this.model}));
			return this;
		}
	})

};

$(document).ready(function() {
	var v=new ViewsEvalIndividual.App({ el: $("#containerEtapaIndividual") });
});

