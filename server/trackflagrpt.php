<script language="javascript" src="js/jquery-1.3.2.js" type="text/javascript"></script>

<?php
include "includes/reports.css";
include "includes/dbconnection.php";
include "includes/version.php";
require_once dirname(__FILE__) . '/classes/PHPExcel.php';

$db = getdbconnection();
$version = version();


$track_query = "
	SELECT ID, track_name
	FROM track 
	order by track.track_name
";
$track_result = $db->query($track_query);


print "

	<script>

	function checkform(){
		if (document.reports.event){
			document.reports.event.value = 0;
		}
		document.reports.submit();
	}
	</script>

";

print "<form name='reports' method='post' action='trackflagrpt.php'>";
print "<span class='welcome'><center>Welcome to TrackFlag v".$version." - Reporting Center</center></span><br>";
print "<span class='eventmenu'><input id='menu' type='button' class='overridebuttonactive' value='Menu' onclick='document.location=\"http://trackflag.nasasafety.com\"'></span>";
print "<span class='excelmenu'><div id='excel' name='excel'></div></span>";
print "<br><br>";
print "<span class='selecttext'>Track: </span><select name='track' id='track' class='largetext' onchange='checkform();'>";
print "<option name='track' value=0 SELECTED>Select an Option</option>";

while ($track_row = $track_result->fetch(PDO::FETCH_ASSOC)) {
	if ($_POST['track'] == $track_row['ID']){
		$selected = ' SELECTED';
		$track_name = $track_row['track_name'];
	}else{
		$selected = '';
	}
	print "<option name='track' value='".$track_row['ID']."'" . $selected . ">".$track_row['track_name']."</option>";
}
print "</select>";
print "<br><br>";

if (isset($_POST['track']) && $_POST['track'] > 0){
	$event_query = "
		SELECT ID, 
		DATE_FORMAT(begin_date, '%Y.%m.%d') as begin_date_prty,
    	DATE_FORMAT(end_date, '%Y.%m.%d') as end_date_prty
		FROM event 
		where track_id = " . $_POST['track'] . "
		order by begin_date
	";
	$event_result = $db->query($event_query);

	print "<span class='selecttext'>Event: </span><select name='event' id='event' class='largetext' onchange='document.reports.submit();'>";
	print "<option name='event' value=0 SELECTED>Select an Option</option>";
	if ($_POST['event'] == -1){
		$selected = ' SELECTED';
		$event_name = 'All';
	}else{
		$selected = '';
	}
	print "<option name='event' value=-1 ". $selected . ">All</option>";

	while ($event_row = $event_result->fetch(PDO::FETCH_ASSOC)) {
		if ($_POST['event'] == $event_row['ID']){
			$selected = ' SELECTED';
			$event_name = $event_row['begin_date_prty']." - " . $event_row["end_date_prty"];
		}else{
			$selected = '';
		}
		print "<option name='event' value='".$event_row['ID']."'" . $selected . ">".$event_row['begin_date_prty']." - " . $event_row["end_date_prty"] . "</option>";
	}
	print "</select>";
	print "<br><br>";

	if (isset($_POST['event']) && $_POST['event'] <> 0){
		$track_id = $_POST['track'];
		$event_id = $_POST['event'];

		if ($event_id == -1){
			$totalcalls = "select case flag_name
								when 'black' then 'Black'
								when 'white' then 'White'
								when 'red' then 'Red'
								when 'safety' then 'Safety'
								when 'restart' then 'Restart'
								when 'checkered' then 'Checkered'
								when 'fullyellow' then 'Full Course Yellow'
								when 'restart' then 'Restart'
								when 'green' then 'Green'
								when 'debris' then 'Local Debris'
								when 'wavingyellow' then 'Local Waving Yellow'
								when 'yellow' then 'Local Standing Yellow'
								when 'oil' then 'Oil Down'
								end  as flag_name
								, sum(TIMEDIFF(inactivation_time, activation_time)) as numseconds
							from flag_history join event on flag_history.event_id = event.id
							where track_id = " . $track_id ."
							group by flag_name
							order by flag_name"; 
		}else{
			$totalcalls = "select case flag_name
								when 'black' then 'Black'
								when 'white' then 'White'
								when 'red' then 'Red'
								when 'safety' then 'Safety'
								when 'restart' then 'Restart'
								when 'checkered' then 'Checkered'
								when 'fullyellow' then 'Full Course Yellow'
								when 'restart' then 'Restart'
								when 'green' then 'Green'
								when 'debris' then 'Local Debris'
								when 'wavingyellow' then 'Local Waving Yellow'
								when 'yellow' then 'Local Standing Yellow'
								when 'oil' then 'Oil Down'
								end  as flag_name,
							sum(TIMEDIFF(inactivation_time, activation_time)) as numseconds
							from flag_history join event on flag_history.event_id = event.id
							where event_id = " . $event_id . "
							group by flag_name
							order by flag_name";
		}


		$call_result = $db->query($totalcalls);

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("TrackFlag")
									 ->setLastModifiedBy("TrackFlag")
									 ->setTitle("TrackFlag Report")
									 ->setSubject("TrackFlag Report")
									 ->setDescription("TrackFlag Report")
									 ->setKeywords("TrackFlag")
									 ->setCategory("TrackFlag Report");		

		$stylebold = array(
		        'font' => array(
		            'bold' => true,
		        )
		    );							 
		$styleboldunderline = array(
		        'font' => array(
		            'bold' => true,
		            'underline' => true,
		        )
		    );									 

		print "<table border=1>";
		print "<tr><td><b>Flag</b></td><td><b>Total Time</b></td></tr>";


		$objPHPExcel->getActiveSheet()->setCellValue('A1',"TrackFlag Report executed " .date('m/d/y H:i:s'));
		$objPHPExcel->getActiveSheet()->getStyle("A1")->applyFromArray($styleboldunderline);	

		$objPHPExcel->getActiveSheet()->setCellValue('A2',"Track:");
		$objPHPExcel->getActiveSheet()->getStyle("A2")->applyFromArray($stylebold);		
		$objPHPExcel->getActiveSheet()->setCellValue('B2',$track_name);


		$objPHPExcel->getActiveSheet()->setCellValue('E2',"Event:");
		$objPHPExcel->getActiveSheet()->getStyle("E2")->applyFromArray($stylebold);		
		$objPHPExcel->getActiveSheet()->setCellValue('F2',$event_name);

		$objPHPExcel->getActiveSheet()->setCellValue('A4',"Flag:");
		$objPHPExcel->getActiveSheet()->getStyle("A4")->applyFromArray($stylebold);		


		$objPHPExcel->getActiveSheet()->setCellValue('C4',"Total Time:");
		$objPHPExcel->getActiveSheet()->getStyle("C4")->applyFromArray($stylebold);	


		$row = 4;
		while ($call_row = $call_result->fetch(PDO::FETCH_ASSOC)) {
			$row++;
			$flag_name = $call_row['flag_name'];
			$numseconds = $call_row['numseconds'];
			$numseconds = ($call_row{'numseconds'} =='') ? '[none]' : gmdate("H:i:s", $call_row{'numseconds'});

			switch ($flag_name) {
			    case "white":
			        $flag_name = "White";
			        break;
			    case "red":
			        $flag_name = "Red";
			        break;
			    case "safety":
			        $flag_name = "Safety";
			        break;
			    case "green":
			        $flag_name = "Green";
			        break;
			    case "black":
			        $flag_name = "Black";
			        break;
			    case "checkered":
			        $flag_name = "Checkered";
			        break;
			    case "restart":
			        $flag_name = "Restart";
			        break;
			    case "fullyellow":
			        $flag_name = "Full Course Yellow";
			        break;
			    case "wavingyellow":
			        $flag_name = "Local Waving Yellow";
			        break;
			    case "yellow":
			        $flag_name = "Local Standing Yellow";
			        break;
			    case "debris":
			        $flag_name = "Local Debris";
			        break;			        			        
			}

			print "<tr>";
			print "<td>". $flag_name . "</td>";
			print "<td>". $numseconds . "</td>";
			print "</tr>";

			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$flag_name);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$numseconds);
		}


		$session = rand(1,5000000);


		$objPHPExcel->setActiveSheetIndex(0);
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('temp/'.$session.'.xlsx'); 
		print "
		<script>
		document.getElementById('excel').innerHTML = ".chr(34)."<a href='temp/".$session.".xlsx' style='color:red'>Click here for Excel!</a>".chr(34).";
		</script>
		";



	} # end of if event exists
} # end of if track exists
?>
</body>
</html>
