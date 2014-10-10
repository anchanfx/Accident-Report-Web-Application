(function(window) {

	function SSE() {
		this.eSource;
	}

	SSE.prototype.initialize = function(source) {
		this.eSource = new EventSource(source);
	};

	SSE.prototype.addEvent = function(eventName, action) {
		this.eSource.addEventListener(eventName, function(event){
			action(event);
		});
	};

	SSE.prototype.isBrowserSupported = function() {
		if(typeof(EventSource)!=="undefined")
			return true;
		else
			return false;
	};
	window.SSE = SSE;
})(window);