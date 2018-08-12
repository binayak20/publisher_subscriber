<?php include 'header.php'; ?>
<?php  
include_once 'blade/view.institution.blade.php';
include_once 'blade/view.subcategory.blade.php';
include_once 'blade/view.user.blade.php';
include_once '/../../common/class.common.php';
$count=0;
ob_start();

if (session_status() == PHP_SESSION_NONE) {
  session_start();

  $ID   =  $_SESSION['globalUser']->getID();
  $Name = $_SESSION['globalUser']->getFirstName();
}
else
{
  $ID   =  $_SESSION['globalUser']->getID();
  $Name = $_SESSION['globalUser']->getFirstName();
  //echo $ID;
 // echo $Name;
}
?>
<?php 
    $loginmsg = Session::get("loginmsg");
    if (isset($loginmsg)) {
      echo $loginmsg;
    }
    Session::set("loginmsg",NULL);
 ?>
 <style type="text/css">
    .navbar-inner ul{margin:0;padding: 0;list-style: none;border: 1px solid #ddd; }
    .navbar-inner ul li{display: block;float: left;}
    .post1{display: block;float: left; }
    .row_image {
  width: 100%;
  margin: 0 auto;
}
.block {
  width: 310px;
  display: inline-block;
  padding-bottom: 50px;
  padding-right: 120px;
}
.block p{line-height: 0;
font-style: italic;
font-weight: bold;}
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
  <div style="font-size: 35px;line-height: 10px;padding-top: 40px;font-style: italic">
     <?php echo $FirstName ;?>
     <?php echo $LastName ;?>
  </div>
     <h2>My Dashboard</h2>
  </div>
</div>

<?php include 'view.navbarprofile.php'; ?>
      <div class="row">
          <div class="col-sm-2" >
            
          </div>
          <div class="col-sm-10">
        
          <legend><h3>Recent Post</h3></legend>
          
              <div class="row_image" class="block">

                  <div class="block" >
                    <p>Publisher:</p><br>
                    <p>Organization:</p><br>
                    <p>Group:</p><br>
                    <img src="recent.jpg" height="150" width="220"/>
                  </div>
                  
                  <div class="block">
                    <p>Publisher:</p><br>
                    <p>Organization:</p><br>
                    <p>Group:</p><br>
                    <img src="recent.jpg" height="150" width="220"/>
                  </div>
                  
                  <div class="block" >
                    <p>Publisher:</p><br>
                    <p>Organization:</p><br>
                    <p>Group:</p><br>
                    <img src="recent.jpg" height="150" width="220"/>
                  </div>

                  <div class="block">
                    <p>Publisher Name:</p><br>
                    <p>Organization Name:</p><br>
                    <p>Group Name:</p><br>
                    <img src="recent.jpg" height="150" width="220"/>
                  </div>

                  <div class="block" >
                    <p>Publisher Name:</p><br>
                    <p>Organization Name:</p><br>
                    <p>Group Name:</p><br>
                    <img src="recent.jpg" height="150" width="220"/>
                  </div>

                  <div class="block">
                    <p>Publisher Name:</p><br>
                    <p>Organization Name:</p><br>
                    <p>Group Name:</p><br>
                    <div style="height: 150px;width: 220px;border:solid 1px black;background-color:white;">
                        <p style="text-align: center;padding-top: 75px;height: 150px;width: 220px;">Hello This is Khulna University,Bnagladesh.Only politics free campus in Bangladesh.</p>
                    </div>
                  
                  </div>
                 
              </div>

              <legend><h3>Previous Post</h3></legend>
          
              <div class="row_image" class="block">
                  <div class="block" >
                    <p>Publisher Name:</p><br>
                    <p>Organization Name:</p><br>
                    <p>Group Name:</p><br>
                    <img src="recent.jpg" height="150" width="220"/>
                  </div>

                  <div class="block">
                    <p>Publisher Name:</p><br>
                    <p>Organization Name:</p><br>
                    <p>Group Name:</p><br>
                    <img src="recent.jpg" height="150" width="220"/>
                  </div>

                  <div class="block" >
                    <p>Publisher Name:</p><br>
                    <p>Organization Name:</p><br>
                    <p>Group Name:</p><br>
                    <img src="recent.jpg" height="150" width="220"/>
                  </div>

                  <div class="block">
                    <p>Publisher Name:</p><br>
                    <p>Organization Name:</p><br>
                    <p>Group Name:</p><br>
                    <img src="recent.jpg" height="150" width="220"/>
                  </div>

                  <div class="block" >
                    <p>Publisher Name:</p><br>
                    <p>Organization Name:</p><br>
                    <p>Group Name:</p><br>
                    <img src="recent.jpg" height="150" width="220"/>
                  </div>

                  <div class="block">
                    <p>Publisher Name:</p><br>
                    <p>Organization Name:</p><br>
                    <p>Group Name:</p><br>
                    <img src="recent.jpg" height="150" width="220"/>
                  </div>
                 
              </div>
          </div>
         
      </div>
  </div>

<?php include 'footer.php';  ?>
