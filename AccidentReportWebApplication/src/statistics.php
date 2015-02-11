<?php
	require_once 'menubar.php';
// 	require_once 'DB.php';
	
// 	$db = new DB();
// 	$db->connect();
// 	$mysql = $db->selectAllAccidentReport();
	 
// 	$rows = array();
// 	while($r = mysqli_fetch_assoc($mysql)) {
// 		$rows[] = $r;
// 	}
// 	print json_encode($rows);
// 	$db->closeDB();
?>

<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<link rel="stylesheet" media="all" type="text/css" href="API/jquery-ui.css" />
<link rel="stylesheet" media="all" type="text/css" href="API/jquery-ui-timepicker-addon.css" />

<script type="text/javascript" src="API/jquery-1.11.2.js"></script>
<script type="text/javascript" src="API/jquery-ui.min.js"></script>

<script type="text/javascript" src="API/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="API/jquery-ui-sliderAccess.js"></script>


<style>
.hidden {
    display:none;
}
</style>

</head>

<body>

	<form method="post" action=" ">
	    <div >
	        <form class="valu">
			<input type="radio" name=myradio id="time" value="Time">
 			<label for="time">Time From Report</label>
			<input type="radio" name=myradio id="response" value="response">
 			<label for="response">Time response</label>
			</form>
	    </div>
	</form>
	
	<form id="tradio" class="hidden" method="post" action=" ">
	    <div >
	        <form class="valu">
			<input type="radio" name=timeradio id="all" value="dataTimeRespond.php">
 			<label for="all">Time statistic for all response</label>
			<input type="radio" name=timeradio id="first" value="dataFirstRespond.php">
 			<label for="first">Time statistic for first response</label>
 			<input type="button" value="Show Statistics" id="showS" />
			</form>
	    </div>
	</form>

	<form id="f_date" class="hidden">
		<font size='4'>From</font>
		<input type="text" name="sDate" id="sDate" value="" /> 
		<font size='4'>To</font>
		<input type="text" name="nDate" id="nDate" value="" />
		<input type="button" value="Show Graph" id="showG" />
	</form>
	
	
	<div id="donutchart" class="hidden" style="width: 900px; height: 500px;"></div>
	<div id="outp" class="hidden"> </div>
	
	<script type="text/javascript">

	google.load("visualization", "1", {packages:["corechart"]});

	function drawChart(json) {
  	  var data = new google.visualization.DataTable(json);
        
        var options = {
        	is3D: true,
        	title: 'Time Phase in report'
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }

	$("input").on("click", function(){
		var selectValu = $( "input:checked" ).val();
		if(selectValu == "Time"){
			$("#donutchart").show();
			$("#f_date").show();
			$("#tradio").hide();
			$("#outp").hide();
			
			$("#showG").click(function(){
				$.ajax(
					    {
					    url: "dataTime.php",
					    type: "POST",
					    data: { sDate: $('#sDate').val(), nDate: $('#nDate').val()},
					    success: function(resultData){
					    	//$("#outp").text(status);
					    	$("#donutchart").show();
					    	google.setOnLoadCallback(drawChart(resultData));
					    }
					}); 
			});
			
		}else if(selectValu == "response"){
			$("#donutchart").hide();
			$("#f_date").hide();
			$("#tradio").show();
			$("#outp").show();

			$("#showS").click(function(){
				var urldata = $('input[name=timeradio]:checked').val();
				$.ajax(
					    {
					    url: urldata,
					    type: "POST",
					    success: function(status){
					    	$("#outp").text(status);
					    }
				}); 
			});

			
			
		}
	}).change();

	
	$(function(){

		$('#nDate').datepicker({
			dateFormat: "yy-mm-dd 23:59:59",
			maxDate: 0,
			minDate: 1
		});
		
		$('#sDate').datepicker({
	        dateFormat: "yy-mm-dd 00:00:00",
	        maxDate: 0,
	        onSelect: function () {
	        	var endDate = $('#nDate');
                var startDate = $(this).datepicker('getDate');
                
                startDate.setDate(startDate.getDate());
                endDate.datepicker('option', 'maxDate', 0);
                endDate.datepicker('option', 'minDate', startDate);
                endDate.datepicker('setDate', startDate);
	        }
	    });
	});
	</script>
</body>
</html>
