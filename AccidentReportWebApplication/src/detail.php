<?php
	header('Content-Type: text/html; charset=utf-8');
	require_once 'AccidentReport.php';
        require_once 'DB.php';
        require_once 'menubar.php';
        $id = $_GET['id'];

        $db = new DB();
        $db->connect();
        $info = $db->selectAccidentReport ($id);
        $db->closeDB();
?>
	

<html>
        <head>
        
                <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDz0rT51DX278aAZzuoKpMp8XYQrNCpzIE"></script>
        </head>
	<body>
		<div>
                        <script>
                                var myCenter=new google.maps.LatLng(<?php echo $info->latitude; ?>,<?php echo $info->longitude; ?>);
                                
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
			<span>
				<div>
					ID : 
					<?php echo $id?>
				</div>
				<div>
					Date & Time : 
					<?php echo $info->dateTime; ?>
				</div>
				<div>
					Latitude : 
					<?php echo $info->latitude; ?>
				</div>
				<div>
					Longitude : 
					<?php echo $info->longitude; ?>
				</div>
				<div>
					Type : 
					<?php echo $info->accidentType; ?>
				</div>
				<div>
					Dead : 
					<?php echo $info->amountOfDead?>
				</div>
				<div>
					Injured : 
					<?php echo $info->amountOfInjured?>
				</div>
				<div>
					Traffic Block : 
					<?php
                                        if ($info->trafficBlocked == 0)
                                                echo "No";
                                        else
                                                echo "Yes";
                                        ?>
				</div>
				<div>
					Message : 
					<?php echo $info->message?>
				</div>
				<div id="googleMap" style="width:500px;height:380px;"></div>
			</span>
		</div>
	</body>

</html>