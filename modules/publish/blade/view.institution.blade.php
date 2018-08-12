<?php
include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.institutionbao.php';
include_once '/../../../bao/class.subcategorybao.php';
ob_start();
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
$_InstitutionBAO = new InstitutionBAO();
$_DB = DBUtil::getInstance();
$_Log= LogUtil::getInstance();
$globalInstitution = '';

if(isset($_POST['save_institution']))
{
	ob_start();
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
		 $a = $_SESSION['globalUser'];
	}
	else
	{
	   $a = $_SESSION['globalUser'];
	}
	  // session_start();
	$permited  = array('jpg', 'jpeg', 'png','gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];
   
   	$div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "Institute_uploads/".$unique_image;
    if (empty($file_name)) {
       $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Please Select any Image!</div>";
	   return $msg;
      }
      elseif ($file_size >1048567) {
       $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Image Size should be less then 1MB!</div>";
	   return $msg;
      } 
      elseif (!$file_temp) {
      	$msg = "<div class='alert alert-danger'><strong>Error ! </strong>No File Selected,Upload Again!</div>";
	    return $msg;
      }
      else
      {
  	 move_uploaded_file($file_temp, $uploaded_image);
	 $Institution = new Institution();	
	
	 $Institution->setID(Util::getGUID());
	 $Institution->setUserID($a->getID());
     $Institution->setName($_DB->secureInput($_POST['name']));
     $Institution->setAddress($_DB->secureInput($_POST['address']));
     $Institution->setDescription($_DB->secureInput($_POST['description']));
     $Institution->setImage($uploaded_image);

    
     if (empty($Institution->getName() || $Institution->getAddress())) 
     {
     	$msg = "<div class='alert alert-danger'><strong>Error !</strong>Field must not be empty</div>";
		return $msg;
     }
     else
     {
     	
	    $_InstitutionBAO->createInstitution($Institution);
	
	 $Subcategory = new Subcategory();
	 	
	 $Subcategory->setCatID(Util::getGUID());
	 $Subcategory->setUserID($a->getID());
	 $Subcategory->setInstituteID($Institution->getID());
     $Subcategory->setName($_DB->secureInput($_POST['name']));
     $Subcategory->setParentID(0);
     $Subcategory->setImage($uploaded_image);

     $_InstitutionBAO->createSubcategory($Subcategory);

     $NewPublisher = new NewPublisher();

     $NewPublisher->setInstituteID($Institution->getID());
     $NewPublisher->setCategoryID($Subcategory->getCatID());
     $NewPublisher->setPublisherID($Subcategory->getUserID());
     
 
	$_InstitutionBAO->createDefaultPublisher($NewPublisher);


     $msg = "<div class='alert alert-success'><strong>Success ! </strong>Create Institute Successfully!!</div>";
	 return $msg;

 }
}
	 
}

if(isset($_GET['edit']))
{
	$Institution = new Institution();	
	$Institution->setID($_GET['edit']);	
	$globalInstitution = $_InstitutionBAO->readInstitutionData($Institution)->getResultObject(); //reading the user object from the result object
}
if (isset($_POST['update_institution'])) {

	$Institution = new Institution();
		
    $Institution->setID ($_GET['edit']);   	
    $Institution->setName( $_POST['name'] );
    $Institution->setAddress ( $_POST['address'] );

    $permited  = array('jpg', 'jpeg', 'png');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];
   
   	$div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "Institute_uploads/".$unique_image;

   	$Institution->setImage($uploaded_image);

   	if (empty($Institution->getName() || $Institution->getAddress())) 
     {
      $msg="<div class='alert alert-danger'><strong>Error !</strong>Field must not be empty</div>";
	  return $msg;
     }
     else
     {
     	if (!empty($file_name)) {

     		if ($file_size >1048567) {
		    $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Image Size should be less then 1MB!</div>";
			   return $msg;
		    } 
		    elseif (!$file_temp) {
		    $msg = "<div class='alert alert-danger'><strong>Error ! </strong>No File Selected,Upload Again!</div>";
			    return $msg;
		    }
		    elseif (in_array($file_ext, $permited) === false) {
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong><span class='error'>You can upload only:-".implode(', ', $permited)."</span></div>";
				//$msg = "<div class='alert alert-danger'><strong>Error ! </strong>No File Selected,Upload Again!</div>";
				return $msg;
			}
			else{
				move_uploaded_file($file_temp, $uploaded_image);
				$Result = $_InstitutionBAO->updateInstitutionWithImage($Institution);
				if ($Result->getIsSuccess()) {
					$msg = "<div class='alert alert-success'><strong>Success ! </strong>Update Institute Successfully!!</div>";
					return $msg;
				}
				else{
					$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Institute not Updated!!</div>";
					return $msg;
				}
			}
     	}
     	else
     	{
     		$Result = $_InstitutionBAO->updateInstitutionWithoutImage($Institution);
			if ($Result->getIsSuccess()) {
				$msg = "<div class='alert alert-success'><strong>Success ! </strong>Update Institute Successfully!!</div>";
				return $msg;
			}
			else{
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Institute not Updated!!</div>";
				return $msg;
			}
     	}
     }
	$Result = $_InstitutionBAO->updateInstitution($Institution);
	if ($Result->getIsSuccess()) {
		$msg = "<div class='alert alert-success'><strong>Success ! </strong>Update Institute Successfully!!</div>";
		return $msg;
	}

	//header("Location:view.userprofile.php");
}
if (isset($_GET['del'])) {

	$Institution = new Institution();	
	$Institution->setID($_GET['del']);	
	$_InstitutionBAO->deleteInstitution($Institution); //reading the user object from the result object

	$Subcategory = new Subcategory();	
	$Subcategory->setInstituteID($_GET['del']);	
	$_InstitutionBAO->deleteCateory($Subcategory);

	$NewPublisher = new NewPublisher();	
	$NewPublisher->setInstituteID($_GET['del']);	
	$_InstitutionBAO->deletePublisher($NewPublisher);

	$AddSubscriber = new AddSubscriber();
	$AddSubscriber->setInstituteID($_GET['del']);
	$_InstitutionBAO->deleteSubscriber($AddSubscriber);


	//header("Location:".PageUtil::$Institution);

}


 //echo '<br> log:: exit blade.Institution.php';
 
?>