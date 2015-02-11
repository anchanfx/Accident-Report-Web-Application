<?php
header('Content-Type: text/html; charset=utf-8');
require_once 'DB.php';

function dataTimeRespond(){
	$db = new DB();
	$db->connect();
	$mysql = $db->timeRespond();
	$db->closeDB();
	 
	if (!$mysql) {
		echo 'MySQL Error: ' . mysqli_error();
		exit;
	}

	
	$max = strtotime('0');
	$min = strtotime('23:59:59');
	$sum = strtotime('0');
	$count = 0;
	$index = 0;
	while($info = mysqli_fetch_array($mysql))
	{
		$serverDate = strtotime($info['ServerDateTime']);
		$rescueDate = strtotime($info['DateTime']);
		$date = $rescueDate-$serverDate;
		if($info['ID'] != $index){
			$sum += $date;
			$index = $info['ID'];
			if(($date < $min) && ($date > $max)){
				$min = $date;
				$max = $date;
			}else if($date > $max ){
				$max = $date;
			}else if ($date < $min){
				$min = $date;
			}
			$count++;
		}else{
			
		}
	}
	$avg = $sum/$count;
	echo "MAX = ".date('H:i:s', $max).' ';
	echo "MIN = ".date('H:i:s', $min).' ';
	echo "AVERAGE = ".date('H:i:s', $avg);
}
echo dataTimeRespond();
?>