============
DDAPNS v.1.0
============

Use this script to manage APNS (Apple Push Notification Service).


REQUIREMENT
===========
- PHP 5.2.x with SQLite support
- .pem files for APNS (go to apple provisioning portal)
- server with port 2195 open


INSTALLATION
============

1. Edit config.php. 
2. If necessary provide both PRODUCTION and DEVELOPMENT .pem file.
3. Set sandbox_mode = true for DEVELOPMENT and set false for PRODUCTION.
4. Set apns_access_key to any string so only you able to use this script.

<?php  
  $config['sandbox_mode'] = true;
  $config['apns_pem_file_sandbox'] = "aps_acsdemo_dev.pem";
  $config['apns_pem_file_production'] = "aps_acsdemo_prod.pem";
  $config['apns_access_key'] = "123456";
?>


TESTING
=======

1) Adding new device token. Your iOS app need to send data containing device token.

Assuming you install in localhost with IP address 192.168.1.144 under ddapns folder. When testing on localhost, always use IP because your device need to find you mac.

Open browser and locate to: 

http://192.168.1.144/ddapns/subscribe.php?key=123456&token=fc5ef26f9811e83d93c2b3bd0403907d7ba97d287f9b3889074838e5bcfec89b

Parameters:
- key is apns_access_key
- token is device token


2) View device tokens. You can use it to see all device tokens

Open browser and locate to: 
http://192.168.1.144/ddapns/viewtokens.php?key=123456

Parameters:
- key is apns_access_key


3) Remove all tokens. You can use it to remove all tokens

http://192.168.1.144/ddapns/removetokens.php?key=123456

Parameters:
- key is apns_access_key


4) Push a message to all devices.

http://192.168.1.144/ddapns/push.php?key=123456&msg=this%20is%20test

Parameters:
- key is apns_access_key
- msg is the message


5) Checking port 2195 is open

http://192.168.1.144/ddapns/checkport.php
