var placeSearch, autocomplete;
var componentForm = {
	locality: 'long_name',
	country: 'short_name',
};

function citySearch() {
	var input = document.getElementById('autocomplete');
	var options = {
		types: ['(cities)']
	};
	autocomplete = new google.maps.places.Autocomplete(input, options);
	autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
	// Get the place details from the autocomplete object.
	var place = autocomplete.getPlace();
	var lat = place.geometry.location.lat();
	var lng = place.geometry.location.lng();

	for (var component in componentForm) {
		document.getElementById(component).value = '';
		document.getElementById(component).disabled = false;
	}

	// Get each component of the address from the place details
	// and fill the corresponding field on the form.
	for (var i = 0; i < place.address_components.length; i++) {
		var addressType = place.address_components[i].types[0];
		if (componentForm[addressType]) {
			var val = place.address_components[i][componentForm[addressType]];
			document.getElementById(addressType).value = val;
		}
	}

	// Get Lati and Longi to determine the Timezone
	document.getElementById("latitude").value = lat;
	document.getElementById("longitude").value = lng;
}
