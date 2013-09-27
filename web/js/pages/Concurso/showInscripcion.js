var OptionButton=function(){
    this.routeNew='_admin_inscripcion_new';
    this.routeSave='_admin_inscripcion_save';
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
    NextWizard:function(){
        var terminos=$("#chkTerminos").is(':checked');
        console.log(terminos);
        this.WizardIndex++;
        if(terminos){
           
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
                    break;
            }
        }
        
    },
    New:function(id){
        this.idConcurso=id;
        this.WizardIndex=0;
        this.Window=new BootstrapWindow({id:"winForm",title:"Nueva Inscripci&oacute;n"});
        this.Window.setWidth(1000);
        //this.Window.setHeight(300);
        var url=Routing.generate(this.routeNew,{id:id});
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
            label:'Continuar',
            'class':'btn-success',
            fn:function(){
                parent.NextWizard();               
                //parent.Window.Hide();
            }
        });
         $("#btn-inscripcion-save").addClass("disabled");
         
    },
    Save:function(){
            var parent=this;
            var url=Routing.generate(this.routeSave,{id:this.idConcurso});
            params = $('#myform').serializeObject();
            console.log(params);
            
            $.ajax({
                    type:'POST',
                    url:url,
                    data:params,
                    dataType:"html",
                    success:function(datos){
                            //parent.Window.AddHTML(datos);
                            //new OptionButton().Refresh();
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });
        
    }
}


$(document).ready(function() {
  
  
 
  $("button[data-type='inscripcion']").click(function(){
    var url=Routing.generate("_admin_concurso_showInscripcion");
    new jAjax().Load(url,"main-body","GET","","")
});

});