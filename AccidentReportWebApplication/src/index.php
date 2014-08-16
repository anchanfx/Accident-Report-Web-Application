<?php
	include_once 'connect.php';
	$mysql = mysqli_query ($con, "SELECT * FROM AccidentReport");
?>

<html>
	<head>
		<title>All Accident</title>
	</head>
	<body>
		<table border=1>
			<thead>
				<tr>
					<td>Date Time</td>
					<td>Position</td>
					<td>Type</td>
					<td>Select</td>
				</tr>
			</thead>
			<tbody>
				<?php
			        while( $info = mysqli_fetch_array($mysql))
			        {
			            echo "<tr>";
			            echo "<td>".$info['DateTime']."</td>";
			            echo "<td>".$info['Latitude'].", ".$info['Longitude']."</td>";
			            echo "<td>".$info['AccidentType'];
			            echo "<td><a href='detail.php/?url=".$info['ID']."'> Select </a></td>";
			            echo '<tr>';
			        }
		        ?>
			</tbody>
		</table>
	</body>
</html>