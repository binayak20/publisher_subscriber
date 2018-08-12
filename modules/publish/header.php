<?php 
include_once '/../../common/class.common.php';
include_once 'blade/view.user.blade.php';
include_once 'blade/view.subcategory.blade.php';
Session:: checkSession();
ob_start();

if (session_status() == PHP_SESSION_NONE) {
  session_start();

  $ID   =  $_SESSION['globalUser']->getID();
  $Name = $_SESSION['globalUser']->getFirstName();
 // echo $Name;

}
else
{
  $ID        = $_SESSION['globalUser']->getID();
  $FirstName = $_SESSION['globalUser']->getFirstName();
  $LastName  = $_SESSION['globalUser']->getLastName();
  //echo $Name;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Publish_Subscription</title>

    <!-- Bootstrap -->
    
    <link href="bootstrap/css/custom.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css">
    <script src="http://localhost/Publish_Subscription/modules/publish/bootstrap/js/jquery.js"></script>
    <!-- <script src="bootstrap-treeview.js"></script> -->
    <!-- <script src="bootstrap/css/select2-bootstrap.min.css"></script> -->
    <link href="bootstrap/css/simple-sidebar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js" ></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="tree.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">

   <script src="chosen.jquery.js" type="text/javascript"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.js" type="text/javascript"></script>
   <script src="docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
    <script src="docsupport/init.js" type="text/javascript" charset="utf-8"></script>
    <!-- <link rel="stylesheet" href="docsupport/style.css"> -->
    <!-- <link rel="stylesheet" href="docsupport/prism.css"> -->
    <link rel="stylesheet" href="chosen.css">
   <!--  <link rel="stylesheet" href="docsupport/style.css">
    <link rel="stylesheet" href="docsupport/prism.css">
    <link rel="stylesheet" href="chosen.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.js" type="text/javascript"></script>
    <script src="chosen.jquery.js" type="text/javascript"></script>
    <script src="docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
    <script src="docsupport/init.js" type="text/javascript" charset="utf-8"></script> -->
   <!--  <script>
      $(function() {
        $('.chosen-select').chosen();
        $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
      });
    </script> -->


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <?php 
      if (isset($_GET['action']) && $_GET['action'] == "logout") {
        Session:: destroy();
        //session_start();
        //session_destroy();
        //header("Location:view.user.php");
      }
  ?>
       <?php 
          $Result = $_SubcategoryBAO->getPublisherSubcategory($ID);
          if($Result->getIsSuccess()){

          $SubcategoryList = $Result->getResultObject();
          for ($i = 0; $i<sizeof($SubcategoryList); $i++){
              $Subcategory = $SubcategoryList[$i];
         }     
       }
       ?>
  <body style="#">
   <!--  <a href="https://github.com/alxlit/bootstrap-chosen"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png" alt="Fork me on GitHub"></a> -->
  <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #449D44" >
    <div style="color: #ddd">
      <div class="container" style="color: #3D3D3B">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
      </button>
        <ul class="nav navbar-nav" style="padding-top: 10px">
              <a  href="#" class="btn btn-default" id="menu-toggle">Side Bar</a>
             
          </ul>
        <a class="navbar-brand" href="#"><span style="color: #ffffff">Publisher_Subscriber-Network</span></a>
        <div class="collapse navbar-collapse">
          
          <ul class="nav navbar-nav navbar-right">
             <li class="#"><a href="view.userprofile.php?profile=<?php echo $ID; ?>"><span style="color: #ffffff"><?php echo $FirstName ;?></span></a></li>
             <li class="#"><a href="home.php"><span style="color: #ffffff">Home</span></a></li>
             <li class="#"><a href="view.userprofile.php?profile=<?php echo $ID; ?>"><span style="color: #ffffff">Profile</span></a></li>
             <li class="#"><a href="?action=logout"><span style="color: #ffffff">Logout</span></a></li>
             <li class="dropdown">
                   <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span style="color: #ffffff">Learn<b class="caret"></b></span>
                      <ul class="dropdown-menu">
                        <li class="dropdown-header">All Option</li>
                        <li><a href="view.institution.php">Creat Institution</a></li>
                         <?php 
                            $id = $_UserBAO->getPublisherId($ID);
                            if ($id == 'ture') {
                         ?>
                        <li><a href="view.addpublisher.php">Publisher</a></li>
                        <?php } ?>
                           <?php 
                              $id = $_UserBAO->getSubscriberId($ID);
                              if ($id == 'ture') {
                           ?>
                        <li><a href="view.subscriber.php">Subscriber</a></li>
                        <li><a href="view.subscriber.php">Show Notice</a></li>
                        <?php } ?>
                    
                      </ul>
                   </a>
              </li>


          </ul>
        </div>  
      </div>
      </div>

  </nav>
  <div id="wrapper">
       <!-- Sidebar -->
        <div id="sidebar-wrapper">

            <ul class="sidebar-nav">
            <?php 

                $Result = $_UserBAO->getUserProfileImage($ID);
                if($Result->getIsSuccess()){

                $UserImageList = $Result->getResultObject();
                for ($i = 0; $i<sizeof($UserImageList); $i++){
                    $UserProfileImage = $UserImageList[$i];
              
             ?>
                  <a style="padding: 20px;" href=""><img src="<?php echo $UserProfileImage->getImage(); ?>" height="100px" 
                   width="90px" /></a>
            <?php } } ?>
                <li class="sidebar-brand">
                    <a href="home.php">
                       <?php echo $FirstName ;?>
                       <?php echo $LastName ;?>
                    </a>
                </li>
                <li>
                    <a href="home.php">Home</a>
                </li>
                <?php 
                    $id = $_UserBAO->getOrganizerId($ID);
                    if ($id == 'ture') {
                 ?>
                <li>
                    <a href="view.organizer.php">Organizer</a>
                </li>
                <?php } ?>
                 <?php 
                    $id = $_UserBAO->getPublisherId($ID);
                    if ($id == 'ture') {
                 ?>
                <li>
                    <a href="view.addpublisher.php">Publisher</a>
                </li>
                <?php } ?>
                 <?php 
                    $id = $_UserBAO->getSubscriberId($ID);
                    if ($id == 'ture') {
                 ?>
                <li>
                    <a href="view.subscriber.php">Subscriber</a>
                </li>
                <li>
                    <a href="view.subscriber.php">Show Notice</a>
                </li>
                <?php } ?>
                
                <li>
                    <a href="view.about.php">About</a>
                </li>
                
                <li class="#">
                    <a href="?action=logout">Logout</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-12">
  