<?php include 'header.php'; ?>
<?php
include_once 'blade/view.institution.blade.php';
include_once 'blade/view.subcategory.blade.php';
include_once 'blade/view.user.blade.php';
include_once '/../../common/class.common.php';
ob_start();

if (session_status() == PHP_SESSION_NONE) {
  session_start();
  $ID   =  $_SESSION['globalUser']->getID();
  $Name = $_SESSION['globalUser']->getFirstName();
}
else
{
  $ID  =  $_SESSION['globalUser']->getID();
  $Name= $_SESSION['globalUser']->getFirstName();
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
  <div style="font-size: 35px;line-height: 10px;padding-top: 40px;font-style: italic">
     <?php echo $FirstName ;?>
     <?php echo $LastName ;?>
  </div>
     <h2>My Institution or Organization</h2>
  </div>
</div>

<?php include 'view.navinstitution.php'; ?>

		<div class="row" style="background: #F5F6F7;padding: 10px;height: 700px;">	
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
            <a class="leftTab" data-toggle="tab" href="#"><i class="fa fa-fw fa-key">
            </i>ChangePassword</a>
          </li>
          <li>
            <a data-toggle="tab" href="#"><i class="fa fa-user-times"></i> Merge Accounts</a>
          </li>
      </ol>  
  </div>
		<div class="col-xs-6">
    <div style="background: #FFFFFF;padding: 20px">
      <form role="form" method="post" enctype="multipart/form-data">
      <!--<h3 style="color: #286090;padding-left: 120px" >Add Institution</h3>-->
      
      <?php 
          if (isset($_POST['update_institution'])) {
            echo $msg;
          }
       ?>
       <?php 
            if(isset($_GET['edit']))
              {
        ?> 
        <legend style="color: #286090;">Update Institution</legend>    
          <div class="form-group"> 
              <label for="name">Institution Name :</label> 
            <input type="name" name="name" placeholder="Institution Name"  class="form-control" value="<?php if(isset($_GET['edit'])) echo $globalInstitution->getName();  ?>" />
          </div>

          <div class="form-group" >
              <label for="name">Address :</label> 
            <input type="address" name="address" placeholder="Address"  class="form-control" value="<?php 
            if(isset($_GET['edit'])) echo $globalInstitution->getAddress();  ?>" />
          </div>
          <div class="form-group" >                
               <label for="image">Institute image :</label> 
                   <div>  
                      <a href=""><img src="<?php if(isset($_GET['edit'])) echo $globalInstitution->getImage(); ?>" height="120px" width="130px"/></a>          
                   </div>              
          </div>
           <div class="form-group" >                
                  <div>
                     <input type="file" name="image"/>
                  </div>              
          </div>

            <button type="submit" name="update_institution" class="btn btn-success">update</button>
             
          <?php } ?>
        
      </form>
      </div>

      
			<div style="background: #FFFFFF;padding: 20px">
      <legend style="color: #286090;">My Institution</legend>  
				<table class="table table-bordered">
						<?php			
						$Result = $_InstitutionBAO->getInstitution($ID);

						//if DAO access is successful to load all the users then show them one by one
						if($Result->getIsSuccess()){

							$InstitutionList = $Result->getResultObject();
						?>
							<tr class="success">
								<!--<td>ID</td>
								<td>UserID</td>-->
								<td>Institute Name</td>
								<td>Address</td>
								<td>Edit</td>
								<td>Delete</td>
							</tr>
							<?php
							for($i = 0; $i < sizeof($InstitutionList); $i++) {
								$Institution = $InstitutionList[$i];
								?>
							    <tr>
								    <!--<td><?php //echo $Institution->getID(); ?></td>
								    <td><?php //echo $Institution->getUserID(); ?></td>-->
								    <td><?php echo $Institution->getName(); ?></td>
								    <td><?php echo $Institution->getAddress(); ?></td>
								    <td><a href="?edit=<?php echo $Institution->getID(); ?>" onclick="return confirm('sure to edit !'); " >edit</a></td>
								    <td><a href="?del=<?php echo $Institution->getID(); ?>" onclick="return confirm('sure to delete !'); " >delete</a></td>
							    </tr>
						    <?php

							}

						}
						else{

							echo $Result->getResultObject(); //giving failure message
						}

						?>
				</table>
			</div>
		</div>	
    <div class="col-xs-4"></div>
	</div>
	</div>

<?php include 'footer.php';  ?>