<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.userbao.php';

$_UserBAO = new UserBAO();
$_DB = DBUtil::getInstance();
$_Log= LogUtil::getInstance();

$globalUser = '';

if(isset($_POST['save']))
{
	 $User = new User();

	 $User->setID(Util::getGUID());
     $User->setFirstName($_DB->secureInput($_POST['firstname']));
     $User->setLastName($_DB->secureInput($_POST['lastname']));
     $User->setEmail($_DB->secureInput($_POST['email']));
     $User->setPassword($_DB->secureInput($_POST['password']));
     $User->setAddress($_DB->secureInput($_POST['address']));

     $mail_check = $_UserBAO->mailcheck($User);
     
     if (empty($User->getFirstName()) || empty($User->getLastName()) || empty($User->getEmail()) || empty($User->getPassword()) 
     	    || empty($User->getAddress()))
     {
     	$msg = "<div class='alert alert-danger'><strong>Error !</strong>Field must not be empty</div>";
		return $msg;
     }
     if (strlen($User->getFirstName())  < 3) {
		$msg = "<div class='alert alert-danger'><strong>Error !</strong>User name is too short</div>";
		return $msg;
		}elseif (preg_match('/[^a-z0-9_-]+/i', $User->getFirstName())) {
			$msg = "<div class='alert alert-danger'><strong>Error !</strong>User name must only contains alphanumerical,dashes 
			and underscore</div>";
			return $msg;
	}
	if (filter_var($User->getEmail(), FILTER_VALIDATE_EMAIL) === false) {
		$msg = "<div class='alert alert-danger'><strong>Error !!</strong>The email Address is not valid</div>";
		return $msg;
		}
	if ($mail_check == true) {
		$msg = "<div class='alert alert-danger'><strong>Error !!</strong>The email Address Already exist</div>";
		return $msg;
	}
	 if (strlen($User->getPassword())  < 4) {
		$msg = "<div class='alert alert-danger'><strong>Error !</strong>Password should be greater than 4 character</div>";
		return $msg;
		}
     else
     {
	    $_UserBAO->createUser($User);
	    $msg = "<div class='alert alert-success'><strong>Success !!</strong>Registration Complete Successfully!!Please Login</div>";
	    return $msg;
	 }
	 
}

if(isset($_POST['login']))
{
	$User = new User();	
    $User->setEmail($_DB->secureInput($_POST['email']));
    $User->setPassword($_DB->secureInput($_POST['password']));

    if (empty($User->getEmail()) || empty($User->getPassword())) {
    	$msg =  "<div>User name or password must not be empty</div>";
    	return $msg;
    }
    else
    {
	$Result = $_UserBAO->userLogin($User); //reading the user object from the result 

	if($Result->getIsSuccess()){
		   ob_start();	
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
				$globalUser = $Result->getResultObject();
				$_SESSION["globalUser"]=$globalUser;
			}
			else
			{
				$_SESSION["globalUser"]=$globalUser;
			}
		
		//Session::init();
		Session::set("login", true);
		Session::set("id",$User->getID());
		Session::set("loginmsg", "<div class='alert alert-success'><strong>Success !!</strong>You are Logged In</div>");
		header("Location:home.php");		
	}
	
	
	else{
		$msg =  "<div>Wrong Email or Password</div>";
    	return $msg;	
	}
}
	
}

if(isset($_GET['edit']))
{
	$User = new User();	
	$User->setID($_GET['edit']);	
	$globalUser = $_UserBAO->readUserData($User)->getResultObject(); //reading the user object from the result object
}

if (isset($_POST['update'])) {
	$User = new User();	

    $User->setID ($_GET['edit']);
   	$User->setFirstName( $_POST['firstname'] );
    $User->setLastName( $_POST['lastname'] );
    $User->setEmail ( $_POST['email'] );
    $User->setAddress ( $_POST['address'] );
   
	$_UserBAO->updatLogineUser($User);

	header("Location:view.userprofile.php");
}

if (isset($_POST['changpass'])) {
	$User = new User();	

	if (isset($_GET['changpass'])) {
		$uid = $_GET['changpass'];
		//echo $uid;
	}

	 $User->setPassword($_POST['old_pass']);
	 $oldpass = $User->getPassword();

	 $User->setPassword($_POST['password']);
	 $newpass = $User->getPassword();
	 
	 $chek_pass = $_UserBAO->checkPassword($uid,$oldpass);


     if (empty($newpass) || empty($oldpass))
     {
     	$msg = "<div class='alert alert-danger'><strong>Error !</strong>Field must not be empty</div>";
		return $msg;
		//echo "string";
     }
     
     if ($chek_pass == false) {
     	$msg = "<div class='alert alert-danger'><strong>Error !</strong>Old Password not exist</div>";
		return $msg;
     }
    if (strlen($newpass)  < 4) {
		$msg = "<div class='alert alert-danger'><strong>Error !</strong>Password should be greater than 4 character</div>";
		return $msg;
		}else{
     	

	   $Result = $_UserBAO->ChangePassword($uid,$User);
	   if ($Result->getIsSuccess()) {
	    $msg = "<div class='alert alert-success'><strong>Success !!</strong>Update Successfully!!</div>";
	    return $msg;
	   }
	 else{
	 	echo "Not Update";
	 }
	}	
}

if (isset($_POST['forgotpass'])) {
	$User = new User();

	$User->setEmail($_POST['email']);

	if (empty($User->getEmail())) {
		$msg = "<div class='alert alert-danger'><strong>Error !</strong>Please Enter Your Email</div>";
		return $msg;
	}

	$data = $_UserBAO->findIdFromEmail($User);
	if ($data) {
		$str = "0123456789qwertyuiopasdfghjklzxcvbnm";
		$str = str_shuffle($str);
		$str = substr($str, 0, 10);
		echo $str;
		$msg = "<div class='alert alert-success'><strong>Success !</strong>Insert Correctly</div>";
		return $msg;
	}
	else{
		$msg = "<div class='alert alert-danger'><strong>Error !</strong>Problem Occured Here</div>";
		return $msg;
	}

}

if(isset($_POST['submit']))
{
	//$UserProfileImage = new UserProfileImage();
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
	$permited  = array('jpg', 'jpeg', 'png');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];
   
   	$div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/".$unique_image;

    if (empty($file_name)) {
       $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Please Select any Image!</div>";
	   return $msg;
      }
      elseif ($file_size >1048567) {
       $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Image Size should be less then 1MB!</div>";
	   return $msg;
      } 
      elseif (!$file_temp) {
      	$msg = "<div class='alert alert-danger'><strong>Error ! </strong>No File Selected,Upload Again!</div>";
	    return $msg;
      }
      else{
        move_uploaded_file($file_temp, $uploaded_image);
          $UserProfileImage = new UserProfileImage();

          $UserProfileImage->setUserID($a->getID());
          $UserProfileImage->setImage($uploaded_image);

          $Result = $_UserBAO->addProfileImage($UserProfileImage);

         
          
         if ($Result->getIsSuccess()) {
            $msg = "<div class='alert alert-success'><strong>Success ! </strong>Upload Successfully!</div>";
	        return $msg;
          }
            else {
            $msg = "<div class='alert alert-danger'><strong>Error ! </strong>No File Selected,Upload Again!</div>";
	        return $msg;
          }
    }
}

 //echo '<br> log:: exit blade.User.php';
 
?>