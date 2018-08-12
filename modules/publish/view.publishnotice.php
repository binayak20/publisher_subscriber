<?php include 'header.php'; ?>
 <?php 
   if (!isset($_GET['categoryId'])  || !isset($_GET['catName']) || $_GET['categoryId'] == NULL ) {
        header("Location:view.404.php");
     } else{
           $catId = $_GET['categoryId']; 
     }
?>
<?php
include_once 'blade/view.institution.blade.php';
include_once 'blade/view.publishnotice.blade.php';
include_once 'blade/view.subcategory.blade.php';
include_once 'blade/view.addsubscriber.blade.php';
include_once '/../../common/class.common.php';

?>  
	<div id="header">
		<!--<label><a>By : Kazi Masudul Alam</a></label>-->
	</div>
	   <style type="text/css">
        .tree        /*position: center;*/

      {
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
          $res = $db->doQuery("SELECT * FROM tbl_child_cat where UserID = '".$ID."' ");
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
<div class="container">
	<div class="row">
		<div class="col-sm-3">	     
		<button class="btn btn-success" style="width: 160px;"><?php echo $_SubcategoryBAO->getGroupNameFromcatId($catId);?></button>
        <div style="padding: 5px">
        <a style="padding-top: 5px;" href=""><img src="<?php echo $_InstitutionBAO->getOrganizerImage($ID); ?>" height="140px" width="150px"  /></a>
        </div>
        <div style="font-size: 25px;padding-top: 4px;font-style: italic;font-weight: bold">
             <?php echo $FirstName ;?>
			     <?php echo $LastName ;?>
        </div>
		</div>

	    <div class="col-sm-9" >
	         <a href=""><img src="<?php echo $_SubcategoryBAO->getImageFromcatId($catId);?>" height="240px" 
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

               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user"></span> Publisher <b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a tabindex="0" href="#">Add Group</a></li> 
                    <li class="divider"></li>
                    <li><a tabindex="0" href="#">Search Group</a></li>
                    <li><a tabindex="0" href="#">My Impact</a></li>
                  </ul>
                </li> 
                 
                   <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="glyphicon glyphicon-education"></span> Create Notice <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                       
                      <?php 
                          $Result = $_SubcategoryBAO->getPublisherSubcategory($ID);
                          if($Result->getIsSuccess()){

                          $SubcategoryList = $Result->getResultObject();
                          for ($i = 0; $i<sizeof($SubcategoryList); $i++){
                                  $Subcategory = $SubcategoryList[$i];
                          ?>
                            <li><a href='view.publishnotice.php?categoryId=<?php echo $Subcategory->getCatID();?>'><span style=""><?php echo $Subcategory->getName();?></span></a></li>
                             <?php 
                             }     
                           }
                      ?>
                    
                    </ul>
                </li>    
            </ul>
        </div>
      </div>
    </div>

</div>
	<div class="row">
	<div class="col-xs-3">
		<div style="background: #F5F6F7;height: 600px;padding: 20px">
             <p style="color:#fff;font-size: 18px;padding: 5px;background-color: #449D44;width: 176px;position: center;padding-left: 42px">My Institution</p>
              <div class="tree" id="tree">
            <!-- <h1>Tree View</h1> -->
              </div>
             
        </div>
	</div>
	<div class="col-xs-6">
		<div style="background: #F5F6F7;height: 600px; padding: 20px">
		<h3 style="color: #286090;padding-left: 150px" >Post Something</h3>
			
			<form method="post" enctype="multipart/form-data">
				<?php 
	        if (isset($_POST['notice_save'])) {
	          echo $msg;
	    	}  	
	    ?>
				<div style="background: #ddd;padding: 20px">
					<div class="form-group">
						<textarea type="notice" name="notice" class="form-control" placeholder="Write Something" value ="<?php if(isset($_GET['edit'])) echo $globalPublisher->getNotice(); ?>" rows="5"></textarea>
					</div>
					<div class="form-group">
			            <div class="uploadBtn"><input type="file" name="image" /></div>
	                </div>
				</div>
				<select id="security" name="security" class="form-control" style="width: 120px;display: inline-block;float: right;margin-top: 5px">
						<option name="one" value="1">Public</option>	
						<option name="two" value="2">Private</option>
						<option name="three" value="3">Select Group</option>
				</select>
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
							<button  type="submit" name="notice_save" class="btn btn-success" >post</button>
						
							<?php
						}
					?>		
			
			</form>
					
		</div>
		</div>
		<div class="col-xs-3">
			
			    <div style="background: #F5F6F7;height: 300px;">
	               <p style="color:#fff;font-size: 18px;padding: 5px;background-color: #449D44;width: 253px;position: center;margin-left: 5px;margin-top: 15px"><span style="margin-left: 65px">Subscribers</span></p>
                 <?php 
                  $Result = $_SubcategoryBAO->getAllSubscriberOfCategory($ID,$catId);
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
	                    <!--  <p style="padding-left: 10px;font-weight: bold;margin-left: 20px"><a href="">CSE 13</a></p> -->
	                     <a href="" onclick="return confirm('sure to delete !'); " ><button style="margin-left: 30px" type="button" class="btn btn-danger" name="reject">Un-Subscribe</button></a>
	                  </div>
                   </div><br>
                   <?php } } ?>
               
		       <br><br>
		         <button class="btn btn-info" type="button" style="width: 225px">Notice</button>
	            <div class="dropdown">
	              <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" style="width: 225px">Select Category
	              <span class="caret"></span></button>
	              <ul class="dropdown-menu" style="width: 225px;">
	               <?php 
	               $Result = $_SubcategoryBAO->getSubscriberSubcategory($ID);
	               if($Result->getIsSuccess()){

	                  $SubcategoryList = $Result->getResultObject();
	                  for ($i = 0; $i<sizeof($SubcategoryList); $i++){
	                  $Subcategory = $SubcategoryList[$i];
	                      // Start count Notice every category
	                        $Result = $_NewPublisherBAO->getNoticeStatus($Subcategory->getCatID());
	                        if ($Result->getIsSuccess()) {

	                            $NoticeList = $Result->getResultObject();
	                            $count=0;
	                             for ($j = 0; $j<sizeof($NoticeList); $j++){
	                             $Notice = $NoticeList[$j];
	                                 $count++;
	                           }

	                        }
	                      //End Count Notice Every Category
	                    ?>
	                <li><a href='view.notice.php?CatId=<?php echo $Subcategory->getCatID();?>'><?php echo $Subcategory->getName();?><span style="padding-left: 10px;color: red"><?php if($count > 0){echo $count; }?></span></a></li>
	                  <?php 
	                
	                
	                  }     
	                }
	                  ?>
	              </ul>       
	           </div>
			</div>

		</div>
	</div>
</div>
		

<div class="container">
	<table class="table table-bordered">
	<?php
	
	
	$Result = $_NewPublisherBAO->getAllNotice($ID, $catId);

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
			<td>Edit</td>
			<td>Delete</td>
			
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
			    
			    <td><a href="view.updatenotice.php?edit=<?php echo $Notice->getID(); ?>&categoryId=<?php echo $Notice->getPubCatID(); ?>" onclick="return confirm('sure to edit !'); " >edit</a></td>
			    <td><a href="?del=<?php echo $Notice->getID(); ?>&categoryId=<?php echo $Notice->getPubCatID(); ?>" onclick="return confirm('sure to delete !'); " >delete</a></td>
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
	<script type="text/javascript">
      genAllParents();
    </script>
<?php include 'footer.php';  ?>