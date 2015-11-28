<?php
header('Access-Control-Allow-Origin: *');
include "includes/dbconnection.php";
$db = getdbconnection();

$event_id = $_REQUEST['event_id'];
if ($event_id == ""){
	$event_id = 0;
}


$sql = "select controlmessages from event where id = " . $event_id;
$controlmessages_result = $db->query($sql);
$controlmessages_row = $controlmessages_result->fetch(PDO::FETCH_ASSOC);
$controlmessages = $controlmessages_row['controlmessages'];

$command = 'document.getElementById("controlmessages").value= ' . $controlmessages;

echo $command;

$db->connection = null;

?>


