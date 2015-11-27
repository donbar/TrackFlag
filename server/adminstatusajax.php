<?php
header('Access-Control-Allow-Origin: *');
include "includes/dbconnection.php";
$db = getdbconnection();

$event_id = $_REQUEST['event_id'];
if ($event_id == ""){
	$event_id = 0;
}

$event_query = "SELECT * from flag where event_id = " . $event_id;
$event_result = $db->query($event_query);

$command = '';


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
//12 ('oilflag');



    $flag = $event_row['id'];
    if ($flag == 1){
        if($event_row['active'] == 1){
            $command .= "document.getElementById('action1').value = 0;";
            $command .= 'clickblack(1,1);';
        }else{
            $command .= "document.getElementById('action1').value = 1;";
            $command .= 'clickblack(1,1);';
        }
    }
    if ($flag == 2){
        if($event_row['active'] == 1){
            $command .= "document.getElementById('action2').value = 0;";
            $command .= 'clickwhite(2,1);';
        }else{
            $command .= "document.getElementById('action2').value = 1;";
            $command .= 'clickwhite(2,1);';
        }
    }    
    if ($flag == 3){
        if($event_row['active'] == 1){
            $command .= "document.getElementById('action3').value = 0;";
            $command .= 'clicksafety(3,1);';
        }else{
            $command .= "document.getElementById('action3').value = 1;";
            $command .= 'clicksafety(3,1);';
        }
    }
    if ($flag == 4){
        if($event_row['active'] == 1){
            $command .= "document.getElementById('action4').value = 0;";
            $command .= 'clickdblyellow(4,1);';
        }else{
            $command .= "document.getElementById('action4').value = 1;";
            $command .= 'clickdblyellow(4,1);';
        }
    }
    if ($flag == 5){
        if($event_row['active'] == 1){
            $command .= "document.getElementById('action5').value = 0;";
            $command .= 'clickred(5,1);';
        }else{
            $command .= "document.getElementById('action5').value = 1;";
            $command .= 'clickred(5,1);';
        }
    }
    if ($flag == 6){
        if($event_row['active'] == 1){
            $command .= "document.getElementById('action6').value = 0;";
            $command .= 'clickgreen(6,1);';
        }else{
            $command .= "document.getElementById('action6').value = 1;";
            $command .= 'clickgreen(6,1);';
        }
    }
    if ($flag == 7){
        if($event_row['active'] == 1){
            $command .= "document.getElementById('action7').value = 0;";
            $command .= 'clickrestart(7,1);';
        }else{
            $command .= "document.getElementById('action7').value = 1;";
            $command .= 'clickrestart(7,1);';
        }
    }
    if ($flag == 11){
        file_put_contents('don.txt',$event_row['active']);
        if($event_row['active'] == 1){
            $command .= "document.getElementById('action11').value = 0;";
            $command .= 'clickcheckered(11,1);';
        }else{
            $command .= "document.getElementById('action11').value = 1;";
            $command .= 'clickcheckered(11,1);';
        }
    }
    if ($flag == 8){
        if($event_row['active'] == 1){
            $command .= "document.getElementById('action8').value = 0;";
            $command .= 'showlocaldebris("' . $event_row['turn'].'",1); document.getElementById("localdebrisFlag").style.display = "inline-block";';
        }else{
            $command .= "document.getElementById('action8').value = 1;";
            $command .= 'hidelocaldebris();';
        }
    }
    if ($flag == 9){
        if($event_row['active'] == 1){
            $command .= "document.getElementById('action9').value = 0;";
            $command .= 'showlocalyellow("' . $event_row['turn'].'",1);document.getElementById("localyellowFlag").style.display = "inline-block";';
        }else{
            $command .= "document.getElementById('action9').value = 1;";
            $command .= 'hidelocalyellow();';
        }
    }
    if ($flag == 10){
        if($event_row['active'] == 1){
            $command .= "document.getElementById('action10').value = 0;";
            $command .= 'showwavingyellow("' . $event_row['turn'].'",1);document.getElementById("localwavingFlag").style.display = "inline-block";';
        }else{
            $command .= "document.getElementById('action10').value = 1;";
            $command .= 'hidewavingyellow();';
        }
    }
    if ($flag == 12){
        if($event_row['active'] == 1){
            $command .= "document.getElementById('action12').value = 0;";
            $command .= 'showlocaloil("' . $event_row['turn'].'",1); document.getElementById("localoilFlag").style.display = "inline-block";';
        }else{
            $command .= "document.getElementById('action12').value = 1;";
            $command .= 'hidelocaloil();';
        }
    }    
}

$command = preg_replace('/gscale/',$gscale, $command);
$command = preg_replace('/lscale/',$lscale, $command);

//print "Trying newer status for track " . $event_row['track_name'] . " and here it is again";

// We will be returning javascript commands and executing functions in the main app
    //showwavingYellow();
    //hidewavingYellow();
    //showGreenFlag(1);
    //hideGreenFlag();
    //showBlackFlag();
    //hideBlackFlag();
    //showDebrisFlag();
    //hideDebrisFlag();
    //showSafetyFlag();
    //hideSafetyFlag();
	//showStandingYellowFlag();
    //hideStandingYellowFlag();

echo $command;

$db->connection = null;

?>


