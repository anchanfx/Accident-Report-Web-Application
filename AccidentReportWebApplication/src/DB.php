<?php
    header('Content-Type: text/html; charset=utf-8');
    require_once('AccidentReport.php');
    require_once('config.php');
	class DB{
		var $con;
		function connect()
		{
			$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
			$con->set_charset("utf8");
		
			if (mysqli_connect_error()) {
				echo "Fail to connect to mysql: " . mysqli_connect_error();
			}
		
			$this->con = $con;
		}
		
        function closeDB(){
			mysqli_close($this->con) or die("Can't Close Connection");
		}
		
        function selectAllAccidentReport()
		{
			$mysql = mysqli_query ($this->con, "SELECT * FROM AccidentReport ORDER BY ID DESC");
		
			return $mysql;
		}

        function selectAllRescueUnit()
		{
			$mysql = mysqli_query ($this->con, "SELECT * FROM RescueUnit ORDER BY Online DESC, Available DESC");
		
			return $mysql;
		}

		function selectAccidentReport ($id)
		{
			$conn = $this->con;
	                $stmt = $conn->prepare("SELECT * FROM AccidentReport WHERE ID = ?");
	                $stmt->bind_param("i", $id);
	                $stmt->execute();
	                $stmt->bind_result($id, $imei, $longitude,$latitude,$accidentType,
	                                        $amountOfDead,$amountOfInjured,
	                                        $trafficBlocked,$message,
	                                        $dateTime,$serverDateTime,$resolve);
	                
	                $stmt->fetch();
	                $stmt->close();
	                
	                $result = new AccidentReport($longitude,$latitude,$accidentType,
	                                            $amountOfDead,$amountOfInjured,
												$trafficBlocked,$message,$dateTime);
                    $result->imei = $imei;
	                $result->serverDateTime = $serverDateTime;
	                $result->resolve = $resolve;
	                return $result;
		}
		
		function selectByDate($sDate,$ndate){
			$accidentData = array();
			$conn = $this->con;
			$stmt = $conn->prepare("SELECT * FROM AccidentReport WHERE ServerDateTime BETWEEN ? AND ?");
			$stmt->bind_param("ss", $sDate,$ndate);
			$stmt->execute();
			$stmt->bind_result($id, $imei, $longitude,$latitude,$accidentType,
	                                        $amountOfDead,$amountOfInjured,
	                                        $trafficBlocked,$message,
	                                        $dateTime,$serverDateTime,$resolve);

			while ($stmt->fetch()) { 
				$result = new AccidentReport($longitude,$latitude,$accidentType,
					$amountOfDead,$amountOfInjured,
					$trafficBlocked,$message,$dateTime);
				$result->imei = $imei;
				$result->serverDateTime = $serverDateTime;
				$result->resolve = $resolve;
				array_push($accidentData, $result);
			}
	
			$stmt->close();
	
			return $accidentData;
		}
		
		function timeRespond(){
			$mysql = mysqli_query ($this->con, 
					"SELECT A.ID ,A.ServerDateTime ,M.DateTime
					FROM AccidentReport A ,MissionReport M 
					WHERE A.ID = M.AccidentID AND M.RescueState = '1'");
		
			return $mysql;
		}
	}
?>