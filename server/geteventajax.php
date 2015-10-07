<?php
header('Access-Control-Allow-Origin: *');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


include "includes/dbconnection.php";
$db = getdbconnection();

$lat =  $_REQUEST['lat'];
$lon=  $_REQUEST['lon'];

if ($lat == ""){
	$lat = 0;
	$lon = 0;
}

?>


<?php
$event_query = "
SELECT event.id AS evid, *
FROM track INNER JOIN event ON track.ID = event.track_id
WHERE (((Now()) Between [begin_date] And dateadd('d',1,[end_date])))
order by track.track_name;";
$event_result = $db->query($event_query);

print "
	<center>";


while ($event_row = $event_result->fetch(PDO::FETCH_ASSOC)) {
	//print getDistance($lat, $lon, $event_row['latitude'], $event_row['longitude']) . "<br>";
	if (getDistance($lat, $lon, $event_row['latitude'], $event_row['longitude']) < 100 || $lat == 0 && $lon == 0){
		print "<button class='button button-large button-energized' onclick='document.trackflag.event_id.value=".$event_row['evid'].";clearLogo(); clearMessage(); getGlobalCommand();'>". $event_row['track_name']."</button>&nbsp;";
	}
}


$db->connection = null;
?>



<?php
	function getDistance( $latitude1, $longitude1, $latitude2, $longitude2 ) {  
	    $earth_radius = 6371;

	    $dLat = deg2rad( $latitude2 - $latitude1 );  
	    $dLon = deg2rad( $longitude2 - $longitude1 );  

	    $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);  
	    $c = 2 * asin(sqrt($a));  
	    $d = $earth_radius * $c;  

	    return $d;  
	}

?>