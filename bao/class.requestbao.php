<?php

include_once '/../util/class.util.php';
include_once '/../dao/class.requestdao.php';

/*
	Role Business Object 
*/
Class RequestBAO{

	private $_DB;
	private $_RequestDAO;
	
	function RequestBAO(){

		$this->_RequestDAO = new RequestDAO();

	}

	public function sentRequest($Request){

		$Result = new Result();	
		$Result = $this->_RequestDAO->sentRequest($Request);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in sentRequest.sentRequest()");		

		return $Result;
	}

	public function sentPublisherRequest($RequestPublisher){
		
		$Result = new Result();	
		$Result = $this->_RequestDAO->sentPublisherRequest($RequestPublisher);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in sentRequest.sentPublisherRequest()");		

		return $Result;
	}

	public function SubscriberCheck($Request){
		return $this->_RequestDAO->SubscriberCheck($Request);
	}

	public function PublisherCheck($RequestPublisher){
		return $this->_RequestDAO->PublisherCheck($RequestPublisher);
	}
//Subscriber Request Page
	public function getAllRequestOfSubscriber($ID){
		$Result = new Result();	
		$Result = $this->_RequestDAO->getAllRequestOfSubscriber($ID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in getAllRequestOfSubscriber.getAllRequestOfSubscriber()");		

		return $Result;
	}

	public function getAllRequestOfPublisher($ID){
		$Result = new Result();	
		$Result = $this->_RequestDAO->getAllRequestOfPublisher($ID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in getAllRequestOfPublisher.getAllRequestOfPublisher()");		

		return $Result;
	}


	public function getCategoryIDFromRequest($b){

		return $this->_AddSubscriberDAO->getCategoryIDFromRequest($b);
	}

	public function UpdateRequestSubscriber($Request){

		$Result = new Result();	
		$Result = $this->_RequestDAO->UpdateRequestSubscriber($Request);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in updateRequestSubscriber.UpdateRequestSubscriber()");		

		return $Result;
	}

	public function UpdateRequestPublisher($RequestPublisher){

		$Result = new Result();	
		$Result = $this->_RequestDAO->UpdateRequestPublisher($RequestPublisher);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in updateRequestPublisher.UpdateRequestPublisher()");		

		return $Result;
	}

	public function deleteRequestSubscriber($Request){
		$Result = new Result();	
		$Result = $this->_RequestDAO->deleteRequestSubscriber($Request);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in deleteRequestSubscriber.deleteRequestSubscriber()");		

		return $Result;
	}

	public function deleteRequestPublisher($RequestPublisher){
		$Result = new Result();	
		$Result = $this->_RequestDAO->deleteRequestPublisher($RequestPublisher);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in deleteRequestPublisher.deleteRequestPublisher()");		

		return $Result;
	}
}
//echo '<br> log:: exit the class.Requestbao.php';
?>