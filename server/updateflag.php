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

	$event_query = "insert into flag_history (id, flag_name, event_id, activation_time, inactivation_time)
					select id, flag_name, ".$event_id.", activation_time, now() from flag
					where event_id = " . $event_id . " and active = 1";
	$event_result = $db->query($event_query);

	$event_query = "update flag set active = 0, turn = '' where event_id = " . $event_id;
	$event_result = $db->query($event_query);
}else if($id == -2){
	# clear global flags
	$event_query = "insert into flag_history (id, flag_name, event_id, activation_time, inactivation_time)
					select id, flag_name, ".$event_id.", activation_time, now() from flag
					where event_id = " . $event_id . " and active = 1 and id in (1,2,3,4,5,6,7,11)";
	$event_result = $db->query($event_query);

	$event_query = "update flag set active = 0, turn = '' where event_id = " . $event_id . " and id in (1,2,3,4,5,6,7,11)";
	$event_result = $db->query($event_query);
}else if($id == -3){
	# clear local flags
	$event_query = "insert into flag_history (id, flag_name, event_id, activation_time, inactivation_time)
					select " . $id.", flag_name, ".$event_id.", activation_time, now() from flag
					where event_id = " . $event_id . " and active = 1 and id in (8,9,10)";
	$event_result = $db->query($event_query);

	$event_query = "update flag set active = 0, turn = '' where event_id = " . $event_id . " and id in (8,9,10)";
	$event_result = $db->query($event_query);
}else{
	if($action == 1){
		# activating a flag
		$event_query = "update flag set active = " . $action . ", turn = '".$turn."', activation_time = now() where event_id = " . $event_id . " and id = " . $id;
		$event_result = $db->query($event_query);
	}else{
		#inactivating a flag
		$event_query = "insert into flag_history (id, flag_name, event_id, activation_time, inactivation_time)
						select " . $id.", flag_name, ".$event_id.", activation_time, now() from flag
						where event_id = " . $event_id . " and id = " . $id . " and active = 1";
		$event_result = $db->query($event_query);

		$event_query = "update flag set active = " . $action . ", turn = '".$turn."', activation_time = null where event_id = " . $event_id . " and id = " . $id;
		$event_result = $db->query($event_query);

	}
}
?>