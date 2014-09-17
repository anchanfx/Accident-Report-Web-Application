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
                        var myCenter=new google.maps.LatLng(0,0);
                        var myCenter1=new google.maps.LatLng(1,1);
                        
                        function initialize()
                        {
                        var mapProp = {
                          center:myCenter,
                          zoom:5,
                          mapTypeId:google.maps.MapTypeId.ROADMAP
                          };
                        
                        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
                        
                        var marker=new google.maps.Marker({
                                position:myCenter, 
                          });
                        
                        marker.setMap(map);
                        
                        var marker2=new google.maps.Marker({
                                position:myCenter1, 
                          });
                        
                        marker2.setMap(map);
                        }
                        
                        google.maps.event.addDomListener(window, 'load', initialize);
                </script>
                
		<div>
                <span>
                        <div id="googleMap" style="width:500px;height:380px;"></div>
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
                                        
                                        for(var i = 0; i < data.length; i++)
                                        {
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
                                        
                                        document.getElementById("serverData").innerHTML = string;
                                }, false);
                        }
                        else {
                                alert("Whoops! Your browser doesn't receive server-sent events.");
                        }
                </script> 
	</body>

</html>
