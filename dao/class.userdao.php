<?php
// write dao object for each class
include_once '/../common/class.common.php';
include_once '/../util/class.util.php';

Class UserDAO{

	private $_DB;
	private $_User;
	private $_UserProfileImage;

	function UserDAO(){

		$this->_DB = DBUtil::getInstance();
		$this->_User= new User();
		$this->_UserProfileImage = new UserProfileImage();
	}

	public function createUser($User){

		$ID        = $User->getID();
		$FirstName = $User->getFirstName();
		$LastName  = $User->getLastName();
		$Email     = $User->getEmail();
		$Password  = $User->getPassword();
		$Address   = $User->getAddress();

		$SQL = "INSERT INTO tbl_user(ID,FirstName,LastName,Email,Password,Address) VALUES('$ID','$FirstName','$LastName','$Email','$Password','$Address')";


		$SQL = $this->_DB->doQuery($SQL);		
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	
	
	}

	public function mailcheck($User){
		$SQL = "SELECT Email FROM tbl_user WHERE Email = '".$User->getEmail()."' LIMIT 1 ";

		$SQL = $this->_DB->doQuery($SQL);
		$rows = $this->_DB->getAllRows();

		if (sizeof($rows) > 0 ) {
			return true;
		}else{
			return false;
		}

	}

	public function getAllUser(){

		$UserList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_user");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_User = new User();

		    $this->_User->setID ( $row['ID']);
		    $this->_User->setFirstName( $row['FirstName'] );
		    $this->_User->setLastName( $row['LastName'] );
		    $this->_User->setEmail( $row['Email'] );
		    $this->_User->setPassword( $row['Password']);
		    $this->_User->setAddress( $row['Address']);

		    $UserList[]=$this->_User;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($UserList);

		return $Result;
	}

	public function userLogin($User){
	
		$Result = new Result();
		
		//start::user reading information
		$SQL = "SELECT * FROM tbl_user WHERE Email='".$User->getEmail()."' and Password='".$User->getPassword()."'";
	
		$this->_DB->doQuery($SQL);
		//reading the top row for this user from the database
		$row = $this->_DB->getTopRow();

		if(isset($row)){

			$this->_User = new User();

			//preparing the user object
		    $this->_User->setID ( $row['ID']);
		    $this->_User->setFirstName ( $row['FirstName'] );
		    $this->_User->setLastName ( $row['LastName'] );    
		    $this->_User->setEmail ( $row['Email'] );
		    $this->_User->setPassword ( $row['Password'] );
		    $this->_User->setAddress( $row['Address'] );
			//end::user reading information

			$Result->setIsSuccess(1);
			$Result->setResultObject($this->_User);

		}

		return $Result;
	}

	public function readUserData($User){
		$SQL = "SELECT * FROM tbl_User WHERE ID ='".$User->getID()."'";
		$this->_DB->doQuery($SQL);

		//reading the top row for this user from the database
		$row = $this->_DB->getTopRow();

		$this->_User = new User();

		//preparing the user object
	    $this->_User->setID ( $row['ID']);
	      
	    $this->_User->setEmail ( $row['Email'] );
	    $this->_User->setFirstName ( $row['FirstName'] );
	    $this->_User->setLastName ( $row['LastName'] );    
	    $this->_User->setEmail ( $row['Email'] );
	    $this->_User->setAddress( $row['Address'] );

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($this->_User);

		return $Result;
	}

	public function updatLogineUser($User){

		$SQL = "UPDATE tbl_User SET
		 
	    FirstName = '".$User->getFirstName()."',
	    LastName  = '".$User->getLastName()."',
		Email     = '".$User->getEmail()."',
		Address   = '".$User->getAddress()."'

		WHERE ID = '".$User->getID()."' ";

		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);
		return $Result;

	}

	public function ChangePassword($uid,$User){
		//echo "dao_first,";
		$SQL = "UPDATE tbl_User SET 
		        Password   = '".$User->getPassword()."'
		        WHERE ID = '".$uid."' ";

		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);
		//echo "dao_last,";
		return $Result;

	}

	public function checkPassword($uid,$oldpass){
		$SQL = "SELECT Password FROM tbl_user WHERE ID = '".$uid."' AND  Password = '".$oldpass."' ";

		$SQL = $this->_DB->doQuery($SQL);
		$rows = $this->_DB->getAllRows();

		if (sizeof($rows) > 0 ) {
			return true;
		}else{
			return false;
		}
	}

	public function findIdFromEmail($User){
		//$SQL = "SELECT ID FROM tbl_user WHERE Email = '".$User->getEmail()."' ";
		//$SQL = $this->_DB->doQuery($SQL);

		$UserList = array();

		$this->_DB->doQuery("SELECT ID FROM tbl_user WHERE Email = '".$User->getEmail()."'");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_User = new User();

		    $this->_User->setID ( $row['ID']);
		  /*  $this->_User->setFirstName( $row['FirstName'] );
		    $this->_User->setLastName( $row['LastName'] );
		    $this->_User->setEmail( $row['Email'] );
		    $this->_User->setPassword( $row['Password']);
		    $this->_User->setAddress( $row['Address']);*/

		    $UserList[]=$this->_User;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($UserList);

		return $Result;
	}

	public function getOrganizerId($ID){
		$this->_DB->doQuery("SELECT UserID FROM tbl_institution Where UserID = '".$ID."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		if (sizeof($rows)>0) {
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getPublisherId($ID){
		$this->_DB->doQuery("SELECT PublisherID FROM tbl_new_publisher Where PublisherID = '".$ID."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		if (sizeof($rows)>0) {
			return true;
		}
		else
		{
			return false;
		}
	}

	public function OrganizerCheck($ID){
		$this->_DB->doQuery("SELECT UserID FROM tbl_institution Where UserID = '".$ID."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		if (sizeof($rows)>0) {
			return true;
		}
		else
		{
			return false;
		}
	}

	public function CheckPub($ID){
		$this->_DB->doQuery("SELECT PublisherID FROM tbl_new_publisher Where PublisherID = '".$ID."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		if (sizeof($rows)>0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function getSubscriberId($ID){
		$this->_DB->doQuery("SELECT SubscriberID FROM tbl_add_subscriber Where SubscriberID = '".$ID."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		if (sizeof($rows)>0) {
			return true;
		}
		else
		{
			return false;
		}
	}

	/*public function createSubcategory($Subcategory){

		$CatID       = $Subcategory->getCatID();
		$InstituteID = $Subcategory->getInstituteID();
		$Name        = $Subcategory->getName();
		$Parent      = $Subcategory->getParent();


		$SQL = "INSERT INTO tbl_child_cat(CatID,InstituteID,Name,ParentID) VALUES('$CatID','$InstituteID','$Name','$Parent')";


		$SQL = $this->_DB->doQuery($SQL);		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}*/

	public function getLoginUser($ID){
		$UserList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_user WHERE ID = '".$ID."' ");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_User = new User();

		    $this->_User->setID ( $row['ID']);
		    $this->_User->setFirstName( $row['FirstName'] );
		    $this->_User->setLastName( $row['LastName'] );
		    $this->_User->setEmail( $row['Email'] );
		    $this->_User->setPassword( $row['Password']);
		    $this->_User->setAddress( $row['Address']);

		    $UserList[] = $this->_User;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($UserList);

		return $Result;
	}

	public function addProfileImage($UserProfileImage){
		$UserID = $UserProfileImage->getUserID();	
		$Image  = $UserProfileImage->getImage();
	
		//$SQL = "INSERT INTO tbl_image(ID,Name,Image) VALUES('$ID','$Name','$Image')";
		$SQL = "INSERT INTO tbl_profileimage(UserID,Image) VALUES('$UserID','$Image')";

		$SQL = $this->_DB->doQuery($SQL);		
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	public function getUserProfileImage($ID){
		$UserImageList = array();

		$this->_DB->doQuery("SELECT * from tbl_profileimage WHERE UserID ='".$ID."' order by id desc limit 1");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_UserProfileImage = new UserProfileImage();

		    $this->_UserProfileImage->setUserID ( $row['UserID']);
		    $this->_UserProfileImage->setImage( $row['Image'] );


		    $UserImageList[]=$this->_UserProfileImage;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($UserImageList);

		return $Result;
	}

	public function getTree(){
		$TreeList = array();

		$this->_DB->doQuery("SELECT * from tbl_tree ");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Tree = new Tree();

		    $this->_Tree->setID ( $row['ID']);
		    $this->_Tree->setName ( $row['Name']);
		    $this->_Tree->setParentID( $row['ParentID'] );


		    $TreeList[]=$this->_Tree;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($TreeList);

		return $Result;
	}
	
}

//echo '<br> log:: exit the class.userdao.php';

?>