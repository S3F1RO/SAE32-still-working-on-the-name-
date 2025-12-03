$(document).ready(function(){
//==============================================================================





/*==============================================================================
	Fullscreen
==============================================================================*/
	


	// Start fullscreen on btn click
	jQuery("body").on("click", ".startFullscreen", function() {
		document.getElementById("fullscreen").requestFullscreen();
	});
	


	// Stop fullscreen on btn click
	jQuery("body").on("click", ".stopFullscreen", function() {
		document.exitFullscreen();
	});






//==============================================================================
});
