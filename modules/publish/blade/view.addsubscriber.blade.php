<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.addsubscriberbao.php';

$_AddSubscriberBAO = new AddSubscriberBAO();
$_DB = DBUtil::getInstance();
$_Log= LogUtil::getInstance();

$globalUser = '';

if(isset($_GET['accept']))
{
     //$b = $_SESSION['categoryId'];
     if(isset($_GET['InstituteId']))
      {
        $a = $_GET['InstituteId'];
      }
      if(isset($_GET['categoryId']))
      {
        $b = $_GET['categoryId'];
      }
	   $AddSubscriber = new AddSubscriber();

     $AddSubscriber->setInstituteID($a);
     $AddSubscriber->setCategoryID($b);
     $AddSubscriber->setSubscriberID($_GET['accept']);

	 $_AddSubscriberBAO->createAddSubscriber($AddSubscriber);
     
     
}
if (isset($_GET['CatId'])) {
    $Notice = new Notice();
    $Notice->setPubCatID($_GET['CatId']);

    $_AddSubscriberBAO->UpdateNoticeStatus($Notice);
  }

 //echo '<br> log:: exit blade.addsubscriber.php';
 
?>