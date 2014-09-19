(function(window) {
	
	function Position(longitude, latitude) {
		this.longitude = longitude;
		this.latitude = latitude;
	}

	Position.prototype.toString = function() {
		var string;

		string = "Longitude: " + this.longitude + "\n";
	    string += "Latitude: " + this.latitude + "\n";	

	    return string;
	};

	window.Position = Position;
})(window);
