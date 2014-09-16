<?php
	header('Content-Type: text/html; charset=utf-8');
?>
	

<html>
	<body>
		<div>
			<span>
                        <script
                        src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDz0rT51DX278aAZzuoKpMp8XYQrNCpzIE">
                        </script>
                                
                                <script>
                                var myCenter=new google.maps.LatLng(<?php echo -33.867; ?>,<?php echo 151.206; ?>);
                                
                                function initialize()
                                {
                                var mapProp = {
                                  center:myCenter,
                                  zoom:15,
                                  mapTypeId:google.maps.MapTypeId.ROADMAP
                                  };
                                
                                var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
                                
                                var marker=new google.maps.Marker({
                                  position:myCenter,
                                  });
                                
                                marker.setMap(map);
                                }
                                
                                google.maps.event.addDomListener(window, 'load', initialize);
                                </script>
                        </span>
			<span>
				<div id="googleMap" style="width:500px;height:380px;"></div>
			</span>
		</div>
	</body>

</html>
