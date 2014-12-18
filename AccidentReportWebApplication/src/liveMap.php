<?php
header('Content-Type: text/html; charset=utf-8');
require_once 'menubar.php';
?>
    
<!DOCTYPE html>
<html>
    <head>
        <title>Live Map</title>
        
        <script type="text/javascript" src="js/liveMapHeader.js"></script>
        <script type="text/javascript">
            headerSetup();
        </script>
    </head>
    <body>
        <div>
            <div id="googleMap" style="width:1366px;height:768px;"></div>

            <h3>Accident</h3>
            <div id="accidentRadioList"></div>
            <input id="messageTxtBox" type="text" placeholder="Message">
            <button id="sendMessageButton" type="button" value="Submit">Send Message</button>
            <hr>
            <h3>Rescue Unit</h3>
            <div id="rescueUnitRadioList"></div>
            <hr>
            <button id="assignButton" type="button" value="Submit">Assign</button>
        </div>

        <script type="text/javascript">
            footerSetup();
        </script>
    </body>

</html>
