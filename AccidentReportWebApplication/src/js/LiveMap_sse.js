(function(window) {

	function LiveMap_SSE(accidentSSE, liveMap) {
		this.accidentSSE = accidentSSE;
		this.liveMap = liveMap;
	}

	LiveMap_SSE.prototype.initialize = function() {
		if(this.accidentSSE.isBrowserSupported())
		{
			this.accidentSSE.initialize("liveMap_sse.php");
			this.accidentSSE.addEvent('AccidentReport', onEventAccidentReport());
			this.accidentSSE.addEvent('RescueUnit', onEventRescueUnit());
		} else {
			alert("Whoops! Your browser doesn't receive server-sent events.");
		}
	};


	function onEventAccidentReport() {
		return function(event) {
			var data = JSON.parse(event.data);
            var string = "";
            var markerIconURL = '';
            var accidentRadioList = document.getElementById("accidentRadioList");
            accidentRadioList.innerHTML = "";
            this.liveMap.emptyAccidentMarkers();
            

            for(var i = 0; i < data.length; i++){
            	if(data[i].Resolve == 0){
            		markerIconURL = './res/red-dot.png';
            	} else {
                    markerIconURL = './res/green-dot.png';
            	}

                var position = new Position(data[i].Longitude, data[i].Latitude);
                
                var additionalInfo = new AdditionalInfo(data[i].AccidentType, 
                    data[i].AmountOfDead, data[i].AmountOfInjured, 
                    data[i].TrafficBlocked, data[i].Message);
                                        
                var accidentReport = new AccidentReport(data[i].ID, position, 
                    additionalInfo, data[i].DateTime, data[i].ServerDateTime, data[i].Resolve);
                                        
                string = accidentReport.toString();
                accidentRadioList.innerHTML += '<input type="radio" name="accidentRadio" value="' + data[i].ID + '"> ' + string + "<br>";
                this.liveMap.addAccidentMarker(position, markerIconURL, onClickMarker(string));
            }

            this.liveMap.showAccidentMarkers();
		}
	}

	function onEventRescueUnit() {
		return function(event) {
			var data = JSON.parse(event.data);
            var string = "";
            var markerIconURL = '';
            var rescueUnitRadioList = document.getElementById("rescueUnitRadioList");
            rescueUnitRadioList.innerHTML = "";
            this.liveMap.emptyRescueUnitMarkers();

            for(var i = 0; i < data.length; i++){
            	if(data[i].Online == 1){
            		if(data[i].Available == 1){
            			markerIconURL = './res/white-dot.png';
            		} else {
                        markerIconURL = './res/blue-dot.png';
                    }
            	} else {
                    markerIconURL = './res/black-dot.png';
            	}
                
                var position = new Position(data[i].Longitude, data[i].Latitude);
                
                var rescueUnitStatus = new RescueUnitStatus(data[i].Online, data[i].Available);
                                        
                var rescueUnit = new RescueUnit(data[i].IMEI, position, rescueUnitStatus);
                                        
                string = rescueUnit.toString();
                rescueUnitRadioList.innerHTML += '<input type="radio" name="rescueUnitRadio" value="' + data[i].IMEI + '"> ' + string + "<br>";
                this.liveMap.addRescueUnitMarker(position, markerIconURL, onClickMarker(string));
            }

            this.liveMap.showRescueUnitMarkers();
		}
	}

	function onClickMarker(data) {
		return function() {
		    alert(data);
		}
	}

	window.LiveMap_SSE = LiveMap_SSE;
})(window);