<?php
        header('Content-Type: text/html; charset=utf-8');
        require_once('AccidentReport.php');
class DB{
	var $con;
	function connect()
	{
		$host = "fdb7.runhosting.com";
		$user = "1679495_dbacc";
		$pass = "tot_1288";
		$name = "1679495_dbacc";
	
		$con = mysqli_connect($host, $user, $pass, $name);
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
                                        $trafficBlocked,$message,$dateTime);
                
                $stmt->fetch();
                $stmt->close();
                
                $result = new AccidentReport($longitude,$latitude,$accidentType,
                                                $amountOfDead,$amountOfInjured,
						$trafficBlocked,$message,$dateTime);
                return $result;
	}
}
?>