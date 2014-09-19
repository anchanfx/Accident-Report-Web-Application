(function(window) {

	function LiveMap_SSE(SSE, liveMap) {
		this.SSE = SSE;
		this.liveMap = liveMap
	}

	LiveMap_SSE.prototype.initialize = function() {
		if(this.SSE.isBrowserSupported())
		{
			this.SSE.initialize("liveMap_sse.php");
			this.SSE.addEvent('AccidentReport', onEventAccidentReport());
		} else {
			alert("Whoops! Your browser doesn't receive server-sent events.");
		}
	};

	function onEventAccidentReport() {
		return function(event) {
			var data = JSON.parse(event.data);
            var string = "";
            var markerIconURL = 'http://maps.google.com/mapfiles/ms/icons/red-dot.png';
            this.liveMap.emptyMarkers();
            document.getElementById("serverData").innerHTML = "";

            for(var i = 0; i < data.length; i++){
                var position = new Position(data[i].Longitude, data[i].Latitude);
                
                var additionalInfo = new AdditionalInfo(data[i].AccidentType, 
                    data[i].AmountOfDead, data[i].AmountOfInjured, 
                    data[i].TrafficBlocked, data[i].Message);
                                        
                var accidentReport = new AccidentReport(data[i].ID, position, 
                    additionalInfo, data[i].DateTime);
                                        
                string = accidentReport.toString();

                this.liveMap.addMarker(position, markerIconURL, onClickMarker(string));
                document.getElementById("serverData").innerHTML += string + "<br><br>";
            }

            this.liveMap.showMarkers();
		}
	}

	function onClickMarker(data) {
		return function() {
		    alert(data);
		}
	}

	window.LiveMap_SSE = LiveMap_SSE;
})(window);