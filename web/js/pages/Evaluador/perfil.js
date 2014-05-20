var OptionButton = OptionButton || {Perfil: {}, Contactos: {}};
var myWindow=null;


OptionButton.Perfil=function(){
    this.routeList='_admin_evaluador_perfil';
   
    this.routeEdit='_admin_evaluador_edit';
    this.routeUpdate='_admin_evaluador_update';    
}
OptionButton.Perfil.prototype={
    Edit:function(id){
        this.IdEntity=id;
        this.Window=new BootstrapWindow({id:"winForm",title:"Editar Mi Perfil"});
        this.Window.setWidth(750);
        this.Window.setHeight(450);
        var url=Routing.generate(this.routeEdit,{id:id});
        this.Window.Load(url,"");
        this.Window.Show();
        var parent=this;
        this.Window.AddButton('btn-perfil-cancel',{
            label:'Cancelar',
            'class':'btn-default',
            fn:function(){
                parent.Window.Hide();
            }
            
        })
       
        this.Window.AddButton('btn-perfil-save',{
            label:'Grabar',
            'class':'btn-success',
            fn:function(){
                parent.Update();               
            }
        });
    },
    Update:function(){
            console.log("actualizando perfil con id:"+this.IdEntity);
            var parent=this;
            parent.Window.Buttons(0).disabled();
            parent.Window.Buttons(1).disabled();
            var url=Routing.generate(this.routeUpdate,{id:this.IdEntity});
            params = $('#myPerfilform').serializeObject();
            var nodes = $('#tree').tree('getChecked');
            var s = '';
                    
            $.ajax({
                    type:'PUT',
                    url:url,
                    data:params,
                    dataType:"json",
                    success:function(obj){
                            parent.Window.Buttons(0).enabled();
                            parent.Window.Buttons(1).enabled();
                            
                            tipo=(obj.success)?'success':'warning';
                            var n = noty({
                                    text: obj.message,
                                    type: tipo,
                                    dismissQueue: true,
                                    layout: 'bottomRight',
                                    theme: 'defaultTheme',
                                    timeout:5000
                            });
                            if(obj.success){
                                parent.Window.Hide();

                                setTimeout(function() {
                                     new OptionButton.Perfil().Refresh();
                                }, 1000);
                            }
                           
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });           
    },
   
    Refresh:function(){
        var id=$('#hdnEntity_id').val();
        var url=Routing.generate(this.routeList,{id:id});
        new jAjax().Load(url,'main-body','get','','');
    }

   

}

OptionButton.Conflictos=function(){
     this.routeList='_admin_conflictodeinteres';
     this.routeNew='_admin_conflictodeinteres_new';
     this.routeSave='_admin_conflictodeinteres_save';
     this.routeEdit='_admin_conflictodeinteres_edit';
     this.routeUpdate='_admin_conflictodeinteres_update';
     this.routeDelete='_admin_conflictodeinteres_delete';
};

OptionButton.Conflictos.prototype={
     Refresh:function(){
        var id=$("#hdnEntity_id").val();
        var url=Routing.generate(this.routeList,{id:id});
        new jAjax().Load(url,'containerConflicto','get','','');
    },
    New:function(){
        this.Window=new BootstrapWindow({id:"winForm",title:"Agregar Conflicto de Interes"});
        this.Window.setWidth(600);
        this.Window.setHeight(360);
        var url=Routing.generate(this.routeNew);
        this.Window.Load(url,"");
        this.Window.Show();
        var parent=this;
        this.Window.AddButton('btn-conflicto-cancel',{
            label:'Cancelar',
            'class':'btn-default',
            fn:function(){
                parent.Window.Hide();
            }
            
        })
       
        this.Window.AddButton('btn-conflicto-save',{
            label:'Grabar',
            'class':'btn-success',
            fn:function(){
                parent.Save();               
                
            }
        });
    },
    Save:function(){
            
            var parent=this;
            parent.Window.Buttons(0).disabled();
            parent.Window.Buttons(1).disabled();
            var id=$("#hdnEntity_id").val();
            var url=Routing.generate(this.routeSave,{id:id});
            params = $('#myform').serializeObject();
            console.log(params);
            
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"json",
                    success:function(obj){
                            parent.Window.Buttons(0).enabled();
                            parent.Window.Buttons(1).enabled();
                            console.log(obj)
                            if(obj.success)
                                tipo='success';
                            else
                                tipo='warning';
                            var n = noty({
                                    text: obj.message,
                                    type: tipo,
                                    dismissQueue: true,
                                    layout: 'bottomRight',
                                    theme: 'defaultTheme',
                                    timeout:5000
                            });
                            if(obj.success){
                                parent.Window.Hide();
                                parent.Refresh(); 
                            }
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });
        
    },
    Edit:function(id){
        this.IdEntity=id;
        this.Window=new BootstrapWindow({id:"winForm",title:"Editar Conflicto de Interes"});
        this.Window.setWidth(600);
        this.Window.setHeight(360);
        var url=Routing.generate(this.routeEdit,{id:id});
        this.Window.Load(url,"");
        this.Window.Show();
        var parent=this;
        this.Window.AddButton('btn-contacto-cancel',{
            label:'Cancelar',
            'class':'btn-default',
            fn:function(){
                parent.Window.Hide();
            }
            
        })
       
        this.Window.AddButton('btn-contacto-save',{
            label:'Grabar',
            'class':'btn-success',
            fn:function(){
                parent.Update();               
            }
        });
    },
    Update:function(){
            
            var parent=this;
            parent.Window.Buttons(0).disabled();
            parent.Window.Buttons(1).disabled();
            var url=Routing.generate(this.routeUpdate,{id:this.IdEntity});
            params = $('#myform').serializeObject();
                   
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"json",
                    success:function(obj){
                            parent.Window.Buttons(0).enabled();
                            parent.Window.Buttons(1).enabled();
                            console.log(obj)
                            if(obj.success)
                                tipo='success';
                            else
                                tipo='warning';
                            var n = noty({
                                    text: obj.message,
                                    type: tipo,
                                    dismissQueue: true,
                                    layout: 'bottomRight',
                                    theme: 'defaultTheme',
                                    timeout:5000
                            });
                            if(obj.success){
                                parent.Window.Hide();
                                parent.Refresh(); 
                            }
                            
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });           
    },
    Delete:function(id){
        this.IdEntity=id;
        if(confirm("Desea eliminar el contacto seleccionado?")){
             var url=Routing.generate(this.routeDelete,{id:this.IdEntity});
             $.ajax({
                    type:'DELETE',
                    url:url,
                    dataType:"html",
                    success:function(datos){
                            
                            new OptionButton.Conflictos().Refresh(); 
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            }); 
        }
    }
};


var viewDisponibilidad={
    App: Backbone.View.extend({
        events: {
                   "click a.pull-right": "SelectDisponibilidad",
        },
        initialize: function(){
            _.bindAll(this);
            this.disponibilidadCollection=new Collections.DisponibilidadEvaluador();
            this.disponibilidadCollection.on('reset', this.renderItems, this);
            this.template = _.template($('#listDisponibilidad_template').html());
            //this.LoadItems();
        },
        render:function(){
            this.$el.html(this.template({}));
            this.LoadItems();
        },
        renderItems:function(){
            this.$el.find('#listDisponibilidad').empty();
            var v = null;
                                 
            this.disponibilidadCollection.each(function(item,idx) {
                var obj=item.toJSON();
                if (obj.diasdisponiblesEvaluador.length>0){
                    var disponibilidad={
                        manana:obj.diasdisponiblesEvaluador[0].manana,
                        tarde:obj.diasdisponiblesEvaluador[0].tarde,
                        noche:obj.diasdisponiblesEvaluador[0].noche
                    }
                }else{
                    var disponibilidad={
                        manana:0,
                        tarde:0,
                        noche:0
                    }
                }
                var model={id:obj.id,dia:obj.nombre,disponibilidad:disponibilidad}
                console.log(model);
                v = new viewDisponibilidad.Item({model:model});
                this.$el.find('#listDisponibilidad').append(v.render().el);
            },this);
            return this;
        },
        LoadItems:function(){
            var params={id:$("#hdnEntity_id").val()};
            this.disponibilidadCollection.fetch({reset:true,data:params})
        },
        SelectDisponibilidad:function(evt){
            var parent=this;
            turno=$(evt.currentTarget).attr('data-turno');
            dia=$(evt.currentTarget).attr('data-dia');
            value=($(evt.currentTarget).attr('data-value')=='true')?0:1;
            
            var item=new Models.DisponibilidadEvaluador({dia_id:dia,turno:turno,value:value,evaluador_id:$("#hdnEntity_id").val()});
            item.save({},{success:function(){
                parent.LoadItems();
            }});
        }
    }),
    Item:Backbone.View.extend({
        tagName:"a",
        initialize: function() {
             this.template = _.template($('#itemDisponibilidad_template').html());
        },
        render: function() {    
        
            this.$el.addClass('list-group-item')       
            this.$el.html(this.template({model:this.model}));
            return this;
        }
    })
}
OptionButton.Disponibilidad=function(){
     this.routeList='_admin_evaluadordisponibilidad';
     this.routeNew='_admin_evaluadordisponibilidad_new';
     this.routeSave='_admin_evaluadordisponibilidad_save';
     this.routeEdit='_admin_evaluadordisponibilidad_edit';
     this.routeUpdate='_admin_evaluadordisponibilidad_update';
     this.routeDelete='_admin_evaluadordisponibilidad_delete';
     this.routeDisponibilidadViaje="_admin_evaluadordisponibilidad_disponibilidadviaje"
};

OptionButton.Disponibilidad.prototype={
    Refresh:function(){
        var id=$("#hdnEntity_id").val();
        var url=Routing.generate(this.routeList,{id:id});
        new jAjax().Load(url,'containerDisponibildad','get','','');
    },
    New:function(){
        this.Window=new BootstrapWindow({id:"winForm",title:"Agregar Disponibilidad"});
        this.Window.setWidth(600);
        //this.Window.setHeight(360);
        var url=Routing.generate(this.routeNew);
        this.Window.Load(url,"");
        this.Window.Show();
        var parent=this;
        this.Window.AddButton('btn-disponibilidad-cancel',{
            label:'Cancelar',
            'class':'btn-default',
            fn:function(){
                parent.Window.Hide();
            }
            
        })
       
        this.Window.AddButton('btn-disponibilidad-save',{
            label:'Grabar',
            'class':'btn-success',
            fn:function(){
                parent.Save();               
                parent.Window.Hide();
            }
        });
    },
    Save:function(){
            var id=$('#hdnEntity_id').val();
            var parent=this;
            var url=Routing.generate(this.routeSave,{id:id});
            params = $('#myDisponibilidadform').serializeObject();
            console.log(params);
            
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"html",
                    success:function(datos){
                            var n = noty({
                                    text: 'Operación realizada satisfactoriamente',
                                    type: 'success',
                                    dismissQueue: true,
                                    layout: 'bottomRight',
                                    theme: 'defaultTheme',
                                    timeout:5000
                                });
                           new OptionButton.Disponibilidad().Refresh(); 
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });
        
    },
    Edit:function(id){
        this.IdEntity=id;
        this.Window=new BootstrapWindow({id:"winForm",title:"Editar Conflicto de Interes"});
        this.Window.setWidth(600);
        //this.Window.setHeight(360);
        var url=Routing.generate(this.routeEdit,{id:id});
        this.Window.Load(url,"");
        this.Window.Show();
        var parent=this;
        this.Window.AddButton('btn-contacto-cancel',{
            label:'Cancelar',
            'class':'btn-default',
            fn:function(){
                parent.Window.Hide();
            }
            
        })
       
        this.Window.AddButton('btn-contacto-save',{
            label:'Grabar',
            'class':'btn-success',
            fn:function(){
                parent.Update();               
                parent.Window.Hide();
            }
        });
    },
    Update:function(){
            
            var parent=this;
            var url=Routing.generate(this.routeUpdate,{id:this.IdEntity});
            params = $('#myDisponibilidadform').serializeObject();
                   
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"html",
                    success:function(datos){
                            new OptionButton.Disponibilidad().Refresh(); 
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });           
    },
    Delete:function(id){
        this.IdEntity=id;
        var url=Routing.generate(this.routeDelete,{id:this.IdEntity});
         var n = noty({
            text: 'Desea eliminar el dia seleccionado?',
            type: 'alert',
            dismissQueue: true,
            layout: 'center',
            modal: true,
            theme: 'defaultTheme',
            buttons: [
                {addClass: 'btn btn-primary', text: 'Si', onClick: function($noty) {
                    
                    $.ajax({
                            type:'DELETE',
                            url:url,
                            dataType:"html",
                            success:function(datos){

                                    new OptionButton.Disponibilidad().Refresh(); 
                            },
                            error:function(objeto, quepaso, otroobj){

                            }
                    }); 
                    $noty.close();
                    noty({dismissQueue: true, force: true, layout: layout, theme: 'defaultTheme', text: 'Se Elimino satisfactoriamente', type: 'success'});
                }
                },
                {addClass: 'btn btn-danger', text: 'No', onClick: function($noty) {
                    $noty.close();
                   // noty({dismissQueue: true, force: true, layout: layout, theme: 'defaultTheme', text: 'You clicked "Cancel" button', type: 'error'});
                }
                }
            ]
          });
       
    },
    DisponibilidadViaje:function(id,value){
        this.IdEntity=id;
        var url=Routing.generate(this.routeDisponibilidadViaje,{id:this.IdEntity,estado:value});
         $.ajax({
                    type:'POST',
                    url:url,
                    dataType:"html",
                    success:function(datos){
                            
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
         }); 
    }
};
//al leer el documento
$(document).ready(function() {
  
    $("#btnEdit").click(function(){
      	var id=$(this).attr("data-id"); 
      	console.log("el id es:"+id);
        new OptionButton.Perfil().Edit(id);   
    });


    $("#btnConflictoNew").click(function(){
        var id=$(this).attr("data-id"); 
        console.log("el id es:"+id);
        new OptionButton.Conflictos().New(id);   
    });
     $("#btnDisponibilidadNew").click(function(){
        var id=$(this).attr("data-id"); 
        console.log("el id es:"+id);
        new OptionButton.Disponibilidad().New(id);   
    });
    
    $("input[name=disponibilidad]:radio").change(function(){
        var id=$(this).attr("data-id");
        console.log(id);
        new OptionButton.Disponibilidad().DisponibilidadViaje(id,$(this).val());   
    });
    $('#lnkCV').click(function(){
	        $('#fileCV').click();
    });
    new OptionButton.Conflictos().Refresh(); 
    //new OptionButton.Disponibilidad().Refresh(); 
    var v=new viewDisponibilidad.App({ el: $("#containerDisponibilidad") }).render();
  
});

$('#fileCV').fileupload({

        url:Routing.generate("_admin_evaluador_cvupload",{id:$('#evaluador_id').val()}),
        singleFileUploads: true,
        add: function (e, data) {
            console.log(data)
            console.log(data.files[0].size);
            var sizeMB=Math.round((data.files[0].size/1024)/1024);
            if(sizeMB<=2){
                var jqXHR = data.submit();
            }else{
                var n = noty({
                    text: "Archivo no debe exceder los 2 mb.",
                    type: 'warning',
                    dismissQueue: true,
                    layout: 'bottomRight',
                    theme: 'defaultTheme',
                    timeout:5000
                });
            }
            
        },
        progress: function(e, data){
            var progress = parseInt(data.loaded / data.total * 100, 10);
        },
        fail:function(e, data){
            //data.context.addClass('error');
        },
        done:function (e, data) {
            obj=data.result;
            console.log(data.result)
                if(obj.success){
                    var path=$("#lnkCVDownload").attr('data-path');
                    $("#lnkCVDownload").attr("href",path+obj.name+"?r="+Math.random()); 
                }
            var type=(obj.success)?'success':'warning';
           var n = noty({
                text: obj.message,
                type: type,
                dismissQueue: true,
                layout: 'bottomRight',
                theme: 'defaultTheme',
                timeout:5000
            });
        }
    });