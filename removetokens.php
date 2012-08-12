<?php  
include "config.php";

if ($_GET['key']!=$config['apns_access_key']) {
  exit;
}

$dbhandle = sqlite_open('tokens.db', 0666, $error);
if (!$dbhandle) die ($error);

$query = "DELETE FROM tokens";
$result = sqlite_query($dbhandle, $query);

sqlite_close($dbhandle);

print "All device tokens has been removed.";
?>