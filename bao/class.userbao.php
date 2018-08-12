<?php

include_once '/../util/class.util.php';
include_once '/../dao/class.userdao.php';

/*
	Role Business Object 
*/
Class UserBAO{

	private $_DB;
	private $_UserDAO;
	

	function UserBAO(){

		$this->_UserDAO = new UserDAO();

	}

	public function createUser($User){

		$Result = new Result();	
		$Result = $this->_UserDAO->createUser($User);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in User.createUser()");		

		return $Result;
	}

	public function mailcheck($User){
		return $this->_UserDAO->mailcheck($User);
	}

	public function getAllUser(){

		$Result = new Result();	
		$Result = $this->_UserDAO->getAllUser();
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in UserDAO.getAllUser()");		

		return $Result;
	}

	public function userLogin($User){
		$Result = new Result();	
		$Result = $this->_UserDAO->userLogin($User);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in UserDAO.userLogin()");		

		return $Result;	
	}

	public function readUserData($User){
       	$Result = new Result();	
		$Result = $this->_UserDAO->readUserData($User);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in UserDAO.readUserData()");		

		return $Result;
	}

	public function updatLogineUser($User){

		$Result = new Result();	
		$Result = $this->_UserDAO->updatLogineUser($User);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in UserDAO.updatLogineUser()");		

		return $Result;
	}

	public function ChangePassword($uid,$User){
		echo "bao_first,";
		$Result = new Result();
		$Result = $this->_UserDAO->ChangePassword($uid,$User);

		if (!$Result->getIsSuccess()) 
			$Result->setResultObject("Database failure in UserDAO.ChangePassword()");
		echo "bao_last,";
		return $Result;

	}

	public function checkPassword($uid,$oldpass){
		
		return $this->_UserDAO->checkPassword($uid,$oldpass);
	}

	public function getOrganizerId($ID)
	{
		return $this->_UserDAO->getOrganizerId($ID);
	}

	public function getPublisherId($ID)
	{
		return $this->_UserDAO->getPublisherId($ID);
	}

	public function OrganizerCheck($ID){
		return $this->_UserDAO->OrganizerCheck($ID);
	}
	
	public function CheckPub($ID){
		return $this->_UserDAO->CheckPub($ID);
	}

	public function getSubscriberId($ID)
	{
		return $this->_UserDAO->getSubscriberId($ID);
	}

	public function findIdFromEmail($User){
		$Result = new Result();	
		$this->_UserDAO->findIdFromEmail($User);

		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubcategoryDAO.createSubcategory()");		

		return $Result;

	}

	/*public function createSubcategory($Subcategory){

		$Result = new Result();	
		$Result = $this->_InstitutionDAO->createSubcategory($Subcategory);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubcategoryDAO.createSubcategory()");		

		return $Result;
	
	}*/
	public function getLoginUser($ID){
		$Result = new Result();	
		$Result = $this->_UserDAO->getLoginUser($ID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in UserDAO.getLoginUser()");		

		return $Result;	
	}
	public function addProfileImage($UserProfileImage){
	    $Result = new Result();	
		$Result = $this->_UserDAO->addProfileImage($UserProfileImage);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in UserDAO.addProfileImage()");		

		return $Result;	
	}

	public function getUserProfileImage($ID){
	    $Result = new Result();	
		$Result = $this->_UserDAO->getUserProfileImage($ID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in UserDAO.getUserProfileImage()");		

		return $Result;
	}
	public function getTree(){
		$Result = new Result();	
		$Result = $this->_UserDAO->getTree();
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in UserDAO.getTree()");		

		return $Result;
	}


}

//echo '<br> log:: exit the class.userbao.php';

?>