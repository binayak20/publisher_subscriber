<?php

include_once '/../util/class.util.php';
include_once '/../dao/class.addsubscriberdao.php';

/*
	Role Business Object 
*/
Class AddSubscriberBAO{

	private $_DB;
	private $_AddSubscriberDAO;
	
	function AddSubscriberBAO(){

		$this->_AddSubscriberDAO = new AddSubscriberDAO();

	}

	public function createAddSubscriber($AddSubscriber){

		$Result = new Result();	
		$Result = $this->_AddSubscriberDAO->createAddSubscriber($AddSubscriber);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in AddSubscriber.createAddSubscriber()");		

		return $Result;
	}

	// public function getNamefromSubscriberID($id)
	// {
	// 	return $this->_AddSubscriberDAO->getNamefromSubscriberID($id);
	// }
	
	public function getEmailfromSubscriberID($id)
	{
		return $this->_AddSubscriberDAO->getEmailfromSubscriberID($id);
	}

	public function getSelectedNotice($CatID){

		$Result = new Result();	
		$Result = $this->_AddSubscriberDAO->getSelectedNotice($CatID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in QuestionDAO.getAllNotice()");		

		return $Result;
	}

	public function getAllShowNotice($id){
		$Result = new Result();	
		$Result = $this->_AddSubscriberDAO->getAllShowNotice($id);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in QuestionDAO.getAllShowNotice()");		

		return $Result;
	}

	public function getFavouriteNotice($id){
		$Result = new Result();	
		$Result = $this->_AddSubscriberDAO->getFavouriteNotice($id);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in QuestionDAO.getFavouriteNotice()");		

		return $Result;
	}

	public function getAllFavouriteNotice($id){
		$Result = new Result();	
		$Result = $this->_AddSubscriberDAO->getAllFavouriteNotice($id);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in QuestionDAO.getAllFavouriteNotice()");		

		return $Result;
	}

	public function getNamefromCategoryID($id)
	{
		return $this->_AddSubscriberDAO->getNamefromCategoryID($id);
	}

	public function getNoticefromNoticeID($id)
	{
		return $this->_AddSubscriberDAO->getNoticefromNoticeID($id);
	}

	public function getNamefromSubscriberID($id)
	{
		return $this->_AddSubscriberDAO->getNamefromSubscriberID($id);
	}

	public function getNamefromPublisherID($id)
	{
		return $this->_AddSubscriberDAO->getNamefromPublisherID($id);
	}

	public function getImagefromPublisherID($id)
	{
		return $this->_AddSubscriberDAO->getImagefromPublisherID($id);
	}

	public function getInstituteFromID($id)
	{
		return $this->_AddSubscriberDAO->getInstituteFromID($id);
	}

	public function getGroupNameFromCatID($id){
		return $this->_AddSubscriberDAO->getGroupNameFromCatID($id);
	}

	public function getSubscriberImage($id){
		return $this->_AddSubscriberDAO->getSubscriberImage($id);
	}

	public function UpdateNoticeStatus($Notice){
		$Result = new Result();	
		$Result = $this->_AddSubscriberDAO->UpdateNoticeStatus($Notice);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in FileDAO.UpdateNoticeStatus()");		

		return $Result;
	}

}
//echo '<br> log:: exit the class.addpublisherbao.php';
?>