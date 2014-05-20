$('#upload1 a').click(function(){
	$(this).parent().find('input').click();
});
$('#upload2 a').click(function(){
   $(this).parent().find('input').click();
});

$(function(){

    var ul = $('#ulFiles');
    var input;
    
    // Initialize the jQuery File myform plugin
    $('#myform').fileupload({

        // This element will accept file drag/drop uploading
        dropZone: $('#drop'),
        singleFileUploads: true,
        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {
            $("#typeFile").val($(e.currentTarget).attr('data-type'));
            var info=$('#info-'+e.currentTarget.id);
            this.INFO=info;
            info.html(data.files[0].name+ ' - '+(data.files[0].size/1024)+' kb')
            console.log(data);
            var sizeMB=Math.round((data.files[0].size/1024)/1024);
            if(sizeMB<=2){
                var jqXHR = data.submit();
                info.html("<div class='home-loading' style='margin-top:2px;nargin-bottom:2px;'>Cargando...</div>") ;
            }else{
                var n = noty({
                    text: "Archivo no debe exceder los 2 mb.",
                    type: 'warning',
                    dismissQueue: true,
                    layout: 'bottomRight',
                    theme: 'defaultTheme',
                    timeout:5000
                });
                info.html("No se ha cargado el archivo");
            }

           
        },

        progress: function(e, data){

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            //data.context.find('input').val(progress).change();

            if(progress == 100){
                //data.context.removeClass('working');
            }
        },

        fail:function(e, data){
            // Something has gone wrong!
            //data.context.addClass('error');
        },
        done:function (e, data) {
            
            obj=data.result;
            console.log(data.result)
            var type=(obj.success)?'success':'warning';
           var n = noty({
                text: obj.message,
                type: type,
                dismissQueue: true,
                layout: 'bottomRight',
                theme: 'defaultTheme',
                timeout:5000
            });

           if(obj.success){
                this.INFO.html("Se cargo el documento satisfactoriamente");
           }else{
             
             this.INFO.html("No se pudo cargar el archivo.")
           }
        }

    });


    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }

        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }

});