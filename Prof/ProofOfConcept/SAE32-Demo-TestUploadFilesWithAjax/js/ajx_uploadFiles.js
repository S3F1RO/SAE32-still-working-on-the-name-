$(document).ready(function(){
//==============================================================================





/*==============================================================================
	Send ajax to server
==============================================================================*/

	// Send files with ajax on input change
	jQuery("body").on("change", "input[type='file']", function(key) {
		// Get files
		var files = this.files;

		// Send files
		sendAjaxFiles("ajx_uploadFiles.php", files);
	});





/*==============================================================================
	Receive ajax from server
==============================================================================*/

	// Receive ajax
	function receiveAjax(data) {
		jQuery("article").append(data.html);
	}





/*==============================================================================
	AJAX functions
==============================================================================*/


	// --- General function sending files to server
	function sendAjaxFiles(serverUrl, files) {
		// Add files to formData
		var formData = new FormData();
		for (var i=0 ; i<files.length ; i++) {
			formData.append("files[]", files[i]);
			jQuery("article").append("<p>Upload file '" + files[i].name + "' of type '" + files[i].type + "' having size '" + files[i].size + "B'</p>");
		}

		// Send formData
		jQuery.ajax({type: 'POST', url: serverUrl, dataType: 'json', data: formData, processData: false, contentType: false, cache: false,
			success: function(data) {
				receiveAjax(data);
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
