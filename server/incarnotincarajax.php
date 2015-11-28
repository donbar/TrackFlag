<?php
header('Access-Control-Allow-Origin: *');
header("Pragma: no-cache");
?>

<br><br>
<center>
	<table cellpadding='5' width='95%'>
	<tr>
		<td width='50%' align='right'>

			<button style='z-index:2147483647' 
					class='button button-large button-energized' 
					onclick='document.trackflag.incar.value=1;clearMessage();getRaceEvent();'>
					This device is IN CAR
			</button>
		</td>
		<td>&nbsp;</td>
		<td>
			Use this option if this device will be in the car with the driver.<br>
			If the car is stopped, the display will automatically change to messages<br>
			after 10 seconds.  Flags will show again when the car is moving.
		</td>
	</tr>
	<tr>
		<td colspan=3>&nbsp;</td>
	</tr>
	<tr>
		<td width='50%' align='right'>
			<button style='z-index:2147483647' 
					class='button button-large button-energized' 
					onclick='document.trackflag.incar.value=0;clearMessage();getRaceEvent();'>
					This device is NOT IN CAR
			</button>
		</td>
		<td>&nbsp;</td>
		<td>
			Use this option if this device will NOT be in the car with the driver.<br>
			Touch anywhere on the screen to change to the messages screen.<br>
			Touch again to change display to flags.
		</td>
	</tr>
</table>
