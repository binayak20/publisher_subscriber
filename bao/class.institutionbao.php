<?php

include_once '/../util/class.util.php';
include_once '/../dao/class.institutiondao.php';
include_once '/../dao/class.subcategorydao.php';

/*
	Institution Business Object 
*/
Class InstitutionBAO{

	private $_DB;
	private $_InstitutionDAO;
	private $_SubcategoryDAO;

	function InstitutionBAO(){

		$this->_InstitutionDAO = new InstitutionDAO();

	}

	public function createInstitution($Institution){

		$Result = new Result();	
		$Result = $this->_InstitutionDAO->createInstitution($Institution);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in InstitutionDAO.createInstitution()");		

		return $Result;

	
	}

	public function getAllInstitution(){

		$Result = new Result();	
		$Result = $this->_InstitutionDAO->getAllInstitution();
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in InstitutionDAO.getAllInstitution()");		

		return $Result;
	}

	public function getInstitutionByID($InsId){

		$Result = new Result();	
		$Result = $this->_InstitutionDAO->getInstitutionByID($InsId);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in InstitutionDAO.getInstitutionByID()");		

		return $Result;
	}

	public function getInstituteNameFromID($ID)
	{
		return $this->_InstitutionDAO->getInstituteNameFromID($ID);
	}

	public function getInstituteLocation($ID)
	{
		return $this->_InstitutionDAO->getInstituteLocation($ID);
	}

	public function getOrganizerImage($id)
	{
		return $this->_InstitutionDAO->getOrganizerImage($id);
	}

	public function getOrganizerName($id)
	{
		return $this->_InstitutionDAO->getOrganizerName($id);
	}
//Institution
	public function getInstitution($ID){

		$Result = new Result();	
		$Result = $this->_InstitutionDAO->getInstitution($ID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in InstitutionDAO.getAllInstitution()");		

		return $Result;
	}

	public function getPublisherRequestCount($id)
	{
		return $this->_InstitutionDAO->getPublisherRequestCount($id);
	}
	
	public function getInstituteAsRootParent($ID,$Ins_ID){

		$Result = new Result();	
		$Result = $this->_InstitutionDAO->getInstituteAsRootParent($ID,$Ins_ID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in InstitutionDAO.getInstituteAsRootParent()");		

		return $Result;
	}

	public function createSubcategory($Subcategory){

		$Result = new Result();	
		$Result = $this->_InstitutionDAO->createSubcategory($Subcategory);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubcategoryDAO.createSubcategory()");		

		return $Result;	
	}

	public function createDefaultPublisher($NewPublisher){

		$Result = new Result();	
		$Result = $this->_InstitutionDAO->createDefaultPublisher($NewPublisher);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in NewPublisher.createDefaultPublisher()");		
		return $Result;
	}

	public function readInstitutionData($Institution){
	    $Result = new Result();	
		$Result = $this->_InstitutionDAO->readInstitutionData($Institution);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubcategoryDAO.createSubcategory()");		

		return $Result;
	}

	public function updateInstitutionWithoutImage($Institution){
		$Result = new Result();	
		$Result = $this->_InstitutionDAO->updateInstitutionWithoutImage($Institution);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubcategoryDAO.updateInstitutionWithoutImage()");		

		return $Result;
	}

	public function updateInstitutionWithImage($Institution){
		$Result = new Result();	
		$Result = $this->_InstitutionDAO->updateInstitutionWithImage($Institution);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubcategoryDAO.updateInstitutionWithImage()");		

		return $Result;
	}

	public function deleteInstitution($Institution){
		$Result = new Result();	
		$Result = $this->_InstitutionDAO->deleteInstitution($Institution);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in InstitutionDAO.deleteInstitution()");		

		return $Result;
	}

	public function deleteCateory($Subcategory){
		$Result = new Result();	
		$Result = $this->_InstitutionDAO->deleteCateory($Subcategory);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in InstitutionDAO.deleteCateory()");		

		return $Result;
	}

	public function deletePublisher($NewPublisher){
		$Result = new Result();	
		$Result = $this->_InstitutionDAO->deletePublisher($NewPublisher);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in InstitutionDAO.deletePublisher()");		

		return $Result;
	}

	public function deleteSubscriber($AddSubscriber){
		$Result = new Result();	
		$Result = $this->_InstitutionDAO->deleteSubscriber($AddSubscriber);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in InstitutionDAO.deleteSubscriber()");		

		return $Result;
	}

}

//echo '<br> log:: exit the class.institutionbao.php';

?>