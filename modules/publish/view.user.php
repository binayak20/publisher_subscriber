<?php

include_once 'blade/view.user.blade.php';
include_once '/../../common/class.common.php';
Session:: init();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Registration</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

 <body>
 <div >
	  <nav class="navbar navbar-default navbar-fixed-top" style="height: 90px;background-color: #449D44">   
	      <div class="container">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	              <span class="sr-only">Toggle navigation</span>
	              <span class="icon-bar"></span>
	              <span class="icon-bar"></span>
	              <span class="icon-bar"></span>     
	          </button>
	          <a class="navbar-brand" href="view.user.php" style="padding-top: 30px;color: #ffffff;"><h2>Publisher-Subscriber Network</h2></a>
	          <div class="collapse navbar-collapse">
	                <ul class="nav navbar-nav navbar-right">
	                  <form class="form-inline" role="form" method="post" style="padding: 20px"> 
				        <?php 
			           		if (isset($_POST['login'])) {
			           			echo $msg;
			           		}
			            ?>              
	                       <table>
	                           <div class="form-group" style="padding-right: 10px">            
	                              <input type="text" name="email" class="form-control" placeholder="Email">
	                           </div>

	                           <div class="form-group" style="padding-right: 10px">           
	                              <input type="password" name="password" class="form-control" placeholder="Password">
	                           </div>
	                          
	                           <div class="form-group">
	                              <button type="submit" name="login" class="btn btn-primary">Log in</button>
	                           </div>

	                            <br><a style="padding-left: 200px; padding-top: 4px;color:#fff " href="view.forgotpass.php">Forgotten password?</a>                   
	                       </table>
	                  </form>
	            </ul>
	          </div>
	      </div>  
	  </nav>
</div>  

  <div class="container" style="padding-top: 90px">
      <div class="col-sm-4">
        
      </div>
      <div class="col-sm-5">
        <form  role="form" method="post">
           <h2 style="color: #286090"  >Create a new account</h2>
           <?php 
           		if (isset($_POST['save'])) {
           			echo $msg;
           		}
            ?>
           <table>
               <div class="form-group">  
               	  <div class="input-group">
	                  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>       
	                  <input type="text" name="firstname" class="form-control" placeholder="First Name">
                  </div>
               </div>

               <div class="form-group">
                  <div class="input-group"> 
	                  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span> 
	                  <input type="text" name="lastname" class="form-control" placeholder="Last Name">
                  </div>
               </div>

               <div class="form-group"> 
                  <div class="input-group">
	                  <span class="input-group-addon">@</span> 
	                  <input type="text" name="email" class="form-control" placeholder="Email" value="">
                  </div>
               </div>

               <div class="form-group">
                  <div class="input-group">
	                  <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span> 
	                  <input type="password" name="password" class="form-control" placeholder="Password">
                  </div>
               </div>

               <div class="form-group">
                  <div class="input-group">
	                  <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
	                  <input type="text" name="address" class="form-control" placeholder="Address">
                  </div>
               </div>

               <button type="submit" name="save" class="btn btn-success">Create Account</button>
             
           </table>
        </form>
        <?php 
           echo date("d/m/Y");
           echo date("l");
         ?>
        </div>
        <div class="col-sm-3">
        </div>

  </div>
   
 <?php include 'footer.php';  ?>