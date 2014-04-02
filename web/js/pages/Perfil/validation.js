_.extend(Backbone.Validation.callbacks, {
  valid: function(view, attr, selector) {
    // do something
    console.log("valid...");
  },
  invalid: function(view, attr, error, selector) {
    // do something
    console.log("invalid...");
  }
});

// Define a model with some validation rules
var FormModel = {
    Perfil:Backbone.Model.extend({
            defaults: {
                
            },
            validation: {
                "app_webbundle_perfiltype[_token]":{

                },
                "app_webbundle_perfiltype[nombre]": {
                    required: true
                },
                "app_webbundle_perfiltype[descripcion]": {
                    required: true
                }
            }
        })
};

// Define a View that uses our model
var FormView = {
    Perfil: Backbone.View.extend({

        initialize: function () {
            // This hooks up the validation
            // See: http://thedersen.com/projects/backbone-validation/#using-form-model-validation/validation-binding
            console.log("ini...");
            Backbone.Validation.bind(this);
            $("#btn-perfil-save").click(this.save);
        },

        save: function () {
            console.log("validando...")

            var data = $('#myform').serializeObject();
            //var data = this.$el.serializeObject();
            console.log(data);
            this.model=new FormModel.Perfil(data);
            
            // Check if the model is valid before saving
            // See: http://thedersen.com/projects/backbone-validation/#methods/isvalid
            if(this.model.isValid(true)){
                // this.model.save();
                alert('Great Success!');
            }
        },
        
        remove: function() {
            // Remove the validation binding
            // See: http://thedersen.com/projects/backbone-validation/#using-form-model-validation/unbinding
            Backbone.Validation.unbind(this);
            return Backbone.View.prototype.remove.apply(this, arguments);
        }
    })
};

$.fn.serializeObject = function () {
    "use strict";
    var a = {}, b = function (b, c) {
        var d = a[c.name];
        "undefined" != typeof d && d !== null ? $.isArray(d) ? d.push(c.value) : a[c.name] = [d, c.value] : a[c.name] = c.value
    };
    return $.each(this.serializeArray(), b), a
};