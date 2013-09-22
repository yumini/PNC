$("button[data-type='inscripcion']").click(function(){
	var url=Routing.generate("_admin_concurso_showInscripcion");
	new jAjax().Load(url,"main-body","GET","","")
});

var OptionButton=function(){
    this.routeList='_admin_concurso';
    this.routeNew='_admin_concurso_new';
    this.routeSave='_admin_concurso_save';
    this.routeEdit='_admin_concurso_edit';
    this.routeUpdate='_admin_concurso_update';
    this.routeDelete='_admin_concurso_delete';
    this.routeCriterios="_admin_concurso_criterio";
    
}
OptionButton.prototype={
    New:function(id){
console.log("nuevo....")
        this.Window=new BootstrapWindow({id:"winForm",title:"Nuevo Concurso"});
        this.Window.setWidth(1000);
        this.Window.setHeight(300);
        //var url=Routing.generate(this.routeNew);
        //this.Window.Load(url,"");
        this.Window.Show();
         var parent=this;
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
                parent.Save();               
                parent.Window.Hide();
            }
        });
    },
    Save:function(){
            var parent=this;
            var url=Routing.generate(this.routeSave);
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
//new Concurso().List();