(function(window) {
	var map;

	function LiveMap() {
		this.markers = [];
	}

	LiveMap.prototype.initialize = function() {
	    var myCenter=new google.maps.LatLng(0,0);
	    var mapProp = {   
			center:myCenter,
			zoom:5,
			mapTypeId:google.maps.MapTypeId.TERRAIN
	    };
	    
	    map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
	}

	LiveMap.prototype.addMarker = function(position, icon, clickAction) {
		var location = new google.maps.LatLng(position.latitude, position.longitude);
		
	    var marker = new google.maps.Marker({
		position: location,
		icon: icon
	    });
		
		google.maps.event.addListener(marker, 'click', clickAction);
		
	    this.markers.push(marker);		
	}

	LiveMap.prototype.showMarkers = function() {
		for (var i = 0; i < this.markers.length; i++) {
			this.markers[i].setMap(map);
		}
	}

	LiveMap.prototype.hideMarkers = function() {
		for (var i = 0; i < this.markers.length; i++) {
			this.markers[i].setMap(null);
		}
	}

	LiveMap.prototype.emptyMarkers = function() {
		this.hideMarkers();
		while(this.markers.length > 0) {
			this.markers.pop();
		}
	}

	window.LiveMap = LiveMap;
})(window);