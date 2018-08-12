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
include_once 'blade/view.user.blade.php';
include_once 'blade/view.institution.blade.php';
include_once 'blade/view.addpublisher.blade.php';
include_once 'blade/view.addsubscriber.blade.php';
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
	<?php 
		if (isset($_GET['InstituteId']) || isset($_GET['InsName'])) {
			$InsId = $_GET['InstituteId'];
		    $InsName = $_GET['InsName']; 
		}
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
                    <a href="view.allpublisher.php?InstituteId=<?php echo $Institution->getID();?>&InsName=<?php echo $Institution->getName(); ?>'" name="pub"><span class="glyphicon glyphicon-user"></span>Publisher<span style="color: red;font-weight: bold;"><?php echo $_SubcategoryBAO->getPublisherCount($InsId); ?></span></a>    
                  <!-- </li>
                    <li class="active">
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
			 <?php 
                if (isset($_GET['change_pub']) || isset($_GET['PubId'])) {    
                $catID =  $_GET['change_pub'];
                $pubId =  $_GET['PubId'];
                //echo $pubId;
             ?>
             <!--  <div class="form-group">                
                    <label style="color: #286090">Previous Publisher :</label> 
                    <div class="form-control"><?php  // echo $User->getEmail(); ?></div>               
              </div> -->
              
             <form  role="form" method="post" >  
              <legend>Change Publisher</legend> 
            
	                <div class="form-group" >                
	                    <label>Previous Publisher:</label> 
	                    <div class="form-control"><?php echo $_AddSubscriberBAO->getNamefromPublisherID($pubId); ?></div>               
	                </div>
             
 	               <div class="form-group"> 
	                   <label for="groupName">Group Name :</label>    
		              <input type="catId" name="address" class="form-control" value="<?php 
                        if(isset($_GET['change_pub'])) echo $_AddSubscriberBAO->getGroupNameFromCatID($catID);  ?>">
	               </div>

	                <label for="PublisherName">Publisher Name :</label>   
	                <select name="uId" class="form-control">
	              <?php 
	                  $Result = $_UserBAO->getAllUser();
	                  if($Result->getIsSuccess()){

	                  $UserList = $Result->getResultObject();
	                  for ($i = 0; $i<sizeof($UserList); $i++){
	                      $User = $UserList[$i];
	              ?>
	                	<!--  <option value="<?php// echo $Subcategory->getCatID();?>"><?php //echo $Subcategory->getName();?></option> -->
	                	 <option value="<?php echo $User->getID();?>"><?php echo $_AddSubscriberBAO->getNamefromPublisherID($User->getID()); ?></option>
	               <?php 
	                 }     
	               }
	               ?>
	                </select><br>     
	             
	               <button type="submit" name="change_publisher" class="btn btn-success">Change</button> 
	          
            </form>
      <form >  
       
         <div>
          <em>Into This</em>
          <select data-placeholder="Choose a Country..." class="chosen-select" tabindex="2">
            <option value=""></option>
            <option value="United States">United States</option>
            <option value="United Kingdom">United Kingdom</option>
            <option value="Afghanistan">Afghanistan</option>
            <option value="Aland Islands">Aland Islands</option>
            <option value="Albania">Albania</option>
            <option value="Algeria">Algeria</option>
            <option value="American Samoa">American Samoa</option>
            <option value="Andorra">Andorra</option>
            <option value="Angola">Angola</option>
            <option value="Anguilla">Anguilla</option>
            <option value="Antarctica">Antarctica</option>
            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
            <option value="Argentina">Argentina</option>
            <option value="Armenia">Armenia</option>
            <option value="Aruba">Aruba</option>
          </select>
        </div>
        
      </form>
            <?php } else { ?>
		<?php 
             $Result = $_NewPublisherBAO->getAllPublisher($InsId);
             if($Result->getIsSuccess()){
               $PublisherList = $Result->getResultObject();
               for($i = 0; $i < sizeof($PublisherList); $i++) {
                 $Publisher = $PublisherList[$i];
             
          ?>
   

          <div class="row" style="background-color: #ddd;padding-top: 10px;margin-left: 5px;margin-right: 5px; padding-bottom: 10px;margin-bottom: 5px">
                <div class="col-sm-2">     
                  <img src="<?php echo $_AddSubscriberBAO->getImagefromPublisherID($Publisher->getPublisherID()); ?>" height="90px" width="80px"/>
                </div>
                <div class="col-sm-6" style="">
                   <p style="padding-left: 10px;"> Name :<a href=""><?php echo $_AddSubscriberBAO->getNamefromPublisherID($Publisher->getPublisherID()); ?></a></p>
                   
                   <p style="padding-left: 10px;">Group :<a href=""><?php echo $_AddSubscriberBAO->getGroupNameFromCatID($Publisher->getCategoryID()); ?></a></p>
                </div>
                <div class="col-sm-4">
                    <a href="view.allpublisher.php?change_pub=<?php echo $Publisher->getCategoryID();?>&InstituteId=<?php echo $Institution->getID();?>&InsName=<?php echo $Institution->getName(); ?>&PubId=<?php echo $Publisher->getPublisherID(); ?>">
                     <button style="margin-top: 15px" type="button" class="btn btn-success" name="approve" >Change Publisher</button></a>
                    
                     <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#MyModal"></button> -->
<!--                      <div id="MyModal" class="modal fade" role="dialog">
                     	<div class="modal-dialog">
                     		<div class="modal-content">
                     			<div class="modal-header">
                     				<div class="modal-title">Change Publisher</div>
                     				<button type="button" class="close" data-dismiss="modal">&times;</button>
                     			</div>
                     			<div class="modal-body">
		                     	<form  role="form" method="post" style="padding: 20px">         
			                       <table>
			                           <div class="form-group"> 
							               <div class="input-group">   
								               <input type="text" name="email" class="form-control" placeholder="Group Name" value="<?php //echo $_AddSubscriberBAO->getGroupNameFromCatID($Publisher->getCategoryID()); ?>" >
							                  </div>
							               </div>

							               <div class="form-group">
							                  <div class="input-group">  
								                <input type="text" name="password" class="form-control" placeholder="Publisher Name" value="madhury Ray">
							                  </div>
							               </div>
			                          
			                           <div class="form-group">
			                              <button type="submit" name="login" class="btn btn-primary">Change</button>
			                           </div>                 
			                       </table>
			                    </form>
                     			</div>
                     			<div class="modal-footer">
                     				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     			</div>
                     		</div>  		
                     	</div>
                     </div> -->
                </div>
          </div>
          <?php } } }?>
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
