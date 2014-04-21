var ViewsEvalIndividual={
	App: Backbone.View.extend({
		events: {
                    "change #cmbEvaluador": "LoadGrupos",
                    "change #cmbGrupo": "LoadConcursantes",
                    "change #cmbPostulante": "LoadProyectos",
                    "change #cmbProyecto": "SelectProyecto",
                    "click #btnNew":"Nuevo",
                    "click #btnInformeCompleto":"InformeCompleto",
                    "click #btnInformeBasico":"InformeBasico"
        },
		initialize: function(){
				_.bindAll(this);
				
				this.GrupoEvaluadorCollection=new Collections.GrupoEvaluacionEvaluador();
				this.GrupoEvaluadorCollection.on('reset', this.RenderGrupos, this);

				this.ConcursosCollection=new Collections.GrupoEvaluacionPostulante();
				this.ConcursosCollection.on('reset', this.RenderConcursantes, this);

				this.ProyectosCollection=new Collections.Inscripcion();
				this.ProyectosCollection.on('reset', this.RenderProyectos, this);

				

				this.LoadGrupos();
				this.grupo=-1;
				this.concurso=-1;
				this.proyecto=-1;
				this.$el.find('#btnNew').attr('disabled',true);
		},
		InformeCompleto:function(evt){
			var doc=this.proyecto.informepostulacionc||'';
			var id=this.proyecto.id||'';
	        
	        if(doc!=''){
	            var path=$('#pathUpload').val();
	            window.open(path+'/'+id+'/'+doc, '_blank');
	        }else{

	            var n = noty({
	                text: 'No existe informe vinculado a la inscripción',
	                type: 'warning',
	                dismissQueue: true,
	                layout: 'bottomRight',
	                theme: 'defaultTheme',
	                timeout:5000
	            });
	        }
	    },
	    InformeBasico:function(evt){
			var doc=this.proyecto.informepostulacionsic||'';
			var id=this.proyecto.id||'';
	        
	        if(doc!=''){
	            var path=$('#pathUpload').val();
	            window.open(path+'/'+id+'/'+doc, '_blank');
	        }else{

	            var n = noty({
	                text: 'No existe informe vinculado a la inscripción',
	                type: 'warning',
	                dismissQueue: true,
	                layout: 'bottomRight',
	                theme: 'defaultTheme',
	                timeout:5000
	            });
	        }
	    },
		LoadGrupos: function(evt){
			this.evaluador=$("#cmbEvaluador").val();
			var params={ evaluador_id:this.evaluador};
			this.GrupoEvaluadorCollection.fetch({reset:true,data:params});
		},
		ResetApp:function(){
			this.$el.find('#body-etapa').empty();
			this.$el.find('#btnNew').attr('disabled',true);
		},
		RenderGrupos:function(){
			this.ResetApp();
			
			this.$el.find('#cmbGrupo').empty();
			var v = null;
			                     
			this.GrupoEvaluadorCollection.each(function(item,idx) {
				var obj=item.toJSON();
				var model={value:obj.id,text:obj.nombre}
				v = new ViewsEvalIndividual.ItemSelect({model:model});
				this.$el.find('#cmbGrupo').append(v.render().el);
			},this);
			this.LoadConcursantes();
			return this;
		},
		LoadConcursantes: function(evt){
			this.grupo=$("#cmbGrupo").val();
			var params={ grupo_id:this.grupo};
			this.ConcursosCollection.fetch({reset:true,data:params});
		},
		RenderConcursantes:function(){
			
			this.$el.find('#cmbPostulante').empty();
			var v = null;
			                     
			this.ConcursosCollection.each(function(item,idx) {
				var obj=item.toJSON();
				var model={value:obj.id,text:obj.postulante.razonsocial}
				v = new ViewsEvalIndividual.ItemSelect({model:model});
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
			
			var params={ concurso_id:objJSON.grupo.concurso.id,postulante_id:objJSON.postulante.id};
			this.ProyectosCollection.fetch({reset:true,data:params});
			this.LoadCriterios();
			
			
		},
		RenderProyectos:function(){
			this.$el.find('#cmbProyecto').empty();
			var v = null;
			                     
			this.ProyectosCollection.each(function(item,idx) {
				var obj=item.toJSON();
				var text=obj.nombreproyecto||'';
				text+=' - '+obj.concurso.nombre;
				var model={
					value:obj.id,
					text:text
				};
				v = new ViewsEvalIndividual.ItemSelect({model:model});
				this.$el.find('#cmbProyecto').append(v.render().el);
			},this);    
			this.SelectProyecto();   
			return this;
		},
		SelectProyecto:function(){
			var value=$("#cmbProyecto").val();
			var item=this.ProyectosCollection.get(value);
			this.proyecto=item.toJSON();
			console.log(item.toJSON())
			$("#btnInformeCompleto").removeClass("disabled");
			$("#btnInformeBasico").removeClass("disabled");
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
			
			
			this.nodeSelected=node;
			this.$el.find('#titleCriterio').html(node.text);
			
			switch(node.tipoArbol_id){
				case "1":
					this.ParentNode=node;
					
					switch(node.tipoCriterio_id){
						case "1"://criterio
							
							this.LoadRespuestas(node.id,false);
							this.isCriterio=true;
							break;
						case "2"://aspecto clave
							
							this.LoadAspectosClaves(node.id,true);
							this.isAspectoClave=true;
							break;
					}
					break;
				case "2":
					this.ParentNode=$('#treeCriterios').tree('getParent', node.target);
					switch(this.ParentNode.tipoCriterio_id){
						case "1"://subcriterio de criterio
							
							this.LoadRespuestas(node.id,true);
							this.isCriterio=true;
							break;
						case "2"://subcriterio de aspecto clave
							
							this.LoadAspectosClaves(node.id,false);
							this.isAspectoClave=true;
							break;
					}
					break;	

			}
		},
		LoadAspectosClaves:function(idCriterio,isParent){
			
			
			var v=new ViewsEvalIndividual.AspectosClaves({
				el:$("#body-etapa") ,
				attributes:{
					app:this,
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
				inscripcion_id:$('#cmbProyecto').val(),
				evaluador_id:$("#cmbEvaluador").val(),
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
				
				var obj=item.toJSON();
				var model={
					value:obj.id,
					text:obj.descripcion
				};
				v = new ViewsEvalIndividual.ItemSelect({model:model});
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
	        			inscripcion_id:$('#cmbProyecto').val(),
	        			evaluador_id:$("#cmbEvaluador").val(),
						criterio_id:this.nodeSelected.id,
						puntaje:$('#cmbPuntaje').val(),
						respuesta:$('#txtRespuesta').val(),
						aspectoclave_id:0
					});
	        		break;
	        	case "2":
	        		var obj=new Models.RespuestaCriterio({
	        			inscripcion_id:$('#cmbProyecto').val(),
	        			evaluador_id:$("#cmbEvaluador").val(),
						criterio_id:$("#cmbPregunta").val(),
						criterio_padreid:this.nodeSelected.id,
						puntaje:$('#cmbPuntaje').val(),
						respuesta:$('#txtRespuesta').val(),
						aspectoclave_id:$('#cmbRespuestaAspectoClave').val()
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
			this.comboAspectoClave=new Collections.AspectoClave();
			this.comboAspectoClave.on('reset',this.renderComboAspectosClave,true);
			this.loadComboAspectosClave();
		},
		LoadAreaAnalisis:function(){
			this.Subcriterio=new Models.Criterio({id:this.nodeSelected.id});
			this.Subcriterio.bind("sync", this.renderAreaAnalisis)
			this.Subcriterio.fetch();
			
		},
		loadComboAspectosClave:function(){
			var params={
				inscripcion_id:$('#cmbProyecto').val(),
				evaluador_id: $("#cmbEvaluador").val(),
				idconcurso:this.concurso.id
			};
			this.comboAspectoClave.fetch({reset:true,data:params})
		},
		renderComboAspectosClave:function(){
			$('#cmbRespuestaAspectoClave').empty();
			this.comboAspectoClave.each(function(item,idx) {
				
				var obj=item.toJSON();
				var model={
					value:obj.id,
					text:obj.descripcion
				};
				v = new ViewsEvalIndividual.ItemSelect({model:model});
				$('#cmbRespuestaAspectoClave').append(v.render().el);
			},this); 


		},
		renderAreaAnalisis:function(){
			
			var collection = new Backbone.Collection(this.Subcriterio.toJSON().children);
			$('#cmbAreaAnalisis').empty();
			collection.each(function(item,idx) {
				var obj=item.toJSON();
				var model={
					value:obj.id,
					text:obj.descripcion
				};
				v = new ViewsEvalIndividual.ItemSelect({model:model});
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
			
			var collection = new Backbone.Collection(this.AreaAnalisis.toJSON().children);
			$('#cmbPregunta').empty();
			collection.each(function(item,idx) {
				
				var obj=item.toJSON();
				var model={
					value:obj.id,
					text:obj.descripcion
				};
				v = new ViewsEvalIndividual.ItemSelect({model:model});
				$('#cmbPregunta').append(v.render().el);
			},this); 
		}
	}),
	
	ItemSelect: Backbone.View.extend({
        tagName:"option",
        value:0,
        text:'',
		initialize: function() {
			this.template = _.template($('#itemOption_template').html());	
		},
		render: function() {
			console.log(this.model.value);
			console.log(this.model.text);
			this.$el.attr('value',this.model.value);
			this.$el.html(this.model.text);
			return this;
		}
	}),
	

//////////APLICACION RESPUESTAS////////////////////////////////////////////////
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
			
			var params={
				inscripcion_id:$('#cmbProyecto').val(),
				evaluador_id: $("#cmbEvaluador").val(),
				concursocriterio_id:this.attributes.idCriterio
			};
			this.VisitasCollection.fetch({reset:true,data:params});
		},
		LoadAspectosClaves:function(){

			
			var params={
				inscripcion_id:$('#cmbProyecto').val(),
				evaluador_id:$("#cmbEvaluador").val(),
				idcriterio:this.attributes.idCriterio
			};
			this.AspectosClavesCollection.fetch({reset:true,data:params});
		},
		renderAspectosClave:function(){
			
			$('#gridCriterioAspectosClaves tbody').empty();
			this.AspectosClavesCollection.each(function(item,idx) {
				
				v = new ViewsEvalIndividual.ItemAspectoClave({
					model:item.toJSON(),
					attributes:{type:3}
				});
				$('#gridCriterioAspectosClaves tbody').append(v.render().el);
			},this); 
			$("#gridCriterioAspectosClaves tbody a").click(this.EventCriterioAspectoClave); 
			return this;
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
			var params={ 
				inscripcion_id:$('#cmbProyecto').val(),
				evaluador_id:$("#cmbEvaluador").val(),
				isparent:this.attributes.isParent,
				idcriterio:this.attributes.idCriterio
			};
			this.RespuestasCollection.fetch({reset:true,data:params});
			return this;
		},
		renderVisita:function(){
			
			
			this.Visita=new Models.CriterioVisita({id:0});
			if(this.VisitasCollection.size()>0){

				this.Visita=this.VisitasCollection.at(0).toJSON();
				
				$("#txtVisita").text(this.Visita.descripcion);
			}
			
			//this.$el.find("#txtVisita").val(this.Visita.toJSON().descripcion);
		},
		renderRespuestas:function(){
			
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
			this.$el.find('#gridAreasMejora tbody').empty();
			this.AreasMejoraCollection.each(function(item,idx) {
				
				obj=item.toJSON();
				obj.isParent=this.attributes.isParent;
				v = new ViewsEvalIndividual.ItemRespuesta({model:obj});
				this.$el.find('#gridAreasMejora tbody').append(v.render().el);
			},this);  
			$("#gridFortalezas tbody a").click(this.EventRespuestas);   
			$("#gridAreasMejora tbody a").click(this.EventRespuestas);   
			return this;
		},
		SaveVisita:function(){
			
			if(this.Visita.id==0){
				var item=new Models.CriterioVisita({
					inscripcion_id:$('#cmbProyecto').val(),
					evaluador_id:$("#cmbEvaluador").val(),
					concursocriterio_id:this.attributes.idCriterio,
					descripcion:$("#txtVisita").val()
				});
			}else{
				var item=new Models.CriterioVisita({
					inscripcion_id:$('#cmbProyecto').val(),
					evaluador_id:$("#cmbEvaluador").val(),
					id:this.Visita.id,
					concursocriterio_id:this.attributes.idCriterio,
					descripcion:$("#txtVisita").val()
				});
			}

			//this.Visita.set({})
			item.save({},{success:function(){
						noty({
		                    text: 'Se ha actualizado el registro satisfactoriamente', 
		                    type: 'success',
		                    layout:'bottomRight',
		                    timeout:5000,
		                });
			}});
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
			var params={
				inscripcion_id:$('#cmbProyecto').val(),
				evaluador_id: $("#cmbEvaluador").val(),
				idconcurso:this.attributes.idConcurso
			};
			this.AddAspectosClavesCollection.fetch({reset:true,data:params})
		},
		renderAddAspectosClave:function(){
			$('#gridAddAspectosClave tbody').empty();
			this.AddAspectosClavesCollection.each(function(item,idx) {
				
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
					inscripcion_id:$('#cmbProyecto').val(),
					evaluador_id: $("#cmbEvaluador").val(),
					criterio_id:parent.attributes.idCriterio,
					aspectoclave_id:$(this).attr('data-id')
				})
			    model.save({},{success:function(){
			    	parent.attributes.app.SelectCriterio(parent.attributes.app.nodeSelected);
			    }});
			});
			
		},
		EventRespuestas:function(evt){
			
        	var element=$(evt.currentTarget);
        	var type=element.attr('data-type');
        	switch(type){
        		case "edit":
	        		this.EditRespuesta(element.attr('data-id'));
	        		break;
        		case "delete":
        			this.DeleteRespuesta(element.attr('data-id'));
	        		break;
        	}
        },
        EditRespuesta:function(id){

			var template='';
			if(this.attributes.isParent)
				template="_admin_respuesta_edit2";
			else
				template="_admin_respuesta_edit";
			var parent=this;
			this.Window=new BootstrapWindow({id:"winForm",title:"Editar Respuesta"});
	        this.Window.setWidth(600);
	        //this.Window.setHeight(200);
	        var idRespuesta=id;
	        var url=Routing.generate(template);
	        this.Window.LoadWithFnSuccess(url,function(){
	        	parent.InitFormRespuesta(idRespuesta);
	        });
	        this.Window.Show();
	        
	        this.Window.AddButton('btn-respuesta-cancel',{
	            label:'Cancelar',
	            'class':'btn-default',
	            fn:function(){
	               parent.Window.Hide();
	            }
	            
	        })
	       
	        this.Window.AddButton('btn-respuesta-save',{
	            label:'Grabar',
	            'class':'btn-success',
	            fn:function(){
	                $('#btn-respuesta-save').attr('disabled',true);
	                $('#btn-respuesta-cancel').attr('disabled',true);
	                parent.UpdateAspectoClave(idRespuesta);               
	                
	            }
	        });
        },
        InitFormRespuesta:function(idRespuesta){
			
			var parent=this; 
			this.RespuestaSelected=new Models.RespuestaCriterio({id:idRespuesta});
			this.RespuestaSelected.fetch({success:function(model){
				var item=model.toJSON();
				$("#txtRespuesta").val(item.respuesta);
				$("#cmbPuntaje").val(item.puntaje);
			}})
			
		},
        DeleteRespuesta:function(id){
        	var parent=this;
			var n=noty({
	          text: 'Desea eliminar el registro seleccionado?',
	          layout: 'center',
	          theme: 'defaultTheme',
	          modal:true,
	          buttons: [
	            {addClass: 'btn btn-success', text: 'Si', onClick: function($noty) {

	                var model=new Models.RespuestaCriterio({id:id})
	                model.destroy({success:function(){
	                	parent.attributes.app.SelectCriterio(parent.attributes.app.nodeSelected);
	                	noty({
		                    text: 'Se ha eliminado el registro satisfactoriamente', 
		                    type: 'success',
		                    layout:'bottomRight',
		                    timeout:5000,
		                });
	                }})
	                $noty.close();
	                
	              }
	            },
	            {addClass: 'btn btn-danger', text: 'No', onClick: function($noty) {
	                $noty.close();
	                
	            }
	            }
	          ]
	        });
        },
        EventCriterioAspectoClave:function(evt){
			
        	var element=$(evt.currentTarget);
        	var type=element.attr('data-type');
        	switch(type){
        		case "edit":
	        		this.EditCriterioAspectoClave(element.attr('data-id'));
	        		break;
        		case "delete":
        			this.DeleteCriterioAspectoClave(element.attr('data-id'));
	        		break;
        	}
        },
        EditCriterioAspectoClave:function(id){
			alert("edit..:D: "+id);
        },
        DeleteCriterioAspectoClave:function(id){
        	var parent=this;
			var n=noty({
	          text: 'Desea eliminar el registro seleccionado?',
	          layout: 'center',
	          theme: 'defaultTheme',
	          modal:true,
	          buttons: [
	            {addClass: 'btn btn-success', text: 'Si', onClick: function($noty) {

	                var model=new Models.CriterioAspectoClave({id:id})
	                model.destroy({success:function(){
	                	parent.attributes.app.SelectCriterio(parent.attributes.app.nodeSelected);
	                	noty({
		                    text: 'Se ha eliminado el registro satisfactoriamente', 
		                    type: 'success',
		                    layout:'bottomRight',
		                    timeout:5000,
		                });
	                }})
	                $noty.close();
	                
	              }
	            },
	            {addClass: 'btn btn-danger', text: 'No', onClick: function($noty) {
	                $noty.close();
	                
	            }
	            }
	          ]
	        });
        }
	}),
	ItemRespuesta: Backbone.View.extend({
        tagName:"tr",
		initialize: function() {
			this.template = _.template($('#itemRespuesta_template').html());
			
		},
		render: function() {
			
			this.$el.html(this.template({model:this.model}));
			return this;
		}
	}),

//////////APLICACION ASPECTOS CLAVES////////////////////////////////////////////////
	AspectosClaves: Backbone.View.extend({
        tagName:"div",
        
        attributes :{
        	app:null,
        	isParent:false,
        	idCriterio:0

        },
        
		initialize: function() {
			_.bindAll(this);
			this.template = _.template($('#FactoresClave_template').html());
			
			this.AspectosClaveCollection=new Collections.AspectoClave();
			this.AspectosClaveCollection.on('reset', this.renderAspectosClave, this);
			this.loadAspectosClave();
		},
		render: function() {
			this.$el.html(this.template());

			return this;
		},
		loadAspectosClave:function(){
			
			var params={ 
				inscripcion_id:$('#cmbProyecto').val(),
				evaluador_id: $("#cmbEvaluador").val(),
				isparent:this.attributes.isParent,
				idcriterio:this.attributes.idCriterio
			};
			this.AspectosClaveCollection.fetch({reset:true,data:params});
		},
		renderAspectosClave:function(){
			if(this.attributes.isParent)
				this.renderAspectosClavesParent();
			else
				this.renderAspectosClavesNode();
			return this;
			
		},
		renderAspectosClavesParent:function(){
			$('#AspectosClaveParent').show();
			$('#gridFactoresClave').hide();

			var collection = new Backbone.Collection(this.attributes.app.ParentNode.children);
        	$('#tabAspectos').empty();
        	$('#tabAspectosContent').empty();
        	collection.each(function(item,idx) {
				
				var obj=item.toJSON();
				var model={
					value:obj.id,
					text:obj.descripcion
				};
				v = new ViewsEvalIndividual.ItemTabAspectoClave({model:model});
				$('#tabAspectos').append(v.render().el);

				v = new ViewsEvalIndividual.ItemTabContentAspectoClave({model:model});
				$('#tabAspectosContent').append(v.render().el);
			},this); 

			this.AspectosClaveCollection.each(function(item,idx) {
				var obj=item.toJSON();
				v = new ViewsEvalIndividual.ItemAspectoClave({
					model:item.toJSON(),
					attributes:{type:1}
				});
				var content='#gridFactoresClave-'+obj.criterio.id+' tbody';
				this.$el.find(content).append(v.render().el);
			},this);

			collection.each(function(item,idx) {
				var obj=item.toJSON();
				var content='#gridFactoresClave-'+obj.id+' tbody a';
				$(content).click(this.EventAspectos);
			},this); 
			$('#tabAspectos a:first').tab('show')
		},
		renderAspectosClavesNode:function(){
			$('#gridFactoresClave').show();
			$('#AspectosClaveParent').hide();
			this.$el.find('#gridFactoresClave tbody').empty();
			var v = null;
			                     
			this.AspectosClaveCollection.each(function(item,idx) {
				v = new ViewsEvalIndividual.ItemAspectoClave({
					model:item.toJSON(),
					attributes:{type:1}
				});
				this.$el.find('#gridFactoresClave tbody').append(v.render().el);
			},this);
            $("#gridFactoresClave tbody a").click(this.EventAspectos);          
			return this;
		},
		EventAspectos:function(evt){
			
        	var element=$(evt.currentTarget);
        	var type=element.attr('data-type');
        	switch(type){
        		case "edit":
	        		this.Edit(element.attr('data-id'));
	        		break;
        		case "delete":
        			this.Delete(element.attr('data-id'));
	        		break;
        	}
        },
        Edit:function(id){
			var parent=this;
			this.Window=new BootstrapWindow({id:"winForm",title:"Editar Aspecto Clave"});
	        this.Window.setWidth(600);
	        this.Window.setHeight(200);
	        var idAspecto=id;
	        var url=Routing.generate('_admin_aspectoclave_edit');
	        this.Window.LoadWithFnSuccess(url,function(){
	        	parent.InitFormAspectosClaves(idAspecto);
	        });
	        this.Window.Show();
	        
	        this.Window.AddButton('btn-aspecto-cancel',{
	            label:'Cancelar',
	            'class':'btn-default',
	            fn:function(){
	               parent.Window.Hide();
	            }
	            
	        })
	       
	        this.Window.AddButton('btn-aspecto-save',{
	            label:'Grabar',
	            'class':'btn-success',
	            fn:function(){
	                $('#btn-aspecto-save').attr('disabled',true);
	                $('#btn-aspecto-cancel').attr('disabled',true);
	                parent.UpdateAspectoClave(idAspecto);               
	                
	            }
	        });
        },
        InitFormAspectosClaves:function(idAspecto){
			var collection = new Backbone.Collection(this.attributes.app.ParentNode.children);
        	$('#cmbAspectoCLave').empty();
        	collection.each(function(item,idx) {
				
				var obj=item.toJSON();
				var model={
					value:obj.id,
					text:obj.descripcion
				};
				v = new ViewsEvalIndividual.ItemSelect({model:model});
				$('#cmbAspectoCLave').append(v.render().el);
			},this);
			var parent=this; 
			this.AspectoClaveSelected=new Models.AspectoClave({id:idAspecto});
			this.AspectoClaveSelected.fetch({success:function(model){
				var item=model.toJSON();
				console.log(item);
				$('#cmbAspectoCLave').val(item.criterio.id);
				$("#txtDescripcionAspectoClave").val(item.descripcion);

			}})
			
		},
		UpdateAspectoClave:function(idAspecto){
			var parent=this;
			var obj=new Models.AspectoClave({
				id:idAspecto,
				inscripcion_id:$('#cmbProyecto').val(),
				evaluador_id:$("#cmbEvaluador").val(),
				criterio_id:$('#cmbAspectoCLave').val(),
				descripcion:$('#txtDescripcionAspectoClave').val()
			});
			
			obj.save({},{
				success:function(){
					parent.Window.Hide();
					parent.attributes.app.SelectCriterio(parent.attributes.app.nodeSelected);
				}
			});
		},
        Delete:function(id){
        	var parent=this;
			var n=noty({
	          text: 'Desea eliminar el registro seleccionado?',
	          layout: 'center',
	          theme: 'defaultTheme',
	          modal:true,
	          buttons: [
	            {addClass: 'btn btn-success', text: 'Si', onClick: function($noty) {

	                var model=new Models.AspectoClave({id:id})
	                model.destroy({success:function(){
	                	parent.attributes.app.SelectCriterio(parent.attributes.app.nodeSelected);
	                	noty({
		                    text: 'Se ha eliminado el registro satisfactoriamente', 
		                    type: 'success',
		                    layout:'bottomRight',
		                    timeout:5000,
		                });
	                }})
	                $noty.close();
	                
	              }
	            },
	            {addClass: 'btn btn-danger', text: 'No', onClick: function($noty) {
	                $noty.close();
	                
	            }
	            }
	          ]
	        });
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
			
			this.$el.html(this.template({model:this.model}));
			return this;
		}
	}),
	ItemTabAspectoClave: Backbone.View.extend({
        tagName:"li",
		initialize: function() {
			this.template = _.template($('#FactoresClaveTab_template').html());		
		},
		render: function() {			
			this.$el.html(this.template({model:this.model}));
			return this;
		}
	}),
	ItemTabContentAspectoClave: Backbone.View.extend({
        tagName:"div",
		initialize: function() {
			this.template = _.template($('#FactoresClaveTabContainer_template').html());		
		},
		render: function() {
			this.$el.attr('id',"tab-aspectoclave-"+this.model.value);
			this.$el.addClass("tab-pane");
			this.$el.html(this.template({model:this.model}));
			return this;
		}
	})

};

$(document).ready(function() {
	var v=new ViewsEvalIndividual.App({ el: $("#containerEtapaIndividual") });


});

