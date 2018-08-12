<?php
// write dao object for each class
include_once '/../common/class.common.php';
include_once '/../util/class.util.php';

Class NewPublisherDAO{

	private $_DB;
	private $_NewPublisher;
	private $_Subcategory;

	function NewPublisherDAO(){

		$this->_DB = DBUtil::getInstance();
		$this->_NewPublisher = new NewPublisher();
		$this->_Subcategory  = new Subcategory();
	}

	public function createNewPublisher($NewPublisher){

		$InstituteID = $NewPublisher->getInstituteID();	
		$CategoryID  = $NewPublisher->getCategoryID();
		$PublisherID = $NewPublisher->getPublisherID();

		$SQL = "INSERT INTO tbl_new_publisher(InstituteID,CategoryID,PublisherID) VALUES ('$InstituteID','$CategoryID','$PublisherID')";


		$SQL = $this->_DB->doQuery($SQL);

		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}
	public function readPublisherData($NewPublisher){
		$SQL = "SELECT * FROM tbl_new_publisher WHERE CategoryID ='".$NewPublisher->getCategoryID()."'";
		$this->_DB->doQuery($SQL);

		//reading the top row for this user from the database
		$row = $this->_DB->getTopRow();

		$this->_NewPublisher = new NewPublisher();

		//preparing the user object
	    $this->_NewPublisher->setInstituteID ( $row['InstituteID']);	      
	    $this->_NewPublisher->setCategoryID ( $row['CategoryID'] );
	    $this->_NewPublisher->setPublisherID ( $row['PublisherID'] );

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($this->_NewPublisher);

		return $Result;
	}

	public function updatPublisher($NewPublisher,$catID){
		$SQL = "UPDATE tbl_new_publisher SET
		 
	    PublisherID = '".$NewPublisher->getPublisherID()."'	    

		WHERE CategoryID = '".$catID."' ";

		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);
		return $Result;
	}

	public function CheckPublisher($NewPublisher){

		$CategoryQuery = "SELECT CategoryID FROM tbl_new_publisher WHERE CategoryID = '".$NewPublisher->getCategoryID()."'";
		$CategoryQuery = $this->_DB->doQuery($CategoryQuery);

		$rows = $this->_DB->getAllRows();
		
		if (sizeof($rows) > 0) {
			return true;
			//echo "Here exist alredy a publisher in this Category";
		}else{
			return false;
		}
	 
	}

	public function CheckNotice($FavouriteNotice){
		$CategoryQuery = "SELECT * FROM tbl_favourite_notice WHERE FNoticeID = '".$FavouriteNotice->getFavouriteNoticeID()."' and SubscriberID = '".$FavouriteNotice->getSubscriberID()."' ";
		$CategoryQuery = $this->_DB->doQuery($CategoryQuery);

		$rows = $this->_DB->getAllRows();
		
		if (sizeof($rows) > 0) {
			return true;
			//echo "Here exist alredy a publisher in this Category";
		}else{
			return false;
		}
	}

	public function addFavouriteNotice($FavouriteNotice){

		$FNoticeID    = $FavouriteNotice->getFavouriteNoticeID();
		$SubscriberID = $FavouriteNotice->getSubscriberID();

		$SQL = "INSERT INTO tbl_favourite_notice(FNoticeID,SubscriberID) VALUES ('$FNoticeID','$SubscriberID' )";

		$SQL = $this->_DB->doQuery($SQL);
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);
		return $Result;
	}

	public function createNotice($Notice){

		$ID       = $Notice->getID();
		$ChildID  = $Notice->getChildCatID();
		$PubCatID = $Notice->getPubCatID();
		$PubID    = $Notice->getPublisherID();
		$Status   = $Notice->getStatus();
		$Not      = $Notice->getNotice();
		$Img      = $Notice->getImage();
	
		$SQL = "INSERT INTO tbl_notice(ID,ChildCatID,PubCatID,PublisherID,Status,Notice,Image) VALUES('$ID','$ChildID','$PubCatID','$PubID','$Status','$Not','$Img')";

		$SQL = $this->_DB->doQuery($SQL);		
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	//Data insert into notification table
	
	public function createPostNotification($PostNotification){

		$SubscriberID = $PostNotification->getSubscriberID();
		$SubCatID     = $PostNotification->getSubCatID();
		$Status       = $PostNotification->getStatus();
		$Notice       = $PostNotification->getNotice();
	
		$SQL = "INSERT INTO tbl_post_notification(SubscriberID,SubCatID,Status,Notice) VALUES('$SubscriberID','$SubCatID','$Status','$Notice')";

		$SQL = $this->_DB->doQuery($SQL);		
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	//For Post Notification
	
	public function getUserIDForNotification($childCatID){
		$con = mysqli_connect("localhost","root","","publish_subscription");
		$result = mysqli_query($con, "SELECT * FROM tbl_add_subscriber where CategoryID = '$childCatID'");
		$a = 1;
		while($row = mysqli_fetch_assoc($result))
		{
			$a = $row['SubscriberID'];	
		}
		return $a;
	}

	public function getAllNotice($PublisherID,$catId){

		$NoticeList = array();
		$this->_DB->doQuery("SELECT * FROM tbl_notice where PublisherID = '$PublisherID' AND ChildCatID ='$catId' ");
		$rows = $this->_DB->getAllRows();

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
	public function getAllNoticeByPiblisherID($ID){
		$NoticeList = array();
		$this->_DB->doQuery("SELECT * FROM tbl_notice where PublisherID = '$ID' ");
		$rows = $this->_DB->getAllRows();

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

	// public function addFile($File){
	// 	$ID    = $File->getID();
	// 	$cID   = $File->getCategoryID();
	// 	$pID   = $File->getPublisherID();
	// 	$pName = $File->getPublisherName();
	// 	$Image = $File->getImage();
	
	// 	$SQL = "INSERT INTO tbl_file(ID,CategoryID,PublisherID,PublisherName,Image) VALUES('$ID','$cID','$pID','$pName','$Image')";

	// 	$SQL = $this->_DB->doQuery($SQL);		
		
	//  	$Result = new Result();
	// 	$Result->setIsSuccess(1);
	// 	$Result->setResultObject($SQL);

	// 	return $Result;
	// }

	public function readNoticeByCategory($Notice){
		$NoticeList = array();
		$SQL = "SELECT * FROM tbl_notice WHERE ID ='".$Notice->getID()."' ";
		$this->_DB->doQuery($SQL);
		
		$row = $this->_DB->getTopRow();
		//reading the top row for this user from the database
		
		$this->_Notice = new Notice();

		//preparing the user object
	    $this->_Notice->setID ( $row['ID']);
	    $this->_Notice->setChildCatID ( $row['ChildCatID'] );    
	    $this->_Notice->setPubCatID ( $row['PubCatID'] );
	    $this->_Notice->setPublisherID( $row['PublisherID'] );
	    $this->_Notice->setNotice( $row['Notice'] );
		   

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($this->_Notice);

		return $Result;
	}

	public function PublisherIDfromCategoryID($id)
	{
		$con = mysqli_connect("localhost","root","","publish_subscription");
		$result = mysqli_query($con, "SELECT * FROM tbl_new_publisher where CategoryID = '$id'");
		$a = 1;
		while($row = mysqli_fetch_assoc($result))
		{
			$a = $row['PublisherID'];	
		}
		return $a;
	}
//Subscriber Count
	public function getSubscriberCount($id)
	{
		$con = mysqli_connect("localhost","root","","publish_subscription");
		$result = mysqli_query($con,"SELECT count(*) as total FROM tbl_add_subscriber Where CategoryID = '".$id."' ");
		$data = mysqli_fetch_assoc($result);
		return $data['total'];		
	}

	public function getSubscriberRequestCount($id)
	{
		$con = mysqli_connect("localhost","root","","publish_subscription");
		$result = mysqli_query($con,"SELECT count(*) as total FROM tbl_request as r, tbl_new_publisher as np  Where r.CatID = np.CategoryID AND np.PublisherID = '".$id."' AND r.Status = 2 ");
		$data = mysqli_fetch_assoc($result);
		return $data['total'];
	}

	public function findChild ($a){

	 	$GLOBALS['c'] = array();
	 	$children     = array();

		 array_push($children, $a);

		 if (hasChild($a) == true) 
		 {	
		 	$value = $GLOBALS['c'];
		 	for($i = 0; $i < count($value); $i++) {
		 		
		 		array_push($children, $value[0]);
		 		$g =  hasChild($value[0]);
		 		array_splice($GLOBALS['c'], 0, 1);
		 		$value = $GLOBALS['c'];
		 		$i = -1;
		 	}
		 }
		 return $children;
    }

    public function updateNotice($Notice){
    	$SQL = "UPDATE tbl_notice SET
	            Notice = '".$Notice->getNotice()."'
		        WHERE ID = '".$Notice->getID()."' ";

		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);
		return $Result;
    }

    public function deleteNotice($Notice){
    	$SQL = "DELETE from tbl_notice WHERE ID = '".$Notice->getID()."' ";

    	$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
    }

    public function getNoticeStatus($catID){
    	$NoticeList = array();

		$this->_DB->doQuery("SELECT Status FROM tbl_notice  WHERE ChildCatID = '".$catID."' and Status = '1' ");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Notice = new Notice();

		    $this->_Notice->setStatus ( $row['Status']);

		    $NoticeList[]=$this->_Notice;
   
		}

		//todo: LOG util with level of log


		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($NoticeList);

		return $Result;
    }

    public function deleteSubcategory($Subcategory){

       // echo $Subcategory->getCatID();
		$SQL = "DELETE from tbl_child_cat where CatID = '".$Subcategory->getCatID()."' ";
	
		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}

	public function getAllPublisher($InsId){
		$PublisherList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_new_publisher  WHERE InstituteID = '".$InsId."' ");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_NewPublisher = new NewPublisher();

			$this->_NewPublisher->setInstituteID( $row['InstituteID']);
			$this->_NewPublisher->setCategoryID( $row['CategoryID']);
		    $this->_NewPublisher->setPublisherID($row['PublisherID']);
		    
		    

		    $PublisherList[] = $this->_NewPublisher;
   
		}

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($PublisherList);

		return $Result;
		
	}
}

    function hasChild($parent){

		$con    = mysqli_connect("localhost","root","","publish_subscription");
		$flag   = false;
		$result = mysqli_query($con, "SELECT * FROM tbl_child_cat where ParentID = '$parent'");

		if (mysqli_num_rows($result) > 0)
		{
			$flag = true;
			while ($row = mysqli_fetch_assoc($result))
			{
				array_push($GLOBALS['c'], $row['CatID']);
			}
		}

		return $flag;
	}



	/*public function getPublisherIDFromNewPublisher($PublisherID){
		$this->_DB->doQuery("SELECT * FROM tbl_new_publisher Where PublisherID = '$PublisherID' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		for ($i=0; $i<sizeof($rows); $i++)
		{
			$row = $rows[$i];
		}
		return $row['PublisherID'];
	}*/
	

//echo '<br> log:: exit the class.newpublisherdao.php';
?>