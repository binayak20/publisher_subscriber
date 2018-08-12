<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.imagebao.php';

$_ImageBAO = new ImageBAO();
$_DB = DBUtil::getInstance();
$_Log= LogUtil::getInstance();

$globalUser = '';

if(isset($_POST['submit']))
{
	//$permited  = array('jpg', 'jpeg', 'png', 'gif','docx');
    $doc_name  = $_POST['doc_name']; 
    $file_name = $_FILES['image']['name'];
   // $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];
    $uploaded_image = "uploads/$file_name";
    move_uploaded_file($file_temp, $uploaded_image);
    if ($doc_name) {
          
          $ImageFile = new ImageFile();

          $ImageFile->setID(Util::getGUID());
          $ImageFile->setName($_DB->secureInput($_POST['doc_name']));
          $ImageFile->setImage($uploaded_image);

          $_ImageBAO->addImage($ImageFile);

          header('Location:view.image.php');

         
    }

   /* $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/".$unique_image;

    if (empty($file_name)) {
       echo "<span class='error'>Please Select any Image !</span>";
      }
      elseif ($file_size >1048567) {
       echo "<span class='error'>Image Size should be less then 1MB!
       </span>";
      } */
      /*elseif (in_array($file_ext, $permited) === false) {
       echo "<span class='error'>You can upload only:-"
       .implode(', ', $permited)."</span>";
      }*/else{
          

          echo "Please Select a File";

          
      }
	     
	 
	 header("Location:view.image.php");

	 //Location("view.addpublisher.php");
}
if (isset($_GET['dow'])) {
  $Image = $_GET['dow'];

  $Result =  $_ImageBAO->downloadImage($Image);
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename = "'.basename($Image).'"');
  header('Content-Length: ' . filesize($Image));
  readfile($Image);
}


 echo '<br> log:: exit blade.image.php';
 
?>