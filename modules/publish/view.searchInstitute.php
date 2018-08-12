 <?php include 'header.php';?>
<?php  

include_once 'blade/view.addpublisher.blade.php';
include_once 'blade/view.institution.blade.php';
include_once 'blade/view.subcategory.blade.php';
//include_once 'blade/view.user.blade.php';
include_once '/../../common/class.common.php';

?>
<?php 
   if (isset($_GET['InstituteId'])) {
      $Ins_ID = $_GET['InstituteId'];
      //echo $Ins_ID;
  }
 ?>
 <?php 
   if (isset($_GET['InstituteId'])) {
      $Ins_ID = $_GET['InstituteId'];
     // echo $Ins_ID;
  }
 ?>
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
          $res = $db->doQuery("SELECT * FROM tbl_child_cat");
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
        <div style="font-size: 35px;line-height: 10px;padding-top: 40px;padding-bottom: 10px;font-style: italic">
           <?php echo $FirstName ;?>
           <?php echo $LastName ;?>
        </div>
           <p style="font-size: 30px;padding-top: 8px">Searching Page</p>
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

                     <li><a tabindex="0" href="view.changepassword.php?changpass=<?php echo $ID ; ?>">Change Password</a>
                     </li>

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
      <div class="col-sm-3">
        <div style="background: #F5F6F7;height: 600px;padding: 20px">
          <p style="color:#fff;font-size: 18px;padding: 5px;background-color: #449D44;width: 176px;position: center;padding-left: 42px">Institution</p>
              <div class="tree" id="tree">
          
              </div>     
        </div>
    </div>
  <div class="col-sm-9" >
    <div style="background: #F5F6F7;height: 600px;padding: 20px">
          <?php 
            if (isset($_POST['sav'])) { 
            echo $msg;
             }
           ?>
               <?php 
                    $output = NULL;

                    if (isset($_POST['submit_search'])) {
                      $db = new mysqli('localhost','root','','publish_subscription');
                      $search = $db->real_escape_string($_POST['search']);
                      if (empty($search)) {
                        //header("Location:home.php");
                      }else{
                      $Result = $db->query("SELECT * FROM tbl_institution WHERE Name LIKE '%$search%' OR Address LIKE '%$search%' OR Description LIKE '%$search%'");
                      if ($Result->num_rows>0) {
                        while ($rows = $Result->fetch_assoc()) {

                          $name        = $rows['Name'];
                          $id          = $rows['ID'];
                          $uid         = $row['UserID'];
                          $address     = $rows['Address'];
                          $description = $rows['Description'];
                          $image       = $rows['Image'];
                        ?>

                <div class="row">
                  <div class="col-sm-2">     
                    <img src="<?php echo $image;?>" height="110px" width="110px"/>
                  </div>
                  <div class="col-sm-10">
                     <div style="border:1px solid #cecece;background: #ddd;height: 110px">
                       <div>
                         <p style="padding-top: 5px;padding-left: 5px;font-size: 15px;font-weight: bold;color: #286090"><a href='view.institutionshow.php?InstituteId=<?php echo $id;?>&organizerId=<?php echo $uid ?>'><?php echo $name;?></a></p>
                         <p style="padding-left: 5px">Location: <span style="color: #286090"><?php echo $address;?></span><br><a href='view.institutionshow.php?InstituteId=<?php echo $id;?>'><?php echo $description;?></a></p>
                       </div>
                     </div>
                  </div>
              </div><br>
                          
                        <?php
                        }
                      }else{
                        $output = "no result";
                      }
                    }
                    }
              ?>
    </div>
    <p></p>
  </div>

   
  </div>
</div>
<script type="text/javascript">
      genAllParents();
    </script>
<?php include 'footer.php';?>