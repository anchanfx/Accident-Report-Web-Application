<?php
	header('Content-Type: text/html; charset=utf-8');
	require_once 'connect.php';
	$con = connect();
	
	function queryAllAccident($con)
	{
		$mysql = mysqli_query ($con, "SELECT * FROM AccidentReport ORDER BY ID DESC");
	
		return $mysql;
	}
	
	function selectAccident($con, $id)
	{
		$con->set_charset("utf8");
		$mysql = mysqli_query ($con, "SELECT * FROM AccidentReport WHERE ID = " . $id);
		$info = mysqli_fetch_array($mysql);
		return $info;
	}
	
?>