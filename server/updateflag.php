<?php
header('Access-Control-Allow-Origin: *');
include "includes/dbconnection.php";
$db = getdbconnection();

$event_id = $_REQUEST['event_id'];
$action = $_REQUEST['action'];
$id = $_REQUEST['id'];
$turn = $_REQUEST['turn'];

if ($event_id == ""){
	$event_id = 0;
}

if($id == -1){
	# clear all flags
	$event_query = "update flag set active = 0, turn = '' where event_id = " . $event_id;
	$event_result = $db->query($event_query);
}else if($id == -2){
	# clear global flags
	$event_query = "update flag set active = 0, turn = '' where event_id = " . $event_id . " and id in (1,2,3,4,5,6,7,11)";
	$event_result = $db->query($event_query);
}else if($id == -3){
	# clear local flags
	$event_query = "update flag set active = 0, turn = '' where event_id = " . $event_id . " and id in (8,9,10)";
	$event_result = $db->query($event_query);
}else{
	$event_query = "update flag set active = " . $action . ", turn = '".$turn."' where event_id = " . $event_id . " and id = " . $id;
	$event_result = $db->query($event_query);
}
?>