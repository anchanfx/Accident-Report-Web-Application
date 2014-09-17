<?php
header('Content-Type: text/html; charset=utf-8');
?>
	
<!DOCTYPE html>
<html>
        <head>
                <title>Live Map</title>
        <!-- <script src="https://code.jquery.com/jquery-2.1.1.min.js"> </script> -->
        <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDz0rT51DX278aAZzuoKpMp8XYQrNCpzIE"></script>
        </head>
	<body>
                                
                <script>
                        var map;
                        var accidentMarkers = [];
                        
                        function initialize()
                        {
                                var myCenter=new google.maps.LatLng(0,0);
                                var mapProp = {   
                                  center:myCenter,
                                  zoom:5,
                                  mapTypeId:google.maps.MapTypeId.TERRAIN
                                };
                                
                                map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
                        }
                        
                        function addMarker(location, markers, map) {
                          var marker = new google.maps.Marker({
                            position: location,
                            map: map
                          });
                          markers.push(marker);
                        }
                        
                        function setMakersOnMap(markers, map) {
                          for (var i = 0; i < markers.length; i++) {
                                 markers[i].setMap(map);
                          }
                        }
                        
                        function clearMarkers(markers) {
                                setMakersOnMap(markers, null);
                        }
                        
                        function setCenter(location) {
                                map.setCenter(location);
                        }
                        
                        function deleteMarkers(markers) {
                          clearMarkers(markers);
                                //markers = [];
                                while(markers.length > 0) {
                                    markers.pop();
                                }
                        }

                        google.maps.event.addDomListener(window, 'load', initialize);
                </script>
                
		<div>
                <span>
                        <div id="googleMap" style="width:1176px;height:664px;"></div>
                </span>
		</div>
                
                <div id="serverData"></div>
                
                <script type="text/javascript">
                        if(typeof(EventSource)!=="undefined") {
                                var eSource = new EventSource("liveMap_sse.php");
                                
                                eSource.onopen = function(event) {
                                        //alert("OnOpen");                                       
                                };
                                
                                eSource.onerror = function(event) {
                                        //alert("OnError");
                                };
                                
                                eSource.onmessage = function(event) {
                                        alert(event.data);
                                };
                                
                                eSource.addEventListener('AccidentReport', function(event) {
                                        var data = JSON.parse(event.data);
                                        var string = "";
                                        var location;
                                        deleteMarkers(accidentMarkers);
                                         
                                        for(var i = 0; i < data.length; i++)
                                        {
                                                location = new google.maps.LatLng(data[i].Latitude, data[i].Longitude);
                                                addMarker(location, accidentMarkers, map);
                                                string += data[i].ID + ", ";
                                                string += data[i].Longitude + ", ";
                                                string += data[i].Latitude + ", ";
                                                string += data[i].AccidentType + ", ";
                                                string += data[i].AmountOfDead + ", ";
                                                string += data[i].AmountOfInjured + ", ";
                                                string += data[i].TrafficBlocked + ", ";
                                                string += data[i].Message + ", ";
                                                string += data[i].DateTime + ", ";
                                                string += "<br>";
                                        }
                                        
                                        setMakersOnMap(accidentMarkers, map);
                                        setCenter(location);
                                        document.getElementById("serverData").innerHTML = string;
                                }, false);
                        }
                        else {
                                alert("Whoops! Your browser doesn't receive server-sent events.");
                        }
                </script> 
	</body>

</html>
