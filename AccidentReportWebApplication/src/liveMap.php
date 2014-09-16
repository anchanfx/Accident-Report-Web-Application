<?php
//header('Content-Type: text/html; charset=utf-8');
?>
	
<!DOCTYPE html>
<html>
        <head>
        
        </head>
	<body>
                <script
                        src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDz0rT51DX278aAZzuoKpMp8XYQrNCpzIE">
                </script>
                                
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
                        //check for browser support
                        if(typeof(EventSource)!=="undefined") {
                                //create an object, passing it the name and location of the server side script
                                var eSource = new EventSource("liveMap_sse.php");
                                //detect message receipt
                                eSource.onmessage = function(event) {
                                        //write the received data to the page
                                        document.getElementById("serverData").innerHTML = event.data;
                                };
                        }
                        else {
                                document.getElementById("serverData").innerHTML="Whoops! Your browser doesn't receive server-sent events.";
                        }
                </script> 
	</body>

</html>
