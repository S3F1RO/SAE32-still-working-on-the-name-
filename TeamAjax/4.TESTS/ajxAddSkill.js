$(document).ready(function(){

/*=============================================================================
   Send ajax to server
==============================================================================*/
alert("coucou 1");
    // Send files with ajax on button click
    jQuery("body").on("click", "#btnOK", function() {
alert("coucou 2");

        // Get file
        var file = jQuery("input[type='file']")[0].files[0];

        // Get data
        var mainName = jQuery("input[name='mainName']").val();
        var subName  = jQuery("input[name='subName']").val();
        var domain   = jQuery("input[name='domain']").val();
        var level    = jQuery("input[name='level']").val();
        var color    = jQuery("input[name='color']").val();
        
alert("coucou 3");

        // Send file
        sendAjaxFile("ajxAddSkill.php", file, {
            mainName: mainName,
            subName: subName,
            domain: domain,
            level: level,
            color: color
        }, this);
        
alert("coucou 4");

    });


/*==============================================================================
  Receive ajax
 ============================================================================== */

    function receiveAjax(data, domElt) {
      alert("coucou 5");

        if (data['success'])
            jQuery(domElt).css("background-color", "green");
        else
            jQuery(domElt).css("background-color", "red");

        alert("coucou 5");

    }


/*==============================================================================
 AJAX functions
============================================================================== */
	// --- General function sending file and data to server
    function sendAjaxFile(serverUrl, file, data, domElt) {
        alert("coucou 6");

        // Add file to formData
        var formData = new FormData();
        formData.append("file", file);

        // Add data
        for (var key in data) {
            formData.append(key, data[key]);
        }
                alert("coucou 2.6");

        // Send ajax
        jQuery.ajax({
            type: 'POST',
            url: serverUrl,
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                receiveAjax(data, domElt);
            } ,
            
        });

      alert("coucou 7");

    }

    
        //alert("coucou Final");

/*============================================================================== */
});
