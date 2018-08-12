<?php include 'header.php'; ?>
<?php  
include_once 'blade/view.user.blade.php';
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
     <h2>View and Update Your Account</h2>
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
            <a class="leftTab" data-toggle="tab" href="#"><i class="fa fa-fw fa-key"></i>ChangePassword</a>
          </li>
          <li>
            <a data-toggle="tab" href="#"><i class="fa fa-user-times"></i> Merge Accounts</a>
          </li>
      </ol>  
  </div>
   <div class="col-xs-1"></div>
   <div class="col-xs-7">
   <legend>Basic Profile Information</legend>
             <?php 
                if (isset($_GET['edit'])) {     
             ?>
      <div class="form-group" >                
            <label style="color: #286090">Profile image :</label> 
            <div >
              <?php
                  $Result = $_UserBAO->getUserProfileImage($ID);
                  if($Result->getIsSuccess()){

                  $UserImageList = $Result->getResultObject();
                  for ($i = 0; $i<sizeof($UserImageList); $i++){
                      $UserProfileImage = $UserImageList[$i];
                    
              ?>
              <a href=""><img src="<?php echo $UserProfileImage->getImage(); ?>" height="200px" width="180px"/></a>
              <?php } } ?>
             
            </div>              
    </div> 
    <form role="form" method="post" enctype="multipart/form-data">
         <table class="table table-bordered" style="width: 100px">
            <tr class="success">            
                <td><input type="file" name="image"/></td>
            </tr>

            <tr>              
                 <td><input type="submit" name="submit" value="Upload"/></td>
            </tr>
         </table>
     </form>
     <form role="form" method="post">
            
           
           <?php 
              if (isset($_POST['save'])) {
                echo $msg;
              }
            ?>
           <table>
               <label>First Name :</label>    
               <div class="form-group">  
                  <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>  
                    <input type="text" name="firstname" class="form-control" value="<?php 
                       if(isset($_GET['edit'])) echo $globalUser->getFirstName();  ?>">
                  </div>
               </div>

                <label>Last Name :</label> 
               <div class="form-group">
                  <div class="input-group"> 
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>   
                    <input type="text" name="lastname" class="form-control" value="<?php 
                       if(isset($_GET['edit'])) echo $globalUser->getLastName();  ?>">
                  </div>
               </div>

               <label>Email :</label> 
               <div class="form-group"> 
                  <div class="input-group">                 
                    <span class="input-group-addon">@</span>               
                    <input type="text" name="email" class="form-control" value="<?php 
                      if(isset($_GET['edit'])) echo $globalUser->getEmail();  ?>">
                  </div>
               </div>

               <label>Address :</label>
               <div class="form-group">
                  <div class="input-group">      
                    <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                    <input type="text" name="address" class="form-control" value="<?php 
                        if(isset($_GET['edit'])) echo $globalUser->getAddress();  ?>">
                  </div>
               </div>

               <button type="submit" name="update" class="btn btn-success">Update</button>   
           </table>
           <?php } else { ?>
        </form>  
        <?php 
          $Result = $_UserBAO->getLoginUser($ID);
          if($Result->getIsSuccess()){
            $UserList = $Result->getResultObject();
        ?>
          <?php
         
            for($i = 0; $i < sizeof($UserList); $i++) {
               $User = $UserList[$i];       
          ?> 
           
              <form role="form" method="post">
                <div class="form-group" >                
                    <label style="color: #286090">Profile image :</label> 
                    <div >
                      <?php
                          $Result = $_UserBAO->getUserProfileImage($ID);
                          if($Result->getIsSuccess()){

                          $UserImageList = $Result->getResultObject();
                          for ($i = 0; $i<sizeof($UserImageList); $i++){
                              $UserProfileImage = $UserImageList[$i];
                            
                      ?>
                      <a href=""><img src="<?php echo $UserProfileImage->getImage(); ?>" height="200px" width="180px"/></a>
                      <?php } } ?>
                     
                    </div>              
                </div>
                <div class="form-group" >                
                    <label style="color: #286090">First Name :</label> 
                    <div class="form-control"><?php echo $User->getFirstName(); ?></div>               
                </div>
                <div class="form-group">                
                    <label style="color: #286090">Last Name :</label> 
                    <div class="form-control"><?php echo $User->getLastName(); ?></div>               
                </div>
                <div class="form-group">                
                    <label style="color: #286090">Email :</label> 
                    <div class="form-control"><?php echo $User->getEmail(); ?></div>               
                </div>
                <div class="form-group">                
                    <label style="color: #286090">Address :</label> 
                    <div class="form-control"><?php echo $User->getAddress(); ?></div>               
                </div>

                <a href="view.userprofile.php?edit=<?php echo $User->getID(); ?>" onclick="return confirm('Are You Sure to Edit !'); ">
                       <button type="button" class="btn btn-primary" >Edit Profile</button></a>
              </form>
              
              <?php
            }
              }
                else{
                 echo $Result->getResultObject(); //giving failure message
                }
              }
                  ?>
      
    </div>
    <div class="col-xs-2"></div>
    </div>
<?php include 'footer.php';  ?>