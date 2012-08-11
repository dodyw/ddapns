<?php  

$dbhandle = sqlite_open('tokens.db', 0666, $error);
if (!$dbhandle) die ($error);

$query = "SELECT * FROM tokens";
$result = sqlite_query($dbhandle, $query);

$rows = sqlite_num_rows($result);
$field1 = sqlite_field_name($result, 0);
$field2 = sqlite_field_name($result, 1);

for ($i = 0; $i < $rows; $i++) {
  $row = sqlite_fetch_array($result, SQLITE_NUM); 
  print_r($row);
}

sqlite_close($dbhandle);
?>