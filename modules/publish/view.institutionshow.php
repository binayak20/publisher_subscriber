<?php include 'header.php'; ?>
<?php 
   if (!isset($_GET['InstituteId']) || !isset($_GET['organizerId']) || $_GET['InstituteId'] == NULL) {
        header("Location:view.404.php");
     } else{
        $InsId   = $_GET['InstituteId'];
     }
?>
<?php
include_once 'blade/view.institution.blade.php';
include_once 'blade/view.request.blade.php';
include_once 'blade/view.subcategory.blade.php';
include_once 'blade/view.addsubscriber.blade.php';
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
	<?php 
		// if (isset($_GET['InstituteId'])) {
		// 	$InsId   = $_GET['InstituteId'];
			
		// }
	 ?>

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
	    <div class="col-sm-9" >
	         <a href=""><img src="<?php echo $Institution->getImage(); ?>" height="240px" 
	         width="830px"/></a>	  
		</div>
		<div class="col-sm-3">
			
				<button class="btn btn-success" style="width: 160px;">Organizer/Admin</button></br>
				<div style="padding: 5px">
				<a style="padding-top: 5px;" href=""><img src="<?php echo $_InstitutionBAO->getOrganizerImage($Institution->getUserID()); ?>" height="140px" width="150px"  /></a>
				</div>
				<div style="font-size: 25px;padding-top: 4px;font-style: italic;font-weight: bold">
				    <?php echo $_InstitutionBAO->getOrganizerName($Institution->getUserID()); ?>
				</div>
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
			<form class="form" method="post">
              <label style="color: #286090;">Select Group to be Publisher/Subscriber</label>
              <?php 
                if (isset($_POST['request']) || isset($_POST['request_publisher'])) {
                   echo $msg;
                  }
              ?>
	            <select name="catid" class="form-control">
	            <?php 
	                  $Result = $_SubcategoryBAO->getInstituteSubcategory($InsId);
	                  if($Result->getIsSuccess()){

	                  $SubcategoryList = $Result->getResultObject();
	                  for ($i = 0; $i<sizeof($SubcategoryList); $i++){
	                      $Subcategory = $SubcategoryList[$i];
	              ?>
	               <option value="<?php echo $Subcategory->getCatID();?>"><?php echo $Subcategory->getName();?></option>
	                 <?php 
	                 }     
	               }
	               ?>
	            </select><br>
               <button style="margin-left: 170px" type="submit" class="btn btn-sm btn-success" name="request">+Join Subscriber</button>
               <button type="submit" class="btn btn-sm btn-success" name="request_publisher">+Join Publisher</button>
            </form><br>
          
            <?php 
                  $Result = $_SubcategoryBAO->getInstituteSubcategory($InsId);
                  if($Result->getIsSuccess()){

                  $SubcategoryList = $Result->getResultObject();
                  for ($i = 0; $i<sizeof($SubcategoryList); $i++){
                      $Subcategory = $SubcategoryList[$i];
              ?>
            <div class="row" style="background-color: #ddd;padding-top: 10px;margin-left: 5px;padding-bottom: 10px;margin-right: 5px">
                  <div class="col-sm-2">     
                    <img src="<?php echo $Subcategory->getImage();?>" height="70px" width="70px"/>
                  </div>
                  <div class="col-sm-10" style="">
                     <p style="padding-left: 10px;font-weight: bold">Group Name :<a href=""> <?php echo $Subcategory->getName();?></a></p>
                     <p style="padding-left: 10px;font-weight: bold">Publisher :<a href=""> <?php echo $_SubcategoryBAO->getPublisgerFromCatID($Subcategory->getCatID());?></a></p>
                  </div>
            </div><br>
              <?php 
                 }     
               }
               ?>
         
		</div>
      <div class="col-sm-3">
          <div style="background: #F5F6F7;height: 600px;">
               <p style="color:#fff;font-size: 18px;padding: 5px;background-color: #449D44;width: 253px;position: center;margin-left: 5px;margin-top: 15px"><span style="margin-left: 65px">All Subscriber</span></p>
               <?php 
                  $Result = $_SubcategoryBAO->getAllSubscriberFromInstitution($InsId);
                    if($Result->getIsSuccess()){

                    $SubscriberList = $Result->getResultObject();
                    for ($i = 0; $i<sizeof($SubscriberList); $i++){
                        $Subscriber = $SubscriberList[$i];
                ?>
              <div class="row" style="background-color: #ddd;padding-top: 10px;margin-left: 4px;padding-bottom: 10px;margin-right: 5px">
                  <div class="col-sm-2">     
                    <img src="<?php echo $_AddSubscriberBAO->getSubscriberImage($Subscriber->getSubscriberID()); ?>" height="65px" width="60px"/>
                  </div>
                  <div class="col-sm-10" style="">
                     <p style="padding-left: 10px;font-weight: bold;margin-left: 20px"><a href=""><?php echo $_AddSubscriberBAO->getNamefromSubscriberID($Subscriber->getSubscriberID()); ?></a></p>
                     <p style="padding-left: 10px;font-weight: bold;margin-left: 20px"><a href=""><?php echo  $_AddSubscriberBAO->getGroupNameFromCatID($Subscriber->getCategoryID());?></a></p>
                     
                  </div>
            </div><br>
            <?php } } ?>
          </div>
      </div>
	</div>
</div>
<script type="text/javascript">
      genAllParents();
    </script>
<?php include 'footer.php';  ?>
