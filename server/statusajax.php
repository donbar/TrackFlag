<?php
header('Access-Control-Allow-Origin: *');
include "includes/dbconnection.php";
$db = getdbconnection();

$event_id = $_REQUEST['event_id'];
if ($event_id == ""){
	$event_id = 0;
}


$track_id = $_REQUEST['track_id'];
if ($track_id > 0){
    # this call is coming in from dispatch and the event IDs don't line up, what's active for this track?
    $sql = "select id from event where track_id = " . $track_id . " and now() between begin_date and end_date";
    $event_result = $db->query($sql);
    $event_row = $event_result->fetch(PDO::FETCH_ASSOC);
    $event_id = $event_row['id'];
}

if ($event_id > 0){
$event_query = "SELECT flag.* from flag where event_id = " . $event_id;
$event_result = $db->query($event_query);

$command = '
hideBlackFlag();
hideWhiteFlag();
hideSafetyFlag();
hideDoubleYellowFlag();
hideRedFlag();
hideGreenFlag();
hideRestartFlag();
hideStandingYellowFlag();
hideDebrisFlag();
hidewavingYellow();
hideCheckeredFlag();
if (typeof hideDownOilFlag == "function") { 
    hideDownOilFlag();
}

';

$gscale = 0;
$lscale = 0;
while ($event_row = $event_result->fetch(PDO::FETCH_ASSOC)){


//1('black');
//2('white');
//3 ('safety');
//4 ('fullyellow');
//5 ('red');
//6 ('green');
//7 ('restart');
//8 ('debris');
//9 ('yellow');
//10 ('wavingyellow');
//11 ('checkeredflag');



    $flag = $event_row['id'];
    if ($event_row['active'] == 1 && $flag == 1){
        $command .= 'showBlackFlag(gscale);';
        $gscale++;
    }
    if ($event_row['active'] == 1 && $flag == 2){
        $command .= 'showWhiteFlag(gscale);';
        $gscale++;
    }
    if ($event_row['active'] == 1 && $flag == 3){
        $command .= 'showSafetyFlag(gscale);';
        $gscale++;

    }
    if ($event_row['active'] == 1 && $flag == 4){
        $command .= 'showDoubleYellowFlag(gscale);';
        $gscale++;
    }
    if ($event_row['active'] == 1 && $flag == 5){
        $command .= 'showRedFlag(gscale);';
        $gscale++;
    }
    if ($event_row['active'] == 1 && $flag == 6){
        $command .= 'showGreenFlag(gscale);';
        $gscale++;
    }
    if ($event_row['active'] == 1 && $flag == 7){
        $command .= 'showRestartFlag(gscale);';
        $gscale++;
    }  
    if ($event_row['active'] == 1 && $flag == 11){
        $command .= 'showCheckeredFlag(gscale);';
        $gscale++;
    }     
    if ($event_row['active'] == 1 && $flag == 8){
        $command .= "showDebrisFlag('" . $event_row['turn']."', lscale);";
        $lscale++;
    }  
    if ($event_row['active'] == 1 && $flag == 9){
        $command .= "showStandingYellowFlag('" . $event_row['turn']."', lscale);";
        $lscale++;
    }  
    if ($event_row['active'] == 1 && $flag == 10){
        $command .= "hidewavingYellow('" . $event_row['turn']."',lscale);";
        $command .= "showwavingYellow('" . $event_row['turn']."',lscale);";
        $lscale++;
    }  
    if ($event_row['active'] == 1 && $flag == 12){
        $command .= "if ( typeof( showDownOilFlag) == 'function') { 
                        showDownOilFlag('" . $event_row['turn']."', lscale);
                        }";
        $lscale++;
    }     
}

$command = preg_replace('/gscale/',$gscale, $command);
$command = preg_replace('/lscale/',$lscale, $command);

echo $command;
}

$db->connection = null;

?>


