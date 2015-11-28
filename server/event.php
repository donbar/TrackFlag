<?php
  // add &admin=1 to URL to go into permadelete mode to delete test events
?>
<!DOCTYPE html>
<html>


<?php
include "includes/trackflag.css";
include "includes/dbconnection.php";
include "includes/version.php";
$version = version();
$db = getdbconnection();

?>

	<script>
	function changelogin(){
		thevar = document.getElementById('eventvehicle').value;
		results = thevar.split("/");
		document.truck.event_id.value= results[0];
		document.truck.vehicle_id.value= results[1];
		document.truck.submit();
	}

	</script>

<?php
print "<body>";
if($_POST['deleteme'] > 0){
	$sql = "delete from event where ID = " . $_POST['deleteme'];
	$result = $db->query($sql);
}
if($_POST['deletemehard'] > 0){

	$sql = "delete * from flag_history where event_id = ". $_POST['deletemehard'];			
	$result = $db->query($sql);
	$sql = "delete from event where ID = " . $_POST['deletemehard'];
	$result = $db->query($sql);
}
if($_POST['post_it'] == '1' && $_POST['begindate'] > '' && $_POST['enddate'] > ''){
	$oktosave = 0;
	$counter = 0;
	$track = $_POST['track'];
	$begin = $_POST['begindate'];
	$end = $_POST['enddate'];
	$vehicles = $_POST['veh_counter'];
	$counter = 0;

	$end = $end . " 23:59:59";
		#print $end;
	$insert_query = "insert into event (track_id, begin_date, end_date) 
				values (".$track.",STR_TO_DATE('".$begin."','%m-%d-%Y'),STR_TO_DATE('".$end."','%m-%d-%Y %H:%i:%s'))";

#print $insert_query;				
	$result = $db->query($insert_query);	
}


print "<link href='includes/CalendarControl.css' rel='stylesheet' type='text/css'>
		<script src='includes/CalendarControl.js' language='javascript'></script>";
print "<form name='event' method='post'>";
print "<input type='hidden' name='post_it' value='0'>";
print "<input type='hidden' name='deleteme' value='0'>";
print "<input type='hidden' name='deletemehard' value='0'>";


print "<span class='welcome'><center>Welcome to TrackFlag v".$version." - Event Management</center></span>";
print "<span class='eventmenu'><input id='menu' type='button' class='overridebuttonactive' value='Menu' onclick='document.location=\"http://trackflag.nasasafety.com\"'></span>";


print "<br><br>";

$event_query = "
SELECT event.id AS evid, 
	DATE_FORMAT(begin_date, '%Y.%m.%d') as pretty_start,
    DATE_FORMAT(end_date, '%Y.%m.%d') as pretty_end,
    track.*, event.begin_date,
    (select count(*) from flag_history where flag_history.event_id = event.ID) as counter
	FROM (track INNER JOIN event ON track.ID = event.track_id) 
    order by begin_date
    limit 10 offset 0
";
$event_result = $db->query($event_query);

print "<center>";
print "<span class='largetext'>Upcoming Events (up to 10 shown)</span><br>";
print "<table id='events' border=0 >
		<tr>
		<th>Track</th>
		<th>Begin</th>
		<th>End</th>
		<th></th>
		</tr>";
while ($event_row = $event_result->fetch(PDO::FETCH_ASSOC)) {
print "<tr>
		<td title='ID:".$event_row['evid'] . "'>".$event_row['track_name']."</td>
		<td>".$event_row['pretty_start']."</td>
		<td>".$event_row['pretty_end']."</td>
		<td>";
		if($event_row['counter'] ==0){
			print "<a href='#' onclick='document.event.deleteme.value=".$event_row['evid']."; document.event.submit();'><img src='images/delete.png'></a></td>";
		}else{
			if($_GET['admin'] == 1){
				print "<a href='#' onclick='document.event.deletemehard.value=".$event_row['evid']."; document.event.submit();'>PERMADELETE</a>";
			}	
			print "</td>";
		}
		print "</tr>";

}
print "</table></span>";
print "<br><br>";
print "<table border=0>";
print "<tr><td colspan=2 align='center'><span class='largetext'>Add new event:</span></td></tr>";

print "<tr><td align='right' width='50%'><span class='selecttext'>Track:</span></td>";

print "<td><select id='track' name='track'>";
$track_query = "select * from track";
$track_result = $db->query($track_query);
while ($track_row = $track_result->fetch(PDO::FETCH_ASSOC)) {
	print "<option value='".$track_row['id']."'>".$track_row['track_name']."</option>";
}
print "</select></td></tr>";

print "<tr><td align='right' width='50%'><span class='selecttext'>Begin Date:</span></td>";
print "<td width='50%'><span class='normal'><input type='text' name='begindate' id='begindate' maxlength=8 size=8 value='' onfocus='showCalendarControl(this);'></td>";

print "<tr><td align='right' width='50%'><span class='selecttext'>End Date:</span></td>";
print "<td width='50%'><span class='normal'><input type='text' name='enddate' id='enddate' maxlength=8 size=8 value='' onfocus='showCalendarControl(this);'></td>";


print "<tr><td colspan=2 align='center'>
		<input id='savedata' type='button' class='overridebuttonactive' value='Save Event' onclick='document.event.post_it.value=1;document.event.submit();'>
		</td></tr>";
print "</center>";




print "</form>";

$db->connection = null;
?>

</body>
</html>