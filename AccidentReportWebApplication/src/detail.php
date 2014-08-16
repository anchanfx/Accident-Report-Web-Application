<?php
	$url = $_GET['url'];
	include_once 'connect.php';
	$mysql = mysqli_query ($con, "SELECT * FROM AccidentReport WHERE ID = " . $url);
	$info = mysqli_fetch_array($mysql)
?>

<html>
	<body>
		<div>
			<span>MAP</span>
			<span>
				<div><?php echo $info['DateTime']; ?></div>
				<div><?php echo $info['Latitude']; ?></div>
				<div><?php echo $info['Longitude']; ?></div>
				<div><?php echo $info['AccidentType']; ?></div>
			</span>
		</div>
	</body>
</html>