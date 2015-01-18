<?php
	header('Content-Type: text/html; charset=utf-8');
 	require_once 'DB.php';
 	require_once 'AccidentReport.php';
 	
 	$sDate = $_REQUEST['sDate'];
 	$nDate = $_REQUEST['nDate'];
	
 	$db = new DB();
 	$db->connect();
 	$mysql = $db->selectByDate($sDate,$nDate);
 	
 	
    if (!$mysql) {
    	echo 'MySQL Error: ' . mysqli_error();
        exit;
    }
	
    $round = count($mysql);
    for($i=0 ; $round >= $i; $i++){
    	echo $mysql[$i]->accidentType;
    	echo '<br>';
    }
    $db->closeDB();
?>