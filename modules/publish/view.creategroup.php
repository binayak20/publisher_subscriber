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
  $ID   =  $_SESSION['globalUser']->getID();
  $Name = $_SESSION['globalUser']->getFirstName();
}
?>
<?php 
   if (isset($_GET['InstituteId'])) {
      $Ins_ID = $_GET['InstituteId'];
     // echo $Ins_ID;
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
     <h2>Create Group Under Organization</h2>
  </div>
</div>

<?php include 'view.navinstitution.php'; ?>

		<div class="row" style="height: 500px;">	
    <?php include 'view.insidebar.php'; ?>
		<div class="col-xs-6">
    <div class="dropdown">
              <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" style="width: 550px;">To create Group Select Institution
              <span class="caret"></span></button>
              <ul class="dropdown-menu" style="width: 525px;">
               <?php 
               $Result = $_InstitutionBAO->getInstitution($ID);
                 if($Result->getIsSuccess()){

                  $InstitutionList = $Result->getResultObject();
                  for ($i = 0; $i<sizeof($InstitutionList); $i++){
                    $Institution = $InstitutionList[$i];
                   ?>
                  <li><a href='view.creategroup.php?InstituteId=<?php echo $Institution->getID();?>&InsName=<?php echo $Institution->getName(); ?>'><?php echo $Institution->getName();?></a></li>
                  <?php   
                  }     
                }
                  ?>
              </ul>       
           </div>
      <?php 
         if (isset($_GET['InstituteId']) && isset($_GET['InsName'])) {
            $InsID   = $_GET['InstituteId']; 
            $InsName = $_GET['InsName']; 
       ?>
       
    <form role="form" method="post">
        <legend style="color: #286090;padding-left: 100px;padding-top: 30px">Create Group Under <?php  echo $InsName;?></legend>
        <?php 
          if (isset($_POST['save_cat'])){
             echo $msg;
           }
         ?>
      
        <div class="form-group"> 
          <input type="name" name="txtName" class="form-control" placeholder="Category Name" value="<?php 
          if(isset($_GET['edit'])) echo $globalCategory->getName();  ?>" />
        </div>

        <select name="parentId" class="form-control">
          <?php
            $Result = $_SubcategoryBAO->getAllSubcategoryWithRoot($ID,$Ins_ID);
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
              <button type="submit" name="update_cat" class="btn btn-success">update</button>
              <?php
            }
            else
            {
              ?>
              <button type="submit" name="save_cat" class="btn btn-success" >save</button>
              <?php
            }
            ?>
        
      </div>
    </form>
     <legend style="color: #286090;padding-left: 100px;padding-top: 30px">All Groups Under <?php  echo $InsName;?></legend>
    <table class="table table-bordered">
  <?php
  
  //echo $Ins_ID;
  $Result = $_SubcategoryBAO->getAllSubcategory($ID,$Ins_ID);
  //echo $Ins_ID;
  //if DAO access is successful to load all the Roles then show them one by one
  if($Result->getIsSuccess()){

    $SubcategoryList = $Result->getResultObject();
  ?>
    <tr class="success">
      <!--<td>CatId</td>
      <td>User ID</td>
      <td>Institution ID</td>-->
      <td>Group Name</td>
      <!--<td>Parent ID</td>-->
      <td>Edit</td>
      <td>Delete</td>
      
    </tr>
    <?php
    for($i = 0; $i < sizeof($SubcategoryList); $i++) {
      $Subcategory = $SubcategoryList[$i];
      
      ?>
        <tr>
          <!--<td><?php //echo $Subcategory->getCatID(); ?></td>
          <td><?php //echo $Subcategory->getUserID(); ?></td>
          <td><?php //echo $Subcategory->getInstituteID(); ?></td>-->
          <td><?php echo $Subcategory->getName(); ?></td>
          <!--<td><?php //echo $Subcategory->getParentID(); ?></td>-->
          <td><a href="?edit=<?php echo $Subcategory->getCatID(); ?>&InstituteId=<?php echo $Subcategory->getInstituteID(); ?> &InsName=<?php echo $Institution->getName(); ?>" onclick="return confirm('sure to edit !'); " >edit</a></td>
          <td><a href="?del=<?php echo $Subcategory->getCatID(); ?>&InstituteId=<?php echo $Subcategory->getInstituteID(); ?> " onclick="return confirm('sure to delete !'); " >delete</a></td>
        </tr>
      <?php

    }
  }
  else{

    echo $Result->getResultObject(); //giving failure message
  }

  ?>
  </table>
    <?php } ?>
		</div>
		<div class="col-xs-4">

		</div>
	</div>
	</div>

<?php include 'footer.php';  ?>