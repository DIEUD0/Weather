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

	// Get the Utc Offset to define the timezone later
	document.getElementById("utc_offset").value = place.utc_offset;
}
