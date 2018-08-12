<?php include 'header.php'; ?>
<?php

include_once 'blade/view.publishnotice.blade.php';
include_once 'blade/view.subcategory.blade.php';
include_once '/../../common/class.common.php';
	  ob_start();
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			$a = $_SESSION['globalUser']; 
			//echo $a->getID();
		}
		else
		{
		 $a = $_SESSION['globalUser'];
		 //echo $a->getID();

		}
$i = 0;
?>
<?php 
	/*if (!isset($_GET['edit']) || $_GET['edit'] == NULL ) {
		echo "<script>window.location = view.publishnotice.php</script>";
	}
	else{
		$NoticeId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['edit']);
	}*/
?>

     
	<div id="header">
		<!--<label><a>By : Kazi Masudul Alam</a></label>-->
	</div>
<div class="container">
	<div class="col-sm-3">
		<div style="background: #F5F6F7;height: 600px; padding: 20px">
		</div>
	</div>
	<div class="col-sm-6">
		<div style="background: #F5F6F7;height: 600px; padding: 20px">
			<h3 style="color: #286090;padding-left: 150px" >Post Something</h3>
			<?php 
	           if (isset($_POST['update_notice'])) {
	           		echo $msg;
	           	  }
                ?>
			<form role="form" method="post" >		
				<div style="background: #ddd;padding: 20px">
					<div class="form-group">
						<input type="notice" name="notice" class="form-control" value="<?php if(isset($_GET['edit'])) echo $globalPublisher->getNotice(); ?>" rows="5"/>
					</div>
				</div>

				<div>
					<button type="submit" name="update_notice" class="btn btn-success">update</button>
				</div>	
			</form>	
		</div>
	</div>
	<div class="col-sm-3">
		<div style="background: #F5F6F7;height: 600px;width:300px ; padding: 20px">
			   <button class="btn btn-info" type="button" style="width: 250px;"><span>Creat Notice</span></button>
		       <div style="padding: 10px;font-size: 15px">
		              <?php 
		                  $Result = $_SubcategoryBAO->getPublisherSubcategory($ID);
		                  if($Result->getIsSuccess()){

		                  $SubcategoryList = $Result->getResultObject();
		                  for ($i = 0; $i<sizeof($SubcategoryList); $i++){
		                      $Subcategory = $SubcategoryList[$i];
		              ?>
		                <a href='view.publishnotice.php?categoryId=<?php echo $Subcategory->getCatID();?>'><?php echo $Subcategory->getName();?></a></br>
		                 <?php 
		                 }     
		               }
		               ?>
		        </div>
		</div>
	</div>
</div>
		

<div class="container">
	<table class="table table-bordered">
	<?php
	
	
	$Result = $_NewPublisherBAO->getAllNoticeByPiblisherID($a->getID());

	//if DAO access is successful to load all the users then show them one by one
	if($Result->getIsSuccess()){

		$NoticeList = $Result->getResultObject();
	?>
		<tr class="success">
			<td>ID</td>
			<td>Child Category ID</td>
			<td>Publisher Cat ID</td>
			<td>Publisher ID</td>
			<td>Notice</td>
			<!--<td>Edit</td>
			<td>Delete</td>-->
			
		</tr>
		<?php
		for($i = 0; $i < sizeof($NoticeList); $i++) {
			$Notice = $NoticeList[$i];
			?>
		    <tr>
			    <td><?php echo $Notice->getID(); ?></td>
			    <td><?php echo $Notice->getChildCatID(); ?></td>
			    <td><?php echo $Notice->getPubCatID(); ?></td>
			    <td><?php echo $Notice->getPublisherID(); ?></td>
			    <td><?php echo $Notice->getNotice(); ?></td>
			    
			    <!--<td><a href="?edit=<?php //echo $Notice->getID(); ?>&categoryId=<?php //echo $Notice->getPubCatID(); ?>" onclick="return confirm('sure to edit !'); " >edit</a></td>
			    <td><a href="?delete=<?php //echo $Notice->getID(); ?>" onclick="return confirm('sure to delete !'); " >delete</a></td>-->
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
<?php include 'footer.php';  ?>