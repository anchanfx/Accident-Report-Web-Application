<?php
	include_once 'connect.php';

	$mysql = mysqli_query ($con, "SELECT * FROM AccidentReport");
	echo "<table border='1'>
			<tr>
			<th>ID</th>
			<th>DateTime</th>
			<th>Position</th>
			<th>Type</th>
			<th>Select</th>
			</tr>";
                        
        while( $info = mysqli_fetch_array($mysql))
        {
                echo "<tr>";
                echo "<td>".$info['ID']."</td>";
                echo "<td>".$info['DateTime']."</td>";
                echo "<td>".$info['Latitude'].", ".$info['Longitude']."</td>";
                echo "<td>".$info['AccidentType'];
                echo "<td><a href='detail.php/".$info['ID']."'> Select </a></td>";
                echo '<tr>';
        }
?>