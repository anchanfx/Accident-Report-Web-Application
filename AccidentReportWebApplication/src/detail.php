<?php
	$id = $_GET['id'];
	include_once 'connect.php';
	$mysql = mysqli_query ($con, "SELECT * FROM AccidentReport WHERE ID = " . $id);
	$info = mysqli_fetch_array($mysql)
?>
	
<html>
<script
src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDz0rT51DX278aAZzuoKpMp8XYQrNCpzIE">
</script>

<script>
var myCenter=new google.maps.LatLng(16.74298,100.20436);

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

	<body>
		<div>
			<span>MAP</span>
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
					<?php echo $info['TrafficBlocked']?>
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