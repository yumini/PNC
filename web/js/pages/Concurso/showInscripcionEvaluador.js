var OptionButton=function(){
    this.routeNew='_admin_inscripcionevaluador_new';
    this.routeSave='_admin_inscripcionevaluador_save';
       
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
            label:'Participar',
            'class':'btn-success',
            fn:function(){
                parent.Save();               
                parent.Window.Hide();
            }
        });
         $("#btn-inscripcion-save").addClass("disabled");
         
    },
    Save:function(){
            var parent=this;
            var url=Routing.generate(this.routeSave,{id:this.idConcurso});
           
            
            $.ajax({
                    type:'POST',
                    url:url,             
                    dataType:"html",
                    success:function(datos){
                            //parent.Window.AddHTML(datos);
                            parent.Refresh();
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });
        
    },
    Refresh:function(){
        new Concurso().Detail(this.idConcurso);
    }
}

