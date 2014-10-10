(function(window) {

	function AccidentReport(id, position, additonalInfo, dateTime, serverDateTime, resolve) {
		this.id = id;
		this.position = position;
		this.additonalInfo = additonalInfo;
		this.dateTime = dateTime;
		this.serverDateTime = serverDateTime;
		this.resolve = resolve;
	}

	AccidentReport.prototype.toString = function() {
		var string;

	    string = "ID: " + this.id + "\n";
	    string += String(this.position);
	    string += String(this.additonalInfo);
	    string += "DateTime: " + this.dateTime + "\n";
	    string += "DateTime: " + this.serverDateTime + "\n";
	    string += "Resolve: " + this.resolve + "\n";

	    return string;
	}

	window.AccidentReport = AccidentReport;
})(window);	