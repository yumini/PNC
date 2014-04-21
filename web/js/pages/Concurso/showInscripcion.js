var OptionButton=function(){
    this.routeNew='_admin_inscripcion_new';
    this.routeSave='_admin_inscripcion_save';
    this.routeEdit='_admin_inscripcion_edit';
    this.routeUpdate='_admin_inscripcion_update';
    this.routeDelete='_admin_inscripcion_delete';
    this.WizardIndex=0;
       
}
OptionButton.prototype={
    ValidateTerminos:function(){
        var terminos=$("#chkTerminos").is(':checked');
        if(terminos){
            $("#btn-inscripcion-save").removeClass("disabled");
        }else{
            $("#btn-inscripcion-save").addClass("disabled");
        }
         
    },
    ActiveWizard:function(index){
        for (var i = 1; i <= 3; i++) {
             $("#wizard"+i).removeClass('active');
             $("#wizard"+i).addClass('disabled');
        };
        $("#wizard"+(index+1)).addClass('active');
         $("#wizard"+(index+1)).removeClass('disabled');
        $('#tabWizard li:eq('+index+') a').tab('show');
    },
    NextWizardTipo2:function(){
        var terminos=$("#chkTerminos").is(':checked');
        var tipoConcurso=$("#tipoConcurso").val();
        this.WizardIndex++;
            switch(this.WizardIndex){
                case 0:
                    $("#btn-inscripcion-save").html("Continuar");
                    this.ActiveWizard(0);
                    break;
                case 1:
                    $("#btn-inscripcion-save").html("Inscribirme");
                    this.ActiveWizard(1);
                    break;
                case 2:
                    this.Save();
                    $("#btn-inscripcion-save").html("Finalizar");
                    this.ActiveWizard(2);
                    break;
                case 3:
                    this.Window.Hide();
                    setTimeout(this.Refresh,2000);
                    break;
            }

    },
    NextWizardTipo1:function(){
        var terminos=$("#chkTerminos").is(':checked');
        var tipoConcurso=$("#tipoConcurso").val();
        this.WizardIndex++;
            switch(this.WizardIndex){
                case 0:
                    $("#btn-inscripcion-save").html("Inscribirme");
                    this.ActiveWizard(0);
                    break;
                case 1:
                    this.Save();
                    
                    $("#btn-inscripcion-save").html("Finalizar");
                    this.ActiveWizard(2);
                    break;
                case 2:
                    this.Window.Hide();
                    setTimeout(this.Refresh,2000);
                    break;
            }

    },
    New:function(idConcurso,idPostulante){
        var tipoConcurso=$("#tipoConcurso").val();
        this.idConcurso=idConcurso;
        this.idPostulante=idPostulante;
        this.WizardIndex=0;
        this.Window=new BootstrapWindow({id:"winForm",title:"Nueva Inscripci&oacute;n"});
        this.Window.setWidth(1000);
        //this.Window.setHeight(300);
        var url=Routing.generate(this.routeNew,{id:this.idPostulante,id2:this.idConcurso});
        this.Window.Load(url,"");
        this.Window.Show();
         var parent=this;
        this.Window.AddButton('btn-inscripcion-cancel',{
            label:'Cancelar',
            'class':'btn-default',
            fn:function(){
                
                parent.Window.Hide();
                //if(parent.WizardIndex>2)
                parent.Refresh();
            }
            
        })
       
        this.Window.AddButton('btn-inscripcion-save',{
            label:'Continuar',
            'class':'btn-success',
            fn:function(){
                if(tipoConcurso==1)
                     parent.NextWizardTipo1();
                else
                    parent.NextWizardTipo2();               
                //parent.Window.Hide();
            }
        });
         $("#btn-inscripcion-save").addClass("disabled");
         if(tipoConcurso==1){
            $("#btn-inscripcion-save").html("Inscribirme");
         }
         
    },
    Save:function(){
            var parent=this;
            var url=Routing.generate(this.routeSave,{id:this.idPostulante,id2:this.idConcurso});
            params = $('#myform').serializeObject();
            console.log(params);
            
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"json",
                    success:function(datos){
                        console.log(datos.id)
                            $('#idInscripcion').val(datos.id);
                            //parent.Refresh();
                            //parent.Window.AddHTML(datos);
                            //new OptionButton().Refresh();
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });
        
    },
    Edit:function(idInscripcion){
        this.idInscripcion=idInscripcion;
        var tipoConcurso=$("#tipoConcurso").val();
        this.WizardIndex=0;
        this.Window=new BootstrapWindow({id:"winForm",title:"Editar Inscripci&oacute;n"});
        this.Window.setWidth(1000);
        var url=Routing.generate(this.routeEdit,{id:idInscripcion});
        this.Window.Load(url,"");
        this.Window.Show();
         var parent=this;
        this.Window.AddButton('btn-inscripcion-cancel',{
            label:'Cancelar',
            'class':'btn-default',
            fn:function(){

                parent.Window.Hide();

            }
            
        })
       
        this.Window.AddButton('btn-inscripcion-save',{
            label:'Grabar',
            'class':'btn-success',
            fn:function(){
                parent.Update();
            }
        });

    },
    Update:function(){
            var parent=this;
            var url=Routing.generate(this.routeUpdate,{id:this.idInscripcion});
            params = $('#myform').serializeObject();
            console.log(params);
            
            $.ajax({
                    type:'PUT',
                    url:url,
                    data:params,
                    dataType:"html",
                    success:function(datos){
                        parent.Window.Hide();
                        setTimeout(parent.Refresh,2000);
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });
    },
    Delete:function(id){
        this.IdEntity=id;
        var parent=this;
        var n=noty({
          text: 'Desea eliminar el registro seleccionado?',
          layout: 'center',
          theme: 'defaultTheme',
          modal:true,
          buttons: [
            {addClass: 'btn btn-success', text: 'Si', onClick: function($noty) {

                var url=Routing.generate(parent.routeDelete,{id:parent.IdEntity});
                 $.ajax({
                        type:'DELETE',
                        url:url,
                        dataType:"html",
                        success:function(datos){
                               var n = noty({
                                    text: "Registro eliminado satisfactoriamente",
                                    type: "success",
                                    dismissQueue: true,
                                    layout: 'bottomRight',
                                    theme: 'defaultTheme',
                                    timeout:5000
                                }); 
                                new OptionButton().Refresh();
                        },
                        error:function(objeto, quepaso, otroobj){

                        }
                }); 
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
    Refresh:function(){
        Backbone.history.loadUrl(Backbone.history.fragment);
    },
    Informe:function(id,doc){
        var doc=doc||'';
        if(doc!=''){
            var path=$('#pathUpload').val();
            window.open(path+'/'+id+'/'+doc, '_self');
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
    }
}


$(document).ready(function() {
  
  
 
  $("button[data-type='inscripcion']").click(function(){
    var url=Routing.generate("_admin_concurso_showInscripcion");
    new jAjax().Load(url,"main-body","GET","","")
});

});