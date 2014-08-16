<?php
	$id = $_GET['id'];
	include_once 'connect.php';
	$mysql = mysqli_query ($con, "SELECT * FROM AccidentReport WHERE ID = " . $id);
	$info = mysqli_fetch_array($mysql)
?>

<html>
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
			</span>
		</div>
	</body>
</html>