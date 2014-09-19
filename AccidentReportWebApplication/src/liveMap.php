<?php
    header('Content-Type: text/html; charset=utf-8');
    require_once 'menubar.php';
?>
    
<!DOCTYPE html>
<html>
    <head>
            <title>Live Map</title>
            <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDz0rT51DX278aAZzuoKpMp8XYQrNCpzIE"></script>
            <script src="js/Position.js"></script>
            <script src="js/AdditionalInfo.js"></script>
            <script src="js/AccidentReport.js"></script>
            <script src="js/Accident.js"></script>
            <script src="js/LiveMap.js"></script>
            <script src="js/SSE.js"></script>
            <script src="js/LiveMap_sse.js"></script>
    </head>
    <body>
                                
        <script>
            var liveMap = new LiveMap();
            var liveMap_sse = new LiveMap_SSE(new SSE(), liveMap);
            google.maps.event.addDomListener(window, 'load', liveMap.initialize);
        </script>
                
        <div>
            <span>
                <div id="googleMap" style="width:1176px;height:664px;"></div>
            </span>
        </div>
                
        <div id="serverData"></div>
        <script>
            liveMap_sse.initialize();
        </script> 
    </body>

</html>
