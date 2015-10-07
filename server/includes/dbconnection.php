<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

function getdbconnection(){
	$dbName = "c:\inetpub\wwwroot\\trackflag\server\\trackflag.accdb";

	if (!file_exists($dbName)) {
		print "could not find database file";
	    die;
	}
	$db = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=$dbName; Uid=; Pwd=;");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $db;
}


?>