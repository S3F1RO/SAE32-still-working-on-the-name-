$(document).ready(function(){
//==============================================================================





/*==============================================================================
	Accelerometer (orientation)
==============================================================================*/

// Add orientation listener
window.addEventListener("deviceorientation", getOrientation, true);

// Get orientation
function getOrientation(event) {
	// Get orientation values
	var isAbsolute = event.absolute;
	var alpha = event.alpha;
	var beta = event.beta;
	var gamma = event.gamma;

	// Display orientation values
	var html = "";
	html += "<h1>Orientation</h1>"
	html += "<ul>";
	html += "  <li>isAbsolute = " + isAbsolute + "</li>";
	html += "  <li>alpha = " + alpha + "</li>";
	html += "  <li>beta = " + beta + "</li>";
	html += "  <li>gamma = " + gamma + "</li>";
	html += "</ul>";
	jQuery(".orientation").html(html);
}





/*==============================================================================
	Accelerometer (motion)
==============================================================================*/

// Add motion listener
window.addEventListener("devicemotion", getMotion, true);

// Get motion
function getMotion(event) {
	// Get motion values
	var accelerationX = event.acceleration.x;
	var accelerationY = event.acceleration.y;
	var accelerationZ = event.acceleration.z;
	var accelerationIncludingGravityX = event.accelerationIncludingGravity.x;
	var accelerationIncludingGravityY = event.accelerationIncludingGravity.y;
	var accelerationIncludingGravityZ = event.accelerationIncludingGravity.z;
	var rotationRateAlpha = event.rotationRate.alpha;
	var rotationRateBeta = event.rotationRate.beta;
	var rotationRateGamma = event.rotationRate.gamma;


	// Display motion values
	var html = "";
	html += "<h1>Motion</h1>"
	html += "<ul>";
	html += "  <h2>Acceleration</h2>"
	html += "  <li>accelerationX = " + accelerationX + "</li>";
	html += "  <li>accelerationY = " + accelerationY + "</li>";
	html += "  <li>accelerationZ = " + accelerationZ + "</li>";
	html += "</ul>";
	html += "<ul>";
	html += "  <h2>Acceleration including gravity</h2>"
	html += "  <li>accelerationIncludingGravityX = " + accelerationIncludingGravityX + "</li>";
	html += "  <li>accelerationIncludingGravityY = " + accelerationIncludingGravityY + "</li>";
	html += "  <li>accelerationIncludingGravityZ = " + accelerationIncludingGravityZ + "</li>";
	html += "</ul>";
	html += "<ul>";
	html += "  <h2>Rotation rate</h2>"
	html += "  <li>rotationRateAlpha = " + rotationRateAlpha + "</li>";
	html += "  <li>rotationRateBeta = " + rotationRateBeta + "</li>";
	html += "  <li>rotationRateGamma = " + rotationRateGamma + "</li>";
	html += "</ul>";
	jQuery(".motion").html(html);
}





//==============================================================================
});
