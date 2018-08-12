<?php

include_once '/../util/class.util.php';
include_once '/../dao/class.newpublisherdao.php';

/*
	Role Business Object 
*/
Class NewPublisherBAO{

	private $_DB;
	private $_NewPublisherDAO;
	
	function NewPublisherBAO(){

		$this->_NewPublisherDAO = new NewPublisherDAO();

	}

	public function createNewPublisher($NewPublisher){

		$Result = new Result();	
		$Result = $this->_NewPublisherDAO->createNewPublisher($NewPublisher);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in NewPublisher.createNewPublisher()");		

		return $Result;
	}

	public function CheckPublisher($NewPublisher){

		return $this->_NewPublisherDAO->CheckPublisher($NewPublisher);
	}

	public function CheckNotice($FavouriteNotice){

		return $this->_NewPublisherDAO->CheckNotice($FavouriteNotice);
	}

	public function PublisherIDfromCategoryID($id)
	{
		return $this->_NewPublisherDAO->PublisherIDfromCategoryID($id);
	}

	public function getSubscriberCount($id)
	{
		return $this->_NewPublisherDAO->getSubscriberCount($id);
	}

	public function getSubscriberRequestCount($id)
	{
		return $this->_NewPublisherDAO->getSubscriberRequestCount($id);
	}

	public function findChild($catID){

		return $this->_NewPublisherDAO->findChild($catID);
	
	}

	public function createNotice($Notice){

		$Result = new Result();	
		$Result = $this->_NewPublisherDAO->createNotice($Notice);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in PublishDAO.createNotice()");		

		return $Result;
	
	}

	public function addFavouriteNotice($FavouriteNotice){
		$Result = new Result();	
		$Result = $this->_NewPublisherDAO->addFavouriteNotice($FavouriteNotice);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in PublishDAO.addFavouriteNotice()");		

		return $Result;
	}
	//For show post notification
	
	public function createPostNotification($PostNotification){
		$Result = new Result();	
		$Result = $this->_NewPublisherDAO->createPostNotification($PostNotification);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in PublishDAO.createPostNotification()");		

		return $Result;
	}

	//For show post notification
	
	public function getUserIDForNotification($childCatID){
		/*$Result = new Result();	
		$Result = $this->_NewPublisherDAO->getUserIDForNotification($childCatID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in PublishDAO.getUserIDForNotification()");		

		return $Result;*/
		return $this->_NewPublisherDAO->getUserIDForNotification($childCatID);
	}

	// Add File in database
	public function addFile($File){
		$Result = new Result();	
		$Result = $this->_NewPublisherDAO->addFile($File);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in PublishDAO.addFile()");		

		return $Result;
	}

	public function getAllNotice($PublisherID,$catId){

		$Result = new Result();	
		$Result = $this->_NewPublisherDAO->getAllNotice($PublisherID,$catId);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in QuestionDAO.getAllNotice()");		

		return $Result;
	}

	public function readNoticeByCategory($Notice){
		$Result = new Result();	
		$Result = $this->_NewPublisherDAO->readNoticeByCategory($Notice);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in PublishDAO.readNoticeByCategory()");		

		return $Result;	
	}
	public function getAllNoticeByPiblisherID($ID){
		$Result = new Result();	
		$Result = $this->_NewPublisherDAO->getAllNoticeByPiblisherID($ID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in PublishDAO.readNoticeByCategory()");		

		return $Result;
	}

	public function updateNotice($Notice){
		$Result = new Result();	
		$Result = $this->_NewPublisherDAO->updateNotice($Notice);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in PublishDAO.updateNotice()");		

		return $Result;
	}

	public function deleteNotice($Notice){
		$Result = new Result();	
		$Result = $this->_NewPublisherDAO->deleteNotice($Notice);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in PublishDAO.deleteNotice()");		

		return $Result;
	}

	public function getNoticeStatus($catID){
		$Result = new Result();	
		$Result = $this->_NewPublisherDAO->getNoticeStatus($catID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in PublishDAO.getNoticeStatus()");		

		return $Result;
	}

	public function deleteSubcategory($Subcategory){

		$Result = new Result();	
		$Result = $this->_NewPublisherDAO->deleteSubcategory($Subcategory);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubcategoryDAO.deleteSubcategory()");		

		return $Result;

	}

	public function getAllPublisher($InsId){
		$Result = new Result();	
		$Result = $this->_NewPublisherDAO->getAllPublisher($InsId);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in PublishDAO.getAllPublisher()");		

		return $Result;
	}
	public function readPublisherData($NewPublisher){
       	$Result = new Result();	
		$Result = $this->_NewPublisherDAO->readPublisherData($NewPublisher);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in NewPublisherDAO.readPublisherData()");		

		return $Result;
	}

	public function updatPublisher($NewPublisher,$catID){
       	$Result = new Result();	
		$Result = $this->_NewPublisherDAO->updatPublisher($NewPublisher,$catID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in NewPublisherDAO.updatPublisher()");		

		return $Result;
	}

}
//echo '<br> log:: exit the class.newpublisherbao.php';
?>