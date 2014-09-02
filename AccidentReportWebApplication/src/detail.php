<?php
	header('Content-Type: text/html; charset=utf-8');
	require_once 'connect.php';
	require_once 'db.php';
	$id = $_GET['id'];
	$con = connect();
	
	$info = selectAccident($con, $id);
?>
	

<html>
	<body>
		<div>
			<span>
                        <script
                        src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDz0rT51DX278aAZzuoKpMp8XYQrNCpzIE">
                        </script>
                                
                                <script>
                                var myCenter=new google.maps.LatLng(<?php echo $info['Latitude']; ?>,<?php echo $info['Longitude']; ?>);
                                
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
				<div>
					ID : 
					<?php echo $info['ID']?>
				</div>
				<div>
					Date & Time : 
					<?php echo $info['DateTime']; ?>
				</div>
				<div>
					Latitude : 
					<?php echo $info['Latitude']; ?>
				</div>
				<div>
					Longitude : 
					<?php echo $info['Longitude']; ?>
				</div>
				<div>
					Type : 
					<?php echo $info['AccidentType']; ?>
				</div>
				<div>
					Dead : 
					<?php echo $info['AmountOfDead']?>
				</div>
				<div>
					Injured : 
					<?php echo $info['AmountOfInjured']?>
				</div>
				<div>
					Traffic Block : 
					<?php
                                        if ($info['TrafficBlocked'] == 0)
                                                echo "No";
                                        else
                                                echo "Yes";
                                        ?>
				</div>
				<div>
					Message : 
					<?php echo $info['Message']?>
				</div>
				<div id="googleMap" style="width:500px;height:380px;"></div>
			</span>
		</div>
	</body>

</html>