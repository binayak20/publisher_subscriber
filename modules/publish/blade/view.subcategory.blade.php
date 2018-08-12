<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.subcategorybao.php';
include_once '/../../../bao/class.institutionbao.php';
include_once '/../../../bao/class.newpublisherbao.php';
ob_start();

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
$globalCategory = '';
$_SubcategoryBAO = new SubcategoryBAO();
$_InstitutionBAO = new InstitutionBAO();
$_NewPublisherBAO = new NewPublisherBAO();
$_DB = DBUtil::getInstance();

if(isset($_POST['save_cat']))
{
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

	$permited  = array('jpg', 'jpeg', 'png','gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];
   
   	$div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads_group/".$unique_image;
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
      
	 $Subcategory = new Subcategory();
	 	
	 $Subcategory->setCatID(Util::getGUID());
	 $Subcategory->setUserID($a->getID());
	 $Subcategory->setInstituteID($b);
     $Subcategory->setName($_DB->secureInput($_POST['txtName']));
     $Subcategory->setParentID($_DB->secureInput($_POST['parentId']));
     $Subcategory->setImage($uploaded_image);

     if ($Subcategory->getName() == "" || $Subcategory->getParentID() =="" )  {
     	$msg = "<div class='alert alert-danger'><strong>Error !</strong>Category Name must not be empty</div>";
		return $msg;
     }else{
	    $_InstitutionBAO->createSubcategory($Subcategory,$b);

	    $msg = "<div class='alert alert-success'><strong>Success !!</strong>Group Add Successfully!!</div>";
	    return $msg;
	    }
	}
}

/* reading an existing Subcategory information */
if(isset($_GET['edit']))
{
	$Subcategory = new Subcategory();	
	$Subcategory->setCatID($_GET['edit']);	
	$globalCategory = $_SubcategoryBAO->readSubcategory($Subcategory)->getResultObject(); //reading the Subcategory object from the result object
}

/*updating an existing Role information*/
if(isset($_POST['update_cat']))
{
	$permited  = array('jpg', 'jpeg', 'png','gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];
   
   	$div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads_group/".$unique_image;
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
		$Subcategory = new Subcategory();	

	    $Subcategory->setCatID ($_GET['edit']);
	    $Subcategory->setInstituteID ($_GET['edit']);
	    $Subcategory->setName( $_POST['txtName'] );
		$Subcategory->setParentID( $_POST['parentId'] );
		$Subcategory->setImage($uploaded_image);

		$_SubcategoryBAO->updateSubcategory($Subcategory);
		 $msg = "<div class='alert alert-success'><strong>Success !!</strong>Group Update Successfully!!</div>";
	    return $msg;

    }

	//header("Location: view.Subcategory.php");
}

if (isset($_GET['del'])) {

	$Subcategory = new Subcategory();	
	$Subcategory->setCatID($_GET['del']);

	$child = $_NewPublisherBAO->findChild($Subcategory->getCatID());
	for ($i=0; $i<count($child); $i++)
	 	{
	 		
	 		$Subcategory->setCatID($child[$i]);
	 		$_NewPublisherBAO->deleteSubcategory($Subcategory);
	 	}	

}

//echo '<br> log:: exit blade.Subcategory.php';

?>
