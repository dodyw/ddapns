<?php  

$dbhandle = sqlite_open('tokens.db', 0666, $error);
if (!$dbhandle) die ($error);

$query = "DELETE FROM tokens";
$result = sqlite_query($dbhandle, $query);

sqlite_close($dbhandle);
?>