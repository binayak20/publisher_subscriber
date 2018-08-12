<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.requestbao.php';

$_RequestBAO = new RequestBAO();
$_DB = DBUtil::getInstance();
$_Log= LogUtil::getInstance();

$globalUser = '';

if(isset($_POST['request']))
{
	//echo "Problem Occured";
	if (isset($_GET['InstituteId'])) {
		$b = $_GET['InstituteId'];
	}
    ob_start();
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
		$a = $_SESSION['globalUser']; 		
	}
	else
	{
	     $a = $_SESSION['globalUser'];
	}

	 $Request = new Request();

	 $Request->setRequestID(Util::getGUID());
     $Request->setInstituteID($b);
     $Request->setSubscriberID($a->getID());
     $Request->setCatID($_DB->secureInput($_POST['catid']));
     $Request->setStatus(2);
     
     $Subscriber_Check = $_RequestBAO->SubscriberCheck($Request);

     if ($Request->getStatus() == 1 && $Subscriber_Check == true) {
     	$msg = "<div class='alert alert-danger'><strong>Error !</strong>Yow already a subscriber on this Category</div>";
		return $msg;
     }
     if ($Request->getStatus() == 2 && $Subscriber_Check == true) {
     	$msg = "<div class='alert alert-danger'><strong>Error !</strong>You have already sent Request on this category.</div>";
		return $msg;
     }else{
     	$_RequestBAO->sentRequest($Request);
     	$msg = "<div class='alert alert-success'><strong>Success !</strong>Request sent successfully.</div>";
		return $msg;
	    header("Location:home.php");
     }

	 
}

if(isset($_GET['accept']))
{
	$Request = new Request();

    $Request->setSubscriberID($_GET['accept']);
    $Request->setCatID($_GET['categoryId']);

	$_RequestBAO->UpdateRequestSubscriber($Request);

}
if(isset($_GET['reject']))
{

	$Request = new Request();	
	$Request->setSubscriberID($_GET['reject']);	
	
	$_RequestBAO->deleteRequestSubscriber($Request); 

}
if(isset($_POST['request_publisher']))
{
	//echo "Problem Occured";
	
	if (isset($_GET['InstituteId']) || isset($_GET['organizerId'])) {
		$b = $_GET['InstituteId'];
		$c = $_GET['organizerId'];
	}
    ob_start();
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
		$a = $_SESSION['globalUser']; 		
	}
	else
	{
	     $a = $_SESSION['globalUser'];
	}
	
	 $RequestPublisher = new RequestPublisher();

	 $RequestPublisher->setRequestID(Util::getGUID());
     $RequestPublisher->setInstituteID($b);
     $RequestPublisher->setOrganizerID($c);
     $RequestPublisher->setPublisherID($a->getID());
     $RequestPublisher->setCatID($_DB->secureInput($_POST['catid']));
     $RequestPublisher->setStatus(2);
     
     $Publisher_Check = $_RequestBAO->PublisherCheck($RequestPublisher);
     
     if ($RequestPublisher->getStatus() == 1 && $Publisher_Check == true) {
     	$msg = "<div class='alert alert-danger'><strong>Error !</strong>Yow already a Publisher on this Category</div>";
		return $msg;
     }
     if ($RequestPublisher->getStatus() == 2 && $Publisher_Check == true) {
     	$msg = "<div class='alert alert-danger'><strong>Error !</strong>You have already sent Request on this category.</div>";
		return $msg;
     }else{
     	
     	$_RequestBAO->sentPublisherRequest($RequestPublisher);

     	$msg = "<div class='alert alert-success'><strong>Success !</strong>Request sent successfully.</div>";
		return $msg;
	    header("Location:home.php");
     }
	 
}
if(isset($_GET['approve_publisher']))
{
	$RequestPublisher = new RequestPublisher();

    $RequestPublisher->setPublisherID($_GET['approve_publisher']);
    $RequestPublisher->setCatID($_GET['categoryId']);

	$_RequestBAO->UpdateRequestPublisher($RequestPublisher);

}

if(isset($_GET['reject_publisher']))
{

	$RequestPublisher = new RequestPublisher();	
	$RequestPublisher->setPublisherID($_GET['reject_publisher']);	
	
	$_RequestBAO->deleteRequestPublisher($RequestPublisher); 

}

//echo '<br> log:: exit blade.addsubscriber.php';
 
?>