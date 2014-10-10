(function(window) {

	function RescueUnit(imei, position, rescueUnitStatus) {
		this.imei = imei;
		this.position = position;
		this.rescueUnitStatus = rescueUnitStatus;
	}

	RescueUnit.prototype.toString = function() {
		var string;

	    string = "IMEI: " + this.imei + "\n";
	    string += String(this.position);
	    string += String(this.rescueUnitStatus);

	    return string;
	}

	window.RescueUnit = RescueUnit;
})(window);	