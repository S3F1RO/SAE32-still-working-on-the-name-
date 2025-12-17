$(document).ready(function(){

/*=============================================================================
   Send ajax to server
==============================================================================*/

    // Send files with ajax on button click
    jQuery("body").on("click", "#btnOK", function() {


        // Get file
        var file = jQuery("input[type='file']")[0].files[0];

        // Get data
        var mainName = jQuery("input[name='mainName']").val();
        var subName  = jQuery("input[name='subName']").val();
        var domain   = jQuery("input[name='domain']").val();
        var level    = jQuery("input[name='level']").val();
        var color    = jQuery("input[name='color']").val();


        // Send file
        sendAjaxFile("ajaxAddSkillC.php", file, {
            mainName: mainName,
            subName: subName,
            domain: domain,
            level: level,
            color: color
          
          }, this);
    });


/*==============================================================================
  Receive ajax
 ============================================================================== */

    function receiveAjax(data, domElt) {
        if (data['success'])
            jQuery(domElt).css("background-color", "green");
        else
            jQuery(domElt).css("background-color", "red");
    }


/*==============================================================================
 AJAX functions
============================================================================== */
	// --- General function sending file and data to server
    function sendAjaxFile(serverUrl, file, data, domElt) {

        // Add file to formData
        var formData = new FormData();
        formData.append("file", file);
       
        // Add data
        for (var key in data) {
            formData.append(key, data[key]);
        }
         //alert (JSON.stringify(formData));
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

    }

    // --- Test whether a variable is set or not
	function isset(myVar) {
		if (typeof myVar != 'undefined') return true;
		return false;
	}

/*============================================================================== */
});
