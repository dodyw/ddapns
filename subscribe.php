<?php  
include "config.php";

if ($_GET['key']!=$config['apns_key']) {
  exit;
}

$device_token = $_GET['token'];

$dbhandle = sqlite_open('tokens.db', 0666, $error);
if (!$dbhandle) die ($error);

/*
$query = "CREATE TABLE tokens(id integer PRIMARY KEY," . 
       "token text NOT NULL)";
$result = sqlite_exec($dbhandle, $query, $error);

if (!$result)
   die("Cannot execute query. $error");
*/


// check if token is exist
$query = "SELECT * FROM tokens where token = '$device_token'";
$result = sqlite_query($dbhandle, $query);
$rows = sqlite_num_rows($result);

if ($rows == 0) {
  // insert new token

  $query = "INSERT INTO tokens VALUES(null,'$device_token')";
  $result = sqlite_exec($dbhandle, $query);  
  print "New token added.";
}
else {
  // do nothing
  print "Token already exist.";
}

sqlite_close($dbhandle);
?>