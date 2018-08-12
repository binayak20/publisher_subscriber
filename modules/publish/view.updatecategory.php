<?php include 'header.php'; ?>
<?php

include_once 'blade/view.subcategory.blade.php';
include_once '/../../common/class.common.php';
//include_once 'blade/view.institution.blade.php';
//include_once 'blade/view.user.blade.php';
ob_start();
if (session_status() == PHP_SESSION_NONE) {
	session_start();
	//$_SESSION["globalUser"]=$globalUser;
    $ID  =  $_SESSION['globalUser']->getID();
}
else
{
	//$_SESSION["globalUser"]=$globalUser;
    $ID  =  $_SESSION['globalUser']->getID();
}

?>
<?php 
	 if (isset($_GET['InstituteId'])) {
	    $Ins_ID = $_GET['InstituteId'];
	   echo $Ins_ID;
	}
 ?>

	<div id="header">
		<!--<label>By : Kazi Masudul Alam</label>-->
	</div>

	<div class="container">
	<div class="col-xs-4"></div>
	<div class="col-xs-4">
		<form role="form" method="post">
		<h3 style="color: #286090;padding-left: 100px" >Add Category</h3>
		<?php 
			if (isset($_POST['save'])){
			   echo $msg;
			 }
		 ?>
			
				<div class="form-group"> 
					<input type="name" name="txtName" class="form-control" placeholder="Category Name" value="<?php 
					if(isset($_GET['edit'])) echo $globalCategory->getName();  ?>" />
				</div>

					<select name="parentId" class="form-control">
					<?php
						$Result = $_SubcategoryBAO->getAllSubcategory($ID,$Ins_ID);
						if ($Result->getIsSuccess()){

							$SubcategoryList = $Result->getResultObject();
							for ($i = 0; $i<sizeof($SubcategoryList); $i++){
							$Subcategory = $SubcategoryList[$i];				
			     	?>
						<option value="<?php echo $Subcategory->getCatID();?>" > <?php echo $Subcategory->getName(); ?> 
						</option>	
					
				<?php } }	
							
					?>	

				</select>
				
				
				<div style="padding-top: 10px">
						<?php
						if(isset($_GET['edit']))
						{
							?>
							<button type="submit" name="update" class="btn btn-success">update</button>
							<?php
						}
						else
						{
							?>
							<button type="submit" name="save" class="btn btn-success" >save</button>
							<?php
						}
						?>
				
			</div>
		</form>
		</div>
		<div class="col-xs-4"></div>
	<table class="table table-bordered">
	</div>
<?php include 'footer.php';  ?>