<?php
        require_once 'DB.php';
        
	header('Content-Type: text/event-stream');
	header('Cache-Control: no-cache');
	
	$db = new DB();
	$db->connect();
	$mysql = $db->selectAllAccidentReport();
	$db->closeDB();
	$data = "";
        
	while($extract = mysqli_fetch_array($mysql)) {
                $data .= $extract['Longitude'] . " : " . $extract['Latitude'];
                $data .= "<br>";
	}
	     
        echo "retry:2500\ndata: {$data}\n\n";
	flush();
        
?>
