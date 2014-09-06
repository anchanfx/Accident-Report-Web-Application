<?php
	header('Content-Type: text/html; charset=utf-8');
	require_once 'AccidentReport.php';
	require_once 'DB.php';
	require_once 'connect.php';
	$con = connect();
	$mysql = selectAllAccidentReport($con);
        $con->close();
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
			        while($info = mysqli_fetch_array($mysql))
			        {
			            echo "<tr>";
			            echo "<td>".$info['DateTime']."</td>";
			            echo "<td>".$info['Latitude'].", ".$info['Longitude']."</td>";
			            echo "<td>".$info['AccidentType'];
			            echo "<td><a href='detail.php/?id=".$info['ID']."'> Select </a></td>";
			            echo '<tr>';
			        }
		        ?>
			</tbody>
		</table>
	</body>
</html>
