<?php include 'header.php'; ?>
<?php  
//include_once 'blade/view.user.blade.php';
include_once '/../../common/class.common.php';
ob_start();

if (session_status() == PHP_SESSION_NONE) {
  session_start();

  $ID  =  $_SESSION['globalUser']->getID();
  //echo $ID;
  //$Name= $_SESSION['globalUser']->getFirstName();

}
else
{
  $ID   =  $_SESSION['globalUser']->getID();
  $Name = $_SESSION['globalUser']->getFirstName();
  //echo $ID;
}
?>
<style type="text/css">
    .navbar-inner ul{margin:0;padding: 0;list-style: none;border: 1px solid #ddd; }
    .navbar-inner ul li{display: block;float: left;}
 </style>
<div class="container">
<div class="row">
    <div class="col-sm-2" >
     <?php 

            $Result = $_UserBAO->getUserProfileImage($ID);
            if($Result->getIsSuccess()){

            $UserImageList = $Result->getResultObject();
            for ($i = 0; $i<sizeof($UserImageList); $i++){
                $UserProfileImage = $UserImageList[$i];
              
        ?>
        <a href=""><img src="<?php echo $UserProfileImage->getImage(); ?>" height="140px" 
         width="120px"/></a>
     <?php } } ?>
  </div>
  <div class="col-sm-10">
  <div style="font-size: 35px;line-height: 10px;padding-top: 40px;font-style: italic;color:#286090">
     <?php echo $FirstName ;?>
     <?php echo $LastName ;?>
  </div>
     <h2>Change Your Password</h2>
  </div>
</div>

<?php include 'view.navbarprofile.php'; ?>

  <div class="col-xs-2" style="border-right: 1px solid #dddddd">
      <ol class="nav responsive-tabs myTab">
          <li class="active">
            <a class="leftTab" data-toggle="tab" href="#"><span class="glyphicon glyphicon-user"></span> Basic Info</a>
          </li>

          <li>
            <a class="leftTab" data-toggle="tab" href="#"><i class="fa fa-user-plus"></i> Additional Info</a>
          </li>
          <li>
            <a class="leftTab" data-toggle="tab" href="#"><span class=" glyphicon glyphicon-earphone"></span> Contact Info</a>
          </li>
          <li>
            <a class="leftTab" data-toggle="tab" href="#"><i class="fa fa-ambulance"></i> Emergency</a>
          </li>
  
          <li>
            <a class="leftTab" data-toggle="tab" href="#"><i class="fa fa-ambulance"></i> Medical &amp; Health</a>
          </li>

          <li>
            <a class="leftTab" data-toggle="tab" href="#"><span class=" glyphicon glyphicon-education"></span> Education</a>
          </li>
        
          <li>
            <a class="leftTab" data-toggle="tab" href="#"><i class="fa fa-cogs"></i> Settings</a>
          </li>

          <li>
            <a class="leftTab" data-toggle="tab" href="#"><i class="fa fa-fw fa-key"></i> Change Password</a>
          </li>
          <li>
            <a data-toggle="tab" href="#"><i class="fa fa-user-times"></i> Merge Accounts</a>
          </li>
      </ol>  
  </div>
   <div class="col-xs-2"></div>
   <div class="col-xs-6"> 
     <form  role="form" method="post">  
     <legend>Reset Your Password</legend>      
           <?php 
              if (isset($_POST['changpass'])) {
                echo $msg;
              }
            ?>          
               <div class="form-group">                
                    <label for="old_pass">Old Password :</label> 
                    <input type="password" name="old_pass" class="form-control">                
               </div>

               
               <div class="form-group">                
                    <label for="password">New Password :</label> 
                    <input type="password" name="password" class="form-control">                
               </div>

               <button type="submit" name="changpass" class="btn btn-success">Update</button>          
      </form>    
    </div>
    <div class="col-xs-2"></div>
</div>
    
  
<?php include 'footer.php';  ?>