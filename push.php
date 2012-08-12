<?php
include "config.php";

if ($_GET['key']!=$config['apns_access_key']) {
  exit;
}

date_default_timezone_set('Europe/Rome');

// Report all PHP errors
error_reporting(-1);

require_once 'ApnsPHP/Autoload.php';

if ($config['sandbox_mode']) {
	$push = new ApnsPHP_Push(
		ApnsPHP_Abstract::ENVIRONMENT_SANDBOX,
		$config['apns_pem_file_sandbox']
	);
}
else {
  $push = new ApnsPHP_Push(
    ApnsPHP_Abstract::ENVIRONMENT_PRODUCTION,
    $config['apns_pem_file_production']
  );
}

$push->setRootCertificationAuthority('entrust_root_certification_authority.pem');
$push->connect();

// push to all devices

$dbhandle = sqlite_open('tokens.db', 0666, $error);
if (!$dbhandle) die ($error);

$query = "SELECT * FROM tokens";
$result = sqlite_query($dbhandle, $query);

$rows = sqlite_num_rows($result);

for ($i = 0; $i < $rows; $i++) {
  $row = sqlite_fetch_array($result, SQLITE_NUM); 
  $message = send_push_notification($row[1],$_GET['msg']);
  $push->add($message);
  $push->send();
  print 'sending ..'.$i."\n";
}

sqlite_close($dbhandle);






// Disconnect from the Apple Push Notification Service
$push->disconnect();

// Examine the error message container
$aErrorQueue = $push->getErrors();
if (!empty($aErrorQueue)) {
	var_dump($aErrorQueue);
}

function send_push_notification($token, $msg) {
  // Instantiate a new Message with a single recipient
  $message = new ApnsPHP_Message($token);

  // Set a custom identifier. To get back this identifier use the getCustomIdentifier() method
  // over a ApnsPHP_Message object retrieved with the getErrors() message.
  //$message->setCustomIdentifier("Message-Badge-3");

  // Set badge icon to "3"
  $message->setBadge(1);

  // Set a simple welcome text
  $message->setText($msg);

  // Play the default sound
  $message->setSound();

  // Set a custom property
  //$message->setCustomProperty('acme2', array('bang', 'whiz'));

  // Set another custom property
  //$message->setCustomProperty('acme3', array('bing', 'bong'));

  // Set the expiry value to 30 seconds
  $message->setExpiry(30);

  return $message;
}
