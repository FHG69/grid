<?PHP
$serverName = "DESKTOP-PBIOREA";//serverName\instanceName
$connectionInfo = array( "Database"=>"pendel_db", "UID"=>"pendel", "PWD"=>"frank");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
?>