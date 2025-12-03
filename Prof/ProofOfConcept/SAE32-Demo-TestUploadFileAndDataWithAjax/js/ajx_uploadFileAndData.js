$(document).ready(function(){
//==============================================================================





/*==============================================================================
	Send ajax to server
==============================================================================*/

	// Send files with ajax on button click
	jQuery("body").on("click", "button", function() {
		// Get file
		var file = jQuery("input[type='file']")[0].files[0];

		// Get data
		var data1 = jQuery("input[name='data1']").val();
		var data2 = jQuery("input[name='data2']").val();

		// Send file
		sendAjaxFile("ajx_uploadFileAndData.php", file, {data1: data1, data2: data2}, this);
	});





/*==============================================================================
	Receive ajax from server
==============================================================================*/

	// Receive ajax
	function receiveAjax(data, domElt) {
		// Update button color on success
		if (data['success']) jQuery(domElt).css("background-color", "green");
		else jQuery(domElt).css("background-color", "red");
	}





/*==============================================================================
	AJAX functions
==============================================================================*/

	// --- General function sending file and data to server
	function sendAjaxFile(serverUrl, file, data, domElt) {
		// Add file to formData
		var formData = new FormData();
		formData.append("file", file);

		// Add data to formData
		for (var key in data) {
			formData.append(key, data[key]);
		}

		// Send formData
		jQuery.ajax({type: 'POST', url: serverUrl, dataType: 'json', data: formData, processData: false, contentType: false, cache: false,
			success: function(data) {
				receiveAjax(data, domElt);
			}
		});
	}

	// --- Test whether a variable is set or not
	function isset(myVar) {
		if (typeof myVar != 'undefined') return true;
		return false;
	}

//==============================================================================
});
