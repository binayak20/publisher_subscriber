<?php include 'header.php'; ?>
 <?php 
   if (!isset($_GET['fId'])  || $_GET['fId'] == NULL) {
        header("Location:view.404.php");
     } else{
           $b = $_GET['fId']; 
     }
?>
<?php  
include_once 'blade/view.institution.blade.php';
include_once 'blade/view.subcategory.blade.php';
include_once 'blade/view.publishnotice.blade.php';
include_once 'blade/view.addsubscriber.blade.php';
include_once 'blade/view.user.blade.php';
include_once '/../../common/class.common.php';
$count=0;
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
  //echo $ID;
 // echo $Name;
}
?>

 <style type="text/css">
    .navbar-inner ul{margin:0;padding: 0;list-style: none;border: 1px solid #ddd; }
    .navbar-inner ul li{display: block;float: left;}

#sidebox{



position:absolute;
font-family:verdana;
color:#363030;
font-size:15px;}
#sideboxx1{
left:0px;
width:180px;
height:20px;
font-size:15px;
color:#868383;
}
#sideboxx2{
left:0px;
width:180px;
height:20px;
font-size:15px;
color:#868383;
}
#sideboxx3{
left:0px;
width:180px;
height:20px;
font-size:15px;
color:#868383;
}
#sideboxx4{
left:0px;
width:180px;
height:20px;
font-size:15px;
color:#868383;
}
.sidebox1{top:0;
left:0;
width:200px;
height:400px;
background:white;
border-radius:3px/3px;
padding:10px;}
#sidebox1{top:0;
left:0;
width:200px;
height:250px;
background:white;
border-radius:3px/3px;
padding:10px;}
#sidebox2{top:0px;
left:0;
width:200px;
height:400px;
background:white;
border-radius:3px/3px;
padding:10px;}
#noticebox{

}
#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation */
.modal-content, #caption {    
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
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
     <h2>Subscriber Page</h2>
  </div>
</div>

<?php include 'view.navinstitution.php'; ?>
 <div class="row" style="height: 900px">
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
            <a class="leftTab" data-toggle="tab" href="#"><i class="fa fa-fw fa-key"></i>ChangePassword</a>
          </li>
          <li>
            <a data-toggle="tab" href="#"><i class="fa fa-user-times"></i> Merge Accounts</a>
          </li>
      </ol>  
  </div>

    <div class="col-xs-7" >
      <?php 
        // if (isset($_GET['fId'])) 
        // {
        //    $b = $_GET['fId'];
        //    //echo $b;
        //  }
       ?>
         <?php
            $Result = $_AddSubscriberBAO->getFavouriteNotice($b);
            if($Result->getIsSuccess()){
              $NoticeList = $Result->getResultObject();
              for($i = 0; $i < sizeof($NoticeList); $i++) {
                $Notice = $NoticeList[$i];
          ?>
     <div class="noticebox" style="border: 1px solid green;box-shadow: inset 0 0 1em green, 0 0 1em green;">
      <div style="height: 60px">
       <div class="col-xs-1" style="margin-top: 5px"><img class="img-rounded" src="<?php echo $_AddSubscriberBAO->getImagefromPublisherID($Notice->getPublisherID()); ?>" height="55" width="50" /></div>
       <div class="col-xs-7" style="margin-top: 15px;font-weight: bold;font-size: 18px;color: green"><?php echo $_AddSubscriberBAO->getNamefromCategoryID($Notice->getPubCatID()); ?> ><?php echo $_AddSubscriberBAO->getNamefromPublisherID($Notice->getPublisherID()); ?></div>
       <div class="col-xs-4"></div>
     </div>
      <div style=" border: 1px solid #ddd;margin: 10px;margin-left: 40px;margin-right: 40px;">
       <p style="font-size: 15px;margin: 10px;font-weight: bold;font:  arial, sans-serif; "><?php echo $Notice->getNotice();  ?></p>
    
         <?php if (!empty($Notice->getImage())) {
         
          ?>
       <img id="myImg" style="margin-left: 80px;margin-bottom: 5px" src="<?php echo $Notice->getImage(); ?>" width="400" height="220" />
          <?php } ?>           
     </div>
     <div style="height: 30px">
    
     </div>
   
       
     </div><br>
    <?php } } ?>
  </div>
    <div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
    
    <div class="col-xs-3">
        
        <div class="sidebox" >
          
          <button class="btn btn-success" style="width: 200px">My Favourite</button>

          <div id="sidebox1" class="sidebox">
             <?php 
               $Result = $_AddSubscriberBAO->getAllFavouriteNotice($ID);
               if($Result->getIsSuccess()){

                  $NotieList = $Result->getResultObject();
                  for ($i = 0; $i<sizeof($NotieList); $i++){
                  $FavouriteNotice = $NotieList[$i];
                  ?>
                  <a href="view.favouritenotice.php?fId=<?php echo $FavouriteNotice->getFavouriteNoticeID(); ?>"><?php echo $i+1; ?>. <?php echo $_AddSubscriberBAO->getNoticefromNoticeID($FavouriteNotice->getFavouriteNoticeID());?></a><br>
               <?php 
          
         } } ?>
          </div>
          <button class="btn btn-success" style="width: 200px">Your Subscription</button>
          <div id="sidebox1" class="sidebox">
           <!--  <div id="sideboxx1" >YOUR SUBSCRIPTION</div> -->
                <?php 
               $Result = $_SubcategoryBAO->getSubscriberSubcategory($ID);
               if($Result->getIsSuccess()){

                  $SubcategoryList = $Result->getResultObject();
                  for ($i = 0; $i<sizeof($SubcategoryList); $i++){
                  $Subcategory = $SubcategoryList[$i];
                    ?>
                <a href='view.notice.php?CatId=<?php echo $Subcategory->getCatID();?>'><?php echo $Subcategory->getName();?><span style="padding-left: 10px;color: red"><?php if($count > 0){echo $count; }?></span></a>
                  <?php 
                
                
                  }     
                }
                  ?>
            <br><br><br><button class="btn btn-default">See all</button><hr>

            
          </div>
          
        </div>
   </div>
   
  </div>
  </div>

    <script src="bootstrap/js/bootstrap.min.js"></script>

     <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    // Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}
    </script>
      
  </body>
</html>