(function(window) {

	function AccidentReport(id, position, additonalInfo, dateTime) {
		this.id = id;
		this.position = position;
		this.additonalInfo = additonalInfo;
		this.dateTime = dateTime;
	}

	AccidentReport.prototype.toString = function() {
		var string;

	    string = "ID: " + this.id + "\n";
	    string += String(this.position);
	    string += String(this.additonalInfo);
	    string += "DateTime: " + this.dateTime + "\n";

	    return string;
	}

	window.AccidentReport = AccidentReport;
})(window);	