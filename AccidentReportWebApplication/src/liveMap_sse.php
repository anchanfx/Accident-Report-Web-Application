<?php
        require_once 'DB.php';
        
	header('Content-Type: text/event-stream');
	header('Cache-Control: no-cache');
        
        function run() {
                $db = new DB();
                $accidentReportJSON = null;
                
                while(1) {
                        $db->connect();
                        $query = $db->selectAllAccidentReport();
                        $db->closeDB();
                        $data = "";
                        $accidentReportRow = array();
                        
                        while($r = mysqli_fetch_assoc($query)) {
                                $accidentReportRow[] = $r;
                        }
                        
                        $accidentReportJSON = json_encode($accidentReportRow);
                        
                        echo "event: AccidentReport\ndata: {$accidentReportJSON}\n\n";
                        //echo "data: HELLO\n\n";
                        
                        ob_flush();
                        flush();
                        sleep(5);
                }
        }
        
        run();
?>