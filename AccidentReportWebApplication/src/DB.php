<?php
        header('Content-Type: text/html; charset=utf-8');
        require_once('AccidentReport.php');
	
	function selectAllAccidentReport($con)
	{
		$mysql = mysqli_query ($con, "SELECT * FROM AccidentReport ORDER BY ID DESC");
	
		return $mysql;
	}

        
	function selectAccidentReport ($con, $id)
	{
                $stmt = $con->prepare("SELECT * FROM AccidentReport WHERE ID = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->bind_result($id, $longitude,$latitude,$accidentType,
                                        $amountOfDead,$amountOfInjured,
                                        $trafficBlocked,$message,$dateTime);
                
                $stmt->fetch();
                $stmt->close();
                
                $result = new AccidentReport($longitude,$latitude,$accidentType,
                                                $amountOfDead,$amountOfInjured,
						$trafficBlocked,$message,$dateTime);
                return $result;
	}
	
?>