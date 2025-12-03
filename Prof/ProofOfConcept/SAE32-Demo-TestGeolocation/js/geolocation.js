$(document).ready(function(){
//==============================================================================





/*==============================================================================
	Geolocation
==============================================================================*/

// Geolocate on page load
geolocate();

// Geolocate
function geolocate() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(getPosition, getError);
	} else {
		jQuery(".geolocation").html("Geolocation is not supported by this browser.");
	}
}

// Get position
function getPosition(position) {
	// Get position values
	var latitude = position.coords.latitude;
	var longitude = position.coords.longitude;
	var accuracy = position.coords.accuracy;
	var altitude = position.coords.altitude;
	var altitudeAccuracy = position.coords.altitudeAccuracy;
	var speed = position.coords.speed;
	var timestamp = position.coords.timestamp;

	// Display position values
	var html = "";
	html += "<h1>Geolocation</h1>"
	html += "<ul>";
	html += "<h2>Position</h2>"
	html += "  <li>latitude = " + latitude + "</li>";
	html += "  <li>longitude = " + longitude + "</li>";
	html += "  <li>accuracy = " + accuracy + "</li>";
	html += "</ul>";
	html += "<ul>";
	html += "<h2>Altitude</h2>"
	html += "  <li>altitude = " + altitude + "</li>";
	html += "  <li>altitudeAccuracy = " + altitudeAccuracy + "</li>";
	html += "</ul>";
	html += "<h2>Other</h2>"
	html += "  <li>speed (m/s) = " + speed + "</li>";
	html += "  <li>timestamp = " + timestamp + "</li>";
	html += "</ul>";
	jQuery(".geolocation").html(html);
}

// Get error
function getError(error) {
	// Display error
	if (error.code == error.PERMISSION_DENIED) jQuery(".geolocation").html("User denied the request for Geolocation or my connection does not use HTTPS protocol.");
	else if (error.code == error.POSITION_UNAVAILABLE) jQuery(".geolocation").html("Location information is unavailable.");
	else if (error.code == error.TIMEOUT) jQuery(".geolocation").html("The request to get user location timed out.");
	else if (error.code == error.UNKNOWN_ERROR) jQuery(".geolocation").html("An unknown error occurred.");
	else jQuery(".geolocation").html("A fully unknown error occured.");
}





//==============================================================================
});
