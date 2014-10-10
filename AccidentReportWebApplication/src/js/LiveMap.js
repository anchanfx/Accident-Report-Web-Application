(function(window) {
	var map;

	function LiveMap() {
		this.accidentMarkers = [];
		this.rescueUnitMarkers = [];
	}

	LiveMap.prototype.initialize = function() {
	    var myCenter = new google.maps.LatLng(0,0);
	    var mapProp = {   
			center:myCenter,
			zoom:5,
			mapTypeId:google.maps.MapTypeId.HYBRID 
	    };
	    
	    map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
	    map.setTilt(45);
	    map.setOptions({ minZoom: 2, maxZoom: 15 });
	}

	LiveMap.prototype.addAccidentMarker = function(position, icon, clickAction) {
		this.addMarker(position, icon, clickAction, this.accidentMarkers);
	}

	LiveMap.prototype.addRescueUnitMarker = function(position, icon, clickAction) {
		this.addMarker(position, icon, clickAction, this.rescueUnitMarkers);
	}

	LiveMap.prototype.addMarker = function(position, icon, clickAction, markers) {
		var location = new google.maps.LatLng(position.latitude, position.longitude);
		
	    var marker = new google.maps.Marker({
		position: location,
		icon: icon
	    });
		
		google.maps.event.addListener(marker, 'click', clickAction);
		
	    markers.push(marker);		
	}

	LiveMap.prototype.showAccidentMarkers = function() {
		this.showMarkers(this.accidentMarkers);
	}

	LiveMap.prototype.showRescueUnitMarkers = function() {
		this.showMarkers(this.rescueUnitMarkers);
	}

	LiveMap.prototype.showMarkers = function(markers) {
		for (var i = 0; i < markers.length; i++) {
			markers[i].setMap(map);
		}
	}

	LiveMap.prototype.emptyAccidentMarkers = function() {
		this.emptyMarkers(this.accidentMarkers);
	}

	LiveMap.prototype.emptyRescueUnitMarkers = function() {
		this.emptyMarkers(this.rescueUnitMarkers);
	}

	LiveMap.prototype.emptyMarkers = function(markers) {
		this.hideMarkers(markers);
		while(markers.length > 0) {
			markers.pop();
		}
	}

	LiveMap.prototype.hideMarkers  = function(markers) {
		for (var i = 0; i < markers.length; i++) {
			markers[i].setMap(null);
		}
	}

	window.LiveMap = LiveMap;
})(window);