
function getDistance( $latitude1, $longitude1, $latitude2, $longitude2 ) {  
    $earth_radius = 6371;

    $dLat = deg2rad( $latitude2 - $latitude1 );  
    $dLon = deg2rad( $longitude2 - $longitude1 );  

    $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);  
    $c = 2 * asin(sqrt($a));  
    $d = $earth_radius * $c;  

    return $d;  
}

$distance = getDistance( 56.130366, -106.34677099999, 57.223366, -106.34675644699 );
if( $distance < 100 ) {
    echo "Within 100 kilometer radius";
} else {
    echo "Outside 100 kilometer radius";
}