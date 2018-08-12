<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.newpublisherbao.php';

$_NewPublisherBAO = new NewPublisherBAO();

$_DB = DBUtil::getInstance();
$_Log= LogUtil::getInstance();

$globalPublisher = '';

/* saving a new Publisher account/notice*/
if(isset($_POST['notice_save']))
{
	//echo "string";
	if($_POST['security'] == "1")
	{
		//echo "string1";
		if (isset($_GET['categoryId'])) {
		    $b = $_GET['categoryId'];
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


	 	$Notice = new Notice();

	 	$Notice->setID(Util::getGUID());
	 	$Notice->setChildCatID($b);
	 	$Notice->setPubCatID($b);
	 	$Notice->setPublisherID($a->getID());
	 	$Notice->setStatus(1);
	 	$Notice->setNotice($_POST['notice']);
    
	$permitted = array('jpg', 'jpeg', 'png','gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div            = explode('.', $file_name);
    $file_ext       = strtolower(end($div));
    $unique_image   = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "post_uploads/".$unique_image;
    if (empty($file_name) && empty($Notice->getNotice())) {
       	$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Both field must not be empty !! Please write something.</div>";
	     return $msg;
       }
       elseif(!empty($Notice->getNotice()) && empty($file_name)){
       	$Notice->setImage(NULL);
       	$child = $_NewPublisherBAO->findChild($Notice->getChildCatID());
	 	for ($i=0; $i<count($child); $i++)
	 	{ 		
	 		$Notice->setChildCatID($child[$i]);
	 		$_NewPublisherBAO->createNotice($Notice);	
	 	}

	 	$msg = "<div class='alert alert-success'><strong>Success !!</strong> Notice post successfully!! </div>";
	    return $msg;
       }
       elseif(!empty($file_name) && empty($Notice->getNotice())){

       		if ($file_size >1048567 ) {
             $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Image Size should be less then 1MB!</div>";
	         return $msg;
            } 
            else if(in_array($file_ext, $permitted)==false )
            {
               $msg= "<div class='alert alert-danger'><strong>Error ! </strong>You can upload only :-".implode(',', $permitted)."</div>";
               return $msg;
            }
            else{
	        move_uploaded_file($file_temp, $uploaded_image);
		 	$Notice->setImage($uploaded_image);
		 	$child = $_NewPublisherBAO->findChild($Notice->getChildCatID());
		 	for ($i=0; $i<count($child); $i++)
		 	{ 		
		 		$Notice->setChildCatID($child[$i]);
		 		$_NewPublisherBAO->createNotice($Notice);	
		 	}
		 	$msg = "<div class='alert alert-success'><strong>Success !!</strong> Notice post successfully!! </div>";
		    return $msg;
       }	 	 		 	
	 }

	    else{

       		if ($file_size >1048567 ) {
             $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Image Size should be less then 1MB!</div>";
	         return $msg;
            } 
            else if(in_array($file_ext, $permitted)==false )
            {
               $msg= "<div class='alert alert-danger'><strong>Error ! </strong>You can upload only :-".implode(',', $permitted)."</div>";
               return $msg;
            }
            else{
	        move_uploaded_file($file_temp, $uploaded_image);
		 	$Notice->setImage($uploaded_image);
		 	$child = $_NewPublisherBAO->findChild($Notice->getChildCatID());
		 	for ($i=0; $i<count($child); $i++)
		 	{ 		
		 		$Notice->setChildCatID($child[$i]);
		 		$_NewPublisherBAO->createNotice($Notice);	
		 	}
		 	$msg = "<div class='alert alert-success'><strong>Success !!</strong> Notice post successfully!! </div>";
		    return $msg;
       }	 	 		 	
	 }
	}

 
	if($_POST['security'] == "2")
	  {
			if (isset($_GET['categoryId'])) {
		    $b = $_GET['categoryId'];
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


	 	$Notice = new Notice();

	 	$Notice->setID(Util::getGUID());
	 	$Notice->setChildCatID($b);
	 	$Notice->setPubCatID($b);
	 	$Notice->setPublisherID($a->getID());
	 	$Notice->setStatus(1);
	 	$Notice->setNotice($_POST['notice']);
    
	$permitted = array('jpg', 'jpeg', 'png','gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div            = explode('.', $file_name);
    $file_ext       = strtolower(end($div));
    $unique_image   = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "post_uploads/".$unique_image;
    if (empty($file_name) && empty($Notice->getNotice())) {
       	$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Both field must not be empty !! Please write something.</div>";
	     return $msg;
       }
       elseif(!empty($Notice->getNotice()) && empty($file_name)){
       	$Notice->setImage(Null);
	 	$_NewPublisherBAO->createNotice($Notice);	
	 	

	 	$msg = "<div class='alert alert-success'><strong>Success !!</strong> Notice post successfully!! </div>";
	    return $msg;
       }
       elseif(!empty($file_name) && empty($Notice->getNotice())){

       		if ($file_size >1048567 ) {
             $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Image Size should be less then 1MB!</div>";
	         return $msg;
            } 
            else if(in_array($file_ext, $permitted)==false )
            {
               $msg= "<div class='alert alert-danger'><strong>Error ! </strong>You can upload only :-".implode(',', $permitted)."</div>";
               return $msg;
            }
            else{
	        move_uploaded_file($file_temp, $uploaded_image);
		 	$Notice->setImage($uploaded_image);
		 	$_NewPublisherBAO->createNotice($Notice);	
		 	
		 	$msg = "<div class='alert alert-success'><strong>Success !!</strong> Notice post successfully!! </div>";
		    return $msg;
       }	 	 		 	
	 }

	    else{

       		if ($file_size >1048567 ) {
             $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Image Size should be less then 1MB!</div>";
	         return $msg;
            } 
            else if(in_array($file_ext, $permitted)==false )
            {
               $msg= "<div class='alert alert-danger'><strong>Error ! </strong>You can upload only :-".implode(',', $permitted)."</div>";
               return $msg;
            }
            else{
	        move_uploaded_file($file_temp, $uploaded_image);
		 	$Notice->setImage($uploaded_image);
		 	$_NewPublisherBAO->createNotice($Notice);	
		 	
		 	$msg = "<div class='alert alert-success'><strong>Success !!</strong> Notice post successfully!! </div>";
		    return $msg;
       }	 	 		 	
	 }
	}
}

if (isset($_GET['favId'])) {
	//echo "string";
	    if (isset($_GET['favId'])) 
	    {
		    $b = $_GET['favId'];
		    //echo $b;
		}
		$a = $_SESSION['globalUser']; 
		//echo $a;

		 $FavouriteNotice = new FavouriteNotice();

	     $FavouriteNotice->setFavouriteNoticeID($b);
	     $FavouriteNotice->setSubscriberID($a->getID());
	     $Check_Notice = $_NewPublisherBAO->CheckNotice($FavouriteNotice);

		if ($Check_Notice == true) {
		   // $_NewPublisherBAO->addFavouriteNotice($FavouriteNotice);

	     	$msg = "<div class='alert alert-success'><strong>Success !</strong>Add Favourite successfully.</div>";
			return $msg;
	     }
	     else
	     {
	     	   $_NewPublisherBAO->addFavouriteNotice($FavouriteNotice);

	     	$msg = "<div class='alert alert-success'><strong>Success !</strong>Add Favourite successfully.</div>";
			return $msg;
	     }
		
		//header("Location:view.subscriber.php");
}


/* deleting an existing Notice */
if(isset($_GET['delete']))
{

	$Notice = new Notice();	
	$Notice->setID($_GET['delete']);
	
	$_NewPublisherBAO->deleteNotice($Notice); 

	header("Location:view.notice.php");
}

if(isset($_GET['edit']))
{
	$Notice = new Notice();	
	$Notice->setID($_GET['edit']);	
	$globalPublisher = $_NewPublisherBAO->readNoticeByCategory($Notice)->getResultObject(); //reading the user object from the result object
}

if(isset($_POST['update_notice']))
{

	if (isset($_GET['categoryId'])) {
		    $b = $_GET['categoryId'];
		  }
	$Notice = new Notice();
		
    $Notice->setID ($_GET['edit']); 
    $Notice->setChildCatID($b);  	
    $Notice->setNotice($_POST['notice']);

    $child = $_NewPublisherBAO->findChild($Notice->getChildCatID());
    for ($i=0; $i<count($child); $i++)
	 	{
	 		
	 		$Notice->setChildCatID($child[$i]);
	 		$Result = $_NewPublisherBAO->updateNotice($Notice);	
	 	}
   
	if ($Result->getIsSuccess()) {
		$msg = "<div class='alert alert-success'><strong>Success ! </strong>Update Notice Successfully!!</div>";
		return $msg;
	}
}

if (isset($_GET['del'])) {

	if (isset($_GET['categoryId'])) {
		    $b = $_GET['categoryId'];
		  }

	$Notice = new Notice();	
	$Notice->setID($_GET['del']);
	$Notice->setChildCatID($b);

	$child = $_NewPublisherBAO->findChild($Notice->getChildCatID());
    for ($i=0; $i<count($child); $i++)
	 	{
	 		
	 		$Notice->setChildCatID($child[$i]);
	 		$_NewPublisherBAO->deleteNotice($Notice); 
	 	}

}


//echo '<br> log:: exit blade.publishnotice.php';
$_Log->log(LogUtil::$DEBUG,"exit blade.publishnotice.php");

?>