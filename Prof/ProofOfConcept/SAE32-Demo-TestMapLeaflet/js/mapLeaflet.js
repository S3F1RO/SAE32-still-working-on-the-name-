$(document).ready(function(){
//==============================================================================





/*==============================================================================
	Map Leaflet
==============================================================================*/

	// Set map initial center and zoom
	var map = L.map('map').setView([5.16053, -52.65239], 18);

	// Add map layer
	L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		maxZoom: 20,
		// id: 'mapbox/streets-v11',
		// id: 'mapbox/outdoors-v11',
		// id: 'mapbox/light-v10',
		// id: 'mapbox/dark-v10',
		// id: 'mapbox/satellite-v9',
		// id: 'mapbox/satellite-streets-v11',
		id: 'mapbox/navigation-day-v1',
		// id: 'mapbox/navigation-night-v1',
		tileSize: 512,
		zoomOffset: -1,
		accessToken: 'pk.eyJ1Ijoidm9uZWNvbW0iLCJhIjoiY2t5NHkzaG9jMDVjdzJ1cWl0MXByNTN1YSJ9.eeojSnvR1SRket7qmFWy4g'
	}).addTo(map);

	// Add marker
	var marker = L.marker([5.16067, -52.65293]).addTo(map);
	marker.bindPopup("<b>Entrée de l'IUT</b><br>Regardez en l'air !").openPopup();

	// Add circle
	var circle = L.circle([5.16085, -52.65328], {
		color: 'green',
		fillColor: '#006622',
		fillOpacity: 0.5,
		radius: 20
	}).addTo(map);
	circle.bindPopup("Le bâtiment bois");

	// Add polygon
	var polygon = L.polygon([
		[5.16067, -52.65293],
		[5.16085, -52.65392],
		[5.16053, -52.6542]
	], {
		color: 'yellow',
		fillColor: '#FFDD00',
		fillOpacity: 0.3,
	}).addTo(map);
	polygon.bindPopup("La pelouse mal coupée");

	// Add standalone popup
	var popup = L.popup()
		.setLatLng([5.16181, -52.65373])
		.setContent("Le CROUS !")
		.openOn(map);

	// Process click event
	var popup2 = L.popup();
	map.on('click', onMapClick);

	function onMapClick(e) {
		popup2
			.setLatLng(e.latlng)
			.setContent("Vous avez cliqué à " + deci(e.latlng.lat).toString() + ", " + deci(e.latlng.lng).toString())
			.openOn(map);
	}





	// Round number
	function deci(x) {
		return Number.parseFloat(x).toFixed(5);
	}


//==============================================================================
});
