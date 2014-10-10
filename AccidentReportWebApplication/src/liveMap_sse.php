<?php
        require_once 'DB.php';

        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');

        define("INTERVAL", 7);

        function run() {
                $db = new DB();
                $accidentReportJSON = null;
                $rescueUnitJSON = null;
                
                while(1) {
                        $db->connect();
                        $queryAccidentReport = $db->selectAllAccidentReport();
                        $queryRescueUnit = $db->selectAllRescueUnit();
                        $db->closeDB();
                        $accidentReportRow = array();
                        $rescueUnitRow = array();

                        while($r = mysqli_fetch_assoc($queryAccidentReport)) {
                                $accidentReportRow[] = $r;
                        }
                        
                        while($r = mysqli_fetch_assoc($queryRescueUnit)) {
                                $rescueUnitRow[] = $r;
                        }

                        $accidentReportJSON = json_encode($accidentReportRow);
                        $rescueUnitJSON = json_encode($rescueUnitRow);

                        echo "event: AccidentReport\ndata: {$accidentReportJSON}\n\n";
                        echo "event: RescueUnit\ndata: {$rescueUnitJSON}\n\n";
                        
                        ob_flush();
                        flush();
                        sleep(INTERVAL);
                }
        }

        run();
?>