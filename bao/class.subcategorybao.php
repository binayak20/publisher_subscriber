<?php

include_once '/../util/class.util.php';
include_once '/../dao/class.subcategorydao.php';

/*
	Role Business Object 
*/
Class SubcategoryBAO{

	private $_DB;
	private $_SubcategoryDAO;

	function SubcategoryBAO(){

		$this->_SubcategoryDAO = new SubcategoryDAO();

	}

	//get all Subcategory value
	public function getAllSubcategory($ID,$Ins_ID){

		$Result = new Result();	
		$Result = $this->_SubcategoryDAO->getAllSubcategory($ID,$Ins_ID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubcategoryDAO.getAllSubcategory()");		

		return $Result;
	}

	public function getSubcategory(){
		$Result = new Result();	
		$Result = $this->_SubcategoryDAO->getSubcategory();
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubcategoryDAO.getSubcategory()");		

		return $Result;
	}

	public function getGroupNameFromcatId($ID)
	{
		return $this->_SubcategoryDAO->getGroupNameFromcatId($ID);
	}
	public function getImageFromcatId($ID)
	{
		return $this->_SubcategoryDAO->getImageFromcatId($ID);
	}

	public function getAllSubcategoryWithRoot($ID,$Ins_ID){
		$Result = new Result();	
		$Result = $this->_SubcategoryDAO->getAllSubcategoryWithRoot($ID,$Ins_ID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubcategoryDAO.getAllSubcategory()");		
		return $Result;
	}

	public function getPublisherCount($InsId)
	{
		return $this->_SubcategoryDAO->getPublisherCount($InsId);
	}
	public function getAllSubscriberCount($id)
	{
		return $this->_SubcategoryDAO->getAllSubscriberCount($id);
	}
	public function getPublisgerFromCatID($id)
	{
		return $this->_SubcategoryDAO->getPublisgerFromCatID($id);
	}

    ////get all Subcategory value
	public function getInstituteSubcategory($Ins_ID){

		$Result = new Result();	
		$Result = $this->_SubcategoryDAO->getInstituteSubcategory($Ins_ID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubcategoryDAO.getInstituteSubcategory()");		

		return $Result;
	}
	public function getPublisherSubcategory($ID){
		$Result = new Result();	
		$Result = $this->_SubcategoryDAO->getPublisherSubcategory($ID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubcategoryDAO.getPublisherSubcategory()");		

		return $Result;
	}

	public function getAllSubscriber($ID){
		$Result = new Result();	
		$Result = $this->_SubcategoryDAO->getAllSubscriber($ID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubcategoryDAO.getAllSubscriber()");		

		return $Result;
	}

	public function getAllSubscriberFromInstitution($ID){
		$Result = new Result();	
		$Result = $this->_SubcategoryDAO->getAllSubscriberFromInstitution($ID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubcategoryDAO.getAllSubscriberFromInstitution()");		

		return $Result;
	}

	public function getAllSubscriberOfCategory($ID,$catId){
		$Result = new Result();	
		$Result = $this->_SubcategoryDAO->getAllSubscriberOfCategory($ID,$catId);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubcategoryDAO.getAllSubscriberOfCategory()");		

		return $Result;
	}

	//get all Permissions value
	public function getAllPermissions(){

		$Result = new Result();	
		$Result = $this->_RoleDAO->getAllPermissions();
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in RoleDAO.getAllPermissions()");		

		return $Result;
	}


	//create Role funtion with the Role object
/*	public function createSubcategory($Subcategory){

		$Result = new Result();	
		$Result = $this->_SubcategoryDAO->createSubcategory($Subcategory);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubcategoryDAO.createSubcategory()");		

		return $Result;
	}*/

	//assigning a list of permissions to a role
	public function assignPermissionsToRole($Role,$Permissions){

		$Result = new Result();	
		$Result = $this->_RoleDAO->assignPermissionsToRole($Role,$Permissions);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in RoleDAO.assignPermissionsToRole()");		

		return $Result;

	
	}

	//read an Role object based on its id form Role object
	public function readSubcategory($Subcategory){


		$Result = new Result();	
		$Result = $this->_SubcategoryDAO->readSubcategory($Subcategory);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubcategoryDAO.readSubcategory()");		

		return $Result;


	}

	//read an Role object along with the list of permissions
	public function readRolePermissions($Role){

		$Result = new Result();	
		$Result = $this->_RoleDAO->readRolePermissions($Role);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in RoleDAO.readRolePermissions()");		

		return $Result;


	}

	//update an Role object based on its current information
	public function updateSubcategory($Subcategory){

		$Result = new Result();	
		$Result = $this->_SubcategoryDAO->updateSubcategory($Subcategory);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubcategoryDAO.updateSubcategory()");		

		return $Result;
	}

	//delete an existing Role
	/*public function deleteSubcategory($Subcategory){

		$Result = new Result();	
		$Result = $this->_SubcategoryDAO->deleteSubcategory($Subcategory);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubcategoryDAO.deleteSubcategory()");		

		return $Result;

	}*/
	public function getSubscriberSubcategory($ID){
		$Result = new Result();	
		$Result = $this->_SubcategoryDAO->getSubscriberSubcategory($ID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubcategoryDAO.getSubscriberSubcategory()");		

		return $Result;
	}
	/*public function findChild($catID){

		return $this->_SubcategoryDAO->findChild($catID);
	
	}*/

}

//echo '<br> log:: exit the class.subcategorybao.php';

?>