<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.newpublisherbao.php';

$_NewPublisherBAO = new NewPublisherBAO();
$_DB = DBUtil::getInstance();
$_Log= LogUtil::getInstance();

$globalUser = '';

if(isset($_GET['approve_publisher']))
{
	if (isset($_GET['InstituteId'])) {
		$b = $_GET['InstituteId'];
		//echo $b;
	}
	if (isset($_GET['categoryId'])) {
		$a = $_GET['categoryId'];
	}

	 $NewPublisher = new NewPublisher();

     $NewPublisher->setInstituteID($b);
     $NewPublisher->setCategoryID($a);
     $NewPublisher->setPublisherID($_GET['approve_publisher']);
     $Check_Publisher = $_NewPublisherBAO->CheckPublisher($NewPublisher);
 
	$_NewPublisherBAO->createNewPublisher($NewPublisher);
	 	

}

if(isset($_GET['change_pub']))
{

	$NewPublisher = new NewPublisher();	
	$NewPublisher->setPublisherID($_GET['change_pub']);	
	$globalUser = $_NewPublisherBAO->readPublisherData($NewPublisher)->getResultObject(); //reading the user object from the result object
}

if (isset($_POST['change_publisher'])) {

	if (isset($_GET['change_pub'])) {    
                $catID =  $_GET['change_pub'];
            }
	$NewPublisher = new NewPublisher();	

    $NewPublisher->setCategoryID ($_GET['change_pub']);
   	$NewPublisher->setPublisherID($_POST['uId'] );
    
   
	$_NewPublisherBAO->updatPublisher($NewPublisher,$catID);

	//header("Location:view.allpublisher.php");
}


 //echo '<br> log:: exit blade.addpublisher.php';
 
?>