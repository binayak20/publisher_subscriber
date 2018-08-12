<?php
include_once '/../util/class.util.php';
include_once '/../util/class.xml.php';


$db = new XMLtoPermission("c:/wamp64/www/Publish_Subscription/config/xml/permission.xml");
$db->saveInDB($db->load()); // loading and then saving in the database tbl_permission
?>