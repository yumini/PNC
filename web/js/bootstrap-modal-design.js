/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var BootstrapWindow= Backbone.Model.extend({
    idAttribute: 'id',
    defaults:{
        modal:false,
        Window:null,
        Content:null,
        Dialog:null,
        Header:null,
        Body:null,
        bodyId:"",
        Footer:null,
        title:"modal title",
        method:"GET",
        params:""
    },
    initialize: function(){
        this.CreateWindow();        
    },
    Show:function(){
       this.Window.modal('show');
    },
    Hide:function(){
       this.Window.modal('hide');  
    },
    Load:function(url,js){
        var idDomHTML;
        idDomHTML=this.get("id")+"-body";
        new jAjax().Load(url,idDomHTML,this.get("method"),this.get("params"),js);

    },
    LoadWithFnSuccess:function(url,fnSuccess){
        var idDomHTML;
        idDomHTML=this.get("id")+"-body";
        new jAjax().LoadWithFnSuccess(url,idDomHTML,this.get("method"),this.get("params"),fnSuccess);

    },
    CreateWindow:function(){
        this.Window=$("#"+this.get("id"));
        this.Window.html("");
        this.Window.addClass("modal");
        this.Window.addClass("fade");
        this.AddDialog();
        this.AddContent();
        this.AddHeader();
        this.AddBody();
        this.AddFooter();
        
    },
    AddDialog:function(){
        var idDomHTML;
        idDomHTML=this.get("id")+"-dialog";
        this.Window.append("<div id=\""+idDomHTML+"\" class=\"modal-dialog\"></div>");
        this.Dialog=$("#"+idDomHTML);
    },
    AddContent:function(){
        var idDomHTML;
        idDomHTML=this.get("id")+"-content";
        this.Dialog.append("<div id=\""+idDomHTML+"\" class=\"modal-content\"></div>");
        this.Content=$("#"+idDomHTML); 
    },
    AddHeader:function(){
        var idDomHTML;
        idDomHTML=this.get("id")+"-header";
        this.Content.append("<div id=\""+idDomHTML+"\" class=\"modal-header\"></div>");
        this.Header=$("#"+idDomHTML);
        this.Header.append("<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>");
        this.Header.append("<h4 class=\"modal-title\">"+this.get("title")+"</h4>")
        
    },
    AddBody:function(){
        this.set("bodyId", this.get("id")+"-body");
        this.Content.append("<div id=\""+this.get("bodyId")+"\" class=\"modal-body\"></div>");
        this.Body=$("#"+this.get("bodyId"));
    },
    AddFooter:function(){
        var idDomHTML;
        idDomHTML=this.get("id")+"-footer";
        idDomHTMLSave=this.get("id")+"-save";
        idDomHTMLClose=this.get("id")+"-close";
        this.Content.append("<div id=\""+idDomHTML+"\" class=\"modal-footer\"></div>");
        this.Footer=$("#"+idDomHTML);
        
    },
    AddHTML:function(data){
        this.Body.html(data);
    },
    AddButton:function(id,options){
        
        this.Footer.append( "<a id=\""+id+"\" class=\"btn "+options.class+"\" >"+options.label+"</a>");
        $("#"+id).click(options.fn);
    },
    setWidth:function(width){
        this.Dialog.css("width",width+"px");
    },
    setHeight:function(height){
        //this.Content.css("height",height+"px");
        this.Body.css("height",height+"px");
    }
    
});