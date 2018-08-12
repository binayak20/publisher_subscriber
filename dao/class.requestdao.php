<?php
// write dao object for each class
include_once '/../common/class.common.php';
include_once '/../util/class.util.php';

Class RequestDAO{

	private $_DB;
	private $_Request;
	private $_RequestPublisher;

	function RequestDAO(){

		$this->_DB = DBUtil::getInstance();
		$this->_Request= new Request();
		$this->_RequestPublisher= new RequestPublisher();

	}

	public function sentRequest($Request){

		$ReqID        = $Request->getRequestID();
		$InstituteID  = $Request->getInstituteID();
		$SubscriberID = $Request->getSubscriberID();	
		$CatID        = $Request->getCatID();
		$Status       = $Request->getStatus();
		
		$RequestQuery = "SELECT * FROM tbl_request WHERE SubscriberID = '$SubscriberID' and CatID = '$CatID'  LIMIT 1";
		$RequestQuery = $this->_DB->doQuery($RequestQuery);

		$rows = $this->_DB->getAllRows();
		
		if (sizeof($rows) == 1) {
			//echo "You Sent Already a Request in this Category";

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($RequestQuery);
		return $Result;
		}
		else
		{
		$SQL = "INSERT INTO tbl_request(ReqID,InstituteID,SubscriberID,CatID,Status) VALUES ('$ReqID','$InstituteID','$SubscriberID','$CatID','$Status')";

		$SQL = $this->_DB->doQuery($SQL);
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);
		return $Result;
	   }
	}

	public function sentPublisherRequest($RequestPublisher){

		$ReqID        = $RequestPublisher->getRequestID();
		$InstituteID  = $RequestPublisher->getInstituteID();
		$OrganizerID  = $RequestPublisher->getOrganizerID();
		$PublisherID  = $RequestPublisher->getPublisherID();	
		$CatID        = $RequestPublisher->getCatID();
		$Status       = $RequestPublisher->getStatus();
		
		$PublisherRequestQuery = "SELECT * FROM tbl_request_pub WHERE PublisherID = '$PublisherID' and CatID = '$CatID'  LIMIT 1";
		$PublisherRequestQuery = $this->_DB->doQuery($PublisherRequestQuery);

		$rows = $this->_DB->getAllRows();
		
		if (sizeof($rows) == 1) {
			//echo "You Sent Already a Request in this Category";

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($PublisherRequestQuery);
		return $Result;
		}
		else
		{
		$SQL = "INSERT INTO tbl_request_pub(ReqID,InstituteID,OrganizerID,PublisherID,CatID,Status) VALUES ('$ReqID','$InstituteID','$OrganizerID','$PublisherID','$CatID','$Status')";

		$SQL = $this->_DB->doQuery($SQL);
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);
		return $Result;
	   }
	}

//Subscriber Approval page
	public function getAllRequestOfSubscriber($ID){
		$RequestList = array();

		$this->_DB->doQuery("SELECT r.* FROM tbl_request r, tbl_new_publisher p WHERE 
			p.PublisherID = '".$ID."' and p.CategoryID = r.CatID and r.Status = '2' ");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Request = new Request();

		    $this->_Request->setSubscriberID($row['SubscriberID']);
		    $this->_Request->setCatID( $row['CatID']);
		    $this->_Request->setInstituteID( $row['InstituteID']);

		    $RequestList[]=$this->_Request;
   
		}

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($RequestList);

		return $Result;

	}

	public function getAllRequestOfPublisher($ID){
		$RequestPublisherList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_request_pub  WHERE OrganizerID = '".$ID."' 
	     and Status = '2' ");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_RequestPublisher = new RequestPublisher();

		    $this->_RequestPublisher->setPublisherID($row['PublisherID']);
		    $this->_RequestPublisher->setCatID( $row['CatID']);
		    $this->_RequestPublisher->setInstituteID( $row['InstituteID']);

		    $RequestPublisherList[] = $this->_RequestPublisher;
   
		}

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($RequestPublisherList);

		return $Result;

	}

	public function getCategoryIDFromRequest($b){

		$this->_DB->doQuery("SELECT CatID FROM tbl_request Where SubscriberID = '".$b."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		for ($i=0; $i<sizeof($rows); $i++)
		{
			$row = $rows[$i];
		}
		return $row['CatID'];
	}

	public function UpdateRequestSubscriber($Request){

		$SQL = "UPDATE  tbl_request SET Status = '1' WHERE SubscriberID ='".$Request->getSubscriberID()."' AND CatID = '".$Request->getCatID()."' ";

		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	public function UpdateRequestPublisher($RequestPublisher){

		$SQL = "UPDATE  tbl_request_pub SET Status = '1' WHERE PublisherID ='".$RequestPublisher->getPublisherID()."' AND CatID = '".$RequestPublisher->getCatID()."' ";

		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	public function deleteRequestSubscriber($Request){
	   // echo $Subcategory->getCatID();
		$SQL = "DELETE from tbl_request where SubscriberID ='".$Request->getSubscriberID()."' ";
	
		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	public function deleteRequestPublisher($RequestPublisher){
	   // echo $Subcategory->getCatID();
		$SQL = "DELETE from tbl_request_pub where PublisherID ='".$RequestPublisher->getPublisherID()."' ";
	
		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	public function SubscriberCheck($Request){

		$SQL = "SELECT SubscriberID,CatID FROM tbl_request WHERE SubscriberID ='".$Request->getSubscriberID()."' AND  CatID ='".$Request->getCatID()."'";

		$SQL = $this->_DB->doQuery($SQL);
		$rows = $this->_DB->getAllRows();

		if (sizeof($rows) > 0 ) {
			return true;
		}else{
			return false;
		}
	}

	public function PublisherCheck($RequestPublisher){

		$SQL = "SELECT PublisherID,CatID FROM tbl_request_pub WHERE PublisherID ='".$RequestPublisher->getPublisherID()."' AND  CatID ='".$RequestPublisher->getCatID()."'";

		$SQL = $this->_DB->doQuery($SQL);
		$rows = $this->_DB->getAllRows();

		if (sizeof($rows) > 0 ) {
			return true;
		}else{
			return false;
		}
	}
	
}
//echo '<br> log:: exit the class.Requestdao.php';
?>