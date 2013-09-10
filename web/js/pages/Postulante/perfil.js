var myWindow=null;


var OptionButton=function(){
    this.routeList='_admin_postulante_perfil';
    this.routeEdit='_admin_postulante_edit';
    this.routeUpdate='_admin_postulante_update';    
}
OptionButton.prototype={
    Edit:function(id){
        this.IdEntity=id;
        this.Window=new BootstrapWindow({id:"winFormPerfil",title:"Editar Mi Perfil"});
        this.Window.setWidth(600);
        this.Window.setHeight(360);
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
                parent.Window.Hide();
            }
        });
    },
    Update:function(){
            console.log("actualizando perfil con id:"+this.IdEntity);
            var parent=this;
            var url=Routing.generate(this.routeUpdate,{id:this.IdEntity});
            params = $('#myPerfilform').serializeObject();
            var nodes = $('#tree').tree('getChecked');
            var s = '';
                    
            $.ajax({
                    type:'PUT',
                    url:url,
                    data:params,
                    dataType:"html",
                    success:function(datos){
                            
                            new OptionButton().Refresh();
                    },
                    error:function(objeto, quepaso, otroobj){

                    }
            });           
    },
   
    Refresh:function(){
        var url=Routing.generate(this.routeList);
        new jAjax().Load(url,'main-body','get','','');
    }
}


//al leer el documento
$(document).ready(function() {
  
  console.log("se cargo el perfil...")
  $("#btnEdit").click(function(){
  	var id=$(this).attr("data-id"); 
  	console.log("el id es:"+id);
    new OptionButton().Edit(id);   
  });
  
});