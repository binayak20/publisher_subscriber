<?php
// write dao object for each class
include_once '/../common/class.common.php';
include_once '/../util/class.util.php';

Class AddSubscriberDAO{

	private $_DB;
	private $_AddSubscriber;

	function AddSubscriberDAO(){

		$this->_DB = DBUtil::getInstance();
		$this->_AddSubscriber= new AddSubscriber();
	}

	public function createAddSubscriber($AddSubscriber){
		//echo "Binayak";

		$InstituteID  = $AddSubscriber->getInstituteID();	
		$CategoryID   = $AddSubscriber->getCategoryID();
		$SubscriberID = $AddSubscriber->getSubscriberID();

		$SubscriberQuery = "SELECT * FROM tbl_add_subscriber WHERE SubscriberID = '$SubscriberID' and CategoryID = '$CategoryID'  LIMIT 1";
		$SubscriberQuery = $this->_DB->doQuery($SubscriberQuery);

		$rows = $this->_DB->getAllRows();
		
		if (sizeof($rows) == 1) {
			echo "You are alredy a Subscriber in this Category";

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SubscriberQuery);


		return $Result;
		}
		else
		{
		$SQL = "INSERT INTO tbl_add_subscriber(InstituteID,CategoryID,SubscriberID) VALUES ('$InstituteID','$CategoryID','$SubscriberID')";


		$SQL = $this->_DB->doQuery($SQL);

		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);


		return $Result;
	}

	}

	public function getNamefromSubscriberID($id)
	{
		$this->_DB->doQuery("SELECT * FROM tbl_user Where ID = '".$id."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		for ($i=0; $i<sizeof($rows); $i++)
		{
			$row = $rows[$i];
		}

		return $row['FirstName']." ".$row['LastName'];
	}

	public function getNamefromPublisherID($id)
	{
		$this->_DB->doQuery("SELECT * FROM tbl_user Where ID = '".$id."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		for ($i=0; $i<sizeof($rows); $i++)
		{
			$row = $rows[$i];
		}

		return $row['FirstName']." ".$row['LastName'];
	}

	public function getEmailfromSubscriberID($id){

		$this->_DB->doQuery("SELECT * FROM tbl_user Where ID = '".$id."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		for ($i=0; $i<sizeof($rows); $i++)
		{
			$row = $rows[$i];
		}

		return $row['Email'];
	}

	public function getSelectedNotice($CatID){

		$NoticeList = array();
		$this->_DB->doQuery("SELECT * FROM tbl_notice Where ChildCatID = '".$CatID."' ORDER BY date DESC ");

		$rows = $this->_DB->getAllRows();
		$row = '';
		//$row = $rows[0];
		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Notice = new Notice();

		    $this->_Notice->setID ( $row['ID']);
		    $this->_Notice->setChildCatID ( $row['ChildCatID']);
		    $this->_Notice->setPubCatID ( $row['PubCatID']);
		    $this->_Notice->setPublisherID( $row['PublisherID'] );
		    $this->_Notice->setNotice( $row['Notice'] );


		    $NoticeList[]=$this->_Notice;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($NoticeList);

		return $Result;
	}

	public function getAllShowNotice($id){
		$NoticeList = array();
		$this->_DB->doQuery("SELECT n.* FROM tbl_notice as n, tbl_add_subscriber as ads Where ads.CategoryID = n.ChildCatID and ads.SubscriberID = '".$id."' ORDER BY date DESC");

		$rows = $this->_DB->getAllRows();
		$row = '';
		//$row = $rows[0];
		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Notice = new Notice();

		    $this->_Notice->setID ( $row['ID']);
		    $this->_Notice->setChildCatID ( $row['ChildCatID']);
		    $this->_Notice->setPubCatID ( $row['PubCatID']);
		    $this->_Notice->setPublisherID( $row['PublisherID'] );
		    $this->_Notice->setNotice( $row['Notice'] );
		    $this->_Notice->setImage( $row['Image'] );

		    $NoticeList[]=$this->_Notice;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($NoticeList);

		return $Result;
	}
	public function getFavouriteNotice($id){
		$NoticeList = array();
		$this->_DB->doQuery("SELECT * FROM tbl_notice Where ID = '".$id."' LIMIT 1");

		$rows = $this->_DB->getAllRows();
		$row = '';
		//$row = $rows[0];
		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Notice = new Notice();

		    $this->_Notice->setID ( $row['ID']);
		    $this->_Notice->setChildCatID ( $row['ChildCatID']);
		    $this->_Notice->setPubCatID ( $row['PubCatID']);
		    $this->_Notice->setPublisherID( $row['PublisherID'] );
		    $this->_Notice->setNotice( $row['Notice'] );
		    $this->_Notice->setImage( $row['Image'] );

		    $NoticeList[]=$this->_Notice;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($NoticeList);

		return $Result;
	}

	public function getAllFavouriteNotice($id){

		$NoticeList = array();
		$this->_DB->doQuery("SELECT fn.* FROM tbl_favourite_notice as fn, tbl_add_subscriber as ads,tbl_notice as n Where ads.SubscriberID = fn.SubscriberID and fn.FNoticeID = n.ID and fn.SubscriberID = '".$id."' and n.ChildCatID = ads.CategoryID ");

		$rows = $this->_DB->getAllRows();
		$row = '';
		//$row = $rows[0];
		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_FavouriteNotice = new FavouriteNotice();

		    $this->_FavouriteNotice->setFavouriteNoticeID ( $row['FNoticeID']);
		    $this->_FavouriteNotice->setSubscriberID ( $row['SubscriberID']);
		   

		    $NoticeList[]=$this->_FavouriteNotice;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($NoticeList);

		return $Result;
	}

	public function getNamefromCategoryID($id)
	{
		$this->_DB->doQuery("SELECT * FROM tbl_child_cat Where CatID = '".$id."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		for ($i=0; $i<sizeof($rows); $i++)
		{
			$row = $rows[$i];
		}
		return $row['Name'];
	}

	public function getNoticefromNoticeID($id)
	{
		$this->_DB->doQuery("SELECT * FROM tbl_notice Where ID = '".$id."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		for ($i=0; $i<sizeof($rows); $i++)
		{
			$row = $rows[$i];
		}
		return $row['Notice'];
	}

	// public function getNamefromSubscriberID($id)
	// {
	// 	$this->_DB->doQuery("SELECT * FROM tbl_user Where ID = '".$id."' ");
	// 	$rows = $this->_DB->getAllRows();
	// 	$row = '';
	// 	for ($i=0; $i<sizeof($rows); $i++)
	// 	{
	// 		$row = $rows[$i];
	// 	}

	// 	return $row['FirstName']." ".$row['LastName'];
	// }

	public function getImagefromPublisherID($id){
		$this->_DB->doQuery("SELECT * FROM tbl_profileimage Where UserID = '".$id."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		for ($i=0; $i<sizeof($rows); $i++)
		{
			$row = $rows[$i];
		}

		return $row['Image'];
	}

	public function getInstituteFromID($id){

		$this->_DB->doQuery("SELECT * FROM tbl_institution Where ID = '".$id."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		for ($i=0; $i<sizeof($rows); $i++)
		{
			$row = $rows[$i];
		}

		return $row['Name'];
	}

	public function getGroupNameFromCatID($id){

		$this->_DB->doQuery("SELECT * FROM tbl_child_cat Where CatID = '".$id."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		for ($i=0; $i<sizeof($rows); $i++)
		{
			$row = $rows[$i];
		}

		return $row['Name'];
	}
//Publisher NAme


	public function getSubscriberImage($id){

		$this->_DB->doQuery("SELECT * FROM tbl_profileimage Where UserID = '".$id."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		for ($i = 0; $i<sizeof($rows); $i++)
		{
			$row = $rows[$i];
		}

		return $row['Image'];
	}

	public function UpdateNoticeStatus($Notice){
		$SQL = "UPDATE  tbl_notice SET Status = '0' WHERE PubCatID ='".$Notice->getPubCatID()."' ";


		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}
	
}
//echo '<br> log:: exit the class.addsubscriberdao.php';
?>