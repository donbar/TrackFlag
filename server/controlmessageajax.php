<?php
header('Access-Control-Allow-Origin: *');
include "includes/dbconnection.php";
$db = getdbconnection();

$event_id = $_REQUEST['event_id'];
if ($event_id == ""){
	$event_id = 0;
}



$msg_query = "
    SELECT  
    case when timediff(now(), msgdatetime) > TIME('00:05:00') then msgdatetime
    else concat('<b>',msgdatetime,'</b>')
    end as msgdatetime,
    case when timediff(now(), msgdatetime) > TIME('00:05:00') then msg
    else concat('<b>',msg,'</b>')
    end as msg
    from controlmsg
    where event_id = " . $event_id . "
    order by msgdatetime desc";
$msg_result = $db->query($msg_query);

$command = $command . "<div style='position:absolute; top: 0%; right:2%;'><b>Current time: ".date("h:i:s")."</b></div>";


$command = $command . "<div style='position:absolute; top: 5%; left:2%;'><table id='controlmsg' width='90%'>";

while ($msg_row = $msg_result->fetch(PDO::FETCH_ASSOC)) {
        $command = $command . "<tr><td width='150px'>".$msg_row['msgdatetime']."</td><td>".$msg_row['msg'] . " </td></tr>";
}
$command = $command . "</table>";
echo $command;


$db->connection = null;

?>


