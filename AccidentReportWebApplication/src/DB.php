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

        
	function selectAccidentReport ($id)
	{
		$conn = $this->con;
                $stmt = $conn->prepare("SELECT * FROM AccidentReport WHERE ID = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->bind_result($id, $longitude,$latitude,$accidentType,
                                        $amountOfDead,$amountOfInjured,
                                        $trafficBlocked,$message,
                                        $dateTime,$serverDateTime,$resolve);
                
                $stmt->fetch();
                $stmt->close();
                
                $result = new AccidentReport($longitude,$latitude,$accidentType,
                                                $amountOfDead,$amountOfInjured,
						$trafficBlocked,$message,$dateTime);
                $result->serverDateTime = $serverDateTime;
                $result->resolve = $resolve;
                return $result;
	}
}
?>