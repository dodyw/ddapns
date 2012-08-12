<?php  
include "config.php";

if ($_GET['key']!=$config['apns_access_key']) {
  exit;
}

$dbhandle = sqlite_open('tokens.db', 0666, $error);
if (!$dbhandle) die ($error);

$query = "SELECT * FROM tokens";
$result = sqlite_query($dbhandle, $query);

$rows = sqlite_num_rows($result);
$field1 = sqlite_field_name($result, 0);
$field2 = sqlite_field_name($result, 1);

print "<h2>View device tokens</h2>";

for ($i = 0; $i < $rows; $i++) {
  $row = sqlite_fetch_array($result, SQLITE_NUM); 
  print "<p>".$row[1]."</p>";
}

sqlite_close($dbhandle);
?>