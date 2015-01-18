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
	
    $phase1 = 0;
    $phase2 = 0;
    $phase3 = 0;
    $phase4 = 0;
    $phase5 = 0;
    $phase6 = 0;
    
    $round = count($mysql);
    for($i=0 ; $round > $i; $i++){
    	$str = $mysql[$i]->serverDateTime;
    	$date = strtotime($str);
    	$time = date('H:i:s', $date);
    	$s1 = strtotime("1:00:00");
    	$s5 = strtotime("5:00:00");
    	$s9 = strtotime("9:00:00");
    	$s13 = strtotime("13:00:00");
    	$s17 = strtotime("17:00:00");
    	$s21 = strtotime("21:00:00");
    	$t1 = date('H:i:s', $s1);
    	$t5 = date('H:i:s', $s5);
    	$t9 = date('H:i:s', $s9);
    	$t13 = date('H:i:s', $s13);
    	$t17 = date('H:i:s', $s17);
    	$t21 = date('H:i:s', $s21);
    	
    	if ($time >= $t1 && $time < $t5){
    		$phase1++;
    	}else if($time >= $t5 && $time < $t9){
    		$phase2++;
    	}else if($time >= $t9 && $time < $t13){
    		$phase3++;
    	}else if($time >= $t13 && $time < $t17){
    		$phase4++;
    	}else if($time >= $t17 && $time < $t21){
    		$phase5++;
    	}else {
    		$phase6++;
    	}
    }
//     $arr = array('1:00-4:59'=>$phase1, '5:00-8:59'=>$phase2, '9:00-12:59'=>$phase3,
//     		'13:00-16:59'=>$phase4, '17:00-20:59'=>$phase5, '21:00-0:59'=>$phase6);
	$arr['cols'][]=array('type' => 'string');
	$arr['cols'][]=array('type' => 'string');
	
	$arr['rows'][]=array('c' => array( array('v'=>'1:00-4:59'), array('v'=>$phase1)));
	$arr['rows'][]=array('c' => array( array('v'=>'5:00-8:59'), array('v'=>$phase2)));
	$arr['rows'][]=array('c' => array( array('v'=>'9:00-12:59'), array('v'=>$phase3)));
	$arr['rows'][]=array('c' => array( array('v'=>'13:00-16:59'), array('v'=>$phase4)));
	$arr['rows'][]=array('c' => array( array('v'=>'17:00-20:59'), array('v'=>$phase5)));
	$arr['rows'][]=array('c' => array( array('v'=>'21:00-0:59'), array('v'=>$phase6)));
	
    echo json_encode($arr);
    $db->closeDB();
?>