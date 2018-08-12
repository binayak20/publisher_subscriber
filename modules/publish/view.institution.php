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
     <h2>Create Organization</h2>
  </div>
</div>

<?php include 'view.navinstitution.php'; ?>

		<div class="row" style="height: 500px;">	
    <?php include 'view.insidebar.php'; ?>
		<div class="col-xs-2"></div>
		<div class="col-xs-6">
			<div style="background: #FFFFFF;padding: 20px">
			<form role="form" method="post" enctype="multipart/form-data">
			<!--<h3 style="color: #286090;padding-left: 120px" >Add Institution</h3>-->
               <legend style="color: #286090;">Add Institution</legend>
				<?php 
	           		if (isset($_POST['save_institution']) || isset($_POST['update_institution'])) {
	           			echo $msg;
	           		  }
	            ?>
					
					<div class="form-group"> 
					    <label for="name">Institution Name :</label> 
						<input type="name" name="name" placeholder="Institution Name"  class="form-control" value="<?php if(isset($_GET['edit'])) echo $globalInstitution->getName();  ?>" />
					</div>

					<div class="form-group" >
					    <label for="name">Address :</label> 
						<input type="address" name="address" placeholder="Address"  class="form-control" value="<?php 
						if(isset($_GET['edit'])) echo $globalInstitution->getAddress();  ?>" />
					</div>
					<div class="form-group">
						 <label for="name">Description :</label> 
							<textarea type="description" name="description" placeholder="Write short description" class="form-control"  value ="<?php if(isset($_GET['edit'])) echo $globalPublisher->getDescription(); ?>" rows="3"></textarea>
					</div>
					<div class="form-group" >                
                         <label for="image">Institute image :</label> 
	                     <div>   
	                        <input type="file" name="image"/>       
	                     </div>              
                    </div>
					
							<?php
							if(isset($_GET['edit']))
							{
								?>
								<button type="submit" name="update_institution" class="btn btn-success">update</button>
								<?php
							}
							else
							{
								?>
								<button type="submit" name="save_institution"  class="btn btn-success">save</button>
								<?php
							}
							?>
					
				
			</form>
			</div>
		</div>
		<div class="col-xs-2">

		</div>
	</div>
	</div>

<?php include 'footer.php';  ?>