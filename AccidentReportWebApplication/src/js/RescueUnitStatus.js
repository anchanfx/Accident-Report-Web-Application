(function(window) {
	
	function RescueUnitStatus(online, available) {
		this.online = online;
		this.available = available;
	}

	RescueUnitStatus.prototype.toString = function() {
		var string;

		string = "Online: " + this.online + "\n";
	    string += "Available: " + this.available + "\n";	

	    return string;
	};

	window.RescueUnitStatus = RescueUnitStatus;
})(window);
