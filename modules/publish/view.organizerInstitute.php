<?php include 'header.php'; ?>
<?php 
   if (!isset($_GET['InstituteId']) || !isset($_GET['InsName']) || $_GET['InstituteId'] == NULL) {
        header("Location:view.404.php");
     } else{
          $InsId = $_GET['InstituteId'];
          $InsName = $_GET['InsName']; 
     }
?>
<?php 
    // if (isset($_GET['InstituteId']) || isset($_GET['InsName'])) {
    //   $InsId = $_GET['InstituteId'];
    //   $InsName = $_GET['InsName']; 
    // }
include_once 'blade/view.institution.blade.php';
include_once 'blade/view.request.blade.php';
include_once 'blade/view.subcategory.blade.php';
include_once '/../../common/class.common.php';
	  ob_start();
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			$a = $_SESSION['globalUser']; 
			 $ID   =  $_SESSION['globalUser']->getID();
			//echo $a->getID();
		}
		else
		{
		 $a = $_SESSION['globalUser'];
		  $ID   =  $_SESSION['globalUser']->getID();
		// echo $a->getID();

		}
?>  
	<div id="header">
		<!--<label><a>By : Kazi Masudul Alam</a></label>-->
	</div>

	 <style type="text/css">
        .tree
      {
        /*position: center;*/
        /*top: 100px;*/
       /* left: 40%;*/
      }
      .dinline
      {
        display: inline-block;
      }

      div h2,h3, h4, h5, h6
      {
        margin-top: 5px;
        margin-bottom: 5px;
        cursor: pointer;
        font-size: 16px;
      }
      .childs
      {
        margin-left: 20px;
      }
      h2,h3, h4, h5, h6
      {
        display: inline-block;
      }
      </style>

      <script type="text/javascript">
        var datas = [];
        <?php
          $db = DBUtil::getInstance();
          $res = $db->doQuery("SELECT * FROM tbl_child_cat WHERE InstituteID = '".$InsId."'");
          $rows = $db->getAllRows();
          // var_dump($rows);
          foreach ($rows as $row) {
            echo 'datas.push({name:'.'"'.htmlentities($row['Name']).'"'.', id:'."'".$row['CatID']."'".', pid:'."'".$row['ParentID']."'".'}); ';
            // echo "<br>";
          }
        ?>

      var tstart = null;

      function hasChild(node,name)
      {
        var cid = getIdFromName(name);
        for(var i=0;i<datas.length;++i)
        {
          if(datas[i].pid == cid)
          {
            return true;
          }
        }
        return false;
      }

      function getIdFromName(name)
      {
        for(var i=0;i<datas.length;++i)
        {
          if(datas[i].name == name)
          {
            return datas[i].id;
          }
        }
      }

      function appendAllChild(parent,id)
      {
        for(var i=0;i<datas.length;++i)
        {
          if(datas[i].pid == id)
          {
            var chld = createChild(datas[i].name);
            parent.appendChild(chld);
            parent.childNodes[0].innerHTML = '-&nbsp;';
          }
        }
      }

      function genAllParents()
      {
        tstart = document.createElement('div');
        tstart.setAttribute('class','gparent');
        tstart.setAttribute('id','gparent');

        for(var i=0;i<datas.length;i++)
        {
          if(datas[i].pid == 0)
          {
            //console.log("Here");
            var getParent = createParent(datas[i].name);
            //console.log(getParent);
            tstart.appendChild(getParent);
          }
        }
        console.log(tstart);
        document.getElementById('tree').appendChild(tstart);
      }

      function createChild(name)
      {
        var child = document.createElement('div');
        child.setAttribute('class','childs');
        // var icon = document.createElement('div');
        // icon.setAttribute('class','dinline');
        // icon.innerHTML = '&rarr;';
        if(hasChild(child,name))
        {
          var sign = createTitle('p','+&nbsp;');
          sign.setAttribute('id','sign');
          sign.setAttribute('onclick','onClick(this);');
          child.appendChild(sign);
        }
        //var childnode = document.createElement('div');
        //childnode.setAttribute('class','dinline');
        child.appendChild(createTitle('c',name));
        //child.appendChild(icon);
        //child.appendChild(childnode);
        return child;
      }
       function createParent(name)
       {
        //console.log("p");
        var parent = document.createElement('div');
        parent.setAttribute('class','parents');

        if(hasChild(parent,name))
        {
          var sign = createTitle('p','+&nbsp;');
          sign.setAttribute('id','sign');
          sign.setAttribute('onclick','onClick(this);');
          parent.appendChild(sign);
        }

        parent.appendChild(createTitle('p',name));
        console.log(parent);
        return parent;
       }

       function createTitle(p,name)
       {
        var title = null;
        if(p=="c")
        {
          title = document.createElement('h3');
        }
        else
        {
          title = document.createElement('h2');
        }
        title.innerHTML = name;
        var link = document.createElement('a');
        link.setAttribute('href','#');
        link.appendChild(title);
        console.log(link);
        if(name[0] === '-' || name[0]=== '+') return title;
        return link;
       }

       function onClick(elm)
       {
        console.log("all ok");
        //console.log(elm);

        var pnode = elm.parentNode;
        console.log(pnode);
        //console.log(pnode.parentNode);
        console.log(pnode.childElementCount);
        if(pnode.childElementCount < 3)
        {
          var name;
          if(pnode.childElementCount==1)
          {
            name = pnode.childNodes[0].childNodes[0].innerHTML;
          }
          else
          {
              name = pnode.childNodes[1].childNodes[0].innerHTML;
          }
          var id = getIdFromName(name);
          appendAllChild(pnode,id);
        }
        else
        {

          var del = pnode.childNodes[2];
          while(del)
          {
            pnode.removeChild(del);
            del = pnode.childNodes[2];
          }
          pnode.childNodes[0].innerHTML = '+&nbsp;';
        }
       }

       </script>
   
 <style type="text/css">
    .navbar-inner ul{margin:0;padding: 0;list-style: none;border: 1px solid #ddd; }
    .navbar-inner ul li{display: block;float: left;}
 </style>
  <?php 
        $Result = $_InstitutionBAO->getInstitutionByID($InsId);
        if($Result->getIsSuccess()){

          $InstitutionList = $Result->getResultObject();
          for ($i = 0; $i<sizeof($InstitutionList); $i++){
              $Institution = $InstitutionList[$i];
            
            }     
          }
    ?> 
<div class="container">
	<div class="row">
    <div class="col-sm-3">    
        <button class="btn btn-success" style="width: 160px;">Organizer/Admin</button>
        <div style="padding: 5px">
        <a style="padding-top: 5px;" href=""><img src="<?php echo $_InstitutionBAO->getOrganizerImage($Institution->getUserID()); ?>" height="140px" width="150px"  /></a>
        </div>
        <div style="font-size: 25px;padding-top: 4px;font-style: italic;font-weight: bold">
            <?php echo $_InstitutionBAO->getOrganizerName($Institution->getUserID()); ?>
        </div>
    </div>
	  <div class="col-sm-9" >
	         <a href=""><img src="<?php echo $Institution->getImage(); ?>" height="240px" 
	         width="830px"/></a>	  
		</div>
  </div>

	 <div class="row">
	    <div class="col-sm-12">
	      <div id="user-nav" class="navbar" style="padding-top: 20px">
	        <div class="navbar-inner">   
	            <ul class="nav">
	                <li class="active">
	                  <a href="home.php" ><span class="glyphicon glyphicon-dashboard"></span>Dashboard</a>    
	                </li>
	           
	                <li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                      <span class="glyphicon glyphicon-user"></span> Profile <b class="caret"></b>
	                    </a>
	                    <ul class="dropdown-menu">
	                      <li><a tabindex="0" href="view.userprofile.php">View Profile</a></li>
	                      <li class="divider"></li>
	                      <li><a tabindex="0" href="view.userprofile.php?edit=<?php echo $ID; ?>">Edit Profile</a></li>

	                     <li><a tabindex="0" href="view.changepassword.php?changpass=<?php echo $ID ; ?>">Change Password</a></li>

	                      <li class="divider"></li>
	                      <li><a tabindex="0" href="#">Invite Friends</a></li>
	                    </ul>
	                </li>
                   <li class="active">
                    <a href="view.allpublisher.php?InstituteId=<?php echo $Institution->getID();?>&InsName=<?php echo $Institution->getName(); ?>'" name="pub"><span class="glyphicon glyphicon-user"></span>Publisher<span style="color: red;font-weight: bold;"> <?php echo $_SubcategoryBAO->getPublisherCount($InsId); ?></span></a>
                  </li>

                   <!-- <li class="active">
                    <a href="#" ><span class="glyphicon glyphicon-user"></span>Subscriber<span style="color: red;font-weight: bold;">50</span></a>    
                  </li>  -->     
	            </ul>
	        </div>
	      </div>
	    </div>
	</div>
	<div class="row">
		<div class="col-xs-3" style="border-right: 1px solid #dddddd">
			
	        <div style="background: #fff;height: 600px;padding: 20px">
		   <p style="color:#fff;font-size: 18px;padding: 5px;background-color: #449D44;width: 176px;position: center;padding-left: 42px">Tree View</p>
		        <div class="tree" id="tree">
		      <!-- <h1>Tree View</h1> -->
		        </div>
		       
		    </div>
		</div>
		<div class="col-xs-6">
      <form role="form" method="post" enctype="multipart/form-data">
        <legend style="color: #286090;padding-left: 100px;padding-top: 30px">Create Group Under <br> <?php  echo $InsName;?></legend>
        <?php 
          if (isset($_POST['save_cat'])){
             echo $msg;
           }
         ?>
         <?php 
          if (isset($_POST['edit'])){
             echo $msg;
           }
         ?>
      
        <div class="form-group"> 
           <label for="name">Group Name :</label>   
          <input type="name" name="txtName" class="form-control" placeholder="Category Name" value="<?php 
          if(isset($_GET['edit'])) echo $globalCategory->getName();  ?>" />
        </div>

        <label for="name">Parent Name :</label> 
        <select name="parentId" class="form-control">
          <?php
            $Result = $_SubcategoryBAO->getAllSubcategoryWithRoot($ID,$InsId);
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
        <div class="form-group" >                
           <label for="image">Image :</label> 
           <div>   
              <input type="file" name="image"/>       
           </div>              
        </div>
        
        
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

    <legend style="color: #286090;padding-left: 200px;padding-top: 30px">All Groups</legend>
        <?php 
          if (isset($_GET['pub'])) {
            echo "All Publisher";
          }
     ?>
  <table class="table table-bordered">
  <?php
  
  //echo $Ins_ID;
  $Result = $_SubcategoryBAO->getAllSubcategory($ID,$InsId);
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
		</div>

		<div class="col-xs-3" style="height: 600px;border: 1px solid gray; background-color: #fff">
      <div style="margin-top: 15px;margin-left: 5px">
       <p style="color:#fff;font-size: 18px;padding: 5px;background-color: #449D44;width: 176px;position: center;padding-left: 55px">Subscriber</p>
       <p>Subscriber: <?php echo $_SubcategoryBAO->getAllSubscriberCount($InsId); ?></p>
       <p>Fllowers:50</p>
       <p style="color:#fff;font-size: 18px;padding: 5px;background-color: #449D44;width: 176px;position: center;padding-left: 55px">Publisher</p>
       <p>Publisher: <?php echo $_SubcategoryBAO->getPublisherCount($InsId); ?></p>
       
       </div>
		</div>
	</div>
</div>
<script type="text/javascript">
      genAllParents();
    </script>
<?php include 'footer.php';  ?>
