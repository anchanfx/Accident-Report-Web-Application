//<!-- <script type="text/javascript" src="http://http://code.jquery.com/jquery-2.1.1.min.js"></script> -->
document.writeln('<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCbH9pWLX_wEwOeyloo62JKnGyzLNi4d1k"></script>');
document.writeln('<script type="text/javascript" src="js/Position.js"></script>');
document.writeln('<script type="text/javascript" src="js/AdditionalInfo.js"></script>');
document.writeln('<script type="text/javascript" src="js/AccidentReport.js"></script>');
document.writeln('<script type="text/javascript" src="js/Accident.js"></script>');
document.writeln('<script type="text/javascript" src="js/RescueUnitStatus.js"></script>');
document.writeln('<script type="text/javascript" src="js/RescueUnit.js"></script>');
document.writeln('<script type="text/javascript" src="js/LiveMap.js"></script>');
document.writeln('<script type="text/javascript" src="js/SSE.js"></script>');
document.writeln('<script type="text/javascript" src="js/LiveMap_sse.js"></script>');

var ASSIGN_URL = "http://nuaccrepo.mywebcommunity.org/ReportServer/assignAccident.php";
var liveMap;
var liveMap_sse;

function checkBrowserCompatibility() {
    if(!(window.XMLHttpRequest && typeof(EventSource)!="undefined")) {
        alert('Your browser is not support');
    }
}

function assignAccident() {
    var accidentID = document.querySelector('input[name="accidentRadio"]:checked').value;
    var rescueUnitIMEI = document.querySelector('input[name="rescueUnitRadio"]:checked').value;
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            alert('Assign AccidentID: ' + accidentID + ' to RescueUnitIMEI: ' + rescueUnitIMEI);
        }
    }

    if(accidentID != null && rescueUnitIMEI != null) {
        xmlhttp.open("GET", ASSIGN_URL + "?imei="+ rescueUnitIMEI +"&accidentID=" + accidentID, true);
        xmlhttp.send();
    }
}

function headerSetup() {
	checkBrowserCompatibility();
	liveMap = new LiveMap();
	liveMap_sse = new LiveMap_SSE(new SSE(), liveMap);
	google.maps.event.addDomListener(window, 'load', liveMap.initialize);
}

function footerSetup() {
	liveMap_sse.initialize();
    document.getElementById("assignButton").onclick = assignAccident;
}