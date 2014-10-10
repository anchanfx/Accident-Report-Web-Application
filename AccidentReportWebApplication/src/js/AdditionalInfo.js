(function(window) {
	
	function AdditionalInfo(accidentType, amountOfDead, amountOfInjured, trafficBlocked, message) {
		this.accidentType = accidentType;
		this.amountOfDead = amountOfDead;
		this.amountOfInjured = amountOfInjured;
		this.trafficBlocked = trafficBlocked;
		this.message = message;
	}

	AdditionalInfo.prototype.toString = function() {
		var string;	

	    string = "AccidentType: " + this.accidentType + "\n";
	    string += "AmountOfDead: " + this.amountOfDead + "\n";
	    string += "AmountOfInjured: " + this.amountOfInjured + "\n";
	    string += "TrafficBlocked: " + this.trafficBlocked + "\n";
	    string += "Message: " + this.message + "\n";

	    return string;	
	};

	window.AdditionalInfo = AdditionalInfo;
})(window);